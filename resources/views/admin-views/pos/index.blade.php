<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @php($business_name = \App\Models\BusinessSetting::where(['key'=>'business_name'])->first()->value)
    <!-- Title -->
    <title>{{$business_name}} | {{translate('messages.pos_system')}}</title>
    <!-- Favicon -->
    @php($logo=\App\Models\BusinessSetting::where(['key'=>'icon'])->first()->value)
    <link rel="icon" type="image/x-icon" href="{{asset('storage/app/public/business/'.$logo??'')}}">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('public/assets/admin')}}/css/vendor.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/admin')}}/vendor/icon-set/style.css">
    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{asset('public/assets/admin')}}/css/theme.minc619.css?v=1.0">

    <script src="{{asset('public/assets/admin')}}/js/vendor.min.js"></script>
    <script src="{{asset('public/assets/admin')}}/js/theme.min.js"></script>
    <script src="{{asset('public/assets/admin')}}/js/sweet_alert.js"></script>
    <script src="{{asset('public/assets/admin')}}/js/toastr.js"></script>
    @stack('css_or_js')

    <style>
        .scroll-bar {
            max-height: calc(100vh - 100px);
            overflow-y: auto !important;
        }

        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 1px #cfcfcf;
            /*border-radius: 5px;*/
        }

        ::-webkit-scrollbar {
            width: 3px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            /*border-radius: 5px;*/
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #FC6A57;
        }
        .deco-none {
            color: inherit;
            text-decoration: inherit;
        }
        .qcont{
            text-transform: lowercase;
        }
        .qcont:first-letter {
            text-transform: capitalize;
        }



        .navbar-vertical .nav-link {
            color: #ffffff;
        }

        .navbar .nav-link:hover {
            color: #C6FFC1;
        }

        .navbar .active > .nav-link, .navbar .nav-link.active, .navbar .nav-link.show, .navbar .show > .nav-link {
            color: #C6FFC1;
        }

        .navbar-vertical .active .nav-indicator-icon, .navbar-vertical .nav-link:hover .nav-indicator-icon, .navbar-vertical .show > .nav-link > .nav-indicator-icon {
            color: #C6FFC1;
        }

        .nav-subtitle {
            display: block;
            color: #fffbdf91;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .03125rem;
        }

        .navbar-vertical .navbar-nav.nav-tabs .active .nav-link, .navbar-vertical .navbar-nav.nav-tabs .active.nav-link {
            border-left-color: #C6FFC1;
        }
        .item-box{
            height:250px;
            width:150px;
            padding:3px;
        }

        .header-item{
            width:10rem;
        }

        .cursor-pointer{
            cursor: pointer;
        }

        .select2-selection--single {
            height: 100% !important;
        }
        .select2-selection__rendered{
            word-wrap: break-word !important;
            text-overflow: inherit !important;
            white-space: normal !important;
        }
    </style>

    <script src="{{asset('public/assets/admin')}}/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js"></script>
    <link rel="stylesheet" href="{{asset('public/assets/admin')}}/css/toastr.css">
</head>

<body class="footer-offset">

{{--loader--}}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="loading" style="display: none;">
                <div style="position: fixed;z-index: 9999; left: 40%;top: 37% ;width: 100%">
                    <img width="200" src="{{asset('public/assets/admin/img/loader.gif')}}">
                </div>
            </div>
        </div>
    </div>
</div>
{{--loader--}}

<!-- JS Preview mode only -->
    <header id="header"
            class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-flush navbar-container navbar-bordered">
        <div class="navbar-nav-wrap">
            <div class="navbar-brand-wrapper">
                <!-- Logo Div-->
                @php($store_logo = \App\Models\BusinessSetting::where(['key' => 'logo'])->first()->value)
                <a class="navbar-brand" href="{{route('admin.dashboard')}}" aria-label="">
                    <img class="" style="max-height: 48px; border-radius: 8px"
                         onerror="this.src='{{asset('public/assets/admin/img/160x160/img1.jpg')}}'"
                         src="{{asset('storage/app/public/business/'.$store_logo)}}" alt="Logo">
                </a>
            </div>

            <!-- Secondary Content -->
            <div class="navbar-nav-wrap-content-right">
                <!-- Navbar -->
                <ul class="navbar-nav align-items-center flex-row">
                    <li class="nav-item d-none d-sm-inline-block">
                        <!-- Notification -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                               href="{{route('admin.pos.orders')}}">
                                <i class="tio-shopping-cart-outlined"></i>
                                {{--<span class="btn-status btn-sm-status btn-status-danger"></span>--}}
                            </a>
                        </div>
                        <!-- End Notification -->
                    </li>

                    <li class="nav-item">
                        <!-- Account -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker navbar-dropdown-account-wrapper" href="javascript:;"
                               data-hs-unfold-options='{
                                     "target": "#accountNavbarDropdown",
                                     "type": "css-animation"
                                   }'>
                                <div class="avatar avatar-sm avatar-circle">
                                    <img class="avatar-img"
                                        onerror="this.src='{{asset('public/assets/admin/img/160x160/img1.jpg')}}'"
                                        src="{{asset('storage/app/public/admin/'.auth('admin')->user()->image)}}"
                                        alt="Image Description">
                                    <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                </div>
                            </a>

                            <div id="accountNavbarDropdown"
                                 class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-account"
                                 style="width: 16rem;">
                                <div class="dropdown-item-text">
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-sm avatar-circle mr-2">
                                            <img class="avatar-img"
                                                 onerror="this.src='{{asset('public/assets/admin/img/160x160/img1.jpg')}}'"
                                                 src="{{asset('storage/app/public/admin/'.auth('admin')->user()->image)}}"
                                                 alt="Owner image">
                                        </div>
                                        <div class="media-body">
                                            <span class="card-title h5">{{auth('admin')->user()->f_name}}</span>
                                            <span class="card-text">{{auth('admin')->user()->email}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{route('admin.settings')}}">
                                    <span class="text-truncate pr-2" title="Settings">{{translate('messages.settings')}}</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="javascript:" onclick="Swal.fire({
                                    title: '{{translate("logout_warning_message")}}',
                                    showDenyButton: true,
                                    showCancelButton: true,
                                    confirmButtonColor: '#FC6A57',
                                    cancelButtonColor: '#363636',
                                    confirmButtonText: `Yes`,
                                    denyButtonText: `Don't Logout`,
                                    }).then((result) => {
                                    if (result.value) {
                                    location.href='{{route('admin.auth.logout')}}';
                                    } else{
                                    Swal.fire('Canceled', '', 'info')
                                    }
                                    })">
                                    <span class="text-truncate pr-2" title="Sign out">{{translate('messages.sign_out')}}</span>
                                </a>
                            </div>
                        </div>
                        <!-- End Account -->
                    </li>
                </ul>
                <!-- End Navbar -->
            </div>
            <!-- End Secondary Content -->
        </div>
    </header>
<!-- END ONLY DEV -->

<main id="content" role="main" class="main pointer-event">
<!-- Content -->
	<!-- ========================= SECTION CONTENT ========================= -->
	<section class="section-content padding-y-sm bg-default mt-1">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 card padding-y-sm card ">
                    <div class="card-header d-flex flex-wrap  w-100">
                        <div class="row w-100 justify-content-around">
                            <div class="col-sm-6 col-12 mb-2">
                                <form id="search-form" class="form-control">
                                    <!-- Search -->
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch" type="search" value="{{$keyword?$keyword:''}}" name="search" class="form-control" placeholder="{{translate('messages.search_here')}}" aria-label="{{translate('messages.search_here')}}">
                                    </div>
                                    <!-- End Search -->
                                </form>                                
                            </div>
                            <div class="col-sm-6 col-12 mb-2">
                                <select name="module_id" class="form-control js-select2-custom" onchange="set_filter('{{url()->full()}}',this.value,'module_id')" title="{{translate('messages.select')}} {{translate('messages.modules')}}">
                                    <option value="" {{!request('module_id') ? 'selected':''}}>{{translate('messages.select_a_module')}}</option>
                                    @foreach (\App\Models\Module::notParcel()->get() as $module)
                                        <option
                                            value="{{$module->id}}" {{request('module_id') == $module->id?'selected':''}}>
                                            {{$module['module_name']}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 col-12 mb-2">
                                <select name="store_id" id="store_select" onchange="set_filter('{{url()->full()}}',this.value, 'store_id')" data-placeholder="{{translate('messages.select')}} {{translate('messages.store')}}" class="js-data-example-ajax form-control">
                                    @if($store)    
                                    <option value="{{$store->id}}" selected>{{$store->name}}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6 col-12 mb-2">
                                <select name="category" id="category" class="form-control js-select2-custom mx-1" title="{{translate('messages.select')}} {{translate('messages.category')}}" onchange="set_category_filter(this.value)">
                                    <option value="">{{translate('messages.all_categories')}}</option>
                                    @foreach ($categories as $item)
                                    <option value="{{$item->id}}" {{$category==$item->id?'selected':''}}>{{Str::limit($item->name,20 ,'...')}}</option>
                                    @endforeach
                                </select>                              
                            </div>
                        </div>



                    </div>
					<div class="card-body" id="items">
                        <div class="d-flex flex-wrap mt-2 mb-3" style="justify-content: space-around;">
                            @foreach($products as $product)
                                <div class="item-box">
                                    @include('admin-views.pos._single_product',['product'=>$product, 'store_data'=>$store])
                                    {{--<hr class="d-sm-none">--}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        {!!$products->withQueryString()->links()!!}
                    </div>
				</div>
				<div class="col-md-4">
                    <div class="card">
                        <div class="w-100">
                            <div class="d-flex flex-row p-1">
                                <select id='customer' name="customer_id" data-placeholder="{{translate('messages.walk_in_customer')}}" class="js-data-example-ajax form-control">

                                </select>
                                <!-- <button class="btn btn-sm btn-white btn-outline-primary ml-1" type="button" title="{{translate('messages.add_customer')}}">
                                    <i class="tio-add-circle text-dark"></i>
                                </button> -->
                            </div>
                        </div>
                        <div class="row px-1 pb-2">
                            <div class="form-group mt-1 col-12 col-sm mb-0">
                                <button class="w-100 d-inline-block btn btn-success rounded" id="add_new_customer" type="button" data-toggle="modal" data-target="#add-customer" title="Add Customer">
                                    <i class="tio-add-circle-outlined"></i> {{ translate('messages.add_customer')}}
                                </button>
                            </div>
                        </div>
                        <div class='w-100' id="cart">
                            @include('admin-views.pos._cart',['store'=>$store])
                        </div>
                    </div> 
				</div>
			</div>
		</div><!-- container //  -->
	</section>

    <!-- End Content -->
    <div class="modal fade" id="quick-view" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" id="quick-view-modal">

            </div>
        </div>
    </div>



    <div class="modal fade" id="print-invoice" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{translate('messages.print')}} {{translate('messages.invoice')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row" style="font-family: emoji;">
                    <div class="col-md-12">
                        <center>
                            <input type="button" class="btn btn-primary non-printable" onclick="printDiv('printableArea')"
                                value="Proceed, If thermal printer is ready."/>
                            <!-- <a href="{{url()->previous()}}" class="btn btn-danger non-printable">Back</a> -->
                        </center>
                        <hr class="non-printable">
                    </div>
                    <div class="row" id="printableArea" style="margin: auto;">

                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="add-customer" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{translate('add_new_customer')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.pos.customer-store')}}" method="post" id="product_form"
                          >
                        @csrf
                            <div class="row pl-2" >
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label" >{{translate('first_name')}} <span
                                                class="input-label-secondary text-danger">*</span></label>
                                        <input type="text" name="f_name" class="form-control" value="{{ old('f_name') }}"  placeholder="{{translate('first_name')}}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label" >{{translate('last_name')}} <span
                                                class="input-label-secondary text-danger">*</span></label>
                                        <input type="text" name="l_name" class="form-control" value="{{ old('l_name') }}"  placeholder="{{translate('last_name')}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row pl-2" >
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label" >{{translate('email')}}<span
                                            class="input-label-secondary text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"  placeholder="{{translate('Ex_:_ex@example.com')}}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label" >{{translate('phone')}} ({{translate('with_country_code')}})<span
                                            class="input-label-secondary text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"  placeholder="{{translate('phone')}}" required>
                                    </div>
                                </div>
                            </div>
                        <button type="submit" id="submit_new_customer" class="btn btn-primary">{{translate('submit')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>
<!-- ========== END MAIN CONTENT ========== -->

<!-- ========== END SECONDARY CONTENTS ========== -->

<!-- JS Implementing Plugins -->

<!-- JS Front -->

{!! Toastr::message() !!}

@if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif

<!-- JS Plugins Init. -->
<script>
    $(document).on('ready', function () {
        $('#store_select').select2({
            ajax: {
                url: '{{url('/')}}/admin/vendor/get-stores',
                data: function (params) {
                    return {
                        q: params.term, // search term
                        module_id:{{request('module_id')??'null'}},
                        page: params.page
                    };
                },
                processResults: function (data) {
                    return {
                    results: data
                    };
                },
                __port: function (params, success, failure) {
                    var $request = $.ajax(params);

                    $request.then(success);
                    $request.fail(failure);

                    return $request;
                }
            }
        });

        $('.js-hs-unfold-invoker').each(function () {
            var unfold = new HSUnfold($(this)).init();
        });
    });
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }

    function set_category_filter(id) {
        var nurl = new URL('{!!url()->full()!!}');
        nurl.searchParams.set('category_id', id);
        location.href = nurl;
    }


    $('#search-form').on('submit', function (e) {
        e.preventDefault();
        var keyword= $('#datatableSearch').val();
        var nurl = new URL('{!!url()->full()!!}');
        nurl.searchParams.set('keyword', keyword);
        location.href = nurl;
    });

    function addon_quantity_input_toggle(e)
    {
        var cb = $(e.target);
        if(cb.is(":checked"))
        {
            cb.siblings('.addon-quantity-input').css({'visibility':'visible'});
        }
        else
        {
            cb.siblings('.addon-quantity-input').css({'visibility':'hidden'});
        }
    }
    function quickView(product_id) {
        $.get({
            url: '{{route('admin.pos.quick-view')}}',
            dataType: 'json',
            data: {
                product_id: product_id
            },
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                console.log("success...")
                $('#quick-view').modal('show');
                $('#quick-view-modal').empty().html(data.view);
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    }

    function quickViewCartItem(product_id, item_key) {
        $.get({
            url: '{{route('admin.pos.quick-view-cart-item')}}',
            dataType: 'json',
            data: {
                product_id: product_id,
                item_key: item_key
            },
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                console.log("success...")
                $('#quick-view').modal('show');
                $('#quick-view-modal').empty().html(data.view);
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    }

    function checkAddToCartValidity() {
        var names = {};
        $('#add-to-cart-form input:radio').each(function () { // find unique names
            names[$(this).attr('name')] = true;
        });
        var count = 0;
        $.each(names, function () { // then count them
            count++;
        });
        if ($('input:radio:checked').length == count) {
            return true;
        }
        return false;
    }

    function cartQuantityInitialize() {
        $('.btn-number').click(function (e) {
            e.preventDefault();

            var fieldName = $(this).attr('data-field');
            var type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());

            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });

        $('.input-number').focusin(function () {
            $(this).data('oldValue', $(this).val());
        });

        $('.input-number').change(function () {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            var name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Cart',
                    text: 'Sorry, the minimum value was reached'
                });
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Cart',
                    text: 'Sorry, stock limit exceeded.'
                });
                $(this).val($(this).data('oldValue'));
            }
        });
        $(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    }

    function getVariantPrice() {
        if ($('#add-to-cart-form input[name=quantity]').val() > 0 && checkAddToCartValidity()) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{ route('admin.pos.variant_price') }}',
                data: $('#add-to-cart-form').serializeArray(),
                success: function (data) {
                    $('#add-to-cart-form #chosen_price_div').removeClass('d-none');
                    $('#add-to-cart-form #chosen_price_div #chosen_price').html(data.price);
                }
            });
        }
    }

    function addToCart(form_id = 'add-to-cart-form') {
        if (checkAddToCartValidity()) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
                url: '{{ route('admin.pos.add-to-cart') }}',
                data: $('#' + form_id).serializeArray(),
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    if (data.data == 1) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Cart',
                            text: "{{translate('messages.product_already_added_in_cart')}}"
                        });
                        return false;
                    } 
                    else if (data.data == 2) {
                        updateCart();
                        Swal.fire({
                            icon: 'info',
                            title: 'Cart',
                            text: "{{translate('messages.product_has_been_updated_in_cart')}}"
                        });
                        
                        return false;
                    } 
                    else if (data.data == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Cart',
                            text: '{{translate("Sorry, product out of stock")}}.'
                        });
                        return false;
                    }
                    else if (data.data == -1) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Cart',
                            text: '{{translate("Sorry, you can not add multiple stores data in same cart")}}.'
                        });
                        return false;
                    }
                    $('.call-when-done').click();

                    toastr.success('{{translate('messages.product_has_been_added_in_cart')}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });

                    updateCart();
                },
                complete: function () {
                    $('#loading').hide();
                }
            });
        } else {
            Swal.fire({
                type: 'info',
                title: 'Cart',
                text: 'Please choose all the options'
            });
        }
    }

    function removeFromCart(key) {
        $.post('{{ route('admin.pos.remove-from-cart') }}', {_token: '{{ csrf_token() }}', key: key}, function (data) {
            if (data.errors) {
                for (var i = 0; i < data.errors.length; i++) {
                    toastr.error(data.errors[i].message, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            } else {
                updateCart();
                toastr.info('{{translate('messages.item_has_been_removed_from_cart')}}', {
                    CloseButton: true,
                    ProgressBar: true
                });
            }

        });
    }

    function emptyCart() {
        $.post('{{ route('admin.pos.emptyCart') }}', {_token: '{{ csrf_token() }}'}, function (data) {
            updateCart();
            toastr.info('Item has been removed from cart', {
                CloseButton: true,
                ProgressBar: true
            });
        });
    }

    function updateCart() {
        $.post('<?php echo e(route('admin.pos.cart_items')); ?>?store_id={{request()->store_id}}', {_token: '<?php echo e(csrf_token()); ?>'}, function (data) {
            $('#cart').empty().html(data);
        });
    }

   $(function(){
        $(document).on('click','input[type=number]',function(){ this.select(); });
    });


    function updateQuantity(e){
        var element = $( e.target );
        var minValue = parseInt(element.attr('min'));
        // maxValue = parseInt(element.attr('max'));
        var valueCurrent = parseInt(element.val());

        var key = element.data('key');
        if (valueCurrent >= minValue) {
            $.post('{{ route('admin.pos.updateQuantity') }}', {_token: '{{ csrf_token() }}', key: key, quantity:valueCurrent}, function (data) {
                updateCart();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Cart',
                text: 'Sorry, the minimum value was reached'
            });
            element.val(element.data('oldValue'));
        }
        // if (valueCurrent <= maxValue) {
        //     $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        // } else {
        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Cart',
        //         text: 'Sorry, stock limit exceeded.'
        //     });
        //     $(this).val($(this).data('oldValue'));
        // }
    

        // Allow: backspace, delete, tab, escape, enter and .
        if(e.type == 'keydown')
        {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        }

    };

    // INITIALIZATION OF SELECT2
    // =======================================================
    $('.js-select2-custom').each(function () {
        var select2 = $.HSCore.components.HSSelect2.init($(this));
    });

    $('#customer').select2({
        ajax: {
            url: '{{route('admin.pos.customers')}}',
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data) {
                return {
                results: data
                };
            },
            __port: function (params, success, failure) {
                var $request = $.ajax(params);

                $request.then(success);
                $request.fail(failure);

                return $request;
            }
        }
    });

    $( "#customer" ).change(function() {
        if($(this).val())
        {
            $('#customer_id').val($(this).val());
        }
    });

    function set_filter(url, id, filter_by) {
        var nurl = new URL(url);
        nurl.searchParams.set(filter_by, id);
        location.href = nurl;
    }

    function print_invoice(order_id) {
        $.get({
            url: '{{url('/')}}/admin/pos/invoice/'+order_id,
            dataType: 'json',
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                console.log("success...")
                $('#print-invoice').modal('show');
                $('#printableArea').empty().html(data.view);
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    }

    @if (session('last_order'))
    print_invoice("{{session('last_order')}}")
    @php(session(['last_order'=> false]))
    @endif
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{\App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value}}&libraries=places&callback=initMap&v=3.45.8"></script>
<script>
    function initMap() {
        let map = new google.maps.Map(document.getElementById("map"), {
                zoom: 13,
                center: { lat: {{$store?$store['latitude']:'23.757989'}}, lng: {{$store?$store['longitude']:'90.360587'}} }
            });   

        //get current location block
        let infoWindow = new google.maps.InfoWindow();
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                myLatlng = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                infoWindow.setPosition(myLatlng);
                infoWindow.setContent("Location found.");
                infoWindow.open(map);
                map.setCenter(myLatlng);
            },
            () => {
                handleLocationError(true, infoWindow, map.getCenter());
                }
            );
        } else {
        // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
        //-----end block------
        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
        let markers = [];
        const bounds = new google.maps.LatLngBounds();
        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();

            if (places.length == 0) {
            return;
            }
            // Clear out the old markers.
            markers.forEach((marker) => {
            marker.setMap(null);
            });
            markers = [];
            // For each place, get the icon, name and location.
            places.forEach((place) => {
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                const icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25),
                };
                // Create a marker for each place.
                markers.push(
                    new google.maps.Marker({
                    map,
                    icon,
                    title: place.name,
                    position: place.geometry.location,
                    })
                );

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
        @if ($store)
            $.get({
                url: '{{url('/')}}/admin/zone/get-coordinates/{{$store->zone_id}}',
                dataType: 'json',
                success: function (data) {
                    let = zonePolygon = new google.maps.Polygon({
                        paths: data.coordinates,
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: 'white',
                        fillOpacity: 0,
                    });
                    zonePolygon.setMap(map);
                    zonePolygon.getPaths().forEach(function(path) {
                        path.forEach(function(latlng) {
                            bounds.extend(latlng);
                            map.fitBounds(bounds);
                        });
                    });
                    map.setCenter(data.center);
                    google.maps.event.addListener(zonePolygon, 'click', function (mapsMouseEvent) {
                        infoWindow.close();
                        // Create a new InfoWindow.
                        infoWindow = new google.maps.InfoWindow({
                        position: mapsMouseEvent.latLng,
                        content: JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2),
                        });
                        var coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                        var coordinates = JSON.parse(coordinates);

                        document.getElementById('latitude').value = coordinates['lat'];
                        document.getElementById('longitude').value = coordinates['lng'];
                        infoWindow.open(map);
                    });    
                },
            });            
        @endif

    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(
            browserHasGeolocation
            ? "Error: {{translate('The Geolocation service failed')}}."
            : "Error: {{translate("Your browser doesn't support geolocation")}}."
        );
        infoWindow.open(map);
    }

    $("#order_place").on('keydown', function(e){
        if (e.keyCode === 13) {
            e.preventDefault();
        }
    })
</script>

<!-- IE Support -->
<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="{{asset('public/assets/admin')}}/vendor/babel-polyfill/polyfill.min.js"><\/script>');
</script>
</body>
</html>
