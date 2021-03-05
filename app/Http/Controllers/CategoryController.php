<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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
        if ($category) {
            // on retourne une réponse contenant la catégorie encodée
            // au format json
            return $this->sendJsonResponse($category);
        } else {
            // sinon, on retourne une réponse vide avec un code 404
            return $this->sendEmptyResponse(404);
        }
    }

    public function add(Request $request)
    {
        $categoryAdd = new Category;
        $categoryAdd->name = $request->name;
        $categoryAdd->status = $request->status;

        $categoryAdd->save();


        if ($categoryAdd) {
            return $this->sendJsonResponse($categoryAdd, 201);
        } else {
            return $this->sendEmptyResponse(500);
        }

        if (!$categoryAdd) {
            return $this->sendEmptyResponse(404);
        }
    }

    public function update(Request $request, $id){
        $categoryUpdate = Category::find($id);
        if ($categoryUpdate) {
            if ($request->isMethod('patch')){
                foreach ($categoryUpdate->getAttributes() as $key => $value){
                if ($request->has($key)) {
                    $categoryUpdate->$key = $request->$key;
                 }
                }
            } else {
                $categoryUpdate->title = $request->title;
                $categoryUpdate->completion = $request->completion;
                $categoryUpdate->status = $request->status;
                $categoryUpdate->category_id = $request->categoryId;
            }
            $categoryUpdate->save();
            if ($categoryUpdate) {
                return $this->sendJsonResponse($categoryUpdate, 200);
            } else {
                return $this->sendEmptyResponse(500);
            }
        } else {
            return $this->sendEmptyResponse(400);
        }
    }
}
