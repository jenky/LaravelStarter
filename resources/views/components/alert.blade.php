@props(['type', 'dismissible'])

<div {{ $attributes->merge(['class' => implode(' ', [
        'alert',
        'alert-'.$type,
        ! empty($dismissible) ? 'alert-dismissible' : null,
    ])
]) }} role="alert">
    {{ $slot }}
	@if (! empty($dismissible))
		<button type="button" class="close" data-dismiss="alert" aria-label="{{ __('ui.close') }}">
            <span aria-hidden="true">&times;</span>
        </button>
	@endif
</div>
