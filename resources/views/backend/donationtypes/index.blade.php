@extends('backend.layouts.app')

@section('backend-content')
    @include('backend.layouts.navbar')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('backend/donationtypes.title') }}</h1>
            <a href="{{ route('donation-types-add-backend') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> {{ __('backend/donationtypes.title-create') }}
            </a>
        </div>
        <div class="row">
            <div class="container">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="item">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('backend/donationtypes.table.name_web') }}</th>
                            <th scope="col">{{ __('backend/donationtypes.table.description') }}</th>
                            <th scope="col">{{ __('backend/donationtypes.table.silk') }}</th>
                            <th scope="col">{{ __('backend/donationtypes.table.name_merchant') }}</th>
                            <th scope="col">{{ __('backend/donationtypes.table.price') }}</th>
                            <th scope="col">{{ __('backend/donationtypes.table.currency') }}</th>
                            <th scope="col">{{ __('backend/donationtypes.table.type') }}</th>
                            <th scope="col">{{ __('backend/donationtypes.table.published_at') }}</th>
                            <th scope="col">{{ __('backend/donationtypes.table.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $new)
                            <tr>
                                <th scope="row">{{ $new->id }}</th>
                                <td>{{ $new->name_web }}</td>
                                <td>{{ $new->description }}</td>
                                <td>{{ $new->silk }}</td>
                                <td>{{ $new->name_merchant }}</td>
                                <td>{{ $new->price }}</td>
                                <td>{{ $new->currency }}</td>
                                <td>{{ $new->type }}</td>
                                <td>{{ Carbon\Carbon::parse($new->published_at)->format('d.m.Y H:i \U\h\r') }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-3">
                                            <form method="POST" data-form="deleteForm"
                                                  action="{{ route('donation-types-destroy-backend', ['id' => $new->id]) }}">
                                                @csrf
                                                <span data-toggle="modal" data-target="#itemModalDelete"
                                                      data-title="{{ __('backend/donationtypes.modal-delete-title') }} {{ $new->id }}"
                                                      data-message="{{ __('backend/donationtypes.modal-delete-message') }}"
                                                      class="btn btn-danger btn-circle btn-sm" style="cursor: pointer">
                                                    <i class="fa fa-trash"></i>
                                                </span>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="itemModalDelete" role="dialog" aria-labelledby="itemModalDeleteLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary"
                            data-dismiss="modal">{{ __('backend/notification.modal.return') }}</button>
                    <button type="button" class="btn btn-sm btn-danger"
                            id="confirm">{{ __('backend/notification.modal.submit') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#itemModalDelete').find('.modal-footer #confirm').on('click', function () {
                $(this).data('form').submit();
            });
            $('#itemModalDelete').on('show.bs.modal', function (e) {
                $(this).find('.modal-body p').text($(e.relatedTarget).attr('data-message'));
                $(this).find('.modal-title').text($(e.relatedTarget).attr('data-title'));

                let form = $(e.relatedTarget).closest('form');
                $(this).find('.modal-footer #confirm').data('form', form);
            });
            $('form[data-form="deleteForm"]').on('click', '.form-delete', function (e) {
                e.preventDefault();
                $('#confirm').modal({backdrop: 'static', keyboard: false})
                    .on('click', '#delete-btn', function () {
                        $('form[data-form="deleteForm"]').submit();
                    });
            });
        });
    </script>
@endpush
