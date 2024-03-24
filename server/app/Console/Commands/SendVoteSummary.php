<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Log; // Use for local testing/debugging
use Illuminate\Support\Facades\Mail;

class SendVoteSummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-vote-summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a daily summary of votes to dev@unifysoftware.com';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $voteTotals = DB::table('votes')
                    ->select(DB::raw('count(*) as total_votes, vote_number'))
                    ->groupBy('vote_number')
                    ->get();

        $content = "Daily Vote Summary:\n" . $voteTotals->toJson();

        Mail::raw($content, function ($message) {
            $message->to('dev@unifysoftware.com')->subject('Daily Vote Summary');
        });

        // Use for local testing/debugging
        // Log::info($content);

        $this->info('Vote summary email sent.');
    }
}
