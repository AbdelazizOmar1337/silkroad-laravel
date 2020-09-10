@extends('layouts.app')
@section('title', __('seo.donations.index'))
@section('content')
<div class="rs-products col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    <div class="container">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col">
                <div class="title-style text-center mb-40 md-mb-20">
                    <h2 class="margin-0 uppercase">Donations</h2>
                    <span class="line-bg y-b pt-10"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Thanks for supporting US!
            </div>
        </div>
        <div class="row pt-3">
            @foreach($items as $item)
                <div class="col-sm mb-3">
                    <div class="products">
                        <div class="product-img">
                            <img src="image/products/{{ $loop->index }}.png"
                                 alt="img {{ $item->item_name }}">
                        </div>
                        <h4 class="product-title">{{ $item->item_name }}</h4>
                        <span class="product-price">
                           {{ $item->item_price }}  <span class="symbol">{{ $item->item_currency }}</span>  = {{ $item->item_silk }} Silks
                        </span>
                        <p class="">{{$item->item_desc}}</p>
                        <div class="cart-button readon">
                            <a href="{{ route('donate-paypal', ['id' => $item->id]) }}"><i class="fa fa-paypal"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

</div>
</div>
