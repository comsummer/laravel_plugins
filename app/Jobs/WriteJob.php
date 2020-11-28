<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class WriteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     * 定时写入文件内容
     * @return void
     */
    public function handle()
    {
        //
        $randContent = date("Y-m-d H:i:s") . " execute current job " . mt_rand(1000, 9999) . "\n";
        file_put_contents("/tmp/scheduled_job_run.log", $randContent, FILE_APPEND);
    }
}
