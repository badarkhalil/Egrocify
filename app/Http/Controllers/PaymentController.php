<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        if ($request->has('callback')) {
            Order::where(['id' => $request->order_id])->update(['callback' => $request['callback']]);
        }

        session()->put('customer_id', $request['customer_id']);
        session()->put('order_id', $request->order_id);

        $customer = User::find($request['customer_id']);

        $order = Order::where(['id' => $request->order_id, 'user_id' => $request['customer_id']])->first();

        if (isset($customer) && isset($order)) {
            $data = [
                'name' => $customer['f_name'],
                'email' => $customer['email'],
                'phone' => $customer['phone'],
            ];
            session()->put('data', $data);
          
          
          //Jazzcash payment details
          
        $DateTime = new \DateTime();
        $pp_TxnDateTime = $DateTime->format('YmdHis');

        $ExpiryDateTime = $DateTime;
        $ExpiryDateTime->modify('+' . 24 . ' hours');
        $pp_TxnExpiryDateTime = $ExpiryDateTime->format('YmdHis');

        $pp_TxnRefNo = 'T' . $pp_TxnDateTime;

        $pp_Amount = (ceil($order->order_amount) *100);

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
            "ppmpf_1" => $order->id,
            "ppmpf_2" => $request['customer_id'],
            "ppmpf_3" => "-1",
            "ppmpf_4" => "4",
            "ppmpf_5" => "5",
            "pp_CustomerID" => "Test",
            "pp_CustomerEmail" => "test@gmail.com",
            "pp_CustomerMobile" => "0343456789",
        ];
        	$post_data['pp_SecureHash'] = $this->get_SecureHash($post_data);
          
            return view('payment-view',compact('post_data'));
        }

        return response()->json(['errors' => ['code' => 'order-payment', 'message' => 'Data not found']], 403);
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

    public function success()
    {
        $order = Order::where(['id' => session('order_id'), 'user_id'=>session('customer_id')])->first();
        if (isset($order) && $order->callback != null) {
            return redirect($order->callback . '&status=success');
        }
        return response()->json(['message' => 'Payment succeeded'], 200);
    }

    public function fail()
    {
        $order = Order::where(['id' => session('order_id'), 'user_id'=>session('customer_id')])->first();
        if ($order->callback != null) {
            return redirect($order->callback . '&status=fail');
        }
        return response()->json(['message' => 'Payment failed'], 403);
    }
}
