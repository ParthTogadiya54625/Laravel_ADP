<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DbImportExportController extends Controller
{
    public function index()
    {
        $files = Storage::allFiles('db_backup');
        // return $files;
        return view('admin.database.index', compact('files'));
    }

    public function export()
    {
        Artisan::call('database:backup');

        return back()->with('success', 'Database exported successfully');
    }

    public function import(Request $request)
    {
        $request->validate([
            "file" => "required",
        ]);

        $path = storage_path() . "/app/db_backup/" . $request->file;
        $encrypted = File::get($path);
        $decrypted = Crypt::decryptString($encrypted);
        Storage::put('test.sql', $decrypted);
        // Artisan::call('database:backup'); // uncomment this line if you want to latest-backup your database before import
        DB::unprepared(file_get_contents(storage_path() . "/app/test.sql"));
        Storage::delete('test.sql');

        return back()->with('success', 'Database imported successfully');
    }
}
