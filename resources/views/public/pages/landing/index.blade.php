@extends('public.layouts.master')

@section('content')
<main class="pt-90">
    {{-- Hero Section --}}
    @include('public.pages.landing.hero')

    <div class="container mw-1620 bg-white border-radius-10">
        <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>
        {{-- Category Section --}}
        @include('public.pages.landing.category')

        {{-- Hot Deals Section --}}
        @include('public.pages.landing.hot_deals')

        {{-- Featured Products Section --}}
        @include('public.pages.landing.featured_products')

    </div>
</main>
@endsection