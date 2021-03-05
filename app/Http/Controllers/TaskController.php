<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Liste des catégories
     *
     * @return void
     */
    public function list()
    {
        // on demande au modèle de récupérer toutes les catégories
        $tasksList = Task::all();

        // on retourne la réponse encodée en json
        return $this->sendJsonResponse($tasksList);

    }

    /**
     * Détail d'une catégorie
     */
    public function item($id)
    {
        $task = Task::find($id);


        // si une catégorie avec cet id existe
        if($task){
            // on retourne une réponse contenant la catégorie encodée
            // au format json
            return $this->sendJsonResponse($task);
        } else{
            // sinon, on retourne une réponse vide avec un code 404
            return $this->sendEmptyResponse(404);
        }

    }

    public function add(Request $request)
    {
        $taskAdd = new Task;

        $taskAdd->title = $request->title;
        $taskAdd->completion = $request->completion;
        $taskAdd->status = $request->status;
        $taskAdd->category_id = $request->categoryId;

        $taskAdd->save();


        if($taskAdd){
            // on retourne une réponse contenant la catégorie encodée
            // au format json
            return $this->sendJsonResponse($taskAdd, 201);
        } else{
            // sinon, on retourne une réponse vide avec un code 404
            return $this->sendEmptyResponse(500);
        }

    }

    public function update(Request $request, $id){
        $taskUpdate = Task::find($id);
        if ($taskUpdate) {
            if ($request->isMethod('patch')){
                foreach ($taskUpdate->getAttributes() as $key => $value){
                if ($request->has($key)) {
                    $taskUpdate->$key = $request->$key;
                    break;
                 }
                }
            } else {
                $taskUpdate->title = $request->title;
                $taskUpdate->completion = $request->completion;
                $taskUpdate->status = $request->status;
                $taskUpdate->category_id = $request->categoryId;
            }
            $taskUpdate->save();
            if ($taskUpdate) {
                return $this->sendJsonResponse($taskUpdate, 200);
            } else {
                return $this->sendEmptyResponse(500);
            }
        } else {
            return $this->sendEmptyResponse(404);
        }
    }
}
