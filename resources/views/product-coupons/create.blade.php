<x-master-layout>
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <h5 class="font-weight-bold">Add Coupon</h5>
{{--                            @if($auth_user->can('category list'))--}}
                                <a href="{{ route('product_coupons') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
{{--                            @endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-body">

            <form action="{{ route('create_product_coupons') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" name="code" value="{{ old('code') }}" class="form-control">
                            @error('code')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <label for="type_coupon">Type Coupon</label>
                        <select name="type_coupon" id="type_coupon" class="form-control">
                            <option disabled selected value> -- {{ __('Select an option') }} -- </option>
                            <option value="order" {{ old('type_coupon') == 'order' ? 'selected' : null }}>Order</option>
                            <option value="category" {{ old('type_coupon') == 'category' ? 'selected' : null }}>Categories</option>
                            <option value="product" {{ old('type_coupon') == 'product' ? 'selected' : null }}>Products</option>
                        </select>
                        @error('type_coupon')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>


                    <div class="col-3">
                        <label for="price">Price</label>
                        <input type="text" name="price" value="{{ old('price') }}" class="form-control">
                        @error('price')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-3">
                        <label for="used_count">Used Count</label>
                        <input type="number" name="used_count" value="{{ old('used_count') }}" class="form-control">
                        @error('used_count')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                </div>


                <div class="row">
                    <div class="col-3">
                        <label for="type">Type</label>
                        <select name="type" class="form-control">
                            <option disabled selected value> -- {{ __('Select an option') }} -- </option>
                            <option value="0" {{ old('type') == 0 ? 'selected' : null }}>Fixed</option>
                            <option id="percent" class="d-none" value="1" {{ old('type') == 1 ? 'selected' : null }}>Percentage</option>
                        </select>
                        @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- for pro -->
                    @isset($products)
                        <div class="col-3" id="products">
                            <label class="form-control-label" for="product_id">Products</label>
                            <select class="form-control select2" id="product_id" name="product_id[]" multiple>
                                <option disabled selected value> -- {{ __('Select an option') }} -- </option>
                                @foreach ($products as $product)
                                    <option  value="{{ $product->id }}">{{$product->name}}</option>
                                @endforeach
                            </select>
                            @error('product_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    @endisset
                <!-- for pro -->

                    <!-- for cat -->
                    @isset($categories)
                    <div class="col-3" id="cats">
                            <label class="form-control-label" for="category_id">Categories</label>
                            <select class="form-control select2" id="category_id" name="category_id[]" multiple>
                                <option disabled selected value> -- {{ __('Select an option') }} -- </option>
                                @foreach ($categories as $category)
                                            <option  value="{{ $category->id }}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    @endisset
                    <!-- for cat -->

                </div>
                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Add Coupon</button>
                </div>
            </form>
        </div>
    </div>
</x-master-layout>
<script>
    "use strict";
    $('#type_coupon').on('change', function() {
        if(this.value == 'order'){
            $('#percent').removeClass('d-none');
            $('#cats').addClass('d-none');
            $('#products').addClass('d-none');
        }else if(this.value == 'category'){
            $('#percent').addClass('d-none');
            $('#products').addClass('d-none');
            $('#cats').removeClass('d-none');
        }else if(this.value == 'product'){
            $('#percent').addClass('d-none');
            $('#cats').addClass('d-none');
            $('#products').removeClass('d-none');
        }
    });
</script>
