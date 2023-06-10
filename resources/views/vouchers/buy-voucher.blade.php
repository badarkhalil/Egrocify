<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>
  <body>

    <div class="container-fluid mt-4 ">
        {{-- <form name="jsform" method="post" action="https://sandbox.jazzcash.com.pk/CustomerPortal/transactionmanagement/merchantform/">
            <!-- For Card Tokenization Version should be 2.0 -->
            <div class="formFielWrapper">
                <input type="hidden" name="pp_Version" value="1.1" readonly="true">
            </div>
            <div class="formFielWrapper">
                <input type="hidden" name="pp_TxnType" value="">
            </div>

            <input type="hidden" name="pp_TokenizedCardNumber" value="">
            <input type="hidden" name="pp_CustomerID" value="">
            <input type="hidden" name="pp_CustomerEmail" value="">
            <input type="hidden" name="pp_CustomerMobile" value="">

            <!-- For Card Tokenization 2.0. Uncomment below 5 fields pp_IsRegisteredCustomer, pp_TokenizedCardNumber, pp_CustomerID, pp_CustomerEmail, pp_CustomerMobile -->
            <!--
            <div class="formFielWrapper">
            <label class="active">pp_IsRegisteredCustomer: </label>
            <input type="text" name="pp_IsRegisteredCustomer" value="No">
            </div>

            <div class="formFielWrapper">
            <label class="">pp_TokenizedCardNumber: </label>
            <input type="text" name="pp_TokenizedCardNumber" value="">
            </div>

            <div class="formFielWrapper">
            <label class="">pp_CustomerID: </label>
            <input type="text" name="pp_CustomerID" value="">
            </div>

            <div class="formFielWrapper">
            <label class="">pp_CustomerEmail: </label>
            <input type="text" name="pp_CustomerEmail" value="">
            </div>

            <div class="formFielWrapper">
            <label class="">pp_CustomerMobile: </label>
            <input type="text" name="pp_CustomerMobile" value="">
            </div>
            -->



            <div class="formFielWrapper">
                <input type="hidden" name="pp_MerchantID" value="{{ $voucher->pp_MerchantID }}">
            </div>

            <div class="formFielWrapper">
                <input type="hidden" name="pp_Language" value="EN">
            </div>

            <div class="formFielWrapper">
                <input type="hidden" name="pp_SubMerchantID" value="">
            </div>

            <div class="formFielWrapper">
                <input type="hidden" name="pp_Password" value="{{ $voucher->pp_Password }}">
            </div>

            <div class="formFielWrapper">
                <input type="hidden" name="pp_TxnRefNo" id="pp_TxnRefNo" value="{{ $voucher->pp_TxnRefNo }}">
            </div>

            <div class="formFielWrapper">
                <input type="hidden" name="pp_Amount" value="{{ $voucher->pp_Amount }}">
            </div>

            <div class="formFielWrapper">
                <input type="hidden" name="pp_DiscountedAmount" value="">
            </div>

            <div class="formFielWrapper">
                <input type="hidden" name="pp_DiscountBank" value="">
            </div>

            <div class="formFielWrapper">
                <input type="hidden" name="pp_TxnCurrency" value="PKR">
            </div>

            <div class="formFielWrapper">
                <input type="hidden" name="pp_TxnDateTime" id="pp_TxnDateTime" value="{{ $voucher->pp_TxnDateTime }}">
            </div>

            <div class="formFielWrapper">
                <input type="hidden" name="pp_TxnExpiryDateTime" id="pp_TxnExpiryDateTime" value="{{ $voucher->pp_TxnExpiryDateTime }}">
            </div>

            <div class="formFielWrapper">
                <input type="hidden" name="pp_BillReference" value="billRef">
            </div>

            <div class="formFielWrapper">
                <input type="hidden" name="pp_Description" value="Description of transaction">
            </div>

            <div class="formFielWrapper">
                <input type="hidden" name="pp_ReturnURL" value="{{ $voucher->pp_ReturnURL }}">
            </div>


            <div class="formFielWrapper">
                <input type="hidden" name="pp_SecureHash" value="{{ $voucher->pp_SecureHash }}">
            </div>

            <div class="formFielWrapper">
                <input type="hidden" name="ppmpf_1" value="{{ $voucher->ppmpf_1 }}">
            </div>

            <div class="formFielWrapper">
                <input type="hidden" name="ppmpf_2" value="{{ $voucher->ppmpf_2 }}">
            </div>

            <div class="formFielWrapper">
                <input type="hidden" name="ppmpf_3" value="{{ $voucher->ppmpf_3 }}">
            </div>

            <div class="formFielWrapper">
                <input type="hidden" name="ppmpf_4" value="{{ $voucher->ppmpf_4 }}">
            </div>
            <input type="hidden" name="pp_IsRegisteredCustomer" value="" />
            <input type="hidden" name="pp_BankID" value="" />
            <input type="hidden" name="pp_ProductID" value="" />

            <div class="formFielWrapper">
                <input type="hidden" name="ppmpf_5" value="{{ $voucher->ppmpf_5 }}">
            </div>
            <input type="hidden" name="salt" value="{{ $voucher->salt }}">
            <div class="formFielWrapper" style="margin-bottom: 2rem;">
                <input type="hidden" id="hashValuesString" value="">
                <br><br>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 text-center" >
                    <img src="{{ asset('public/logo_JazzCash.png') }}" height="50" class="mx-auto"  alt="">
                </div>
                <div class="col-md-12 col-lg-12 mt-3">
                    <div class="card border-success">
                      <div class="card-body">
                        <h5 class="card-title">{{ $voucher->voucher_title }}</h5>
                        <table class="table">
                            <tr>
                                <td><p class="card-text">Price:</p></td>
                                <td><b  style="text-decoration: line-through;" class="text-danger">PKR {{ $voucher->voucher_price }} /-</b></td>
                            </tr>
                            <tr>
                                <td><p class="card-text">Discount:</p></td>
                                <td><b class="text-success">PKR {{ $voucher->voucher_discounted_price }} /-</b></td>
                            </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                <div class="col-sm-12 col-md-12 mt-4">
                    <button type="button"  onclick="submitForm()" class="btn btn-danger form-control">Pay with Jazzcash</button>
                </div>
            </div>


        </form> --}}
        <form name="jsform" class=" jazz_cash_btn payment_btns" action="https://payments.jazzcash.com.pk/CustomerPortal/transactionmanagement/merchantform/"
        method="POST">
        @foreach($post_data as $key=> $data)
            <input type="hidden" name="{{ $key }}"
                value="{{ $data }}">
        @endforeach
        <div class="row ">
            <div class="col-sm-12 col-md-12 text-center" >
                <img src="{{ asset('public/logo_JazzCash.png') }}" height="50" class="mx-auto"  alt="">
            </div>
            <div class="col-md-12 col-lg-12 mt-3 d-none">
                <div class="card border-success">
                  <div class="card-body">
                    <h5 class="card-title">{{ $voucher->voucher_title }}</h5>
                    <table class="table">
                        <tr>
                            <td><p class="card-text">Price:</p></td>
                            <td><b  style="text-decoration: line-through;" class="text-danger">PKR {{ $voucher->voucher_price }} /-</b></td>
                        </tr>
                        <tr>
                            <td><p class="card-text">Discount:</p></td>
                            <td><b class="text-success">PKR {{ $voucher->voucher_discounted_price }} /-</b></td>
                        </tr>
                    </table>
                  </div>
                </div>
              </div>
            <div class="col-sm-12 col-md-12 mt-4">
                <button type="submit" class="btn btn-danger form-control">Pay with Jazzcash</button>
            </div>
          </div>
      </form>
   			<div class="row ">
              <div class="col-sm-12 col-md-12 text-center" >
                  <img src="{{ asset('public/easypaisa.png') }}" height="50" class="mx-auto"  alt="">
              </div>
              <div class="col-sm-12 col-md-12 mt-4">
                  <button type="submit" class="btn btn-success form-control">Pay with Easypaisa <small>( Coming Soon )</small>	</button>
              </div>
          </div>
      
      <div class="row ">
              <div class="col-sm-12 col-md-12 text-center" >
                  <img src="{{ asset('public/alfa.png') }}" height="50" class="mx-auto"  alt="">
              </div>
              <div class="col-sm-12 col-md-12 ">
                  <button type="submit" class="btn btn-danger form-control">Pay with Alfa pay <small>( Coming Soon )</small>	</button>
              </div>
          </div>

    <!-- Include Bootstrap JS -->
    <script defer async src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer async src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script defer async src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



  </body>
</html>






