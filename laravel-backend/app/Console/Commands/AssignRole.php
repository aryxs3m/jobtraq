<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AssignRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jtq:assign-role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Beállít egy role-t egy usernek';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->ask('Felhasználó e-mail címe');
        $role = $this->ask('Szerepkör neve');

        /** @var User $user */
        $user = User::query()->where('email', '=', $email)->firstOrFail();
        $user->assignRole($role);
    }
}
