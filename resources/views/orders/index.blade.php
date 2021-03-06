<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <h5 class="font-weight-bold">Orders</h5>
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
                                    <th scope="col">Product Name</th>
                                    <th class="table-web" scope="col">Order Date</th>
                                    <th class="table-web" scope="col">{{ __('Number of orders') }}</th>
                                    <th class="table-web" scope="col">{{ __('Price') }}</th>
                                    <th scope="col">{{ __('Aria') }}</th>
                                    <th scope="col">{{ __('Last status') }}</th>
                                    <th scope="col">{{ __('Actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="table-web">
                                            <a class="btn badge badge-success badge-pill" href="{{ route('get-order',$order->id )}}">#{{ $order->id }}</a>
                                        </td>
                                        <td class="table-web">
                                            {{ $order->product_name }}
                                        </td>
                                        <td class="table-web" dir="ltr">
                                            {{ $order->created_at }}
                                        </td>
                                        <td class="table-web">
                                            {{ $order->quantity }}
                                        </td>
                                        <td class="table-web">
                                            {{ $order->total_amount }}
                                        </td>
                                        <td class="table-web">
                                            {{ $order->address }}
                                        </td>
                                        <td class="table-web">
                                            @if($order->status == 0)
                                                <span>???? ??????????</span>
                                            @elseif($order->status == 1)
                                                <span>???? ???????? ??????????</span>
                                            @elseif($order->status == 2)
                                                <span>???? ?????? ??????????</span>
                                            @elseif($order->status == 3)
                                                <span>???? ?????????? ??????????</span>
                                            @elseif($order->status == 4)
                                                <span>???? ?????????? ??????????</span>
                                            @else
                                                <span>-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->status == 0)
                                                <form method="post" action="{{ route('accept_order',$order->id) }}">
                                                    @csrf
                                                    {{ method_field('PUT') }}
                                                    <button type="submit" class="btn btn-primary btn-sm order-action float-left" id="type-success">????????</button>
                                                </form>
                                                <form method="post" action="{{ route('reject_order',$order->id) }}">
                                                    @csrf
                                                    {{ method_field('PUT') }}
                                                    <button type="submit" class="btn btn-danger btn-sm order-action float-right" id="type-success">??????</button>
                                                </form>
                                            @elseif($order->status == 1)
                                                <form method="post" class="" action="{{ route('done_order',$order->id) }}">
                                                    @csrf
                                                    {{ method_field('PUT') }}
                                                    <button type="submit" class="btn btn-success btn-sm order-action d-inline-block float-right" id="type-success">??????????</button>
                                                </form>
                                                <form method="post" action="{{ route('reject_order',$order->id) }}">
                                                    @csrf
                                                    {{ method_field('PUT') }}
                                                    <button type="submit" class="btn btn-danger btn-sm order-action d-inline-block float-left" id="type-success">??????</button>
                                                </form>
                                            @elseif(!$order->status == 0 || !$order->status == 1)
                                                <small>???? ???????? ?????????????? ???? ????????!</small>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                    @endif
        <!-- orders -->
    </div>
</x-master-layout>
