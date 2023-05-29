<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherBuyer extends Model
{
    use HasFactory;
    protected $fillable = ["user_id","voucher_id","status","count","pp_TxnRefNo","pp_Amount"];
    protected $appends = ["voucher"];




    public function getVoucherAttribute(){

        return Voucher::where('id',$this->voucher_id)->first();
    }

    public function buyer(){
        return User::where('id',$this->user_id)->first();
    }
}
