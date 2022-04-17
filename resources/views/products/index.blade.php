<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <h5 class="font-weight-bold">{{ trans('messages.products') }}</h5>
{{--                            @if($auth_user->can('category add'))--}}
                            <a href="{{ route('products.create') }}" class="float-right mr-1 btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> {{ trans('messages.add_form_title',['form' => trans('messages.products')  ]) }}</a>
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
                    <th>Name</th>
                    <th>Description</th>
                    <th>price</th>
                    <th>status</th>
                    <th>service</th>
                    <th>Created at</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->status() }}</td>
                        <td>{{ $product->service->name }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="if (confirm('Are you sure to delete this record?')) { document.getElementById('delete-product-{{ $product->id }}').submit(); } else { return false; }" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{ route('products.destroy', $product->id) }}" method="post" id="delete-product-{{ $product->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Products found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="float-right">
                            {{ $products->links() }}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- pro -->
    </div>

</x-master-layout>
