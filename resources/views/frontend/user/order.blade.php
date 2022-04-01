@extends('layouts.frontend')

@section('title')
   My Order
@endsection

@section('content')

  <section class="py-5">
    <div class="container">
        <div class="row">
           
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        My Order List :
                    </div>
                </div>
            </div>     
            <div class="col-md-12" style="padding-top: 30px">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Payment</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @foreach($order as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->user->name}}&nbsp;{{$item->user->lname}}</td>
                                    <td>{{$item->Product}}</td>
                                    <td>{{$item->Price}}</td>
                                    <td>{{$item->Payment}}</td>
                                    <td>{{$item->Status}}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>             
        </div>
    </div>
   </section>

@endsection