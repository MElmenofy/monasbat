<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <h5 class="font-weight-bold">Shipping</h5>
{{--                            @if($auth_user->can('category add'))--}}
                            <a href="{{ route('shippings.create') }}" class="float-right mr-1 btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i>Shipping</a>
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
                    <th>ID</th>
                    <th>City</th>
                    <th>Status</th>
                    <th>Price</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($shippings as $shipping)
                    <tr>
                        <td>{{ $shipping->id }}</td>
                        <td>{{ $shipping->city }}</td>
                        <td>{{ $shipping->status() }}</td>
                        <td>{{ $shipping->price }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('shippings.edit', $shipping->id) }}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="if (confirm('Are you sure to delete this record?')) { document.getElementById('delete-product-{{ $shipping->id }}').submit(); } else { return false; }" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{ route('shippings.destroy', $shipping->id) }}" method="post" id="delete-product-{{ $shipping->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Shipping found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="float-right">
                            {{ $shippings->links() }}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- pro -->
    </div>

</x-master-layout>
