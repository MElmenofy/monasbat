<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <h5 class="font-weight-bold">{{ __('messages.orders') }}</h5>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- orders -->
        <div class="row" id="table-hover-row">
            <div class="col-12">
                <div class="card">
                    @if(count($orders))
                        <div class="table-responsive">
                            <table class="table table-hover align-items-center">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('ID') }}</th>
                                    <th scope="col">{{ __('messages.product_name') }}</th>
                                    <th class="table-web" scope="col">{{ __('messages.order_date') }}</th>
                                    <th class="table-web" scope="col">{{ __('messages.quantity') }}</th>
                                    <th class="table-web" scope="col">{{ __('messages.total_amount') }}</th>
                                    <th class="table-web" scope="col">{{ __('messages.discount') }}</th>
                                    <th scope="col">{{ __('messages.aria') }}</th>
                                    <th scope="col">{{ __('messages.last_status') }}</th>
                                    <th scope="col">{{ __('messages.shipping_cost') }}</th>
                                    <th scope="col">{{ __('messages.shipping_place') }}</th>
{{--                                    <th scope="col">{{ __('Actions') }}</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="table-web">
                                            <a class="btn badge badge-success badge-pill" href="{{ route('get-order-admin',$order->id )}}">#{{ $order->id }}</a>
                                        </td>
                                        <td class="table-web">
                                            @foreach(json_decode($order->product_name) as $p)
                                            {{ $p->name }} -<br>
                                            @endforeach
                                        </td>
                                        <td class="table-web" dir="ltr">
                                            {{ $order->created_at }}
                                        </td>
                                        <td class="table-web">
                                            @foreach(json_decode($order->product_name) as $p)
                                                {{ $order->quantity }} -<br>
                                            @endforeach
                                        </td>
                                        <td class="table-web">
                                            {{ $order->all_cost_after_discount_and_shipping }}
                                        </td>
                                        <td class="table-web">
                                            @if($order->discount != null)
                                            {{ $order->discount }}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td class="table-web">
                                            {{ $order->address }}
                                        </td>
                                        <td class="table-web">
                                            @if($order->status == 0)
                                                <span>تم الطلب</span>
                                            @elseif($order->status == 1)
                                                <span>تم قبول الطلب</span>
                                            @elseif($order->status == 2)
                                                <span>تم رفض الطلب</span>
                                            @elseif($order->status == 3)
                                                <span>تم الغاء الطلب</span>
                                            @elseif($order->status == 4)
                                                <span>تم توصيل الطلب</span>
                                            @else
                                                <span>-</span>
                                            @endif
                                        </td>
                                        <td class="table-web">
                                            {{ $order->shipping_cost }}
                                        </td>
                                       <td class="table-web">
                                            {{ $order->shipping_name }}
                                        </td>
{{--                                        <td>--}}
{{--                                            @if($order->status == 0)--}}
{{--                                                <div class="d-flex justify-content-between">--}}
{{--                                                <form method="post" action="{{ route('accept_order',$order->id) }}">--}}
{{--                                                    @csrf--}}
{{--                                                    {{ method_field('PUT') }}--}}
{{--                                                    <button type="submit" class="btn btn-primary btn-sm order-action" id="type-success">قبول</button>--}}
{{--                                                </form>--}}
{{--                                                <form method="post" action="{{ route('reject_order',$order->id) }}">--}}
{{--                                                    @csrf--}}
{{--                                                    {{ method_field('PUT') }}--}}
{{--                                                    <button type="submit" class="btn btn-danger btn-sm order-action float-right" id="type-success">رفض</button>--}}
{{--                                                </form>--}}
{{--                                                </div>--}}
{{--                                            @elseif($order->status == 1)--}}
{{--                                                <form method="post" class="" action="{{ route('done_order',$order->id) }}">--}}
{{--                                                    @csrf--}}
{{--                                                    {{ method_field('PUT') }}--}}
{{--                                                    <button type="submit" class="btn btn-success btn-sm order-action d-inline-block float-right" id="type-success">اتمام</button>--}}
{{--                                                </form>--}}
{{--                                                <form method="post" action="{{ route('reject_order',$order->id) }}">--}}
{{--                                                    @csrf--}}
{{--                                                    {{ method_field('PUT') }}--}}
{{--                                                    <button type="submit" class="btn btn-danger btn-sm order-action d-inline-block float-left" id="type-success">رفض</button>--}}
{{--                                                </form>--}}
{{--                                            @elseif(!$order->status == 0 || !$order->status == 1)--}}
{{--                                                <small>لا توجد إجراءات لك الآن!</small>--}}
{{--                                            @endif--}}
{{--                                        </td>--}}

                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div class="float-right">
                                            {{ $orders->links() }}
                                        </div>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                    @endif
        <!-- orders -->
    </div>
    </div>
    </div>
    </div>
    </div>
</x-master-layout>
