<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AddAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jtq:add-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds new admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->output->title('JobTraq admin user creation');

        $name = $this->ask('Full name');
        $email = $this->ask('Email (for login)');
        $password = $this->secret('Password');

        $user = User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $user->assignRole('Adminisztrátor');

        $this->output->success(sprintf('Admin #%s created! Now you can log in!', $user->id));
    }
}
