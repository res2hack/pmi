<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Backup\Events\BackupZipWasCreated;

class DatabaseBackup
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BackupZipWasCreated  $event
     * @return void
     */
    public function handle(BackupZipWasCreated $event)
    {
        $this->BackupFile($event->pathToZip);
    }

    public function BackupFile($path)
    {
        try {
            \Illuminate\Support\Facades\Artisan::call('backup:run --only-db');
            // return redirect()->route('dashboard');
            // Mail::raw('You have a new database backup file.',   function ($message) use ($path) {
            //     $message->to(env('DB_BACKUP_EMAIL'))
            //         ->subject('DB Auto-backup Done')
            //         ->attach($path);
            // });
        } catch (\Exception $exception) {
            throw $exception;
        }

    }
}
