<x-master-layout>
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <h5 class="font-weight-bold">Edite Tax ({{ $taxProduct->title }})</h5>
{{--                            @if($auth_user->can('category list'))--}}
                                <a href="{{ route('tax_products.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
{{--                            @endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-body">

            <form action="{{ route('tax_products.update', $taxProduct->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ old('title', $taxProduct->title) }}" class="form-control">
                            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $taxProduct->status) == 1 ? 'selected' : null }}>Active</option>
                            <option value="0" {{ old('status', $taxProduct->status) == 0 ? 'selected' : null }}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-4">
                        <label for="type">Type</label>
                        <select name="type" class="form-control">
                            <option value="0" {{ old('type', $taxProduct->type) == 1 ? 'selected' : null }}>Fixed</option>
                            <option value="1" {{ old('type', $taxProduct->type) == 0 ? 'selected' : null }}>Percentage</option>
                        </select>
                        @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-4">
                        <label for="value">Price</label>
                        <input type="number" name="value" value="{{ old('value', $taxProduct->value) }}" class="form-control">
                        @error('value')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update Tax</button>
                </div>
            </form>
        </div>
    </div>
</x-master-layout>
