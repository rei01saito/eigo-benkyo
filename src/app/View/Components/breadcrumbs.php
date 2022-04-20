<?php

namespace App\View\Components;

use Illuminate\View\Component;

class breadcrumbs extends Component
{
    /**
     * breadcrumbsの引数（ページ名）。|で区切る。
     * @var array
     */
    public $args;

    /**
     * breadcrumbsの引数（URL名）。|で区切る。
     * @var array
     */
    public $urls;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($args=null, $urls=null)
    {
        // ページ名が入った配列
        $array_args = explode('|', $args);
        $this->args = $array_args;

        // URL名が入った配列
        $array_urls = explode('|', $urls);
        $this->urls = $array_urls; 
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumbs');
    }
}
