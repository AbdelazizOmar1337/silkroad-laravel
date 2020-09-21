@extends('layouts.app')
@section('title', __('seo.donations'))
@section('content')
    <div class="rs-products col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="container">

            <div class="row">
                <div class="col">
                    <div class="title-style text-center mb-40 md-mb-20">
                        <h2 class="margin-0 uppercase">{{ __('donations.title') }}</h2>
                        <span class="line-bg y-b pt-10"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    {{ __('donations.message') }}
                </div>
            </div>

            <div class="row pt-3">
                @foreach($items as $item)

                    <div class="card" style="width: 18rem;">
{{--                        <img class="card-img-top" src="..." alt="Card image cap">--}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name_web }}</h5>
                            <p class="card-text">{{$item->description}}</p>
                            <a class="btn btn-primary" href="{{ route('donate-paypal', ['id' => $item->id]) }}"><i class="fa fa-paypal"></i> PayPal</a>
                        </div>
                    </div>

{{--                    <div class="col-sm mb-3">--}}
{{--                        <div class="products">--}}
{{--                            <div class="product-img">--}}
{{--                                <img src="image/products/{{ $loop->index }}.png"--}}
{{--                                     alt="xarena club img {{ $item->name_web }}">--}}
{{--                            </div>--}}
{{--                            <h4 class="product-title">{{ $item->name_web }}</h4>--}}
{{--                            <span class="product-price">--}}
{{--                               {{ $item->price }}  <span class="symbol">{{ $item->currency }}</span>  = {{ $item->silk }} Silks--}}
{{--                            </span>--}}
{{--                            <p class="">{{$item->description}}</p>--}}
{{--                            <div class="btn btn-primary">--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                @endforeach
            </div>
        </div>
    </div>
    @endsection

    </div>
    </div>
