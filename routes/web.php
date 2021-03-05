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
        'as' => 'category-list'
    ]
);

$router->get(
    '/categories/{id}',
    [
        'uses' => 'CategoryController@item',
        'as' => 'category-item'
    ]
);

$router->post(
    '/categories',
    [
        'uses' => 'CategoryController@add',
        'as' => 'category-post'
    ]
);

$router->put(
    '/categories/{id}',
    [
        'uses' => 'CategoryController@update',
        'as' => 'category-put'
    ]
);

$router->patch(
    '/categories/{id}',
    [
        'uses' => 'CategoryController@update',
        'as' => 'category-patch'
    ]
);

$router->get(
    '/tasks',
    [
        'uses' => 'TaskController@list',
        'as' => 'task-list'
    ]
);

$router->get(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@item',
        'as' => 'task-item'
    ]
);

$router->post(
    '/tasks',
    [
        'uses' => 'TaskController@add',
        'as' => 'task-post'
    ]
);

$router->put(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@update',
        'as' => 'task-put'
    ]
);

$router->patch(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@update',
        'as' => 'task-patch'
    ]
);

