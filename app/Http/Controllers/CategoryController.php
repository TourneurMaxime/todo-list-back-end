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

        if($category){
            return $this->sendJsonResponse($category);
        } else{
            return $this->sendEmptyResponse(404);
        }

    }

}
