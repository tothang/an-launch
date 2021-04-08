<?php

namespace App\Modules\Questions\Providers;

use App\Modules\Questions\Http\ViewComposers\SpeakersDropdown;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer(
            'questions::partials.ask-a-question', SpeakersDropdown::class
        );
    }
}
