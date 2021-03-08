<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get(
    '/',
    [
        'uses' => 'MainController@home',
        'as'   => 'main-home'
    ]
);

// on ajoute la route pour la liste des catégories
$router->get(
    '/categories',
    [
        'uses' => 'CategoryController@list',
        'as'   => 'categories-list'
    ]
);

// on ajoute la liste de détail d'une catégorie
// cette route a un paramètre obligatoire : id
// cet id pourra être récupéré en poaramètre de la méthode de controller
$router->get(
    '/categories/{id}',
    [
        'uses' => 'CategoryController@item',
        'as'   => 'categories-item'
    ]
);

// on définit la route pour le endpoint /tasks en GET
// c'est la méthode list du controller TaskController
// qui traitera les requêtes sur ce endpoint
$router->get(
    '/tasks',
    [
        'uses' => 'TaskController@list',
        'as' => 'tasks-list'
    ],
);

// on définit la route pour le endpoint /tasks/[id] en GET
// c'est la méthode item du controller TaskController
// qui traitera les requêtes sur ce endpoint
$router->get(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@item',
        'as' => 'tasks-item'
    ],
);

// on définit la route pour le endpoint /tasks en POST
// c'est la méthode create du controller TaskController
// qui traitera les requêtes sur ce endpoint
$router->post(
    '/tasks',
    [
        'uses' => 'TaskController@create',
        'as' => 'tasks-create'
    ],
);

$router->put(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@updateTotal',
        'as' => 'tasks-put',
    ],
);

$router->patch(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@updatePartial',
        'as' => 'tasks-patch',
    ],
);

    $router->delete(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@delete',
        'as' => 'tasks-delete',
    ],
);
