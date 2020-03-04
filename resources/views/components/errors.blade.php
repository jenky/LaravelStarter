@if (count($errors) > 0)
    <x-alert :type="$type ?? 'danger'"
        :dismissible="$dismissible ?? false">
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </x-alert>
@endif
