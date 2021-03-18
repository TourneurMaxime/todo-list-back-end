<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    /**
     * Première route
     *
     * @return void
     */
    public function home()
    {
        $courseCategory = Category::find(2);

        $task = Task::find(1);

        echo $task->title;

        echo $task->category->name;

        dump($courseCategory->tasks);

    }

}
