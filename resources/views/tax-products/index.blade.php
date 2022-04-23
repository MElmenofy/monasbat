<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <h5 class="font-weight-bold">Tax</h5>
{{--                            @if($auth_user->can('category add'))--}}
                            <a href="{{ route('tax_products.create') }}" class="float-right mr-1 btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i>Tax</a>
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
                    <th>Title</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Value</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($taxes as $tax)
                    <tr>
                        <td>{{ $tax->id }}</td>
                        <td>{{ $tax->title }}</td>
                        <td>
                            @if($tax->type == '0')
                                Fixed
                            @else
                                Percent
                            @endif
                        </td>
                        <td>{{ $tax->status() }}</td>
                        <td>{{ $tax->value }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('tax_products.edit', $tax->id) }}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="if (confirm('Are you sure to delete this record?')) { document.getElementById('delete-product-{{ $tax->id }}').submit(); } else { return false; }" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{ route('tax_products.destroy', $tax->id) }}" method="post" id="delete-product-{{ $tax->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Taxes found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="float-right">
                            {{ $taxes->links() }}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- pro -->
    </div>

</x-master-layout>
