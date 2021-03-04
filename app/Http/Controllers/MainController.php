<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        // echo "hello world ;-)";

        // on peut lancer des requêtes SQLcomme suit
        // inconvénient, on récupère des objets standards
        // $results = DB::select("SELECT * FROM categories");

        // grâce à Eloquent, on peut récupérer tous les enregistrements
        // d'un table sans rien coder grâce à la méthode all de la classe
        // Illuminate\Database\Eloquent\Model
        //$results = Category::all();
        //dump($results);

        // Si on veut rajouter des contraite, on peut utiliser
        // le query builder
        // Ici on veut l'équivalent
        // SELECT *
        // FROM categories
        // WHERE status = 1

        //$results = Category::where('status', 1)->get();
        //dump($results);

        // grâce à Eloquent, on peut récupérer un enregistrement en fonction de son id :
        // équivalent à la requête SQL :
        // SELECT * FROM categories  WHERE id = 2
        $courseCategory = Category::find(2);
        dump($courseCategory);

        // Pour récupérer un champ particulier d'un enregistrement, on peut faire :
        echo $courseCategory->name;

        // insertion d'un enregistrement
        /*
        $newCategory = new Category();
        $newCategory->name = 'water poney';
        $newCategory->status = 2;
        $newCategory->save();
        */

        // mise à jour d'un enregistrement
        /*
        $waterPoneyCategory = Category::find(6);
        $waterPoneyCategory->name = 'aquaPoney';
        $waterPoneyCategory->save();
        */

        // supprimer un enregistrement
        // équivaut à DELETE FROM categories where id = 6
        /*
        Category::destroy(6);
        */
    }

}
