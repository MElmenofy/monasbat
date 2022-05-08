<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <h5 class="font-weight-bold">{{ __('messages.order_details') }}</h5>
                                <a href="{{ route('get-orders-admin') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
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
                                        <th class="py-1">{{ __('messages.order_image ') }}</th>
                                        <th class="py-1">{{__('messages.order_name')}}</th>
                                        <th class="py-1">{{__('messages.quantity')}}</th>
                                        <th class="py-1">{{__('messages.price')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(json_decode($order->product_name) as $p)
                                        <tr>
                                                <td class="py-1">
                                                    <img src="{{ asset('uploads/products/').'/'.$p->image }}" alt="{{ $p->name }}" width="30%">
                                                </td>
                                                <td class="py-1"> {{ $p->name }}</td>
                                                <td class="py-1"> {{ $p->quantity }}</td>
                                                @if (!empty($p->price))
                                                <td class="py-1"> {{ $p->price }}</td>
                                                @else
                                                    <span class="font-weight-bold">-</span>
                                                @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr class="my-50">
                                <div class="card-body invoice-padding pb-0">
                                    <div class="row invoice-sales-total-wrapper">
                                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                            @if(!empty($order->user_id))
                                                <p class="card-text mb-0">
                                                    <span class="font-weight-bold">{{ __('messages.name') }}:</span> <span class="ml-75">{{ $order->user->first_name. ' '.$order->user->last_name  }}</span>
                                                </p>
                                            @endif
                                            @if(!empty($order->user_id>2))
                                                <p class="card-text mb-0">
                                                    <span class="font-weight-bold">{{ __('messages.phone') }}:</span> <span class="ml-75">{{ $order->user->contact_number }}</span>
                                                </p>
                                            @endif
                                            @if(!empty($order->address))
                                                <p class="card-text mb-0">
                                                    <span class="font-weight-bold">{{ __('messages.address') }}:</span> <span class="ml-75">{{ $order->address }}</span>
                                                </p>
                                            @endif
                                            @if(!empty($order->shipping_name))
                                                <p class="card-text mb-0">
                                                    <span class="font-weight-bold">{{ __('messages.shipping') }}:</span> <span class="ml-75">{{ $order->shipping_name }}</span>
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                            <div class="invoice-total-wrapper">
                                                @if(!empty($order->coupon_id))
                                                    <div class="invoice-total-item">
                                                        <p class="invoice-total-title">{{ __('messages.discount') }}:</p>
                                                        <p class="invoice-total-amount"> {{$order->discount}}</p>
                                                    </div>
                                                @endif
                                                <hr class="my-50" />
                                                @if(!empty($order->shipping_cost))
                                                    <div class="invoice-total-item">
                                                        <p class="invoice-total-title">{{ __('messages.shipping_cost') }}:</p>
                                                        <p class="invoice-total-amount"> {{$order->shipping_cost}}</p>
                                                    </div>
                                                @endif
                                                <hr class="my-50" />
                                                <div class="invoice-total-item">
                                                    <p class="invoice-total-title">{{ __("messages.total") }}:</p>
                                                    <p class="invoice-total-amount">{{ $order->all_cost_after_discount_and_shipping }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Invoice Description ends -->
                                <hr class="invoice-spacing" />
                            </div>
                    </div>
                    </div>
                    <!-- /Invoice -->

                </div>
            </section>
        </div>
    </div>
</x-master-layout>
