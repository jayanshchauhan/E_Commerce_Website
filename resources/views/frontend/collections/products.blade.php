@extends('layouts.frontend')
@section('title')
    Collection - Category - Subcategory - Products
@endsection

@section('content')
<div class="card mb-5 card py-3">
   <div class="container">
        <div class="row">
            <div class="col-md-12">
                <label class="mb-0">Collection / {{ $subcategory->category->group->name }} /{{ $subcategory->category->name }}/{{$subcategory->name}}</label>
            </div>
        </div>
    </div>
</div> 
<div class="container">
   <div class="row">
        <div class="col-md-12 mb-3">
            <span class="font-weight-bold sort-font">Sort By :</span>
            <a href="{{ URL::current () }}" class="sort-font">All</a>
            <a href="{{ URL::current (). "?sort=price_asc" }}" class="sort-font">Price - Low to High</a>
            <a href="{{ URL::current(). "?sort=price_desc" }}" class="sort-font">Price High to Low</a>
            <a href="{{ URL::current ()."?sort=newest" }}" class="sort-font">Newest</a>
        </div>
        <div class="col-md-12">
            <div class="row">
                @foreach ($products as $product_item)
                <div class="col-md-12 mb-3">
                    <div class="card">
                         <div class="card-body">
                             <div class="row">
                                 <div class="col-md-3">
                                      <div class="">
                                           <img src="{{ asset('uploads/products/'.$product_item->image) }}" class="w-100" height="200px" alt="">
                                      </div>
                                 </div>
                                  <div class="col-md-7 border-right border-left">
                                    <a href="{{url('collection/'.$product_item->subcategory->category->group->url.'/'.$product_item->subcategory->category->url.'/'.$product_item->subcategory->url.'/'.$product_item->url)}}" class="text-center">
                                        <h5 class=" mb-2">{{ $product_item->name }}</h5>
                                      </a>
                                      <div class="">
                                           <h6 class="text-dark mb-0">{!! $product_item->p_highlights !!}</h6>
                                      </div>
                                 </div>
                                 <div class="col-md-2">
                                     <div class="text-right">
                                          <h6 class="font-italic text-dark badge badge-warning px-3 py-1">{{ $product_item->sale_tag }}</h6>
                                         <h6 class="font-italic orig_price"><s> Rs: {{ number_format($product_item->original_price) }} </s></h6>
                                         <h5 class="font-italic font-weight-bold">Rs: {{ number_format($product_item->offer_price) }}</h5>
                                      </div>
                                     <div class="text-right">
                                          <div>
                                              <a href="{{ url('collection/'.$product_item->subcategory->category->group->url.'/'.$product_item->subcategory->category->url.'/'.$product_item->subcategory->url.'/'.$product_item->url)}}" class="btn btn-outline-primary py-1 px-2">
                                                  View Details
                                              </a>
                                          </div>
                                      </div>
                                 </div>
                             </div>
                         </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="float-right">
                {{$products->links()}}
            </div>
        </div>
    </div>
</div>
@endsection

