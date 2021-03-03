<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function list()
    {
        $categoriesList = [
            1 => [
              'id' => 1,
              'name' => 'Chemin vers O\'clock',
              'status' => 1
            ],
            2 => [
              'id' => 2,
              'name' => 'Courses',
              'status' => 1
            ],
            3 => [
              'id' => 3,
              'name' => 'O\'clock',
              'status' => 1
            ],
            4 => [
              'id' => 4,
              'name' => 'Titre Professionnel',
              'status' => 1
            ]
          ];

          return response()->json($categoriesList);
    }

    public function item($categoryId)
    {
        $categoryId = intval($categoryId);

        $categoriesList = [
            1 => [
              'id' => 1,
              'name' => 'Chemin vers O\'clock',
              'status' => 1
            ],
            2 => [
              'id' => 2,
              'name' => 'Courses',
              'status' => 1
            ],
            3 => [
              'id' => 3,
              'name' => 'O\'clock',
              'status' => 1
            ],
            4 => [
              'id' => 4,
              'name' => 'Titre Professionnel',
              'status' => 1
            ]
          ];

          if(array_key_exists($categoryId, $categoriesList)){
            $category = $categoriesList[$categoryId];
            return response()->json($category);
        } else {
            // J'affiche une 404
            abort(404);
        }
    }

    //
}
