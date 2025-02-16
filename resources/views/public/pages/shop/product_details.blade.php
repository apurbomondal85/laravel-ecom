@extends('public.layouts.master')

@section('content')
<main class="pt-90">
    <section class="product-single container">
        <div class="row">
        <div class="col-lg-7">
            <div class="product-single__media" data-media-type="vertical-thumbnail">
            <div class="product-single__image">
                <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide product-single__image-item">
                        <img loading="lazy" class="" src="{{$product->getThumbnailImage()}}" width="674"
                            height="674" alt="" />
                        <a data-fancybox="gallery" class="button-zoom-maximize" href="javascript:void(0);" data-bs-toggle="tooltip"
                            data-bs-placement="left" title="Zoom">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </div>
                    @foreach ($product->gallery_images as $item)
                        <div class="swiper-slide product-single__image-item">
                            <img loading="lazy" class="" src="{{asset($item->attachment)}}" width="674"
                                height="674" alt="" />
                            <a data-fancybox="gallery" href="{{asset($item->attachment)}}" data-bs-toggle="tooltip"
                                data-bs-placement="left" title="Zoom">
                                <i class="fas fa-expand-arrows-alt"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"><i class="fas fa-chevron-left"></i></div>
                <div class="swiper-button-next"><i class="fas fa-chevron-right"></i></div>
                </div>
            </div>
            <div class="product-single__thumbnail">
                <div class="swiper-container">
                <div class="swiper-wrapper flex-column">
                    <div class="swiper-slide product-single__image-item">
                        <img loading="lazy" class="h-auto"
                        src="{{$product->getThumbnailImage()}}" width="104" height="104" alt="" />
                    </div>
                    @foreach ($product->gallery_images as $item)
                        <div class="swiper-slide product-single__image-item">
                            <img loading="lazy" class="h-auto"
                            src="{{asset($item->attachment)}}" width="104" height="104" alt="" />
                        </div>
                    @endforeach
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-5">
            <h1 class="product-single__name">{{$product->name}}</h1>
            {{-- <div class="product-single__rating">
            <div class="reviews-group d-flex">
                <i class="fas fa-star"></i>
                </svg>
                <i class="fas fa-star"></i>
                </svg>
                <i class="fas fa-star"></i>
                </svg>
                <i class="fas fa-star"></i>
                </svg>
                <i class="fas fa-star"></i>
                </svg>
            </div>
            <span class="reviews-note text-lowercase text-secondary ms-1">8k+ reviews</span>
            </div> --}}
            <div class="product-single__price">
                @if ($product->sale_price)   
                    <span class="current-price">{{getFormattedAmount($product->sale_price)}}</span>
                    <del style="font-size: 14px;">{{getFormattedAmount($product->price)}}</del>
                @else
                    <span class="current-price">{{getFormattedAmount($product->price)}}</span>
                @endif
            </div>
            <div class="product-single__short-desc">
            <p>{{$product->short_description}}</p>
            </div>
            <form name="addtocart-form" method="post" action="{{route('public.cart.add_cart')}}">
                @csrf
                <div class="product-single__addtocart">
                    <div class="qty-control position-relative">
                    <input type="number" name="quantity" value="1" min="1" class="qty-control__number text-center">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input type="hidden" name="price" value="{{$product->sale_price}}">
                    <div class="qty-control__reduce">-</div>
                    <div class="qty-control__increase">+</div>
                    </div><!-- .qty-control -->
                    <button type="submit" class="btn btn-primary btn-addtocart" data-aside="cartDrawer">Add to Cart</button>
                </div>
            </form>
            <div class="product-single__addtolinks">
            <a href="#" class="menu-link menu-link_us-s add-to-wishlist"><i class="fas fa-heart"></i><span>Add to Wishlist</span></a>
            <share-button class="share-button">
                {{-- <button class="menu-link menu-link_us-s to-share border-0 bg-transparent d-flex align-items-center">
                <i class="fas fa-shopping-cart"></i><span>Add to Cart</span>
                <span>Share</span>
                </button> --}}
                <details id="Details-share-template__main" class="m-1 xl:m-1.5" hidden="">
                <summary class="btn-solid m-1 xl:m-1.5 pt-3.5 pb-3 px-5">+</summary>
                    <div id="Article-share-template__main"
                        class="share-button__fallback flex items-center absolute top-full left-0 w-full px-2 py-4 bg-container shadow-theme border-t z-10">
                        <div class="field grow mr-4">
                        <label class="field__label sr-only" for="url">Link</label>
                        <input type="text" class="field__input w-full" id="url"
                            value="https://uomo-crystal.myshopify.com/blogs/news/go-to-wellness-tips-for-mental-health"
                            placeholder="Link" onclick="this.select();" readonly="">
                        </div>
                        <button class="share-button__copy no-js-hidden">
                        <svg class="icon icon-clipboard inline-block mr-1" width="11" height="13" fill="none"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" viewBox="0 0 11 13">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M2 1a1 1 0 011-1h7a1 1 0 011 1v9a1 1 0 01-1 1V1H2zM1 2a1 1 0 00-1 1v9a1 1 0 001 1h7a1 1 0 001-1V3a1 1 0 00-1-1H1zm0 10V3h7v9H1z"
                            fill="currentColor"></path>
                        </svg>
                        <span class="sr-only">Copy link</span>
                        </button>
                    </div>
                </details>
            </share-button>
            <script src="js/details-disclosure.html" defer="defer"></script>
            <script src="js/share.html" defer="defer"></script>
            </div>
            <div class="product-single__meta-info">
            <div class="meta-item">
                <label>SKU:</label>
                <span>{{$product->SKU}}</span>
            </div>
            <div class="meta-item">
                <label>Categories:</label>
                <span>{{$product->category?->name}}</span>
            </div>
            <div class="meta-item">
                <label>Brand:</label>
                <span>{{$product->brand?->name}}</span>
            </div>
            </div>
        </div>
        </div>
        <div class="product-single__details-tab">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
            <a class="nav-link nav-link_underscore active" id="tab-description-tab" data-bs-toggle="tab"
                href="#tab-description" role="tab" aria-controls="tab-description" aria-selected="true">Description</a>
            </li>
            <li class="nav-item" role="presentation">
            <a class="nav-link nav-link_underscore" id="tab-additional-info-tab" data-bs-toggle="tab"
                href="#tab-additional-info" role="tab" aria-controls="tab-additional-info"
                aria-selected="false">Additional Information</a>
            </li>
            <li class="nav-item" role="presentation">
            <a class="nav-link nav-link_underscore" id="tab-reviews-tab" data-bs-toggle="tab" href="#tab-reviews"
                role="tab" aria-controls="tab-reviews" aria-selected="false">Reviews (2)</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
            aria-labelledby="tab-description-tab">
            <div class="product-single__description">
                {!! $product->description !!}
            </div>
            </div>
            <div class="tab-pane fade" id="tab-additional-info" role="tabpanel" aria-labelledby="tab-additional-info-tab">
            <div class="product-single__addtional-info">
                <div class="item">
                <label class="h6">Weight</label>
                <span>1.25 kg</span>
                </div>
                <div class="item">
                <label class="h6">Dimensions</label>
                <span>90 x 60 x 90 cm</span>
                </div>
                <div class="item">
                <label class="h6">Size</label>
                <span>XS, S, M, L, XL</span>
                </div>
                <div class="item">
                <label class="h6">Color</label>
                <span>Black, Orange, White</span>
                </div>
                <div class="item">
                <label class="h6">Storage</label>
                <span>Relaxed fit shirt-style dress with a rugged</span>
                </div>
            </div>
            </div>
            <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
            <h2 class="product-single__reviews-title">Reviews</h2>
            <div class="product-single__reviews-list">
                <div class="product-single__reviews-item">
                <div class="customer-avatar">
                    <img loading="lazy" src="assets/images/avatar.jpg" alt="" />
                </div>
                <div class="customer-review">
                    <div class="customer-name">
                    <h6>Janice Miller</h6>
                    <div class="reviews-group d-flex">
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_star" />
                        </svg>
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_star" />
                        </svg>
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_star" />
                        </svg>
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_star" />
                        </svg>
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_star" />
                        </svg>
                    </div>
                    </div>
                    <div class="review-date">April 06, 2023</div>
                    <div class="review-text">
                    <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod
                        maxime placeat facere possimus, omnis voluptas assumenda est…</p>
                    </div>
                </div>
                </div>
                <div class="product-single__reviews-item">
                <div class="customer-avatar">
                    <img loading="lazy" src="assets/images/avatar.jpg" alt="" />
                </div>
                <div class="customer-review">
                    <div class="customer-name">
                    <h6>Benjam Porter</h6>
                    <div class="reviews-group d-flex">
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_star" />
                        </svg>
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_star" />
                        </svg>
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_star" />
                        </svg>
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_star" />
                        </svg>
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_star" />
                        </svg>
                    </div>
                    </div>
                    <div class="review-date">April 06, 2023</div>
                    <div class="review-text">
                    <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod
                        maxime placeat facere possimus, omnis voluptas assumenda est…</p>
                    </div>
                </div>
                </div>
            </div>
            <div class="product-single__review-form">
                <form name="customer-review-form">
                <h5>Be the first to review “Message Cotton T-Shirt”</h5>
                <p>Your email address will not be published. Required fields are marked *</p>
                <div class="select-star-rating">
                    <label>Your rating *</label>
                    <span class="star-rating">
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                        d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                        d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                        d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                        d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                        d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                    </svg>
                    </span>
                    <input type="hidden" id="form-input-rating" value="" />
                </div>
                <div class="mb-4">
                    <textarea id="form-input-review" class="form-control form-control_gray" placeholder="Your Review"
                    cols="30" rows="8"></textarea>
                </div>
                <div class="form-label-fixed mb-4">
                    <label for="form-input-name" class="form-label">Name *</label>
                    <input id="form-input-name" class="form-control form-control-md form-control_gray">
                </div>
                <div class="form-label-fixed mb-4">
                    <label for="form-input-email" class="form-label">Email address *</label>
                    <input id="form-input-email" class="form-control form-control-md form-control_gray">
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input form-check-input_fill" type="checkbox" value="" id="remember_checkbox">
                    <label class="form-check-label" for="remember_checkbox">
                    Save my name, email, and website in this browser for the next time I comment.
                    </label>
                </div>
                <div class="form-action">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </section>
    <section class="products-carousel container">
        <h2 class="h3 text-uppercase mb-4 pb-xl-2 mb-xl-4">Related <strong>Products</strong></h2>

        <div id="related_products" class="position-relative">
        <div class="swiper-container js-swiper-slider" data-settings='{
            "autoplay": false,
            "slidesPerView": 4,
            "slidesPerGroup": 4,
            "effect": "none",
            "loop": true,
            "pagination": {
                "el": "#related_products .products-pagination",
                "type": "bullets",
                "clickable": true
            },
            "navigation": {
                "nextEl": "#related_products .products-carousel__next",
                "prevEl": "#related_products .products-carousel__prev"
            },
            "breakpoints": {
                "320": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 14
                },
                "768": {
                "slidesPerView": 3,
                "slidesPerGroup": 3,
                "spaceBetween": 24
                },
                "992": {
                "slidesPerView": 4,
                "slidesPerGroup": 4,
                "spaceBetween": 30
                }
            }
            }'>
            <div class="swiper-wrapper">
                @foreach ($products as $item_product)
                    <div class="swiper-slide product-card ms-3">
                        <div class="pc__img-wrapper">
                        <a href="{{route('public.shop.details', $item_product->slug)}}">
                            <img loading="lazy" src="{{$item_product->getThumbnailImage()}}" width="330" height="400"
                            alt="{{$item_product->name}}" class="pc__img">
                            @if ($item_product->gallery_images->count() > 0)
                                <img loading="lazy" src="{{asset($item_product->gallery_images[0]->attachment)}}" width="330" height="400"
                                alt="{{$item_product->name}}" class="pc__img pc__img-second">
                            @endif
                        </a>
                        <form name="addtocart-form" method="post" action="{{route('public.cart.add_cart')}}">
                            @csrf
                            <div class="product-single__addtocart">
                                <input type="hidden" name="quantity" value="1" min="1">
                                <input type="hidden" name="product_id" value="{{$item_product->id}}">
                                <input type="hidden" name="price" value="{{$item_product->sale_price}}">
                                <button type="submit" class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium" title="Add To Cart">Add To Cart</button>
                            </div>
                        </form>
                        </div>

                        <div class="pc__info position-relative">
                        <p class="pc__category">{{$item_product->category->name}}</p>
                        <h6 class="pc__title"><a href="{{route('public.shop.details', $item_product->slug)}}">{{$item_product->name}}</a></h6>
                        <div class="product-card__price d-flex">
                            @if ($item_product->sale_price)   
                                <span class="current-price me-2">{{getFormattedAmount($item_product->sale_price)}}</span>
                                <del style="font-size: 14px;">{{getFormattedAmount($item_product->price)}}</del>
                            @else
                                <span class="current-price">{{getFormattedAmount($item_product->price)}}</span>
                            @endif
                        </div>

                        <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
                            title="Add To Wishlist">
                            <i class="fas fa-heart"></i>
                        </button>
                        </div>
                    </div>
                @endforeach
            </div><!-- /.swiper-wrapper -->
        </div><!-- /.swiper-container js-swiper-slider -->

        <div class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
            <i class="fas fa-chevron-left"></i>
        </div><!-- /.products-carousel__prev -->
        <div class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
            <i class="fas fa-chevron-right"></i>
        </div><!-- /.products-carousel__next -->

        <div class="products-pagination mt-4 mb-5 d-flex align-items-center justify-content-center"></div>
        <!-- /.products-pagination -->
        </div><!-- /.position-relative -->

    </section><!-- /.products-carousel container -->
</main>
@endsection