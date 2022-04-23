<x-master-layout>
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <h5 class="font-weight-bold">Edite Product ({{ $product->name }})</h5>
{{--                            @if($auth_user->can('category list'))--}}
                                <a href="{{ route('products.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
{{--                            @endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-body">

            <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : null }}>Active</option>
                            <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : null }}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-3">
                        <label for="name">Is Coupon</label>
                        <input type="checkbox" name="is_coupon" value="1" {{ old('is_coupon', $product->is_coupon) ? 'checked="checked"' : '' }} class="form-control">
                        @error('is_coupon')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-3">
                        <label for="description">Description</label>
                        <textarea name="description" rows="1" class="form-control summernote">
                            {!! old('description', $product->description) !!}
                        </textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <label for="price">Price</label>
                        <input type="text" name="price" value="{{ old('price', $product->price) }}" class="form-control">
                        @error('price')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-4">
                        <label for="services">Service</label>
                        <select name="service_id" class="form-control select2">
                            @forelse($services as $service)
                                <option value="{{ $service->id }}" {{ old('service_id', $product->service_id) == $service->id ? 'selected' : null }}>{{ $service->name }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>


                <div class="pt-4">
                    <div class="d-flex justify-content-between">
                        @isset($product->image_one)
                        <div>
                            <img width="20%" src="{{ asset('uploads/products/').'/'.$product->image_one }}">
                            <br>
                            <label for="image_one">Image</label>
                            <br>
                            <div class="file-loading">
                                <input type="file" name="image_one" id="image_one" class="file-input-overview">
                                @error('image_one')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        @endisset
                            @isset($product->image_two)
                                <div>
                            <img width="20%" src="{{ asset('uploads/products/').'/'.$product->image_two }}">
                                <br>
                                <label for="image_two">Image</label>
                                <br>
                                <div class="file-loading">
                                    <input type="file" name="image_two" id="image_two" class="file-input-overview">
                                    @error('image_two')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                </div>
                            @endisset
                    </div>
                    <div class="mt-5 d-flex justify-content-between">
                            @isset($product->image_three)
                                <div>
                            <img width="20%" src="{{ asset('uploads/products/').'/'.$product->image_three }}">
                                <br>
                                <label for="image_three">Image</label>
                                <br>
                                <div class="file-loading">
                                    <input type="file" name="image_three" id="image_three" class="file-input-overview">
                                    @error('image_three')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                </div>
                            @endisset
                            @isset($product->image_four)
                                <div>
                            <img width="20%" src="{{ asset('uploads/products/').'/'.$product->image_four }}">
                                <br>
                                <label for="image_four">Image</label>
                                <br>
                                <div class="file-loading">
                                    <input type="file" name="image_four" id="image_four" class="file-input-overview">
                                    @error('image_four')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                </div>
                            @endisset
                            @isset($product->image_five)
                                <div>
                            <img width="20%" src="{{ asset('uploads/products/').'/'.$product->image_five }}">
                                <br>
                                <label for="image_five">Image</label>
                                <br>
                                <div class="file-loading">
                                    <input type="file" name="image_five" id="image_five" class="file-input-overview">
                                    @error('image_five')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                </div>
                            @endisset


                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</x-master-layout>
