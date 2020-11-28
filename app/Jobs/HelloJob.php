<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class HelloJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $msg = '';
    public $tries = 5;
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
//        try {
            $msg = "hello " . $this->msg;
            file_put_contents("/tmp/hello_queue", $msg . "\n", FILE_APPEND);
            echo $msg;
//        } catch (\Exception $exception) {
//            echo "something wrong " . $exception->getMessage();
//        }
    }

    public function failed(\Exception $exception)
    {
        echo "helloJob execute failed " . $exception->getMessage();
    }

    /**
     * 自定义标签
     * @return array
     */
    public function tags()
    {
        //定义多个标签
        return ['render', 'msg:' . md5($this->msg)];
    }

}
