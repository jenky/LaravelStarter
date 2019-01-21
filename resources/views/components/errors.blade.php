@if (count($errors) > 0)
    @component('components.alert')
        @slot('type', $type ?? 'danger')
        @slot('dismissible', $dismissible ?? false)
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    @endcomponent
@endif
