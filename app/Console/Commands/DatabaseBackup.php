<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'upload database backup in drive at every saturday 09:00 AM.';

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
     * @return int
     */
    public function handle()
    {
        $files = Storage::allFiles('db_backup');
        if($files && count($files) >= 3)
        {
            Storage::delete($files[0]);
        }

        $filename = Carbon::now()->format('Y-m-d') . "-" .Carbon::now()->timestamp . ".sql";
        $command = " " . env('DUMP_PATH') . " --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . " >" . storage_path() . "/app/db_backup/" . $filename;
        $returnVar = NULL;
        $output  = NULL;
        exec($command, $output, $returnVar);

        $path = storage_path() . "/app/db_backup/" . $filename;
        $encrypt = Crypt::encryptString( File::get($path) );
        // $decrypted = Crypt::decryptString($encrypt);
        Storage::put('db_backup/' . $filename, $encrypt);
    }
}
