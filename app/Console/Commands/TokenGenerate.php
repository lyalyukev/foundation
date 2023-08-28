<?php

namespace App\Console\Commands;

use App\Models\Token;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class TokenGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate token fo API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $token = Token::create([
            'token' => Str::random(60),
        ]);

        $this->info($token->token);

        return $token->id;
    }
}
