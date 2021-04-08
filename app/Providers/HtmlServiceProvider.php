<?php

namespace App\Providers;

use App\EnvX\Form\Builder;
use Collective\Html\HtmlServiceProvider as CollectionHtmlServiceProvider;

class HtmlServiceProvider extends CollectionHtmlServiceProvider
{
    protected function registerFormBuilder(): void
    {
        $this->app->singleton('form', function ($app) {
            $form = new Builder($app['html'], $app['url'], $app['view'], $app['session.store']->token());
            return $form->setSessionStore($app['session.store']);
        });
    }
}
