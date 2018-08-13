@if (count($errors) > 0)
    @component('components.alert')
        @slot('class', isset($class) ? $class : 'alert-danger')
        @slot('dismissible', isset($dismissible) ? $dismissible : false)
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    @endcomponent
@endif
