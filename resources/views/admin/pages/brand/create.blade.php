@extends('admin.layouts.master')

@section('content')
<div class="main-content-wrap">
    @include('admin.layouts.partials.breadcrumb', ['header' => "Create Brand"])
    <!-- new-category -->
    <div class="wg-box">
        <form class="form-new-product form-style-1" action="{{ route('admin.brand.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <fieldset class="name">
                <div class="body-title">Brand Name <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="text" placeholder="Brand name" name="name"
                    tabindex="0" value="{{old('name')}}" aria-required="true" required>
                
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </fieldset>
            <fieldset class="name">
                <div class="body-title">Brand Slug <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="text" placeholder="Brand Slug" name="slug"
                    tabindex="0" value="{{old('slug')}}" aria-required="true" required>
                
                @error('slug')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </fieldset>
            <fieldset>
                <div class="body-title">Upload images <span class="tf-color-1">*</span>
                </div>
                <div class="upload-image flex-grow">
                    <div class="item d-none" id="imgpreview">
                        <div class="display-input-image d-none">
                            <img src="{{ Vite::asset(\App\Library\Enum::NO_IMAGE_PATH) }}"
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

            <div class="bot">
                <div></div>
                <button class="tf-button w208" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection