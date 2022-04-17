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
                    <div class="col-4">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" name="code" value="{{ old('code') }}" class="form-control">
                            @error('code')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="type">Type</label>
                        <select name="type" class="form-control">
                            <option value="0" {{ old('type') == 1 ? 'selected' : null }}>Fixed</option>
                            <option value="1" {{ old('type') == 0 ? 'selected' : null }}>Percentage</option>
                        </select>
                        @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>


                    <div class="col-4">
                        <label for="price">Price</label>
                        <input type="text" name="price" value="{{ old('price') }}" class="form-control">
                        @error('price')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-4">
                        <label for="used_count">Used Count</label>
                        <input type="number" name="used_count" value="{{ old('used_count') }}" class="form-control">
                        @error('used_count')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>




                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Add Coupon</button>
                </div>
            </form>
        </div>
    </div>
</x-master-layout>
