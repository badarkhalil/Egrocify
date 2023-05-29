@extends('layouts.admin.app')

@section('title',translate('Update Voucher'))

@push('css_or_js')

@endpush

@section('content')

    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{asset('public/assets/admin/img/edit.png')}}" class="w--26" alt="">
                </span>
                <span>
                    Voucher {{translate('messages.update')}}
                </span>
            </h1>
        </div>
        <!-- End Page Header -->
        <form enctype="multipart/form-data" action="{{route('admin.business-settings.voucher.update', $voucher->id)}}" method="post" id="voucher" class="shadow--card">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="input-label text-capitalize" for="voucher_title">Voucher Title</label>
                        <input type="text" value="{{ $voucher->voucher_title }}" class="form-control" id="voucher_title" name="voucher_title" placeholder="Enter Title" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="input-label text-capitalize" for="voucher_price">Voucher Price</label>
                        <input type="number" value="{{ $voucher->voucher_price }}" class="form-control" min="0" max="1000000" step="0.01" id="voucher_price" name="voucher_price" placeholder="Enter Price" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="input-label text-capitalize" for="voucher_discounted_price">Voucher Discounted Price</label>
                        <input type="number" value="{{ $voucher->voucher_discounted_price }}" class="form-control" min="0" max="1000000" step="0.01" id="voucher_discounted_price" name="voucher_discounted_price" placeholder="Enter Discounted Price" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="input-label text-capitalize" for="voucher_image">Voucher Image <small>(Leave empty if want to keep last image)</small></label>
                        <input type="file" class="form-control" id="voucher_image" name="voucher_image"  >
                    </div>
                </div>
               <div class="col-6">
                     <div class="form-group">
                             <label class="input-label text-capitalize" for="zone_id">Select Zone</label>
                             <select class="form-control"id="zone_id" name="zone_id" required>
                                              	@php $zones = App\Models\Zone::where('status',1)->get();      @endphp
                                              	@foreach($zones as $zone)
                                              		<option @if($zone->id == $voucher->zone_id ) selected @endif value="{{ $zone->id }}">{{ $zone->name }}</option>
                                              	@endforeach
                              </select>
                      </div>
                </div>
               <div class="col-6"></div>
                <div class="col-6">
                    <button class="btn btn-primary" type="submit">Update Voucher</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@push('script_2')


@endpush
