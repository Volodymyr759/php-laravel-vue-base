<?php

namespace App\Services\Notification;

use Illuminate\Support\Facades\Validator;
use App\Models\Notification\Notification;
use App\Services\Notification\NotificationServiceInterface;

class NotificationService implements NotificationServiceInterface
{
    protected $model;

    public function __construct(Notification $model)
    {
        $this->model = $model;
    }

    public function list()
    {
        return $this->model->orderByDesc('id')->paginate($this->model->paginateLimit);
    }

    public function create(array $attributes)
    {
        Validator::make($attributes, $this->model::VALIDATION_RULES)->validate();

        return $this->model->create($attributes);
    }

    public function delete (int $id) 
    {
        $notification = $this->model->find($id);
        if (!$notification) {
            return response()->json([
                "status" => 'Not Found',
                "message" => "Notification not found"
            ])->setStatusCode(404, 'Notification not found');
        }
        $notification->delete();

        return $notification;
    }
}
