<section class="hot-deals container">
    <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">Hot Deals</h2>
    <div class="row">
      <div class="col-md-6 col-lg-4 col-xl-20per d-flex align-items-center flex-column justify-content-center py-4 align-items-md-start">
        <h2>Summer Sale</h2>
        <h2 class="fw-bold">Up to 60% Off</h2>

        <div class="position-relative d-flex align-items-center text-center pt-xxl-4 js-countdown mb-3"
          data-date="18-3-2026" data-time="06:50">
          <div class="day countdown-unit">
            <span class="countdown-num d-block"></span>
            <span class="countdown-word text-uppercase text-secondary">Days</span>
          </div>

          <div class="hour countdown-unit">
            <span class="countdown-num d-block"></span>
            <span class="countdown-word text-uppercase text-secondary">Hours</span>
          </div>

          <div class="min countdown-unit">
            <span class="countdown-num d-block"></span>
            <span class="countdown-word text-uppercase text-secondary">Mins</span>
          </div>

          <div class="sec countdown-unit">
            <span class="countdown-num d-block"></span>
            <span class="countdown-word text-uppercase text-secondary">Sec</span>
          </div>
        </div>

        <a href="{{route('public.shop.index')}}" class="btn-link default-underline text-uppercase fw-medium mt-3">View All</a>
      </div>
      <div class="col-md-6 col-lg-8 col-xl-80per">
        <div class="position-relative">
          <div class="swiper-container js-swiper-slider" data-settings='{
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": 4,
              "slidesPerGroup": 4,
              "effect": "none",
              "loop": false,
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "slidesPerGroup": 2,
                  "spaceBetween": 14
                },
                "768": {
                  "slidesPerView": 2,
                  "slidesPerGroup": 3,
                  "spaceBetween": 24
                },
                "992": {
                  "slidesPerView": 3,
                  "slidesPerGroup": 1,
                  "spaceBetween": 30,
                  "pagination": false
                },
                "1200": {
                  "slidesPerView": 4,
                  "slidesPerGroup": 1,
                  "spaceBetween": 30,
                  "pagination": false
                }
              }
            }'>
            <div class="swiper-wrapper">
                @foreach ($hot_deals as $product)
                    <div class="swiper-slide product-card product-card_style3">
                        <div class="pc__img-wrapper">
                        <a href="{{route('public.shop.details', ['slug' => $product->slug])}}">
                            <img loading="lazy" src="{{$product->getThumbnailImage()}}" width="258" height="313"
                            alt="Cropped Faux leather Jacket" class="pc__img">
                            @if ($product->gallery_images->count() > 0)
                                <img loading="lazy" src="{{asset($product->gallery_images[0]->attachment)}}" width="258" height="313" alt="Cropped Faux leather Jacket" class="pc__img pc__img-second">
                            @endif
                        </a>
                        </div>
        
                        <div class="pc__info position-relative">
                        <h6 class="pc__title"><a href="{{route('public.shop.details', ['slug' => $product->slug])}}">{{$product->name}}</a></h6>
                        <div class="product-card__price d-flex">
                            @if ($product->sale_price)   
                                <span class="current-price me-2">{{getFormattedAmount($product->sale_price)}}</span>
                                <del style="font-size: 14px;">{{getFormattedAmount($product->price)}}</del>
                            @else
                                <span class="current-price">{{getFormattedAmount($product->price)}}</span>
                            @endif
                        </div>
        
                        <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body">
                            <form name="addtocart-form" method="post" action="{{route('public.cart.add_cart')}}">
                                @csrf
                                <div class="">
                                    <input type="hidden" name="quantity" value="1" min="1">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="price" value="{{$product->sale_price}}">
                                    <button type="submit" class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart" title="Add To Cart" data-aside="cartDrawer">Add To Cart</button>
                                </div>
                            </form>
                            <button class="pc__btn-wl bg-transparent border-0" title="Add To Wishlist">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        </div>
                    </div>
                @endforeach
            </div><!-- /.swiper-wrapper -->
          </div><!-- /.swiper-container js-swiper-slider -->
        </div><!-- /.position-relative -->
      </div>
    </div>
</section>

<div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

<section class="category-banner container">
    <div class="row">
      <div class="col-md-6">
        <div class="category-banner__item border-radius-10 mb-5">
          <img loading="lazy" class="h-auto" src="{{asset('frontend/images/home/demo3/category_9.jpg')}}" width="690" height="665"
            alt="" />
          <div class="category-banner__item-mark">
            Starting at $19
          </div>
          <div class="category-banner__item-content">
            <h3 class="mb-0">Blazers</h3>
            <a href="{{route('public.shop.index')}}" class="btn-link default-underline text-uppercase fw-medium">Shop Now</a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="category-banner__item border-radius-10 mb-5">
          <img loading="lazy" class="h-auto" src="{{asset('frontend/images/home/demo3/category_10.jpg')}}" width="690" height="665"
            alt="" />
          <div class="category-banner__item-mark">
            Starting at $19
          </div>
          <div class="category-banner__item-content">
            <h3 class="mb-0">Sportswear</h3>
            <a href="{{route('public.shop.index')}}" class="btn-link default-underline text-uppercase fw-medium">Shop Now</a>
          </div>
        </div>
      </div>
    </div>
</section>