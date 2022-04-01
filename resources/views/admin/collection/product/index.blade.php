@extends('layouts.admin')
@section('content')
<div class="container-fluid mt-5">
      <!-- Heading -->
      <div class="card mb-4 wOw fadeIn">
       <div class="card-body d-sm-flex justify-content-between">
          <h6 class="mb-2 mb-sm-0 pt-1">
            <a href="#">Collections</a>
            <span>/</span>
            <span>Products</span>
            <a style="position:absolute;top: 10px;right:0;" href="{{url('product-add')}}" class="btn btn-primary py-2">Add Product</a>
          </h6>
        </div>
      </div>
      <!-- Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Sub-Category Name</th>
                            <th>Image</th>
                            <th>Show/Hide</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->subcategory->name}}</td>
                                <td><img src="{{asset('uploads/products/'.$item->image)}}" width="50px" height="50px"></td>
                                <td>
                                    <input type="checkbox" {{$item->status=='1'?'checked':''}}>
                                </td>
                                <td>
                                    <a href="{{url('product-edit/'.$item->id)}}" class="badge btn-primary">Edit</a>
                                    <a href="{{url('product-delete/'.$item->id)}}" class="badge btn-danger">Delete</a>
                                </td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{$products->links()}}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection