@extends('public.layouts.master')

@section('content')
<main class="pt-90" style="padding-top: 0px;">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <div class="row">
            @include('public.user_dashboard.partials.sidebar')

            @yield('dashboardContent')
            
        </div>
    </section>
</main>
@endsection