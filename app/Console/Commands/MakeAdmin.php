<?php

namespace App\Console\Commands;

use App\Admin;
use App\EnvX\Admin\AdminCreator;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class MakeAdmin extends Command
{
    protected $signature = 'envx:make:admin {--default}';

    protected $description = 'Creates an admin user';

    private $creator;

    public function __construct(AdminCreator $creator)
    {
        parent::__construct();

        $this->creator = $creator;
    }

    public function handle(): void
    {
        if ($this->option('default') && config('app.env') !== 'local') {
            $this->error('Default option only available for local development.');

            return;
        }

        if ($this->option('default') === false) {
            $forename = $this->ask('Enter forename');
            $surname = $this->ask('Enter surname');
            $email = $this->ask('Enter email');
            $role = $this->choice('Select role', Role::all()->pluck('name')->toArray());
        }

        if (Admin::where('email', $email ?? 'admin@example.com')->exists()) {
            $this->error('An admin user with this email already exists.');

            return;
        }

        $password = bcrypt($this->secret('Enter password'));

        $this->creator->create([
            'forename' => $forename ?? 'Adrian',
            'surname' => $surname ?? 'Adminson',
            'email' => $email ?? 'admin@example.com',
            'password' => $password,
            'setup_complete' => 1,
        ], $role ?? Admin::ROLE_ROOT);

        $this->info('Admin created!');
    }
}
