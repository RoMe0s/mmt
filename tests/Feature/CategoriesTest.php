<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriesTest extends TestCase
{

    public function testHome() {

        $response = $this->get("/");

        $response->assertStatus(200);

    }

    public function testCreate() {

        $response = $this->get("categories/create");

        $response->assertStatus(200);

    }

    public function testList() {

        $this->post(
            "categories/list"
        )->assertForbidden();

        $this->prepareAjaxJsonRequest();

        $response = $this->post("categories/list");

        $response->assertJson([
            "elements" => true
        ])->assertStatus(200);

    }

    public function testStore() {

        $this->post(
            "categories"
        )->assertForbidden();

        $this->prepareAjaxJsonRequest();

        $response = $this->post("categories", [
            "name" => "Test name",
            "description" => "Test description"
        ]);

        $response->assertExactJson([
            "status" => true
        ])->assertStatus(200);

    }

    public function testUpdate() {

        $object = Category::latest(
            "id"
        )->first();

        $this->post(
            "categories/{$object->id}"
        )->assertForbidden();

        $this->prepareAjaxJsonRequest();

        $response = $this->post("categories/{$object->id}", [
            "name" => "New test name",
            "description" => "New test description"
        ]);

        $response->assertExactJson([
            "status" => true
        ])->assertStatus(200);

    }

    public function testDelete() {

        $this->delete(
            "categories/1"
        )->assertForbidden();

        $this->prepareAjaxJsonRequest();

        $object = Category::latest(
            "id"
        )->first();

        $response = $this->delete(
            "categories/{$object->id}"
        );

        $response->assertExactJson([
            "status" => true
        ])->assertStatus(200);

    }

    public function testShow() {

        $this->get(
            "categories/0"
        )->assertNotFound();

        $object = Category::first();

        if($object) {

            $this->get(
                "categories/{$object->id}"
            )->assertStatus(
                200
            )->assertSee(
                $object->name
            )->assertViewHas(
                "object",
                $object
            );

        }

    }

    public function testEdit() {

        $this->get(
            "categories/0/edit"
        )->assertNotFound();

        $object = Category::first();

        if($object) {

            $this->get(
                "categories/{$object->id}/edit"
            )->assertStatus(
                200
            )->assertViewHas(
                "object",
                $object
            );

        }

    }
 
}
