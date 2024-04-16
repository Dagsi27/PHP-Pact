<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Http\Response;

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/person/{id}', function ($id) use ($router) {

    $result = [
        "first_name" => "Daniel",
        "last_name" => "Śliżewski",
        "alias" => "test",
    ];

    return (new Response($result));
});

$router->get('person', 'PersonController@get');

/*
$router->get('/person', function () use ($router) {
    $result = \App\Models\Person::get();

    return (new Response([
        [
            "first_name" => $result[0]->name,
            "last_name" => $result[0]->lastName,
            "alias" => $result[0]->alias,
        ]
    ]));
});
*/
