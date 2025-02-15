@extends('admin.layouts.master')

@section('content')
<div class="main-content-wrap">
    @include('admin.layouts.partials.breadcrumb', ['header' => "Update Product"])
    <!-- new-category -->
    <div class="wg-box">
        <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data" action="{{route('admin.product.update', $product->id)}}">
            @csrf
            <div class="wg-box">
                <fieldset class="name">
                    <div class="body-title mb-10">Product name <span class="tf-color-1">*</span>
                    </div>
                    <input class="mb-10" type="text" placeholder="Enter product name"
                        name="name" tabindex="0" value="{{old('name', $product->name)}}" aria-required="true" required="">
                    <div class="text-tiny">Do not exceed 100 characters when entering the product name.</div>
                    @error('name')
                        <p class="error-message">{{$message}}</p>
                    @enderror
                    
                </fieldset>

                <fieldset class="name">
                    <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                    <input class="mb-10" type="text" placeholder="Enter product slug"
                        name="slug" tabindex="0" value="{{old('slug', $product->slug)}}" aria-required="true" required="">
                    <div class="text-tiny">Do not exceed 100 characters when entering the product name.</div>
                    @error('slug')
                        <p class="error-message">{{$message}}</p>
                    @enderror
                </fieldset>

                <div class="gap22 cols">
                    <fieldset class="category">
                        <div class="body-title mb-10">Category <span class="tf-color-1">*</span>
                        </div>
                        <div class="select">
                            <select class="" name="category_id">
                                <option disabled>Choose category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{old('category_id',$product->category_id) == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="error-message">{{$message}}</p>
                            @enderror
                        </div>
                    </fieldset>
                    <fieldset class="brand">
                        <div class="body-title mb-10">Brand <span class="tf-color-1">*</span>
                        </div>
                        <div class="select">
                            <select class="" name="brand_id">
                                <option disabled>Choose Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}" {{old('brand_id', $product->brand_id) == $brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <p class="error-message">{{$message}}</p>
                            @enderror
                        </div>
                    </fieldset>
                </div>

                <fieldset class="shortdescription">
                    <div class="body-title mb-10">Short Description</div>
                    <textarea class="mb-10 ht-150" name="short_description"
                        placeholder="Short Description" tabindex="0" aria-required="true"
                        >{{old('short_description', $product->short_description)}}</textarea>
                    <div class="text-tiny">Do not exceed 100 characters when entering the product name.</div>
                    @error('short_description')
                        <p class="error-message">{{$message}}</p>
                    @enderror
                </fieldset>

                <fieldset class="description">
                    <div class="body-title mb-10">Description</div>
                    <textarea class="mb-10" name="description" placeholder="Description"
                        tabindex="0" aria-required="true">{{old('description', $product->description)}}</textarea>
                    @error('description')
                        <p class="error-message">{{$message}}</p>
                    @enderror
                </fieldset>
            </div>
            <div class="wg-box">
                <fieldset>
                    <div class="body-title">Upload images <span class="tf-color-1">*</span>
                    </div>
                    <div class="upload-image flex-grow">
                        <div class="item" id="imgpreview">
                            <div class="display-input-image">
                                <img src="{{ $product->getThumbnailImage() }}"
                                    alt="Preview Image" />
                                <button type="button"
                                    class="btn btn-sm btn-outline-danger file-upload-remove ml-3"
                                    title="Remove">x</button>
                            </div>
                        </div>
                        <div id="upload-file" class="item up-load">
                            <label class="uploadfile" for="myFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Drop your images here or select <span
                                        class="tf-color">click to browse</span></span>
                                <input type="file" id="myFile" name="image" allowed="png,gif,jpeg,jpg" accept="image/*">
                            </label>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="body-title mb-10">Upload Gallery Images</div>
                    <div class="form-group  @error('images') error @enderror">
                        <label class="col-form-label">{{ __('Gallery Image(750X750)') }}</label>
                        <div class="dropMeUpdateImage">

                        </div>
        
                        @error('images')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </fieldset>

                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">Regular Price <span
                                class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter regular price" name="price" tabindex="0" value="{{old('price', $product->price)}}" aria-required="true" required="">
                        @error('price')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title mb-10">Sale Price <span
                                class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter sale price" name="sale_price" tabindex="0" value="{{old('sale_price', $product->sale_price)}}" aria-required="true" required="">
                        @error('sale_price')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>


                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">SKU <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter SKU" name="SKU" tabindex="0" value="{{old('SKU', $product->SKU)}}" aria-required="true" required="">
                        @error('SKU')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title mb-10">Quantity <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter quantity" name="quantity" tabindex="0" value="{{old('quantity', $product->quantity)}}" aria-required="true" required="">
                        @error('quantity')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>
                <div class="cols gap10">
                    <button class="tf-button w-full" type="submit">Add product</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(function () {
            let preloaded = [
                @foreach($product->gallery_images as $image)
                    {
                        id: {{ $image->id }},
                        src: '{{ asset($image->attachment) }}',
                    },
                @endforeach
            ];

            $('.dropMeUpdateImage').imageUploader({
                preloaded: preloaded,
                imagesInputName: 'images',
                preloadedInputName: 'old_images',
                maxSize: 2 * 1024 * 1024,
                maxFiles: 5
            });
        });
    </script>
@endpush