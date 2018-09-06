<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository {

    protected $model;

    function __construct(Model $model) {

        $this->model = $model;

    }

    public function find(int $id, array $with = []) {

        return $this->model->with(
            $with
        )->find(
            $id
        );

    }

    public function get(array $with = []) {

        return $this->model->with(
            $with
        )->get();

    }

    public function create(array $data) {

        return $this->model->create(
            $data
        );

    }

    public function update(int $id, array $data) {

        return $this->model->where(
            "id",
            $id
        )->update(
            $data
        );

    }

    public function delete(int $id) {

        return $this->model->where(
            "id",
            $id
        )->delete();

    }

    public function exists(int $id) {

        return (bool)$this->model->where(
            "id",
            $id
        )->exists();

    }

    public function updateOrCreate(array $selector, array $data = []) {

        return $this->model->updateOrCreate(
            $selector,
            $data
        );

    }

}
