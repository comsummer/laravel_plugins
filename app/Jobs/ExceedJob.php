<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ExceedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //当前单个任务最多执行10秒
    public $timeout = 10;
    private $msg = "";
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        //
        $this->msg = $msg;
    }

    /**
     * 在给定的时间范围内，任务可以无限次尝试
     * 在30秒内任务可以无限次重试
     * @return \Illuminate\Support\Carbon
     */
    public function retryUntil()
    {
        return now()->addSeconds(30);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        echo "输出参数[并sleep 10秒，达到超时时间。任务应该会重复执行3次]：" . $this->msg;
        sleep(10);
    }

    /**
     * 任务执行失败时会调用
     * @param \Exception $exception
     */
    public function failed(\Exception $exception)
    {
        echo self::class . " job execute failed " . $exception->getMessage();
    }
}
