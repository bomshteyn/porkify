<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateTokenForUserCommand extends Command
{
    protected $signature = 'generate:token-for-user {user?}';

    protected $description = 'Command description';

    public function handle()
    {
        if ($this->argument('user')) {
            $user = \App\Models\User::find($this->argument('user'));
        } else {
            $user = \App\Models\User::first();
        }

        $this->info('Generating token for user: ' . $user->name);
        $plainTextToken = $user->createToken('token-name')->plainTextToken;
        $this->info('Token: ' . $plainTextToken);
    }
}
