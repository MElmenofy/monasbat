<x-master-layout>
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <h5 class="font-weight-bold">Add Product</h5>
{{--                            @if($auth_user->can('category list'))--}}
                                <a href="{{ route('products.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
{{--                            @endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-body">

            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status') == 1 ? 'selected' : null }}>Active</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : null }}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-3">
                        <label for="name">Is Coupon</label>
                        <input type="checkbox" name="is_coupon" value="1" {{ old('is_coupon') ? 'checked="checked"' : '' }} class="form-control">
                        @error('is_coupon')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-3">
                        <label for="description">Description</label>
                        <textarea name="description" rows="1" class="form-control summernote">
                            {!! old('description') !!}
                        </textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <label for="price">Price</label>
                        <input type="number" name="price" value="{{ old('price') }}" class="form-control">
                        @error('price')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-4">
                        <label for="services">Service</label>
                        <select name="service_id" class="form-control select2">
                            @forelse($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>


                <div class="row pt-4">
                    <div class="col-12">
                        <label for="images">Images</label>
                        <br>
                        <div class="file-loading">
{{--                            <input type="file" name="image[]" id="product-images" class="file-input-overview" multiple="multiple">--}}
                            <input type="file" name="image" id="product-images" class="file-input-overview" multiple="multiple">
                            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</x-master-layout>
