<?php

namespace App\Repositories;

use App\Models\Post;

class PostsRepository extends AbstractRepository {

    function __construct(Post $model) {

        parent::__construct($model);

    }

    public function getForCategory(int $category_id) {

        return $this->model->where(
            "category_id",
            $category_id
        )->get();

    }

    public function createForCategory(int $category_id, array $data) {

        $object = (new $this->model)->fill([
            "name" => $data["name"],
            "content" => $data["content"],
            "category_id" => $category_id
        ]);

        if(!empty($data["file"])) {

            $object->file = upload_file(
                $data["file"],
                "posts"
            );

        }

        return $object->save();

    }

    public function updateObject(Post $object, array $data) {

        $object->fill([
            "name" => $data["name"],
            "content" => $data["content"],
        ]);

        if(empty($data["old_file"]) && !empty($object->file)) {

            delete_file(
                $object->file
            );

            $object->file = null;

        }

        if(!empty($data["file"])) {

            $object->file = upload_file(
                $data["file"],
                "posts"
            );

        }

        return $object->save();

    }

    public function delete(int $id) {

        $object = $this->find($id);

        if(!empty($object->file)) {

            delete_file($object->file);

        }

        return parent::delete($id);

    }

}
