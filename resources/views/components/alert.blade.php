<div class="alert {{ $class or 'alert-info' }} {{ !empty($dismissible) ? 'alert-dismissible' : '' }}" role="alert">
	@if (!empty($dismissible))
		<button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">{{ __('ui.close') }}</span>
        </button>
	@endif
	{!! $message or $slot !!}
</div>
