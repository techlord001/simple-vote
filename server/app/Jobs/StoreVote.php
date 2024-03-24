<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Vote;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreVote implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public User $user,
        public int $voteNumber,
        public string $ipAddress,
        public string $estimatedLocation,
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->vote()->create([
            'vote_number' => $this->voteNumber,
            'ip_address' => $this->ipAddress,
            'estimated_location' => $this->estimatedLocation,
        ]);
    }
}
