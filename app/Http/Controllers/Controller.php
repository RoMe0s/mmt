<?php

namespace App\Http\Controllers;

use Browser;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repositories\VisitsRepository;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data = [];

    function __construct() {

        $this->middleware(function($request, $next) {

            if(!$request->wantsJson()) {

                VisitsRepository::storeStatistic(
                    $request->ip(),
                    Browser::browserFamily()
                );

            }

            return $next($request);

        });

    }

    public function setData(string $key, $value) {

        $this->data[$key] = $value;

        return $this;

    }

    public function toView(string $view, array $data = []) {

        return view(
            $view
        )->with(
            array_merge(
                $this->data,
                $data
            )
        );

    }

    public function toJson(array $data = []) {

        return response()->json(
            array_merge(
                $this->data,
                $data
            )
        );

    }

}
