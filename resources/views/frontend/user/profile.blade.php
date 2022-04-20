@extends('layouts.frontend')

@section('title')
   My Profile
@endsection

@section('content')

  <section class="py-5">
    <div class="container">
        <div class="row">
            @if ($errors->has('name'))
            <span class="help-block">
                <strong> {{ $errors->first('name') }}</strong>
            </span>
            @endif
            @if ($errors->has('lname'))
            <span class="help-block">
                <strong> {{ $errors->first('lname') }}</strong>
            </span>
            @endif
            @if ($errors->has('address'))
            <span class="help-block">
                <strong> {{ $errors->first('address') }}</strong>
            </span>
            @endif
            @if ($errors->has('city'))
            <span class="help-block">
                <strong> {{ $errors->first('city') }}</strong>
            </span>
            @endif
            @if ($errors->has('pincode'))
            <span class="help-block">
                <strong> {{ $errors->first('pincode') }}</strong>
            </span>
            @endif
            @if ($errors->has('phoneno'))
            <span class="help-block">
                <strong> {{ $errors->first('phoneno') }}</strong>
            </span>
            @endif
            @if ($errors->has('state'))
            <span class="help-block">
                <strong> {{ $errors->first('state') }}</strong>
            </span>
            @endif
            @if ($errors->has('image'))
            <span class="help-block">
                <strong> {{ $errors->first('image') }}</strong>
            </span>
            @endif
            <div class="col-md-12" >
                <div class="card">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                    <div class="card-body">
                        <form action="{{url('my-profile-updatee')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4">
                                   <div class="form-group">
                                        <label for="">First Name</label>
                                       <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                                   </div>
                                </div>
                               <div class="col-md-4">
                                   <div class="form-group">
                                       <label for="">Last Name</label>
                                       <input type="text" name="lname" class="form-control" value="{{ Auth::user()->lname }}">
                                   </div>
                                </div>
                                <div class="col-md-4">
                                    <img style="padding-left:40px" src="{{asset('uploads/profile/'.Auth::user()->image)}}"  width="150px" alt="">
                                    <input name="image" style="padding-top:20px;padding-left:40px" type="file">
                                 </div>
                                <div class="col-md-12">
                                   <div class="form-group">
                                        <label for="">Address 1 (FlatNo, Apt No & Address)</label>
                                       <input type="text" name="address" class="form-control" value="{{ Auth::user()->address }}">
                                   </div>
                                </div>
                               
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">City</label>
                                       <input type="text" name="city" class="form-control" value="{{ Auth::user()->city }}">
                                   </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">State</label>
                                       <input type="text" name="state" class="form-control" value="{{ Auth::user()->state }}">
                                   </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Pincode/Zipcode</label>
                                       <input type="text" name="pincode" class="form-control" value="{{ Auth::user()->pincode }}">
                                   </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                       <input type="text" class="form-control" readonly value="{{ Auth::user()->email }}">
                                   </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Phone No</label>
                                       <input type="text" name="phoneno" class="form-control" value="{{ Auth::user()->phoneno }}">
                                   </div>
                                </div>
                                <div class="col-md-4" style="padding-top:20px">
                                    <div class="form-group">
                                       <button type="submit" name="submit" class="btn btn-primary">Update Profile</button>
                                   </div>
                                </div>
                                

                            </div>
                        </form>
                    </div>
                </div>
               
            
            </div>                
        </div>
    </div>
   </section>

@endsection