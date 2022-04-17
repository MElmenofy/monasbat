<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <h5 class="font-weight-bold">Order Details</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="content-body">
            <section class="invoice-preview-wrapper p-2">
                <div class="row invoice-preview">
                    <!-- Invoice -->
                    <div class="col-xl-12 col-md-12 col-12">
                        <div class="card invoice-preview-card">
                            <div class="card-body invoice-padding pb-0">
                            <hr class="invoice-spacing" />
                            <!-- Invoice Description starts -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="py-1">{{ __('Order image ') }}</th>
                                        <th class="py-1">{{__('Order Name')}}</th>
                                        <th class="py-1">{{__('Quantety')}}</th>
                                        <th class="py-1">Address</th>
                                        <th class="py-1">Product Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="py-1">
                                                <img src="{{ asset('uploads/products/').'/'.$order->product_image }}" alt="{{ $order->product_name }}" width="30%">
                                            </td>
                                            <td class="py-1">
                                                <p class="card-text font-weight-bold">{{$order->product_name}}</p>
                                            </td>
                                            <td class="py-1">
                                                <p class="card-text font-weight-bold">{{$order->quantity}}</p>
                                            </td>
                                            <td class="py-1">
                                                @if(!empty($order->address))
                                                    <p class="card-text font-weight-bold">{{ $order->address }}</p>
                                                @else
                                                    <p class="card-text font-weight-bold">{{ __('Pickup') }}</p>
                                                @endif
                                            </td>

                                            <td class="py-1">
                                                @if (!empty($order->product_price))
                                                    <span class="font-weight-bold">{{ $order->product_price }}</span>
                                                @else
                                                    <span class="font-weight-bold">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr class="my-50">
                                <div class="card-body invoice-padding pb-0">
                                    <div class="row invoice-sales-total-wrapper">
                                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                            @if(!empty($order->user_id))
                                                <p class="card-text mb-0">
                                                    <span class="font-weight-bold">{{ __('Name') }}:</span> <span class="ml-75">{{ $order->user->first_name. ' '.$order->user->last_name  }}</span>
                                                </p>
                                            @endif
                                            @if(!empty($order->user_id>2))
                                                <p class="card-text mb-0">
                                                    <span class="font-weight-bold">{{ __('Phone') }}:</span> <span class="ml-75">{{ $order->user->contact_number }}</span>
                                                </p>
                                            @endif
                                            @if(!empty($order->address))
                                                <p class="card-text mb-0">
                                                    <span class="font-weight-bold">{{ __('Address') }}:</span> <span class="ml-75">{{ $order->address }}</span>
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                            <div class="invoice-total-wrapper">
                                                @if(!empty($order->coupon_id))
                                                    <div class="invoice-total-item">
                                                        <p class="invoice-total-title">Discount:</p>
                                                        <p class="invoice-total-amount"> {{$order->discount}}</p>
                                                    </div>
                                                @endif

                                                <hr class="my-50" />
                                                <div class="invoice-total-item">
                                                    <p class="invoice-total-title">{{ __("Total") }}:</p>
                                                    <p class="invoice-total-amount">{{ $order->total_amount }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Invoice Description ends -->
                                <hr class="invoice-spacing" />
                            </div>
                    </div>
                    <!-- /Invoice -->


</x-master-layout>
