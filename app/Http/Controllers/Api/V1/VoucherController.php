<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Models\VoucherBuyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Throwable;
use App\CentralLogics\CustomerLogic;
use Illuminate\Support\Facades\Mail;

class VoucherController extends Controller
{
    public function buy(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'voucher_id' => 'required|exists:vouchers,id',
        ],[
            'user_id.required' => 'The User ID field is required.',
            'voucher_id.required' => 'The Voucher ID field is required.',
            'user_id.exists' => 'The User ID field is invalid.',
            'voucher_id.exists' => 'The Voucher ID field is invalid.',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        try{
            VoucherBuyer::create([
                "user_id" => $request->user_id,
                "voucher_id" => $request->voucher_id,
            ]);
            return response()->json(['message' => "Voucher Bought Successfuly"], 200);
        }catch(Throwable $th){
            return response()->json(['message' => $th->getMessage()], 200);
        }


    }

    public function voucherList(Request $request){
         if (!$request->hasHeader('zoneId')) {
            $errors = [];
            array_push($errors, ['code' => 'zoneId', 'message' => translate('messages.zone_id_required')]);
            return response()->json([
                'errors' => $errors
            ], 200);
        }
        $zone_id= $request->header('zoneId');
        $user_id = Auth::user()->id;
        $vouchers = Voucher::where('voucher_status',1)
                            ->whereNotIn('id',VoucherBuyer::where('user_id', $user_id)->get()->pluck("voucher_id"))
          					->whereIn('zone_id',json_decode($zone_id, true))
                            ->get();
        foreach ($vouchers as $voucher) {
                $voucher->isBought = false;
        }
        return response()->json(['message' => "Voucher List","vouchers" => $vouchers,"user" =>Auth::user()], 200);
    }

    public function getBoughtList(){
        $vouchers = VoucherBuyer::where('user_id',Auth::user()->id)
                                    ->orderBy('created_at','desc')
                                    ->get();
        return response()->json(['message' => "Voucher List","vouchers" => $vouchers], 200);
    }

    public function redeem(Request $request){
        $voucher = VoucherBuyer::where('user_id',Auth::user()->id)
                    ->where('voucher_id',$request->voucher_id)
                    ->first();
        if($voucher->status == 1){
            $wallet_transaction = CustomerLogic::create_wallet_transaction(Auth::user()->id, $voucher->voucher->voucher_price, 'add_fund_by_admin',"Redeemed Voucher , ID: ".$voucher->id);
            $voucher->status = 3;
            $voucher->save();
            if($wallet_transaction)
            {
                try{
                    if(config('mail.status')) {
                        Mail::to($wallet_transaction->user->email)->send(new \App\Mail\AddFundToWallet($wallet_transaction));
                    }
                }catch(\Exception $ex)
                {
                    info($ex);
                }

                return response()->json(['message' => "Redeemed Successfully, PKR ".$voucher->voucher->voucher_price." /- Added to Wallet"], 200);
            }

            return response()->json(['errors'=>[
                'message'=>"Failed, please try again"
            ]], 200);
        }else if($voucher->status == 2){
            $wallet_transaction = CustomerLogic::create_wallet_transaction(Auth::user()->id, $voucher->voucher->voucher_discounted_price, 'add_fund_by_admin',"Redeemed Voucher , ID: ".$voucher->id);
            $voucher->status = 3;
            $voucher->save();
            if($wallet_transaction)
            {
                try{
                    if(config('mail.status')) {
                        Mail::to($wallet_transaction->user->email)->send(new \App\Mail\AddFundToWallet($wallet_transaction));
                    }
                }catch(\Exception $ex)
                {
                    info($ex);
                }

                return response()->json(['message' => "Redeemed Successfully, PKR ".$voucher->voucher->voucher_discounted_price." /- Added to Wallet"], 200);

            }

            return response()->json(['errors'=>[
                'message'=>"Failed, please try again later"
            ]], 200);
        }

        return response()->json(['message' => "Voucher current status is pending, or it has already redeemed"], 200);

    }
}
