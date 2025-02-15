@extends('admin.layouts.master')

@section('content')
    <div class="main-content-wrap">
        @include('admin.layouts.partials.breadcrumb', ['header' => 'Products'])
        
        <div class="wg-box">
            <div class="table-all-user">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 100px">#Id</th>
                                {{-- <th style="width: 100px; padding-bottom: 4px">Attachment</th> --}}
                                <th>Name</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Price</th>
                                <th>Sale Price</th>
                                <th>Quantity</th>
                                <th>Stock</th>
                                <th>Featured</th>
                                <th style="width: 100px; margin: auto">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('admin.assets.dt')
{{-- @include('admin.assets.select2') --}}
@include('admin.assets.dt-buttons')
{{-- @include('admin.assets.datetimepicker') --}}
@include('admin.assets.dt-buttons-export')

@push('scripts')
 @vite('resources/admin/js/pages/product/index.js');
@endpush