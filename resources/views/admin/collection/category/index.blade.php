@extends('layouts.admin')
@section('content')
<div class="container-fluid mt-5">
      <!-- Heading -->
      <div class="card mb-4 wOw fadeIn">
       <div class="card-body d-sm-flex justify-content-between">
          <h6 class="mb-2 mb-sm-0 pt-1">
            <a href="#">Collections</a>
            <span>/</span>
            <span>Category</span>
            <a style="position:absolute;top: 10px;right:0;" href="{{url('category-add')}}" class="btn btn-primary py-2">Add Category</a>
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
                            <th>Group Name</th>
                            <th>Image</th>
                            <th>Show/Hide</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($category as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->group->name}}</td>
                                <td>
                                    <img src="{{asset('uploads/category/'.$item->image)}}" width="50px" >
                                </td>
                                <td>
                                    <input type="checkbox" {{$item->status=='1'?'checked':''}} >
                                </td>
                                <td>
                                    <a href="{{url('category-edit/'.$item->id)}}" class="badge btn-primary">Edit</a>
                                    <a href="{{url('category-delete/'.$item->id)}}" class="badge btn-danger">Delete</a>
                                </td>
                                </tr>
                            @endforeach      
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{$category->links()}}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection