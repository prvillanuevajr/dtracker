<?php

namespace App\Console\Commands;

use App\ApiMedicTools\GetAuthenticationToken;
use Illuminate\Console\Command;

class GenerateApiMedicAuthenticationTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api_medic:generate_token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates Api Medic Oauth Token';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $token = (new GetAuthenticationToken())->getToken();
        echo $token;
    }
}
