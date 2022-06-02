<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Configuration;

class ConfigurationComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $configuration = Configuration::where('status', 1)->first();
        $view->with('configuration', $configuration);
    }
}
