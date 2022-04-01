@extends('layouts.admin')
@section('content')

<div class="modal fade" id="subcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sub Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{url('sub-category-store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-body">         
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Category Id (Name)</label>
                                <select name="category_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($category as $catitem)
                                    <option value="{{$catitem->id}}">{{$catitem->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Custom URL(Slug)</label>
                                <input type="text" name="url" class="form-control" placeholder="Enter Url">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea rows="4" name="description" class="form-control" placeholder="Enter Description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-top:10px">
                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" name="image">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Priority</label>
                                <input type="number" name="priority" class="form-control" placeholder="Enter Priority">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Show / Hide</label>
                                <input type="checkbox" name="status" class="" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> 
                    </div>   
            </div>
        </form>
      </div>
    </div>
  </div>

<div class="container-fluid mt-5">
      <!-- Heading -->
      <div class="card mb-4 wOw fadeIn">
       <div class="card-body d-sm-flex justify-content-between">
          <h6 class="mb-2 mb-sm-0 pt-1">
            <a href="#">Collections</a>
            <span>/</span>
            <span>Sub-Category</span>
            <a style="position:absolute;top: 10px;right:0;" href="#" data-toggle="modal" data-target="#subcategoryModal" class="btn btn-primary py-2">Add Sub-Category</a>
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
                            <th>Category Name</th>
                            <th>Image</th>
                            <th>Show/Hide</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($subcategory as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->category->name}}</td>
                                <td>
                                    <img src="{{asset('uploads/subcategory/'.$item->image)}}" width="50px" height="50px" >
                                </td>
                                <td>
                                    <input type="checkbox" {{$item->status=='1'?'checked':''}} >
                                </td>
                                <td>
                                    <a href="{{url('sub-category-edit/'.$item->id)}}" class="badge btn-primary">Edit</a>
                                    <a href="{{url('sub-category-delete/'.$item->id)}}" class="badge btn-danger">Delete</a>
                                </td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{$subcategory->links()}}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection