<div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

<section class="products-grid container">
<h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">Featured Products</h2>

<div class="row" id="product-container">
    @foreach ($products as $product)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="product-card product-card_style3 mb-3 mb-md-4 mb-xxl-5">
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
        </div>
    @endforeach
</div><!-- /.row -->

@if ($hasMore)
<div class="text-center mt-2">
    <button id="load-more" class="btn-link btn-link_lg default-underline text-uppercase fw-medium" data-offset="12">
        Load More
    </button>
</div>
@endif
</section>

<div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

@push('scripts')
<script>
    $(document).ready(function () {
        $('#load-more').click(function () {
            let offset = $(this).data('offset');
    
            $.ajax({
                url: "/load-more",
                type: "GET",
                data: { offset: offset },
                dataType: "json",
                success: function (response) {
                    if (response.html) {
                        $('#product-container').append(response.html);
    
                        // Update the offset
                        $('#load-more').data('offset', offset + 12);
    
                    }
                    
                    // Hide button if no more products
                    if (!response.html) {
                        $('#load-more').hide();
                    }
                }
            });
        });
    });
    </script>
@endpush