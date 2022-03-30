@extends('layouts.admin')
@section('content')

<div class="container-fluid mt-5">
    <div class="row">
       <div class="col-md-12">
          <div class="card">
             <div class="card-body">
                 <h6>Collection / Products</h6>
             </div>
          </div>
       </div>
    </div>
    <div style="padding-top:6px" class="row">
       <div class="col-md-12">
          <div class="card">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
             <div class="card-body">
                 <form action="{{url('product-update/'.$product->id)}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="product-tab" data-toggle="tab" href="#product" role="tab">Product</a>
                        </li>
                       <li class="nav-item" role="presentation">
                          <a class="nav-link" id="descriptions-tab" data-toggle="tab" href="#descriptions" role="tab" >Descriptions</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab">Product Status</a>
                        </li>
                      </ul>

                      <div class="tab-content border p-3" id="myTabContent">

                            <div class="tab-pane fade show active" id="product" role="tabpanel" >

                                <div class="tab-pane fade show active" id="product" role="tabpanel" >
                                    <div class="row mt-3">
                                       <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="">Product Name</label>
                                            <input type="text" name="name" value="{{$product->name}}" class="form-control" placeholder="Product Name" required>
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <label for="">Select Sub-Category (Eg: Brands)</label>
                                             <select name="sub_category_id" class="form-control" required>
                                                <option value="{{$product->sub_category_id}}">{{$product->subcategory->name}}</option>
                                                @foreach ($subcategory as $subcateitem)
                                                <option value="{{ $subcateitem->id }}">{{ $subcateitem->name }}</option>
                                               @endforeach
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-12">
                                         <div class="form-group">
                                             <label for="">Custom URL (Slug)</label>
                                             <input type="text" name="url" value="{{$product->url}}" placeholder="Custom URL" class="form-control" required>
                                          </div>
                                       </div>
                                       <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="">Small Description</label>
                                              <textarea rows="4" name="small_description" class="form-control" placeholder="Small Description about Product">{{$product->small_description}}</textarea>
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Product Image</label>
                                                <input type="file" name="prod_image" placeholder="Product Image" class="form-control" />
                                                <img src="{{asset('uploads/products/'.$product->image)}}" width="50px" height="50px" >
                                            </div>
                                        </div>
                                       <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Original Price</label>
                                                <input type="number" name="original_price" value="{{$product->original_price}}" placeholder="Original Price" class="form-control" />
                                            </div>
                                       </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">offer Price</label>
                                                <input type="number" name="offer_price" value="{{$product->offer_price}}" placeholder="offer Price" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Quantity</label>
                                                <input type="number" name="quantity" value="{{$product->quantity}}" placeholder="Quantity" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Priority</label>
                                                <input type="number" name="priority" value="{{$product->priority}}" placeholder="Priority" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="descriptions" role="tabpanel">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                             <label for="">High Lights</label>
                                             <input type="text" name="p_highlight_heading" value="{{$product->p_highlight_heading}}" placeholder="High-Light Heading" class="form-control">
                                             <textarea name="p_highlights" placeholder="High-Light Description" rows="4" class="form-control">{{$product->p_highlights}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                             <label for="">Product Description</label>
                                             <input type="text" name="p_description_heading" value="{{$product->P_description_heading}}" placeholder="Product Description" class="form-control">
                                             <textarea name="p_description" placeholder="Product Description" rows="4" class="form-control">{{$product->p_description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                             <label for="">Product Details/Specification</label>
                                             <input type="text" name="p_details_heading" value="{{$product->P_det_heading}}" placeholder="Product Details/Specification Heading" class="form-control">
                                             <textarea name="p_details" placeholder="Product Details/Specification" rows="4" class="form-control">{{$product->p_details}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                           
                            <div class="tab-pane fade" id="status" role="tabpanel">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                           <label for="">New Arrivals</label>
                                           <input type="checkbox" name="new_arrival" {{$product->new_arrival_products=='1'?'checked':''}} class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                           <label for="">Featured Products</label>
                                           <input type="checkbox" name="featured_products" {{$product->featured_products=='1'?'checked':''}} class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                           <label for="">Popular Products</label>
                                           <input type="checkbox" name="popular_products" {{$product->popular_products=='1'?'checked':''}} class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                           <label for="">offer Products</label>
                                           <input type="checkbox" name="offers_products" {{$product->offers_products=='1'?'checked':''}} class="form-control" />
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Show Hide</label>
                                            <input type="checkbox" name="status" {{$product->status=='1'?'checked':''}} class="form-control" />
                                        </div>
                                     </div>
                                </div>
                            </div>
        
                      </div>
                      <div class="form-group mt-3 text-right">
                          <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                 </form>
             </div>
          </div>
       </div>
    </div>
 </div>
 @endsection