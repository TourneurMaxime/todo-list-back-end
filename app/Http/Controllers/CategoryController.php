<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Liste des catégories
     *
     * @return void
     */
    public function list()
    {
        // on demande au modèle de récupérer toutes les catégories
        $categoriesList = Category::all();

        // on retourne la réponse encodée en json
        return $this->sendJsonResponse($categoriesList);

    }

    /**
     * Détail d'une catégorie
     */
    public function item($id)
    {
        $category = Category::find($id);


        // si une catégorie avec cet id existe
        if($category){
            // on retourne une réponse contenant la catégorie encodée
            // au format json
            return $this->sendJsonResponse($category);
        } else{
            // sinon, on retourne une réponse vide avec un code 404
            return $this->sendEmptyResponse(404);
        }

    }

}
