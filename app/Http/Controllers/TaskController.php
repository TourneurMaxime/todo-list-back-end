<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{

    // c'est la méthode quie est exécutée lors de l'appl
    // du endpoints /tasks en GET
    public function list(){

        // on demande à la couche modèle
        // de récupérer toutes les taches
        // $tasksData = Task::all()->load('category');
        $tasksData =  Task::with('category')->get();

        // on renvoit les taches au format JSON
        return $this->sendJsonResponse($tasksData);

    }

    public function item($id){

        // on essaie de récupérer la tache qui a l'id $id
        // pour cela, on utilise encore la couche modèle
        $task = Task::find($id);

        if ($task){
            return $this->sendJsonResponse($task);
        }else{
            return $this->sendEmptyResponse(404);
        }

    }

    // Ici, grâce au mécanisme d'injection de dépendance
    // Lumen peut nous injecter un objet de type Illuminate\Http\Request
    // modélisant la requête HTTP
    public function create(Request $request){

        // on récupère les données dans la requête
        $title = $request->input('title');
        $categoryId = $request->input('categoryId');
        $completion = $request->input('completion', 0);
        $status = $request->input('status', 1);

        // on pourrait afficher la valeur d'un champ particulier
        //echo $title;

        // validation des entrées
        // ici, on voit une validation simple
        // on vérifie simplement que le titre et la catégories sont renseignés
        if (empty($title) || empty($categoryId)){

            // Dans le cas où certaines entrée ne sont pas présentes
            // on indique à l'utilisateur que la requête est mal formatée
            // grâce à un code réponse HTTP adapté
            return $this->sendEmptyResponse(400);

        }else{

            // on crée une instance de al classe Task
            // qui modélise un enregistrement de la table tasks
            // (on est sur une approche Active Record)
            $newTask = new Task();

            // on positionne chacun des attributs de la tache
            // avec les valeurs reçues depuis la requête
            $newTask->title = $title;
            $newTask->category_id = $categoryId;
            $newTask->completion = $completion;
            $newTask->status = $status;

            // on demande à la couche modèle (notre classe Task)
            // de faire persister l'information
            $inserted = $newTask->save();

            if ($inserted){
                // on charge la catégory associée
                // pour obtenir le même type d'objet
                // que dans l'ajout des taches depuis le retour
                // du endpoint /tasks en GET
                // appelé lors de l'initialisation de notre application front
                $newTask->load('category');
                return $this->sendJsonResponse($newTask, 201);
            }else{
                // Ici on indique que c'est une erreur serveur
                return $this->sendEmptyResponse(500);
            }
        }
    }

    // pour travailler, j'ai besoin :
    // - de l'id de la tache à modifier
    // - du nom et des valeurs des champs à mettre à jour sur la tache concernée
    public function updateTotal(Request $request, $id){

        // j'essaie de charger la tache
        $taskToUpdate = Task::find($id);

        // si elle existe
        if ($taskToUpdate){

            // on récupère et valide les données
            // https://lumen.laravel.com/docs/8.x/validation
            // validators https://laravel.com/docs/8.x/validation
            $this->validate($request, [
                'title' => 'required', // le titre est obligatoire
                'completion' => 'required|numeric|min:0|max:100', // la completion est obligatoire, qui doit être un numérique, au moins égal à 0, au plus égal à 100
                'status' => 'required|in:1,2', // champ obligatoire dont la valeur doit être soit 1 soit 2
                'categoryId' => 'required|exists:categories,id', // champ obligatoire, on veut être sur que le champ corresponde à une valeut existante pour la colonne id de la table categories
            ]);

            // on met à jour les propriété de la tache
            // pour le champ title de la tache, on prend la valeur recue
            // dans la requete au niveau du paramètre title
            $taskToUpdate->title = $request->input('title');
            $taskToUpdate->completion = $request->input('completion');
            $taskToUpdate->status = $request->input('status');
            $taskToUpdate->category_id = $request->input('categoryId');

            // si les donnéees sont valides
            // en fait, pas besoin de vérifier, validate
            // lèvera une exception et retournera un code d'erreur
            // la suite de la méthode ne sera pas exécutée

            // on sauvegarde la tache
            $taskToUpdate->save();

            // on renvoie le json contenant la tache modifiée
            return $this->sendJsonResponse($taskToUpdate);

            // sinon
            // on revoie un code réponse indiquant que
            // la requête est mal formattée
            // en fait ici on ne fait rien, validate s'en est déjà occupé

        }else{
            // j'indique que je n'ai pas trouvé la tache
            return $this->sendEmptyResponse(404);
        }

    }


    public function updatePartial(Request $request, $id){

        // j'essaie de charger la tache
        $taskToUpdate = Task::find($id);

        // si elle existe
        if ($taskToUpdate){

            // on part d'une validation hyper permissive
            // on laisse tout passer
            $validators = [
                'title' => '',
                'completion' => '',
                'status' => '',
                'categoryId' => '',
            ];

            // pour chacun des champs, s'il est présent
            // on ajoute la régle de validation
            // et on met à jour notre objet tache
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

            // si un seul des champs présent est mal rempli
            // le traitement s'arrete ici
            // sinon, on continue !
            $this->validate($request, $validators);

            // on sauvegarde la tache
            $taskToUpdate->save();

            // on renvoie le json contenant la tache modifiée
            return $this->sendJsonResponse($taskToUpdate);

        }else{
            // j'indique que je n'ai pas trouvé la tache
            return $this->sendEmptyResponse(404);
        }
    }

    // il manquera la gestion du routage
    // il nous faut un id pour savoir quelle tache supprimer ! TO DO
    public function delete(){

        // on essaie de trouver la tache en question

        // si elle existe :

            // on la supprime

            // on indique à l'utilisateur que tout s'est bien passé

        // sinon

            // on indique à l'utilisateur que la tache n'a pas été trouvée
    }
};
