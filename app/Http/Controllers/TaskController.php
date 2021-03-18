<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function list(){
        $tasksData =  Task::with('category')->get();
        return $this->sendJsonResponse($tasksData);

    }

    public function item($id){
        $task = Task::find($id);
        if ($task){
            return $this->sendJsonResponse($task);
        }else{
            return $this->sendEmptyResponse(404);
        }
    }

    public function create(Request $request){
        $title = $request->input('title');
        $categoryId = $request->input('categoryId');
        $completion = $request->input('completion', 0);
        $status = $request->input('status', 1);
        if (empty($title) || empty($categoryId)){
            return $this->sendEmptyResponse(400);
        }else{
            $newTask = new Task();
            $newTask->title = $title;
            $newTask->category_id = $categoryId;
            $newTask->completion = $completion;
            $newTask->status = $status;

            $inserted = $newTask->save();

            if ($inserted){
                $newTask->load('category');
                return $this->sendJsonResponse($newTask, 201);
            }else{
                return $this->sendEmptyResponse(500);
            }
        }
    }

    public function updateTotal(Request $request, $id){
        $taskToUpdate = Task::find($id);

        if ($taskToUpdate){
            $this->validate($request, [
                'title' => 'required',
                'completion' => 'required|numeric|min:0|max:100',
                'status' => 'required|in:1,2',
                'categoryId' => 'required|exists:categories,id',
            ]);

            $taskToUpdate->title = $request->input('title');
            $taskToUpdate->completion = $request->input('completion');
            $taskToUpdate->status = $request->input('status');
            $taskToUpdate->category_id = $request->input('categoryId');

            $taskToUpdate->save();

            return $this->sendJsonResponse($taskToUpdate);

        }else{
            return $this->sendEmptyResponse(404);
        }

    }


    public function updatePartial(Request $request, $id){

        $taskToUpdate = Task::find($id);

        if ($taskToUpdate){
            $validators = [
                'title' => '',
                'completion' => '',
                'status' => '',
                'categoryId' => '',
            ];

            if ($request->has('title')){
                $validators['title'] = 'required';
                $taskToUpdate->title = $request->input('title');
            }

            if ($request->has('completion')){
                $validators['completion'] = 'required|numeric|min:0|max:100';
                $taskToUpdate->completion = $request->input('completion');
            }

            if ($request->has('status')){
                $validators['status'] = 'required|in:1,2';
                $taskToUpdate->status = $request->input('status');
            }

            if ($request->has('categoryId')){
                $validators['categoryId'] = 'required|exists:categories,id';
                $taskToUpdate->category_id = $request->input('categoryId');
            }

            $this->validate($request, $validators);

            $taskToUpdate->save();

            return $this->sendJsonResponse($taskToUpdate);

        }else{
            return $this->sendEmptyResponse(404);
        }
    }

    public function delete($id){
        $taskToDelete = Task::find($id);


        if ($taskToDelete) {

            $taskToDelete->delete();
            return $this->sendEmptyResponse(204);
        } else {
            return $this->sendEmptyResponse(404);
        }
    }
};
