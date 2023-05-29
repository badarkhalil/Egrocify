<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Voucher;
use App\Models\VoucherBuyer;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\CentralLogics\Helpers;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Order;
use Throwable;

class VoucherController extends Controller
{
    public function index(){
        $vouchers = Voucher::latest()->paginate(config('default_pagination'));

        return view('admin-views.vouchers.index',compact('vouchers'));
    }
    public function add(){
        $vouchers = Voucher::latest()->paginate(config('default_pagination'));
        return view('admin-views.vouchers.add',compact('vouchers'));
    }
    public function store(Request $request){
        try{
            $request->validate([
                "voucher_title" => "required",
                "voucher_price" => "required",
                "voucher_discounted_price" => "required",
                "voucher_image" => "required",
            ]);
            $voucher_image = null;
            if ($request->hasFile('voucher_image')) {
                $file = $request->file('voucher_image');
                $voucher_image = Helpers::upload('voucher/', $file->getClientOriginalExtension(), $request->file('voucher_image'));
            }
            Voucher::create([
                "voucher_title" => $request->voucher_title,
                "voucher_price" => $request->voucher_price,
                "voucher_discounted_price" => $request->voucher_discounted_price,
                "voucher_image" => $voucher_image,
              	"zone_id" => $request->zone_id,
            ]);
            Toastr::success("Voucher has been created successfully");
            return redirect()->route('admin.business-settings.vouchers');
        }catch(Throwable $th){
            Toastr::error($th->getMessage());
            return back();
        }
    }
    public function edit(Voucher $voucher){
        return view('admin-views.vouchers.edit',compact('voucher'));
    }
    public function update($id, Request $request){
        try{
            $request->validate([
                "voucher_title" => "required",
                "voucher_price" => "required",
                "voucher_discounted_price" => "required",
            ]);
            $voucher_image = Voucher::where('id',$id)->first()->voucher_image;
            if ($request->hasFile('voucher_image')) {
                $file = $request->file('voucher_image');
                $voucher_image = Helpers::update('voucher/',$voucher_image, $file->getClientOriginalExtension(), $request->file('voucher_image'));
            }
            Voucher::where("id",$id)->update([
                "voucher_title" => $request->voucher_title,
                "voucher_price" => $request->voucher_price,
                "voucher_discounted_price" => $request->voucher_discounted_price,
                "voucher_image" => $voucher_image,
              	"zone_id" => $request->zone_id,
            ]);

            Toastr::success("Voucher has been updated successfully");
            return redirect()->route('admin.business-settings.vouchers');
        }catch(Throwable $th){
            Toastr::error($th->getMessage());
            return back();
        }
    }
    public function delete($id){
        try{
            Voucher::where('id',$id)->delete();
            Toastr::error("Voucher has been deleted successfully");
            return redirect()->route('admin.business-settings.vouchers');
        }catch(Throwable $th){
            Toastr::error($th->getMessage());
            return back();
        }
    }

    public function buyerList ($id)
    {
        $vouchers = VoucherBuyer::where('voucher_id',$id)->get();
        return view('admin-views.vouchers.buyerList',compact('vouchers'));

    }
    public function accept($id){
        $vouchers = VoucherBuyer::where('id',$id)->update(["status" => 1]);
        Toastr::success("Voucher has been accepted successfully");
        return back();
    }
    public function reject($id){
        $vouchers = VoucherBuyer::where('id',$id)->update(["status" => 2]);
        Toastr::success("Voucher has been rejected successfully");
        return back();
    }
    public function active($id){
         Voucher::where('id',$id)->update(["voucher_status" => 1]);
         Toastr::success("Voucher status has been inactivated");
         return back();
    }
    public function inactive($id){
        Voucher::where('id',$id)->update(["voucher_status" => 0]);
        Toastr::success("Voucher status has been activated");
        return back();

    }


    public function search(Request $request){
        $key = explode(' ', $request['search']);
        $vouchers=Voucher::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('voucher_title', 'like', "%{$value}%");
            }
        })->limit(50)->get();
        return response()->json([
            'view'=>view('admin-views.vouchers.partials._table',compact('vouchers'))->render(),
            'count'=>$vouchers->count()
        ]);
    }
    public function buyVoucher(Request $request)
    {
        $voucher = Voucher::where('id',$request->voucher_id)->first();
        $DateTime = new \DateTime();
        $pp_TxnDateTime = $DateTime->format('YmdHis');

        $ExpiryDateTime = $DateTime;
        $ExpiryDateTime->modify('+' . 24 . ' hours');
        $pp_TxnExpiryDateTime = $ExpiryDateTime->format('YmdHis');

        $pp_TxnRefNo = 'T' . $pp_TxnDateTime;

        $pp_Amount = ($voucher->voucher_discounted_price *100);

        $post_data = [
            "pp_Version" => config('jazz_cash.VERSION'),
            "pp_TxnType" => "",
            "pp_Language" => config('jazz_cash.LANGUAGE'),
            "pp_MerchantID" => config('jazz_cash.MERCHANT_ID'),
            "pp_SubMerchantID" => "",
            "pp_Password" => config('jazz_cash.PASSWORD'),
            "pp_BankID" => "",
            "pp_ProductID" => "",
            "pp_IsRegisteredCustomer" => "No",
            "pp_TokenizedCardNumber" => "",
            "pp_TxnRefNo" => $pp_TxnRefNo,
            "pp_Amount" => $pp_Amount,
            "pp_TxnCurrency" => config('jazz_cash.CURRENCY_CODE'),
            "pp_TxnDateTime" => $pp_TxnDateTime,
            "pp_BillReference" => "billRef",
            "pp_Description" => "Description of transaction",
            "pp_TxnExpiryDateTime" => $pp_TxnExpiryDateTime,
            "pp_ReturnURL" => config('jazz_cash.RETURN_URL'),
            "pp_SecureHash" => "",
            "ppmpf_1" => $request->user_id,
            "ppmpf_2" => $voucher->id,
            "ppmpf_3" => "3",
            "ppmpf_4" => "4",
            "ppmpf_5" => "5",
            "pp_CustomerID" => "Test",
            "pp_CustomerEmail" => "test@gmail.com",
            "pp_CustomerMobile" => "0343456789",
        ];
      //  return $this->get_SecureHash($post_data);
        $post_data['pp_SecureHash'] = $this->get_SecureHash($post_data);
        /*
                $jc->set_data($post_data);
                $jc->send();*/
        return view('vouchers.buy-voucher',compact('voucher','post_data'));
    }
    private function get_SecureHash($data_array)
    {
        ksort($data_array);

        $str = '';
        foreach ($data_array as $key => $value) {
            if (!empty($value)) {
                $str = $str . '&' . $value;
            }
        }

        $str = config('jazz_cash.INTEGERITY_SALT') . $str;
        return hash_hmac('sha256', $str, config('jazz_cash.INTEGERITY_SALT'));
    }


    public function paymentStatus(Request $request){
		$response = $request->all();
        if($request->pp_ResponseCode == 000){
          if(((int)$response["ppmpf_3"]) == -1){
          	     $order = Order::where('id', $response["ppmpf_1"])->update([
                 			"payment_status" => "paid",
                   			"payment_method" => "digital_payment",
                   			"transaction_reference" => $response["pp_TxnRefNo"]
                 ]);
               	$voucher = new Voucher;
                $voucher->pp_ResponseCode = $response["pp_ResponseCode"];
                $voucher->pp_Amount = (((double)$response["pp_Amount"])/100);
                $voucher->pp_ResponseMessage = $response["pp_ResponseMessage"];
                $voucher->pp_TxnRefNo = $response["pp_TxnRefNo"];
            	return view('vouchers.success',compact('voucher'));
          }else{
              $voucher = VoucherBuyer::create([
                  'user_id' => $response["ppmpf_1"],
                  'voucher_id' => $response["ppmpf_2"],
                  'pp_TxnRefNo' => $response["pp_TxnRefNo"],
                  'pp_Amount' => (((double)$response["pp_Amount"])/100),
                  'status' => 0,
              ]);
            	return view('vouchers.success',compact('voucher'));
            }
            
        }else{
       
            $voucher = new Voucher;
            $voucher->pp_ResponseCode = $response["pp_ResponseCode"];
            $voucher->pp_Amount = (((double)$response["pp_Amount"])/100);
            $voucher->pp_ResponseMessage = $response["pp_ResponseMessage"];
            $voucher->pp_TxnRefNo = $response["pp_TxnRefNo"];

            return view('vouchers.error',compact('voucher'));

        }


    }

    public function sharevoucher(Request $request){
       	VoucherBuyer::where('id', $request->voucher)->increment('count');
        $link = 'https://play.google.com/store/apps/details/Facebook?id=com.facebook.katana&hl=en&gl=US';
        return redirect($link);
    }




}

