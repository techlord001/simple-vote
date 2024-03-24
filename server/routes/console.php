<?php

use App\Console\Commands\SendVoteSummary;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
Schedule::command('queue:work --stop-when-empty')->hourly();
Schedule::command(SendVoteSummary::class)->dailyAt('23:59');
