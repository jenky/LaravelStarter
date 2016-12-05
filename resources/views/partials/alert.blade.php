@if (isset($message))
<div class="alert {{ $alertClass or '' }} {{ !empty($dismissible) ? 'alert-dismissible' : '' }}" role="alert">
	@if (!empty($dismissible))
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	@endif
	{!! $message !!}
</div>
@endif
