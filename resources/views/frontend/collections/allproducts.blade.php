@extends('layouts.frontend')
@section('title')
    Collection - Category - Subcategory - Products
@endsection

@section('content')
<div class="container-fluid mt-5">
<div class="card mb-5 card py-3">
   <div class="container">
        <div class="row">
            <div class="col-md-12">
                <label class="mb-0">All Products</label>
            </div>
        </div>
    </div>
</div> 
<div class="container">
   <div class="row">
        <div class="col-md-12 mb-3">
            <span class="font-weight-bold sort-font">Sort By :</span>
            <a href="{{ URL::current () }}" class="sort-font">All</a>
            <a href="{{URL::current()."?sort=price_asc" }}" class="sort-font">Price - Low to High</a>
            <a href="{{ URL::current()."?sort=price_desc" }}" class="sort-font">Price High to Low</a>
            <a href="{{ URL::current ()."?sort=newest" }}" class="sort-font">Newest</a>
        </div>
   </div>
</div>

<div class="row">

        <div class="col-md-12">
            <div class="card">
                @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="table1">
                        <thead>
                            
                            <th style="width:20%">Image</th>
                            <th style="text-align:center">Description</th>
                            <th style="width:12.5%">Details</th>
                        </thead>
                        <tbody>
                            
                            @foreach ($products as $product_item)
                            <tr>
                                
                                <td>
                                        <img src="{{ asset('uploads/products/'.$product_item->image) }}" class="w-100" height="200px" alt="">             
                                </td>
                                <td>
                                   
                                    <a href="{{url('api/'.$product_item->url)}}" class="text-center">
                                        <h5 class="mb-2" style="color: blue">{{ $product_item->name }}</h5>
                                    </a>
                                    
                                        <h6 class="text-dark mb-0">{!! $product_item->p_highlights !!}</h6>
                                </td>
                                <td>
                                        <h6 class="font-italic text-dark badge badge-warning px-3 py-1">{{ $product_item->sale_tag }}</h6>
                                        <h6 class="font-italic orig_price"><s> Rs: {{ number_format($product_item->original_price) }} </s></h6>
                                        <h5 class="font-italic font-weight-bold">Rs: {{ number_format($product_item->offer_price) }}</h5>
                                    
                                    <div class="text-right">
                                        <div>
                                            <a href="{{url('details/'.$product_item->url)}}" class="btn btn-outline-primary py-1 px-2">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                
                                </td>
                                         
                                        
                            </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready( function () {
    $('#table1').DataTable();
} );
</script>
@endsection