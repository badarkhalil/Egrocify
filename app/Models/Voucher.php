<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = ["voucher_title","voucher_price","voucher_discounted_price","voucher_status","voucher_image","zond_id"];

    public function totalBuyer(){
        return VoucherBuyer::where('voucher_id',$this->id)->count();
    }


}
