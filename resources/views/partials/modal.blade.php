<div class="{{ $modalClass or 'modal fade' }}" role="dialog" tabindex="-1">
    <div class="modal-dialog {{ $modalSize or '' }}">
        <div class="modal-content">
            @section('modal-content')
                <div class="modal-header">
                    @if (!empty($modalClose))
                        <button aria-label="{{ trans('ui.close') }}" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    @endif
                    <h4 class="modal-title">{{ $modalTitle or '' }}</h4>
                </div>
                <div class="modal-body">
                    @yield('modal-body')
                </div>
                <div class="modal-footer">
                    @yield('modal-footer')
                    @if (!empty($modalClose))
                        <button class="btn {{ $modalCloseBtn or 'btn-default' }}" data-dismiss="modal" type="button">{{ trans('ui.close') }}</button>
                    @endif
                </div>
            @show
        </div>
    </div>
</div>