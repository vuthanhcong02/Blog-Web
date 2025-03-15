<?php

namespace App\View\Components\Frontend\Common;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Banner extends Component{
    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('frontend.common.banner');
    }
}