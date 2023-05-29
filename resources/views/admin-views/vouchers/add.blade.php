@extends('layouts.admin.app')

@section('title',"Add Vouchers")

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
                <span class="badge badge-soft-dark ml-2" id="itemCount">Add</span>
            </h1>
        </div>
        <!-- End Page Header -->
        <div class="card">

        <!-- Header -->
        <div class="card-header border-0 py-2">
            <div class="search--button-wrapper justify-content-end">

                <div class="hs-unfold mr-2">


                </div>
                <!-- End Unfold -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Header -->
            <div class="card-body p-0">
                <div class="table-responsive datatable-custom">

                </div>
            </div>
            <div class="card-footer page-area">
                <!-- Pagination -->
                <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                    <div class="container">
                        <div class="">
                            <form action="{{ route('admin.business-settings.voucher.store') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="input-label text-capitalize" for="voucher_title">Voucher Title</label>
                                            <input type="text" class="form-control" id="voucher_title" name="voucher_title" placeholder="Enter Title" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="input-label text-capitalize" for="voucher_price">Voucher Price</label>
                                            <input type="number" class="form-control" min="0" max="1000000" step="0.01" id="voucher_price" name="voucher_price" placeholder="Enter Price" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="input-label text-capitalize" for="voucher_discounted_price">Voucher Discounted Price</label>
                                            <input type="number" class="form-control" min="0" max="1000000" step="0.01" id="voucher_discounted_price" name="voucher_discounted_price" placeholder="Enter Discounted Price" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="input-label text-capitalize" for="zone_id">Select Zone</label>
                                            <select class="form-control"id="zone_id" name="zone_id" required>
                                              	@php $zones = App\Models\Zone::where('status',1)->get();      @endphp
                                              	@foreach($zones as $zone)
                                              		<option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                              	@endforeach
                                          	</select>
                                        </div>
                                    </div>
                                  <div class="col-6"></div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="input-label text-capitalize" for="voucher_discounted_price">Voucher Image</label>
                                            <input type="file" class="form-control" id="voucher_image" name="voucher_image"  required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-primary" type="submit">Add Voucher</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

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

@endpush
