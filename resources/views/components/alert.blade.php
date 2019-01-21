<div class="alert alert-{{ $type ?? 'primary' }} {{ $class ?? '' }} {{ !empty($dismissible) ? 'alert-dismissible' : '' }}" role="alert">
	@if (!empty($dismissible))
		<button type="button" class="close" data-dismiss="alert" aria-label="{{ __('ui.close') }}">
            <span aria-hidden="true">&times;</span>
        </button>
	@endif
	{!! $message ?? $slot !!}
</div>
