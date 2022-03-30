@extends('layouts.admin') 
@section('content')

<div class="container-fluid mt-5">

    <!-- Heading -->
    <div class="card mb-4 wow fadeIn">

      <!--Card content-->
      <div class="card-body d-sm-flex justify-content-between">

        <h4 class="mb-2 mb-sm-0 pt-1">
          <span>Registered Users - Edit Role</span>
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

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
              
            <h4>Current Role: {{ $user_roles->role_as }}</h4>
            <h5>
              isBan Status:
              @if($user_roles->isban=='0')
                 <label class="py-2 px-3 badge btn-primary"> Not Banned</label> 
                  @elseif($user_roles->isban=='1')
                  <label class="py-2 px-3 badge btn-danger"> Banned</label>
              @endif
            </h5>
            <form action="{{ url('role-update/'.$user_roles->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <input type="text" name="name" class="form-control" value="{{ $user_roles->name }}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" readonly value="{{ $user_roles->email }}">
                </div>
                <div class="form-group">
                    <select name="roles" class="form-control">
                        <option value="">--Select Role--</option>
                        <option value="">Default</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="form-group">
                  <select name="isban" class="form-control">
                      <option value="">--Select Ban or UnBan--</option>
                      <option value="0">UnBan</option>
                      <option value="1">Ban</option>
                  </select>
              </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form> 

          </div>
        </div>
      </div>

    </div>

@endsection