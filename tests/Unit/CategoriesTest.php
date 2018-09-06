<?php

namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use App\Models\Category;
use Illuminate\Support\Collection;
use App\Repositories\CategoriesRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriesTest extends TestCase
{

    public function testFind() {

        $mock = Mockery::mock(Category::class);

        $mock->shouldReceive(
            "with"
        )->withAnyArgs()->andReturn(
            $mock
        )->shouldReceive(
            'find'
        )->with(
            1
        )->andReturn(
            new Category
        );

        $repository = new CategoriesRepository(
            $mock
        );

        $category = $repository->find(1);

        $this->assertEquals(
            new Category,
            $category
        );

    }

    public function testGet() {

        $mock = Mockery::mock(Category::class);

        $mock->shouldReceive(
            "with"
        )->with([
            "posts"
        ])->andReturn(
            $mock
        )->shouldReceive(
            "get"
        )->andReturn(
            new Collection
        );

        $repository = new CategoriesRepository(
            $mock
        );

        $categories = $repository->get([
            "posts"
        ]);

        $this->assertEquals(
            new Collection,
            $categories
        );

    }

}
