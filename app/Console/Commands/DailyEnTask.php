<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DailyEnTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-en-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Daily EN task executed successfully!');

        Mail::raw("This is automatically generated Daily GMRS EN Update", function($message)
        {
            $message->from('noreply@fccvalidator.com');
            $message->to('esoares9483@gmail.com')->subject('Daily GMRS EN Update');
        });
    }
}
