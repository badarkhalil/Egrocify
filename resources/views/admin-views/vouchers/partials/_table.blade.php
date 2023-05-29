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
        <span class="d-block font-size-sm text-body text-capitalize">
            {{ $module["total_buyer"] }}
        </span>
    </td>
    <td>
        <div class="btn--container justify-content-center">
            <a class="btn action-btn btn--primary btn-outline-primary"
                href="{{route('admin.business-settings.module.edit',[$module['id']])}}" title="{{translate('messages.edit')}} {{translate('messages.category')}}"><i class="tio-edit"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
