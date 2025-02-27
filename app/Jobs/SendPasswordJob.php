<?php

namespace App\Jobs;

use App\Models\UserModel;
use App\Notifications\SendPasswordNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPasswordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private UserModel $user;
    private ?string $url;
    private string $password;
    private string $token;

    /**
     * Create a new job instance.
     */
    public function __construct(UserModel $user, ?string $url, string $password, string $token)
    {
        $this->user = $user;
        $this->url = $url;
        $this->password = $password;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->notify(new SendPasswordNotification( $this->user, $this->url, $this->password, $this->token));
    }
}
