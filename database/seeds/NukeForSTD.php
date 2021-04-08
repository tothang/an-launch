<?php

use App\EmailLog;
use App\Modules\Analytics\Models\LoginLog;
use App\Modules\Analytics\Models\PageView;
use App\Modules\Registration\Models\UserRegistration;
use App\Token;
use App\User;
use App\EnvX\Database\AutoSeed;

class NukeForSTD extends AutoSeed
{
    public function run(): void
    {
        EmailLog::truncate();
        LoginLog::truncate();
        PageView::truncate();
        Token::truncate();
        UserRegistration::truncate();
        User::truncate();
    }
}
