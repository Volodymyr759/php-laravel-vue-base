<?php

namespace App\Services\Property;

interface PropertyServiceInterface {

    public function list(array $params);

    public function getById(int $id);

    public function search (string $address);

    public function create(array $attributes);

    public function update(array $attributes);

    public function delete(int $id);

}