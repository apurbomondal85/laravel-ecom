@extends('public.layouts.master')

@section('content')
<main>
    <div class="mb-4 pb-4"></div>
    @if (count($carts) > 0)
        <section class="shop-checkout container">
            <h2 class="page-title">Cart</h2>
            <div class="checkout-steps">
            <a href="cart.html" class="checkout-steps__item active">
                <span class="checkout-steps__item-number">01</span>
                <span class="checkout-steps__item-title">
                <span>Shopping Bag</span>
                <em>Manage Your Items List</em>
                </span>
            </a>
            <a href="checkout.html" class="checkout-steps__item">
                <span class="checkout-steps__item-number">02</span>
                <span class="checkout-steps__item-title">
                <span>Shipping and Checkout</span>
                <em>Checkout Your Items List</em>
                </span>
            </a>
            <a href="order-confirmation.html" class="checkout-steps__item">
                <span class="checkout-steps__item-number">03</span>
                <span class="checkout-steps__item-title">
                <span>Confirmation</span>
                <em>Review And Submit Your Order</em>
                </span>
            </a>
            </div>
            <div class="shopping-cart">
            <div class="cart-table__wrapper">
                @php
                    $subtotal = 0;
                    $totalAmount = 0;
                @endphp
                <table class="cart-table">
                <thead>
                    <tr>
                    <th>Product</th>
                    <th></th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                    @php
                        $subtotal += $cart->price * $cart->quantity;
                        $totalAmount += $cart->price * $cart->quantity;
                    @endphp
                    <tr class="cartItems">
                        <td>
                        <div class="shopping-cart__product-item">
                            <img loading="lazy" src="{{$cart->product->getThumbnailImage()}}" width="120" height="120" alt="" />
                        </div>
                        </td>
                        <td>
                        <div class="shopping-cart__product-item__detail">
                            <h4>{{$cart->product->name}}</h4>
                            {{-- <ul class="shopping-cart__product-item__options">
                            <li>Color: Yellow</li>
                            <li>Size: L</li>
                            </ul> --}}
                        </div>
                        </td>
                        <td>
                        <span class="shopping-cart__product-price">{{getFormattedAmount($cart->price)}}</span>
                        </td>
                        <td>
                        <div class="qty-control position-relative">
                            <input type="number" name="quantity" value="{{$cart->quantity}}" min="1" class="qty-control__number qty-input text-center">
                            <div class="qty-control__reduce_cart qty-left-minus">-</div>
                            <div class="qty-control__increase_cart qty-right-plus">+</div>
                        </div>
                        </td>
                        <td>
                        <span class="shopping-cart__subtotal">{{getFormattedAmount($cart->price * $cart->quantity)}}</span>
                        </td>
                        <td>
                        <form method="POST" action="{{route('public.cart.delete', $cart->id)}}">
                            @csrf
                            <button type="submit" class="remove-cart btn btn-sm text-danger">
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                <path d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                </svg>
                            </button>
                        </form>
                        </td>
                        <input type="hidden" name="price" class="unitPrice" value="{{ $cart->product->sale_price }}">
                        <input type="hidden" name="current_stock" class="current_stock" value="{{ $cart->product->quantity }}">
                    </tr>
                    @endforeach
                </tbody>
                </table>
                <div class="cart-table-footer">
                <form action="#" class="position-relative bg-body">
                    <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code">
                    <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit"
                    value="APPLY COUPON">
                </form>
                {{-- <button class="btn btn-light">UPDATE CART</button> --}}
                </div>
            </div>
            <div class="shopping-cart__totals-wrapper">
                <div class="sticky-content">
                <div class="shopping-cart__totals">
                    <h3>Cart Totals</h3>
                    <table class="cart-totals">
                    <tbody>
                        <tr>
                        <th>Subtotal</th>
                        <td class="subtotal">{{getFormattedAmount($subtotal)}}</td>
                        </tr>
                        <tr>
                        <th>Coupon Discount</th>
                        <td class="coupon_discount">$0</td>
                        </tr>
                        <tr>
                        <th>Total</th>
                        <td class="total_amount">{{getFormattedAmount($totalAmount)}}</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <div class="mobile_fixed-btn_wrapper">
                    <div class="button-wrapper container">
                    <a href="checkout.html" id="checkoutButton" class="btn btn-primary btn-checkout">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </section>
    @else
      <div class="text-center">
        <p>Your shopping cart is currently empty.</p>
        <div class="button-wrapper container">
          <a href="{{ url('/') }}" class="btn btn-primary">Continue Shopping</a>
        </div>
      </div>
    @endif
</main>
@endsection

@push('scripts')
@vite('resources/frontend/js/pages/cart/cart.js');
@endpush

@push('styles')
    <style>
        .qty-control__reduce_cart, .qty-control__increase_cart {
            position: absolute;
            top: 0;
            width: .75rem;
            padding: 0;
            cursor: pointer;
            user-select: none;
            -ms-user-select: none;
        }

        .qty-control__increase_cart{
            right: 1.25rem;
        }
    </style>
@endpush