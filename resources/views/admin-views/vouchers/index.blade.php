@extends('layouts.admin.app')

@section('title',"Vouchers")

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{asset('public/assets/admin/img/module.png')}}" alt="">
                </span>
                <span>
                    Vouchers
                </span>
                <span class="badge badge-soft-dark ml-2" id="itemCount">{{$vouchers->total()}}</span>
            </h1>
            <a href="{{ route('admin.business-settings.voucher.add') }}" class="btn btn-primary mr-3">Add Voucher <i ></i></a>
        </div>
        <!-- End Page Header -->
        <div class="card">

        <!-- Header -->
        <div class="card-header border-0 py-2">
            <div class="search--button-wrapper justify-content-end">
                <form id="search-form" class="search-form">
                    @csrf
                    <!-- Search -->
                    <div class="input-group input--group">
                        <input id="datatableSearch" name="search" type="search" class="form-control" placeholder="{{translate('ex_:_search_name')}}" aria-label="{{translate('messages.search_here')}}" value="{{request()->query('search')}}">
                        <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                    </div>
                    <!-- End Search -->
                </form>
                <div class="hs-unfold mr-2">
                    {{-- <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle min-height-40" href="javascript:;"
                        data-hs-unfold-options='{
                                "target": "#usersExportDropdown",
                                "type": "css-animation"
                            }'>
                        <i class="tio-download-to mr-1"></i> {{ translate('messages.export') }}
                    </a> --}}

                    <div id="usersExportDropdown"
                        class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                        {{-- <span class="dropdown-header">{{ translate('messages.options') }}</span>
                        <a id="export-copy" class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                src="{{ asset('public/assets/admin') }}/svg/illustrations/copy.svg"
                                alt="Image Description">
                            {{ translate('messages.copy') }}
                        </a>
                        <a id="export-print" class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                src="{{ asset('public/assets/admin') }}/svg/illustrations/print.svg"
                                alt="Image Description">
                            {{ translate('messages.print') }}
                        </a>
                        <div class="dropdown-divider"></div> --}}
                        <span class="dropdown-header">{{ translate('messages.download') }}
                            {{ translate('messages.options') }}</span>
                        {{-- <a id="export-excel" class="dropdown-item" href="{{route('admin.business-settings.module.export', ['type'=>'excel'])}}"> --}}
                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                src="{{ asset('public/assets/admin') }}/svg/components/excel.svg"
                                alt="Image Description">
                            {{ translate('messages.excel') }}
                        </a>
                        {{-- <a id="export-csv" class="dropdown-item" href="{{route('admin.business-settings.module.export', ['type'=>'csv'])}}"> --}}
                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                src="{{ asset('public/assets/admin') }}/svg/components/placeholder-csv-format.svg"
                                alt="Image Description">
                            .{{ translate('messages.csv') }}
                        </a>
                        {{-- <a id="export-pdf" class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                src="{{ asset('public/assets/admin') }}/svg/components/pdf.svg"
                                alt="Image Description">
                            {{ translate('messages.pdf') }}
                        </a> --}}
                    </div>
                </div>
                <!-- End Unfold -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Header -->
            <div class="card-body p-0">
                <div class="table-responsive datatable-custom">
                    <table id="columnSearchDatatable"
                        class="table table-borderless table-thead-bordered table-align-middle"
                        data-hs-datatables-options='{
                            "isResponsive": false,
                            "isShowPaging": false,
                            "paging":false,
                        }'>
                        <thead class="thead-light border-0">
                            <tr>
                                <th class="border-0 pl-4 w--05">SL</th>
                                <th class="border-0 w--1">ID</th>
                                <th class="border-0 w--2">Voucher Title</th>
                                <th class="border-0 w--2">Voucher Image</th>
                                <th class="border-0 w--2">Voucher Price</th>
                                <th class="border-0 w--1">Discounted Price</th>
                                <th class="border-0 w--2">Zone</th>
                                <th class="border-0 text-center w--2">Total Buyer</th>
                                <th class="border-0 text-center w--2">Buyer List</th>
                                <th class="border-0 text-center w--2">Active</th>
                                <th class="border-0 text-center w--15">{{translate('messages.action')}}</th>
                            </tr>
                        </thead>

                        <tbody id="table-div">
                        @foreach($vouchers as $key=>$module)
                            <tr>
                                <td class="pl-4">{{$key+$vouchers->firstItem()}}</td>
                                <td>{{$module->id}}</td>
                                <td>
                                    <span class="d-block font-size-sm text-body">
                                        {{Str::limit($module['voucher_title'], 20,'...')}}
                                    </span>
                                </td>
                                <td>
                                    <img width="80" height="80" src="{{ asset('public/storage/voucher') }}/{{ $module["voucher_image"] }}" alt="">
                                </td>
                                <td>
                                    <span class="d-block font-size-sm text-body text-capitalize">
                                        {{ $module["voucher_price"] }}
                                    </span>
                                </td>
                                <td>
                                    <span class="d-block font-size-sm text-body text-capitalize">
                                        {{ $module["voucher_discounted_price"] }}
                                    </span>
                                </td>
                              	<td>
                                  	@php $zone = App\Models\Zone::where('id',$module['zone_id'])->first();   @endphp
                                    {{ $zone->name ?? 'No-Zone' }}
                              	</td>
                                <td>
                                    <span class="d-block font-size-sm text-body text-capitalize">
                                        {{ $module->totalBuyer() }}
                                    </span>
                                </td>
                                <td>
                                   @if ($module->voucher_status == 1)
                                        <a href="{{ route('admin.business-settings.voucher.inactive',$module->id) }}" class="btn btn-sm btn-danger">Mark Inactive</a>
                                    @else
                                        <a href="{{ route('admin.business-settings.voucher.active',$module->id) }}" class="btn btn-sm btn-success">Mark Active</a>
                                   @endif
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm"
                                        href="{{route('admin.business-settings.voucher.buyerlist',[$module['id']])}}" title="View Buyers"><i class="tio-visible-outlined"></i>
                                    </a>
                                </td>
                                <td>
                                    <div class="btn--container justify-content-center">
                                        <a class="btn action-btn btn--primary btn-outline-primary"
                                            href="{{route('admin.business-settings.voucher.edit',[$module['id']])}}" title="Edit Voucher"><i class="tio-edit"></i>
                                        </a>
                                        <a class="btn action-btn btn--danger btn-outline-danger"
                                            href="{{route('admin.business-settings.voucher.delete',[$module['id']])}}" title="Delete Voucher"><i class="tio-delete-outlined"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer page-area">
                <!-- Pagination -->
                <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                    <div class="col-sm-auto">
                        <div class="d-flex justify-content-center justify-content-sm-end">
                            <!-- Pagination -->
                            {!! $vouchers->links() !!}
                        </div>
                    </div>
                </div>
                <!-- End Pagination -->
                @if(count($vouchers) === 0)
                <div class="empty--data">
                    <img style="height: 100px;width:100px;" src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
                    <h5>
                        {{translate('no_data_found')}}
                    </h5>
                </div>
                @endif
            </div>
        </div>

    </div>

@endsection

@push('script_2')
    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================

            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>
        <script>
            $('#search-form').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post({
                    url: '{{route('admin.business-settings.voucher.search')}}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#loading').show();
                    },
                    success: function (data) {
                        $('.page-area').hide();
                        $('#table-div').html(data.view);
                        $('#itemCount').html(data.count);
                    },
                    complete: function () {
                        $('#loading').hide();
                    },
                });
            });
        </script>
@endpush
