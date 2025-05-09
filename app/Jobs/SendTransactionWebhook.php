<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendTransactionWebhook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transaction;

    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    public function handle(): void
    {

        if (!$this->transaction->callback_url) {
            return;
        }

        $payload = [
            'transaction_id' => $this->transaction->code,
            'status' => $this->transaction->stringStatus->value,
            'amount' => $this->transaction->amount,
            'timestamp' => now()->toIso8601String(),
        ];

        $secret = env('WEBHOOK_SECRET');
        $signature = hash_hmac('sha256', json_encode($payload), $secret);
        logger($payload);
        Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Signature' => $signature
        ])->post($this->transaction->callback_url, $payload);
    }
}
