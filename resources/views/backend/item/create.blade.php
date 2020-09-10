@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/item.create.title') }}</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('backend/item.create.create') }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('item-create-backend') }}" class="form"
                                  enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <div class="form-group">
                                            <label for="item_name">{{ __('backend/item.create.item-name') }}</label>
                                            <input type="text" class="form-control @error('item_name') is-invalid @enderror"
                                                   id="item_name"
                                                   aria-describedby="itemNameHelp" name="item_name"
                                                   value="{{ Request::old('item_name') }}">
                                            <small id="itemNameHelp" class="form-text text-muted">
                                                {{ __('backend/item.create.item-name-help') }}
                                            </small>
                                            @if($errors->has('item_name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('item_name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="form-group">
                                            <label for="item_desc">{{ __('backend/item.create.item-desc') }}</label>
                                            <input type="text" class="form-control @error('item_desc') is-invalid @enderror"
                                                   id="item_desc"
                                                   aria-describedby="ItemDescHelp" name="item_desc"
                                                   value="{{ Request::old('item_desc') }}">
                                            <small id="ItemDescHelp" class="form-text text-muted">
                                                {{ __('backend/item.create.item-desc-help') }}
                                            </small>
                                            @if($errors->has('item_desc'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('item_desc') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="form-group">
                                            <label for="item_price">{{ __('backend/item.create.item-price') }}</label>
                                            <input type="number" class="form-control @error('item_price') is-invalid @enderror"
                                                   id="item_price"
                                                   aria-describedby="ItemPriceHelp" name="item_price"
                                                   value="{{ Request::old('item_price') }}">
                                            <small id="ItemPriceHelp" class="form-text text-muted">
                                                {{ __('backend/item.create.item-price-help') }}
                                            </small>
                                            @if($errors->has('item_desc'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('item_price') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="form-group">
                                            <label for="item_silk">{{ __('backend/item.create.item-silk') }}</label>
                                            <input type="number" class="form-control @error('item_silk') is-invalid @enderror"
                                                   id="item_silk"
                                                   aria-describedby="ItemPriceHelp" name="item_silk"
                                                   value="{{ Request::old('item_silk') }}">
                                            <small id="ItemPriceHelp" class="form-text text-muted">
                                                {{ __('backend/item.create.item-silk-help') }}
                                            </small>
                                            @if($errors->has('item_desc'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('item_silk') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="form-group">
                                            <label for="item_currency">{{ __('backend/item.create.item-currency') }}</label>
                                            <input type="text" class="form-control @error('item_currency') is-invalid @enderror"
                                                   id="item_currency"
                                                   aria-describedby="ItemCurrencyHelp" name="item_currency"
                                                   value="{{ Request::old('item_currency') }} ">
                                            <small id="ItemCurrencyHelp" class="form-text text-muted">
                                                {{ __('backend/item.create.item-currency-help') }}
                                            </small>
                                            @if($errors->has('item_currency'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('item_currency') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="form-group">
                                            <label for="item_type">{{ __('backend/item.create.item-type') }}</label>
                                            <input type="text" class="form-control @error('item_type') is-invalid @enderror"
                                                   id="item_type"
                                                   aria-describedby="ItemTypeHelp" name="item_type"
                                                   value="{{ Request::old('item_type') }} ">
                                            <small id="ItemTypeHelp" class="form-text text-muted">
                                                {{ __('backend/item.create.item-type-help') }}
                                            </small>
                                            @if($errors->has('item_type'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('item_type') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                   
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <input class="btn btn-sm btn-primary" type="submit"
                                               value="{{ __('backend/item.create.submit') }}">
                                        <a href="{{ route('item-index-backend') }}" class="ml-2 btn btn-sm btn-secondary">
                                            {{ __('backend/item.create.back') }}
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
