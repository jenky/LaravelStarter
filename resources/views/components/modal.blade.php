<div class="{{ $class or 'modal fade' }}" id="{{ $id or '' }}" role="dialog" tabindex="-1">
    <div class="modal-dialog {{ $size or '' }}">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="{{ __('ui.close') }}" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{!! $title or '' !!}</h4>
            </div>
            <div class="modal-body">
                {!! $body or $slot !!}
            </div>
            @if (! empty($footer))
                <div class="modal-footer">
                    {!! $footer !!}
                </div>
            @endif
        </div>
    </div>
</div>
