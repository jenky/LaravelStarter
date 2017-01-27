@if (count($errors) > 0)
    @component('partials.alert')
        @slot('class', isset($class) ? $class : 'alert-danger')
        @slot('dismissible', isset($dismissible) ? $dismissible : false)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    @endcomponent
@endif
