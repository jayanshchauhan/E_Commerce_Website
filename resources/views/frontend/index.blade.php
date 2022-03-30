@extends('layouts.frontend')

@section('title')
   Home
@endsection

@section('content')

  @include('frontend.slider.slider')

  <section class="py-5">
    <div class="container">
        <div class="row">
                @for($i=1;$i<=4;$i++)
                <div class="col-md-3 col-6 mt-3">

                    <!--Card-->
                    <div class="card">

                    <!--Card image-->
                    <div class="view overlay">
                        <a>  
                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12.jpg" class="card-img-top" alt="">
                        <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>
                    <!--Card image-->

                    <!--Card content-->
                    <div class="card-body text-center">
                        <!--Category & Title-->
                        <a href="" class="grey-text">
                        <h5>Shirt</h5>
                        </a>
                        <h5>
                        <strong>
                            <a href="" class="dark-grey-text">Denim shirt
                            <span class="badge badge-pill danger-color">NEW</span>
                            </a>
                        </strong>
                        </h5>

                        <h4 class="font-weight-bold blue-text">
                        <strong>120$</strong>
                        </h4>
                    </div>

                    </div>
                </div>
                @endfor

        </div>
    </div>
   </section>

@endsection