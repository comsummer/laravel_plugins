<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2020-11-25
 * Time: 下午 05:28
 */
namespace App\Admin\Controllers;
use App\Jobs\ExceedJob;
use App\Jobs\HelloJob;
use App\Jobs\ProcessPodcast;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Http\Request;

class JobTesController extends AdminController
{
    private $queue = ['hello', 'delay', 'default'];
    private $jobClass = ["\App\Jobs\HelloJob", "\App\Jobs\ExceedJob"];
    public function tt()
    {
        ProcessPodcast::dispatch();
    }

    public function c()
    {
        dump(config('database.redis'));
        dump(config("horizon.prefix"));
    }

    public function customQueueJob(Request $request)
    {
        $queueName = $request->get("queue");
        $job = $request->get("job");
        //创建延迟队列
        $delay = $request->get("delay", 0);

//        HelloJob::dispatch($job)->onQueue("hello");
        $delay ? ExceedJob::dispatch($job)->delay($delay)->onQueue($queueName)
            : HelloJob::dispatch($job)->onQueue($queueName);
    }

    /**
     * 随机创建任务
     * 个数
     * @param Request $request
     */
    public function generateRandJob(Request $request)
    {
        $queueNum = (int)$request->get("num", 10);
        for($i = 0; $i < $queueNum; $i++) {
            $randQueueIndex = mt_rand(0, count($this->queue) - 1);
            $randJobIndex = mt_rand(0, count($this->jobClass) - 1);
            $randDelay = mt_rand(0, 10);
            $randDelay % 2 == 0 ? $this->jobClass[$randJobIndex]::dispatch("rand job {$i}")->delay($randDelay)->onQueue($this->queue[$randQueueIndex])
                : $this->jobClass[$randJobIndex]::dispatch("rand job {$i}")->onQueue($this->queue[$randQueueIndex]);
        }
    }
}