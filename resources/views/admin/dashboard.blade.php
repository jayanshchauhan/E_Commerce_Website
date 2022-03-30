@extends('layouts.admin')

@section('title')
   Dashboard
@endsection

@section('content')

<div class="container-fluid mt-5">

    <!-- Heading -->
    <div class="card mb-4 wow fadeIn">

      <!--Card content-->
      <div class="card-body d-sm-flex justify-content-between">

        <h4 class="mb-2 mb-sm-0 pt-1">
          <a href="{{url('/dashboard')}}" target="_blank">Home Page</a>
          <span>/</span>
          <span>Dashboard</span>
        </h4>
<!--
        <form class="d-flex justify-content-center">
           Default input 
          <input type="search" placeholder="Type your query" aria-label="Search" class="form-control">
          <button class="btn btn-primary btn-sm my-0 p" type="submit">
            <i class="fa fa-search"></i>
          </button>

        </form>
      -->
      </div>

    </div>
    <!-- Heading -->

    <!--Grid row-->
    <div class="row">

      <!--Grid column-->
      <div class="col-md-12">

        <!--Card-->
        <div class="card">

          <!--Card content-->
          <div class="card-body">

            <a style="padding-left:320px" class="navbar-brand waves-effect" href="{{ url('/dashboard') }}" >
              <img src= {{url('images/download.png')}} alt="Trulli" width="300px" height="300px">
            </a>
            <h4 style="padding-left:260px">WELCOME TO THE ADMIN PORTAL</h4>
        
        </div>
        <!--/.Card-->
      </div>
      <!--Grid column-->
    </div>
@endsection