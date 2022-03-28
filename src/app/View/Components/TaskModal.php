<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TaskModal extends Component
{
    public $tasks;
    public $thinking;
    public $doing;
    public $done;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tasks)
    {
        $this->$tasks = $tasks;
        $this->thinking = $tasks->where('priority', 0);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.task-modal');
    }
}
