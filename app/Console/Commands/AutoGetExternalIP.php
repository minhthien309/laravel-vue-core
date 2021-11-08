<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Configs;
use GuzzleHttp\Client as GuzzleClient;

class AutoGetExternalIP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:external_ip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check external IP';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private $baseUrl = 'https://firestore.googleapis.com/v1/';
    private $document = 'projects/raspberry-pi-7d811/databases/(default)/documents/StoreIP/ip';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
            $ip = rtrim(file_get_contents('https://checkip.amazonaws.com'), "\n");
            $dbIP = Configs::where('key', 'external_ip')->first();
            if($dbIP){
                if($dbIP->value != $ip){
                    $dbIP->value = $ip;
                    $dbIP->save();
                    $this->writeToFireStore($ip);
                }
            }
            else{
                $config = new Configs();
                $config->key = 'external_ip';
                $config->value = $ip;
                $config->save();
                $this->writeToFireStore($ip);
            }
        }
        catch(\Exception $e){
            dd($e->getMessage());
        }
        return Command::SUCCESS;
    }

    public function writeToFireStore($ip){
        $insert = ["fields" => ["ip" => ["stringValue" => $ip]]];
        
        $client = new GuzzleClient();
        $url = $this->baseUrl.$this->document;

        try{
            $res = $client->request('PATCH', $url, ['json' => $insert]);
        }
        catch(\Exception $e){
            dd($e->getMessage());
        }
    }
}
