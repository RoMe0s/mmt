<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PostsRepository;

class PostsController extends Controller
{

    protected $repository;

    function __construct(PostsRepository $repository) {

        parent::__construct();

        $this->repository = $repository;

    }

    public function list(int $category_id) {

        return $this->toJson([
            "elements" => $this->repository->getForCategory(
                $category_id
            )
        ]);

    }

    public function create(int $category_id) {

        return $this->toView("posts.create", [
            "category_id" => $category_id
        ]);

    }

    public function store(int $category_id, Request $request) {

        $request->validate([
            "name" => "required|max:255|unique:posts,name,NULL,id,category_id,$category_id",
            "content" => "required|max:255",
            "file" => "nullable|file|max:2048",
        ]);

        return $this->toJson([
            "status" => (bool)$this->repository->createForCategory(
                $category_id,
                $request->only([
                    "name",
                    "content",
                    "file"
                ])
            )
        ]);

    }

    public function show(int $id) {

        $object = $this->repository->find($id);

        abort_if(!$object, 404);

        return $this->toView("posts.show", [
            "object" => $object
        ]);

    }

    public function edit(int $id) {

        $object = $this->repository->find($id);

        abort_if(!$object, 404);

        return $this->toView("posts.edit", [
            "object" => $object
        ]);

    }

    public function update(int $category_id, int $id, Request $request) {

        $request->validate([
            "name" => "required|max:255|unique:posts,name,$id,id,category_id,$category_id",
            "content" => "required|max:255",
            "file" => "nullable|file|max:2048",
            "old_file" => "string|nullable"
        ]);

        $object = $this->repository->find($id);

        abort_if(!$object, 404);

        return $this->toJson([
            "status" => $this->repository->updateObject($object, $request->only([
                "name",
                "content",
                "file",
                "old_file"
            ]))
        ]);

    }

    public function destroy(int $id) {

        return $this->toJson([
            "status" => $this->repository->delete(
                $id
            )
        ]);

    }

}
