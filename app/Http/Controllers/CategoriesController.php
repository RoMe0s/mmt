<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CategoriesRepository;

class CategoriesController extends Controller
{

    protected $repository;

    function __construct(CategoriesRepository $repository) {

        parent::__construct();

        $this->repository = $repository;

    }

    public function list() {

        return $this->toJson([
            "elements" => $this->repository->get()
        ]);

    }

    public function create() {

        return $this->toView("categories.create");

    }

    public function store(Request $request) {

        $request->validate([
            "name" => "required|max:255|unique:categories,name",
            "description" => "required|max:255"
        ]);

        return $this->toJson([
            "status" => (bool)$this->repository->create(
                $request->only([
                    "name",
                    "description"
                ])
            )
        ]);

    }

    public function show(int $id) {

        $object = $this->repository->find($id);

        abort_if(!$object, 404);

        return $this->toView("categories.show", [
            "object" => $object
        ]);

    }

    public function edit(int $id) {

        $object = $this->repository->find($id);

        abort_if(!$object, 404);

        return $this->toView("categories.edit", [
            "object" => $object
        ]);

    }

    public function update(int $id, Request $request) {

        $request->validate([
            "name" => "required|max:255|unique:categories,name,$id",
            "description" => "required|max:255"
        ]);

        return $this->toJson([
            "status" => (bool)$this->repository->update($id, $request->only([
                "name",
                "description"
            ]))
        ]);

    }

    public function destroy(int $id) {

        return $this->toJson([
            "status" => (bool)$this->repository->delete(
                $id
            )
        ]);

    }

}
