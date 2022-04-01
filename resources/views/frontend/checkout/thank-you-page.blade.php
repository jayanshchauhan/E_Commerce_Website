@extends('layouts.frontend')

@section('title')
Thank You
@endsection

@section('content')

<section class="bg-success">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-2 py-3">
                <h5><a href="/" class="text-dark">Home</a> › Thank You</h5>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 mycard py-5 text-center">
                        <div class="mycards">
                            <h3>Your Order has been Placed.</h3>
                            <h5>Thank You for Shopping </h5>
                            <h6>Have a Good day!</h6>

                            <a href="{{ url('collections') }}" class="btn btn-upper btn-primary outer-left-xs mt-5">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection