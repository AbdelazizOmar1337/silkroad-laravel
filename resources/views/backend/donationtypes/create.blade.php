@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/donationtypes.create.title') }}</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('backend/donationtypes.create.create') }}
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
                            <form method="POST" action="{{ route('donation-types-create-backend') }}" class="form"
                                  enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <div class="form-group">
                                            <label
                                                for="name_web">{{ __('backend/donationtypes.create.name_web') }}</label>
                                            <input type="text"
                                                   class="form-control @error('name_web') is-invalid @enderror"
                                                   name="name_web"
                                                   id="name_web"
                                                   aria-describedby="webNameHelp"
                                                   value="{{ Request::old('name_web') }}">
                                            <small id="webNameHelp" class="form-text text-muted">
                                                {{ __('backend/donationtypes.create.name_web-help') }}
                                            </small>
                                            @if($errors->has('name_web'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name_web') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="form-group">
                                            <label
                                                for="description">{{ __('backend/donationtypes.create.description') }}</label>
                                            <input type="text"
                                                   class="form-control @error('description') is-invalid @enderror"
                                                   name="description"
                                                   id="description"
                                                   aria-describedby="ItemDescHelp"
                                                   value="{{ Request::old('description') }}">
                                            <small id="ItemDescHelp" class="form-text text-muted">
                                                {{ __('backend/donationtypes.create.description-help') }}
                                            </small>
                                            @if($errors->has('description'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('description') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="form-group">
                                            <label
                                                for="name_merchant">{{ __('backend/donationtypes.create.name_merchant') }}</label>
                                            <input type="text"
                                                   class="form-control @error('name_merchant') is-invalid @enderror"
                                                   name="name_merchant"
                                                   id="name_merchant"
                                                   aria-describedby="merchantNameHelp"
                                                   value="{{ Request::old('name_merchant') }}">
                                            <small id="merchantNameHelp" class="form-text text-muted">
                                                {{ __('backend/donationtypes.create.name_merchant-help') }}
                                            </small>
                                            @if($errors->has('name_merchant'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name_merchant') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="form-group">
                                            <label for="silk">{{ __('backend/donationtypes.create.silk') }}</label>
                                            <input type="number"
                                                   class="form-control @error('silk') is-invalid @enderror"
                                                   name="silk"
                                                   id="silk"
                                                   aria-describedby="ItemPriceHelp"
                                                   value="{{ Request::old('silk') }}">
                                            <small id="ItemPriceHelp" class="form-text text-muted">
                                                {{ __('backend/donationtypes.create.silk-help') }}
                                            </small>
                                            @if($errors->has('silk'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('silk') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="form-group">
                                            <label for="price">{{ __('backend/donationtypes.create.price') }}</label>
                                            <input type="number"
                                                   class="form-control @error('price') is-invalid @enderror"
                                                   name="price"
                                                   id="price"
                                                   aria-describedby="ItemPriceHelp"
                                                   value="{{ Request::old('price') }}">
                                            <small id="ItemPriceHelp" class="form-text text-muted">
                                                {{ __('backend/donationtypes.create.price-help') }}
                                            </small>
                                            @if($errors->has('price'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('price') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="form-group">
                                            <label
                                                for="currency">{{ __('backend/donationtypes.create.currency') }}</label>
                                            <input type="text"
                                                   class="form-control @error('currency') is-invalid @enderror"
                                                   name="currency"
                                                   id="currency"
                                                   aria-describedby="ItemCurrencyHelp"
                                                   value="{{ Request::old('currency') }} ">
                                            <small id="ItemCurrencyHelp" class="form-text text-muted">
                                                {{ __('backend/donationtypes.create.currency-help') }}
                                            </small>
                                            @if($errors->has('currency'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('currency') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="form-group">
                                            <label for="type">{{ __('backend/donationtypes.create.type') }}</label>
                                            <input type="text"
                                                   class="form-control @error('type') is-invalid @enderror"
                                                   name="type"
                                                   id="type"
                                                   aria-describedby="ItemTypeHelp"
                                                   value="{{ Request::old('type') }} ">
                                            <small id="ItemTypeHelp" class="form-text text-muted">
                                                {{ __('backend/donationtypes.create.type-help') }}
                                            </small>
                                            @if($errors->has('type'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('type') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <input class="btn btn-sm btn-primary" type="submit"
                                               value="{{ __('backend/donationtypes.create.submit') }}">
                                        <a href="{{ route('donation-types-index-backend') }}"
                                           class="ml-2 btn btn-sm btn-secondary">
                                            {{ __('backend/donationtypes.create.back') }}
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
