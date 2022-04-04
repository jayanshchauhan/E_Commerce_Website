@extends('layouts.frontend')
@section('title')
    collection
@endsection
@section('content')
    <section class="py-5">
       <div class="container">
           <div class="row">
                <div class="col-md-12">
                    <div class="card">
                       <div class="card-header">
                            <h5>Collections / Groups </h5>
                        </div>
                        <div class="card-body">
                            @foreach ($groups as $item)
                                <a href="{{ url('collection/'.$item->url) }}" class="btn btn-info px-3 mx-3">
                                   {{ $item->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection