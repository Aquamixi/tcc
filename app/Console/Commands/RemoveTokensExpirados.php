<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveTokensExpirados extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:tokensexpirados';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove os tokens de acesso à receitas escondidas que estão expirados';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tokens = \App\Models\receita::withoutGlobalScope(\App\Scopes\ReceitaScope::class)->whereNotNull('token_acesso')->get();
        foreach($tokens as $token){
            if(Carbon::now()->diffInHours(Carbon::parse($token->data_token_validade), false) <= 0){
                $token->token_acesso = null;
                $token->data_token_validade = null;
                $token->update();
            }
        }
    }
}
