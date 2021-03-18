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

$router->get(
    '/categories',
    [
        'uses' => 'CategoryController@list',
        'as'   => 'categories-list'
    ]
);

$router->get(
    '/categories/{id}',
    [
        'uses' => 'CategoryController@item',
        'as'   => 'categories-item'
    ]
);

$router->get(
    '/tasks',
    [
        'uses' => 'TaskController@list',
        'as' => 'tasks-list'
    ],
);

$router->get(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@item',
        'as' => 'tasks-item'
    ],
);

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
