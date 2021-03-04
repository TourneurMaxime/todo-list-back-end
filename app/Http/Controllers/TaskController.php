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
        $taskAdd->created_at = $request->created_at;
        $taskAdd->updated_at = $request->updated_at;
        $taskAdd->category_id = $request->category_id;

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



}
