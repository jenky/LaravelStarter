<div class="{{ $class ?? 'modal fade' }}" id="{{ $id ?? '' }}" role="dialog" tabindex="-1">
    <div class="modal-dialog {{ $size ?? '' }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @if (!empty($header))
                    {!! $header !!}
                @else
                    <button aria-label="{{ __('ui.close') }}" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title">{!! $title ?? '' !!}</h5>
                @endif
            </div>
            <div class="modal-body">
                {!! $body ?? $slot !!}
            </div>
            @if (! empty($footer))
                <div class="modal-footer">
                    {!! $footer !!}
                </div>
            @endif
        </div>
    </div>
</div>
