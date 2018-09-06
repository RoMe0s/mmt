<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$router->view("/", "home")->name("home");

$router->group(["prefix" => "categories", "as" => "categories."], function($router) {

    $router->get("create", "CategoriesController@create")->name("create");

    $router->group(["middleware" => "ajax"], function($router) {

        $router->post("list", "CategoriesController@list");

        $router->post("/", "CategoriesController@store");

        $router->group(["prefix" => "{id}", "where" => ["id" => "[0-9]+"]], function($router) {

            $router->delete("/", "CategoriesController@destroy");

            $router->post("/", "CategoriesController@update");

        });

    });

    $router->group(["prefix" => "{id}", "where" => ["id" => "[0-9]+"]], function($router) {

        $router->get("/", "CategoriesController@show")->name("show");

        $router->get("edit", "CategoriesController@edit");

    });

});

$router->group(["prefix" => "posts", "as" => "posts."], function($router) {

    $router->group(["prefix" => "{category_id}", "where" => ["category_id" => "[0-9]+"]], function($router) {

        $router->post("list", "PostsController@list")->middleware("ajax");

        $router->group(["middleware" => "category.check"], function($router) {

            $router->get("create", "PostsController@create")->name("create");

            $router->group(["middleware" => "ajax"], function($router) {

                $router->post("/", "PostsController@store");

                $router->post("{id}", "PostsController@update");

            });

        });

    });

    $router->group(["prefix" => "{id}", "where" => ["id" => "[0-9]+"]], function($router) {

        $router->get("/", "PostsController@show");

        $router->get("edit", "PostsController@edit");

        $router->delete("/", "PostsController@destroy")->middleware("ajax");

    });

});

$router->group(["prefix" => "comments", "as" => "comments."], function($router) {

    $router->post("list", "CommentsController@list");

    $router->post("/", "CommentsController@create");

});

$router->post("visits", "VisitsController@load");
