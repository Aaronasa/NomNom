<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserTable extends Component
{
    public $users;

    /**
     * Create a new component instance.
     *
     * @param $users
     */
    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.user-table');
    }
}
