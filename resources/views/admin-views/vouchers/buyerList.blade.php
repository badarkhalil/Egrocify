@extends('layouts.admin.app')

@section('title',"Vouchers Bought")

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
                    Vouchers Bought
                </span>
                <span class="badge badge-soft-dark ml-2" id="itemCount">{{$vouchers->count()}}</span>
            </h1>
        </div>
        <!-- End Page Header -->
        <div class="card">

        <!-- Header -->
        <div class="card-header border-0 py-2">
            <div class="search--button-wrapper justify-content-end">

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
                                <th class="border-0 w--1">ID</th>
                                <th class="border-0 w--2">Count</th>
                                <th class="border-0 w--2">Username</th>
                                <th class="border-0 w--1">Email</th>
                                <th class="border-0 text-center w--15">{{translate('messages.action')}}</th>
                            </tr>
                        </thead>

                        <tbody id="table-div">
                        @foreach($vouchers as $key=>$module)
                            <tr>
                                <td>{{$module->id}}</td>
                                <td> <span class="badge badge-info">{{$module->count}} </span></td>
                                <td>
                                    <span class="d-block font-size-sm text-body text-capitalize">
                                        {{ $module->buyer()->f_name }} {{ $module->buyer()->l_name }}
                                    </span>
                                </td>
                                <td>
                                    <span class="d-block font-size-sm text-body">
                                        {{ $module->buyer()->email }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn--container justify-content-center">
                                        @if($module->status == 0)
                                            <a class="btn btn-sm btn-success"
                                                href="{{route('admin.business-settings.voucher.accept',[$module['id']])}}" title="Accept Voucher">Accept
                                            </a>
                                            <a class="btn btn-sm btn-danger"
                                                href="{{route('admin.business-settings.voucher.reject',[$module['id']])}}" title="Reject Voucher">Reject
                                            </a>
                                        @endif
                                        @if($module->status == 1)
                                            <span class="badge badge-success">Accepted</span>
                                        @endif
                                        @if($module->status == 2)
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
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

                <!-- End Pagination -->
                @if(count($vouchers) === 0)
                <div class="empty--data">
                    <img style="width: 100px;" src="{{asset('/public/assets/admin/svg/illustrations/sorry.svg')}}" alt="public">
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
