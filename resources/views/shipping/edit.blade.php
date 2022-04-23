<x-master-layout>
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <h5 class="font-weight-bold">Edite Shipping ({{ $shipping->city }})</h5>
{{--                            @if($auth_user->can('category list'))--}}
                                <a href="{{ route('shippings.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
{{--                            @endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-body">

            <form action="{{ route('shippings.update', $shipping->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" value="{{ old('city', $shipping->city) }}" class="form-control">
                            @error('city')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $shipping->status) == 1 ? 'selected' : null }}>Active</option>
                            <option value="0" {{ old('status', $shipping->status) == 0 ? 'selected' : null }}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-4">
                        <label for="price">Price</label>
                        <input type="text" name="price" value="{{ old('price', $shipping->price) }}" class="form-control">
                        @error('price')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update Shipping</button>
                </div>
            </form>
        </div>
    </div>
</x-master-layout>
