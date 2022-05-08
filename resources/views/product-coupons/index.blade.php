<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <h5 class="font-weight-bold">{{ trans('messages.coupon') }}</h5>
{{--                            @if($auth_user->can('category add'))--}}
                            <a href="{{ route('create_product_coupons') }}" class="float-right mr-1 btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i>{{ __('messages.add'). __('messages.coupon') }}</a>
{{--                            @endif--}}
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- cats -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{ __('messages.code') }}</th>
                    <th>{{ __('messages.price') }}</th>
                    <th>{{ __('messages.type') }}</th>
                    <th>{{ __('messages.type_coupon') }}</th>
                    <th>{{ __('messages.created') }}</th>
                    <th>{{ __('messages.used_count') }}</th>
                    <th class="text-center" style="width: 30px;">{{ __('messages.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ $coupon->price }}</td>
                        <td>
                            @if($coupon->type == 0)
                                Fixed
                            @else
                            Percentage
                            @endif
                        </td>

                        <td>
                            @if($coupon->type_coupon == 'order')
                                Order
                            @elseif($coupon->type_coupon == 'category')
                                Category
                            @elseif($coupon->type_coupon == 'product')
                                Product
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $coupon->created_at }}</td>
                        <td>{{ $coupon->used_count }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('edit_product_coupons', $coupon->id) }}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="if (confirm('Are you sure to delete this record?')) { document.getElementById('delete-product-{{ $coupon->id }}').submit(); } else { return false; }" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{ route('delete_product_coupons', $coupon->id) }}" method="post" id="delete-product-{{ $coupon->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">{{ __('messages.no_coupons_found') }}</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="float-right">
{{--                            {{ $coupons->links() }}--}}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- pro -->
    </div>

</x-master-layout>
