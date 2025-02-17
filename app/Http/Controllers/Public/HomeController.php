<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::active()->orderBy('name')->get();
        $hot_deals = Product::featured()->orderBy('price', 'asc')->limit(10)->get();

        $products = Product::featured()
                            ->orderBy('created_at', 'desc')
                            ->limit(12)
                            ->offset(0)
                            ->get();

        $hasMore = Product::featured()
                        ->offset(12)
                        ->limit(1)
                        ->exists();

        return view('public.pages.landing.index', [
            'categories'=> $categories,
            'hot_deals'=> $hot_deals,
            'products'=> $products,
            'hasMore'=> $hasMore
        ]);
    }

    public function loadMore(Request $request)
    {
        $limit = 12;
        $offset = $request->offset ?? 0;

        $products = Product::featured()
                            ->orderBy('created_at', 'desc')
                            ->limit($limit)
                            ->offset($offset)
                            ->get();

        $html = '';

        foreach ($products as $product) {
            $html .= '<div class="col-6 col-md-4 col-lg-3">
                <div class="product-card product-card_style3 mb-3 mb-md-4 mb-xxl-5">
                    <div class="pc__img-wrapper">
                    <a href="'. route('public.shop.details', ['slug' => $product->slug]) .'">
                        <img loading="lazy" src="'.$product->getThumbnailImage().'" width="258" height="313"
                        alt="Cropped Faux leather Jacket" class="pc__img">';
                        if ($product->gallery_images->count() > 0){
                        $html .= '<img loading="lazy" src="'. asset($product->gallery_images[0]->attachment) .'" width="258" height="313" alt="Cropped Faux leather Jacket" class="pc__img pc__img-second">';
                        }
                    $html .= '</a>
                    </div>

                    <div class="pc__info position-relative">
                    <h6 class="pc__title"><a href="'. route('public.shop.details', ['slug' => $product->slug]) .'">'. $product->name .'</a></h6>
                    <div class="product-card__price d-flex">';
                        if ($product->sale_price){
                            $html .= '<span class="current-price me-2">'.getFormattedAmount($product->sale_price) .'</span>
                            <del style="font-size: 14px;">'.getFormattedAmount($product->price).'</del>';
                        }else{
                            $html .= '<span class="current-price">'.getFormattedAmount($product->price).'</span>';
                        }
                    $html .= '</div>

                    <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body">
                        <form name="addtocart-form" method="post" action="'. route('public.cart.add_cart') .'">
                            @csrf
                            <div class="">
                                <input type="hidden" name="quantity" value="1" min="1">
                                <input type="hidden" name="product_id" value="'.$product->id .'">
                                <input type="hidden" name="price" value="'. $product->sale_price .'">
                                <button type="submit" class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart" title="Add To Cart" data-aside="cartDrawer">Add To Cart</button>
                            </div>
                        </form>
                        <button class="pc__btn-wl bg-transparent border-0" title="Add To Wishlist">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    </div>
                </div>
            </div>';
        };

        return response()->json([
            'html' => $html,
            'success' => 'Success'
        ]);

    }

    public function dashboard()
    {
        return view('public.user_dashboard.dashboard');
    }
}
