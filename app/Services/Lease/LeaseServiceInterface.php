<?php

namespace App\Services\Lease;

interface LeaseServiceInterface {

    public function list(array $params);

    public function getById(int $id);

    public function create(array $attributes);

    public function update(array $attributes);

    public function delete(int $id);

}