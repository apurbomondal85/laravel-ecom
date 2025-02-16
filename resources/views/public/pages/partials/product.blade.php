<div class="product-card-wrapper">
    <div class="product-card mb-3 mb-md-4 mb-xxl-5">
      <div class="pc__img-wrapper">
        <div class="swiper-container background-img js-swiper-slider" data-settings='{"resizeObserver": true}'>
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <a href="{{route('public.shop.details', ['slug' => $product->slug])}}"><img loading="lazy" src="{{asset($product->getThumbnailImage())}}" width="330"
                  height="400" alt="Cropped Faux leather Jacket" class="pc__img"></a>
            </div>
            @foreach ($product->gallery_images as $item)
              <div class="swiper-slide">
                  <a href="{{route('public.shop.details', ['slug' => $product->slug])}}"><img loading="lazy" src="{{asset($item->attachment)}}"
                      width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img"></a>
              </div>
            @endforeach
          </div>
          <span class="pc__img-prev"><i class="fas fa-chevron-left"></i></span>
          <span class="pc__img-next"><i class="fas fa-chevron-right"></i></span>
        </div>
        <form name="addtocart-form" method="post" action="{{route('public.cart.add_cart')}}">
          @csrf
          <div class="product-single__addtocart">
              <input type="hidden" name="quantity" value="1" min="1">
              <input type="hidden" name="product_id" value="{{$product->id}}">
              <input type="hidden" name="price" value="{{$product->sale_price}}">
              <button type="submit" class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium" title="Add To Cart">Add To Cart</button>
          </div>
      </form>
      </div>

      <div class="pc__info position-relative">
        <p class="pc__category">{{$product?->category?->name}}</p>
        <h6 class="pc__title"><a href="{{route('public.shop.details', ['slug' => $product->slug])}}">{{$product->name}}</a></h6>
        <div class="product-card__price d-flex">
          @if ($product->sale_price)   
              <span class="current-price">{{getFormattedAmount($product->sale_price)}}</span>
              <del style="font-size: 14px;">{{getFormattedAmount($product->price)}}</del>
          @else
              <span class="current-price">{{getFormattedAmount($product->price)}}</span>
          @endif
        </div>
        {{-- <div class="product-card__review d-flex align-items-center">
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
          <span class="reviews-note text-lowercase text-secondary ms-1">8k+ reviews</span>
        </div> --}}

        <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
          title="Add To Wishlist">
          <i class="fas fa-heart"></i>
        </button>
      </div>
    </div>
</div>