<?php

namespace App\Modules\Questions\Http\ViewComposers;

use Illuminate\View\View;

class SpeakersDropdown
{
    public function compose(View $view)
    {
        $sessions = Session::with('speakers')->sorted()->get();

        $view->with('speakersDropdown', $sessions);
    }
}
