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
    public function tt()
    {
        ProcessPodcast::dispatch()->onConnection("queue");
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
}