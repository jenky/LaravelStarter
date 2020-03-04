<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * The alert type.
     *
     * @var string
     */
    public $type;

    /**
     * The alert message.
     *
     * @var string|null
     */
    public $message;

    /**
     * The alert dismissible.
     *
     * @var bool
     */
    public $dismissible;

    /**
     * Create the component instance.
     *
     * @param  string $type
     * @param  string $message
     * @param  bool $dismissible
     * @return void
     */
    public function __construct(string $type = 'primary', $message = null, bool $dismissible = false)
    {
        $this->type = $type;
        $this->message = $message;
        $this->dismissible = $dismissible;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
