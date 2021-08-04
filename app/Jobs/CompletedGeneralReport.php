<?php

namespace App\Jobs;

use App\Events\ReportCreatedBroadcast;
use App\Mail\GeneralReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CompletedGeneralReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $adminEmail = config('mail.adminEmail');
        Mail::to($adminEmail)->send(new GeneralReport($this->data));
        Log::info("Отправлен Итоговый отчет на адрес $adminEmail");
        ReportCreatedBroadcast::dispatch();
    }
}
