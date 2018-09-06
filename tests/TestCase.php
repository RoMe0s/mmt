<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    use CreatesApplication;

    protected function prepareAjaxJsonRequest() {

        $this->withHeaders([
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
            'HTTP_CONTENT_TYPE' => 'application/json',
            'HTTP_ACCEPT' => 'application/json'
        ]);

    }

}
