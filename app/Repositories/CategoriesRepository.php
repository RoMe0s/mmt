<?php

namespace App\Repositories;

use App\Models\Category;

class CategoriesRepository extends AbstractRepository {

    function __construct(Category $model) {

        parent::__construct($model);

    }

}
