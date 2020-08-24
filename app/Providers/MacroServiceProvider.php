<?php

namespace App\Providers;

use App\Helpers\FormMacros;
use Collective\Html\HtmlServiceProvider;

class MacroServiceProvider extends HtmlServiceProvider
{
    protected function registerFormBuilder()
    {
        $this->app->singleton('form', function ($app) {
            $form = new FormMacros($app['html'], $app['url'], $app['view'], $app['session.store']->token(), $app['request']);

            return $form->setSessionStore($app['session.store']);
        });
    }
}
