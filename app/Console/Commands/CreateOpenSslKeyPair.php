<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;

class CreateOpensslKeyPair extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'opensslKeys:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Openssl key pair creation';

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
      $disk = Storage::disk('openssl_key_pair');
      
      $privateKey = openssl_pkey_new(array(
        'private_key_bits' => 2048,      // Size of Key.
        'private_key_type' => OPENSSL_KEYTYPE_RSA,
      ));

      $privKeyPath = storage_path('openssl_key_pair/private.key');
      openssl_pkey_export_to_file($privateKey, $privKeyPath);

      $a_key = openssl_pkey_get_details($privateKey);
      $disk->put('public.key', $a_key['key']);

      openssl_free_key($privateKey);

      $privKeyContent = $disk->get('private.key');

      die("key=\r\n" . $privKeyContent);
    }
}
