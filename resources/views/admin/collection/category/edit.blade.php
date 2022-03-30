@extends('layouts.admin')
@section('content')

<div class="container-fluid mt-5">
    <div class="row">
       <div class="col-md-12">
          <div class="card">
             <div class="card-body">
                 <h6>Collection / Category Edit</h6>
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
                 <form action="{{url('category-update/'.$category->id)}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Group Id (Name)</label>
                                <select name="group_id" class="form-control">
                                    <option value="{{$category->group_id}}">{{$category->group->name}}</option>
                                    @foreach ($group as $gitem)
                                    <option value="{{$gitem->id}}">{{$gitem->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{$category->name}}" class="form-control" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Custom URL(Slug)</label>
                                <input type="text" name="url" value="{{$category->url}}" class="form-control" placeholder="Enter Url">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea rows="4" name="description" class="form-control" placeholder="Enter Description">{{$category->description}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-top:10px">
                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" name="image">
                                <img src="{{asset('uploads/category/'.$category->image)}}" width="50px" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Show / Hide</label>
                                <input type="checkbox" name="status" {{$category->status=='1'?'checked':''}} placeholder="Enter Name">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"> Save </button>
                        </div>
                    </div>
                 </form>
             </div>
          </div>
       </div>
    </div>
 </div>
 @endsection