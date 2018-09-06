<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\CommentsRepository;

class CommentsController extends Controller
{

    protected $repository;

    function __construct(CommentsRepository $repository) {

        parent::__construct();

        $this->repository = $repository;

    }

    public function list(Request $request) {

        $request->validate([
            "type" => "required|string|in:" . join(',', [
                Post::class,
                Category::class
            ]),
            "id" => "required|numeric|min:1"
        ]);

        return $this->toJson([
            "elements" => $this->repository->getFor(
                $request->get("id"),
                $request->get("type")
            )
        ]);

    }

    public function create(Request $request) {

        $request->validate([
            "type" => "required|string|in:" . join(',', [
                Post::class,
                Category::class
            ]),
            "id" => "required|numeric|min:1",
            "author" => "required|max:255|regex:/^\s*[a-za-я]+\s+[a-zа-я]+\s*$/ui",
            "content" => "required|max:20000"
        ]);

        return $this->toJson([
            "object" => $this->repository->create($request->only([
                "id",
                "type",
                "author",
                "content"
            ]))
        ]);

    }

}
