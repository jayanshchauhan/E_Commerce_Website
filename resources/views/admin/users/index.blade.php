@extends('layouts.admin')
@section('content')

<div class="container-fluid mt-5">

    <!-- Heading -->
    <div class="card mb-4 wow fadeIn">

      <!--Card content-->
      <div class="card-body d-sm-flex justify-content-between">

        <h4 class="mb-2 mb-sm-0 pt-1">
          <a href="https://mdbootstrap.com/docs/jquery/" target="_blank">Home Page</a>
          <span>/</span>
          <span>Registered Users</span>
        </h4>

      </div>

    </div>
    <!-- Heading -->

    <!--Grid row-->
    <div class="row">

      <!--Grid column-->
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
              <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Role As</th>
                          <th>isBan/UnBanned</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                <tbody>
                    @foreach($users as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->role_as}}</td>
                        <td>
                          @if($item->isban=='0')
                            <label class="py-2 px-3 badge btn-primary"> Not Banned</label> 
                          @elseif($item->isban=='1')
                          <label class="py-2 px-3 badge btn-danger"> Banned</label>
                          @endif
                        </td>
                        <td>
                            <a href="{{url('role-edit/'.$item->id)}}" class="badge badge-pill btn btn-primary px-3 py-2">Edit</a>
                            <a href="{{url('role-delete/'.$item->id)}}" class="badge badge-pill btn btn-danger px-3 py-2">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <div class="float-right">
               {{$users->links()}}
              </div>
          </div>
        </div>
      </div>

    </div>

@endsection