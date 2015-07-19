<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;
use NukaCode\Core\Controllers\BaseController;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    protected $layoutOptions = [
        'default' => 'layouts.default',
        'ajax'    => 'layouts.default'
    ];

    protected $resetBlade = false;

    protected function setJavascriptData($key, $value = null)
    {
        if (is_array($key)) {
            JavaScriptFacade::put($key);
        } else {
            JavaScriptFacade::put([$key => $value]);
        }
    }
}
