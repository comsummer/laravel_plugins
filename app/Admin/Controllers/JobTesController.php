<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2020-11-25
 * Time: 下午 05:28
 */
namespace App\Admin\Controllers;
use App\Jobs\ProcessPodcast;
use Encore\Admin\Controllers\AdminController;

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
}