<?php

namespace App\Console\Commands;

use App\Jobs\SendReportJob;
use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class UserReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send report  users';


    public function handle()
    {
        $data = User::with('links')
            ->where( 'created_at', '>', Carbon::now()->subDays(1))
            ->get();
        dispatch(new SendReportJob($data));
    }
}
