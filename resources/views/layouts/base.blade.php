@if (config('view.minify'))
@spaceless
@include('layouts.main')
@endspaceless
@else
@include('layouts.main')
@endif