<?php

namespace App\Services\Notification;

interface NotificationServiceInterface {

    public function list();

    public function create(array $attributes);

    public function delete(int $id);

}