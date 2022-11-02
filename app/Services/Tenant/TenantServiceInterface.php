<?php

namespace App\Services\Tenant;

interface TenantServiceInterface {

    public function list(array $params);

    public function getById(int $id);

    public function search (string $name);

    public function create(array $attributes);

    public function update(array $attributes);

    public function delete(int $id);

}