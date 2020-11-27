<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2020-11-25
 * Time: 下午 05:28
 */
namespace App\Admin\Controllers;
use App\Jobs\HelloJob;
use App\Jobs\ProcessPodcast;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Http\Request;

class JobTesController extends AdminController
{
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

//        HelloJob::dispatch($job)->onQueue("hello");
        HelloJob::dispatch($job)->onQueue($queueName);
    }
}