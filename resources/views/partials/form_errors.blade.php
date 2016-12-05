@if (count($errors) > 0)
    <?php
        $list = '<ul>';

        foreach ($errors->all() as $error)
        {
            $list .= '<li>' . $error . '</li>';
        }

        $list .= '</ul>'
    ?>
    @include('partials.alert', [
        'message'     => $list,
        'alertClass'  => isset($alertClass) ? $alertClass : 'alert-danger',
    ])
@endif
