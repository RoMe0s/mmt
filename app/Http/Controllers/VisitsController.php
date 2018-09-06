<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\VisitsRepository;

class VisitsController extends Controller
{

    protected $repository;

    function __construct(VisitsRepository $repository) {

        $this->repository = $repository;

    }

    public function load() {

        return $this->toJson([
            "counter" => $this->repository->loadCounterString()
        ]);

    }

}
