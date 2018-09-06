<?php

namespace App\Repositories;

use App\Models\Visit;

class VisitsRepository extends AbstractRepository {

    function __construct(Visit $model) {

        parent::__construct($model);

    }

    public static function storeStatistic(string $ip, string $browser) {

        Visit::updateOrCreate([
            "ip" => $ip,
            "browser" => $browser
        ]);

    }

    public function loadCounterString() {

        return $this->model->selectRaw(
            "CONCAT(browser, ':', COUNT(id)) as counter"
        )->groupBy(
            "browser"
        )->get()->implode(
            'counter',
            ' | '
        );

    }

}
