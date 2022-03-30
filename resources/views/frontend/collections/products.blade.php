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
        <div class="col-md-12">
            <div class="row">
                @foreach ($products as $product_item)
                <div class="col-md-3 mb-4">
                    <a href="{{url('collection/'.$product_item->subcategory->category->group->url.'/'.$product_item->subcategory->category->url.'/'.$product_item->subcategory->url.'/'.$product_item->url)}}" class="text-center">
                    <div class="card">
                        <img src="{{ asset('uploads/products/'.$product_item->image) }}" class="w-100" height="200px" alt="">
                       <div class="card-body bg-light">
                                <h6 class="mb-0">{{ $product_item->name }}</h6>
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection