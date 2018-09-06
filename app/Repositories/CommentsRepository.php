<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentsRepository extends AbstractRepository {

    function __construct(Comment $model) {

        parent::__construct($model);

    }

    public function getFor(int $id, string $type) {

        return $this->model->where(
            "modelable_id",
            $id
        )->where(
            "modelable_type",
            $type
        )->get();

    }

    public function create(array $data) {

        return $this->model->create([
            "modelable_id" => $data["id"],
            "modelable_type" => $data["type"],
            "author" => preg_replace_callback("/(\S+)\s+(\S+)/u", function($matches) {

                return mb_ucfirst(
                    mb_strtolower(
                        $matches[1]
                    )
                ) . ' ' . mb_ucfirst(
                    mb_strtolower(
                        $matches[2]
                    )
                );

            }, $data["author"]),
            "content" => $data["content"]
        ]);

    }

}
