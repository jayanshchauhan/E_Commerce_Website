@extends('layouts.admin')
@section('content')
<div class="container-fluid mt-5">
      <!-- Heading -->
      <div class="card mb-4 wOw fadeIn">
       <div class="card-body d-sm-flex justify-content-between">
          <h6 class="mb-2 mb-sm-0 pt-1">
            <a href="#">Collections</a>
            <span>/</span>
            <span>Group</span>
            <a style="position:absolute;top:10px;right:0;" href="{{url('group-add')}}" class="btn btn-primary py-2">Add Group</a>
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
                            <th>Description</th>
                            <th>Show/Hide</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($group as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->descrip}}</td>
                                    <td>
                                        <input type="checkbox" {{$item->status == '1' ? 'checked' : ' ' }} >
                                    </td>
                                    <td>
                                        <a href="{{url('group-edit/'.$item->id)}}" class="badge btn-primary">Edit</a>
                                        <a href="{{url('group-delete/'.$item->id)}}" class="badge btn-danger">Delete</a>
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