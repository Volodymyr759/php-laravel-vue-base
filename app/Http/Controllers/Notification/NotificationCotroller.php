<?php

namespace App\Http\Controllers\Notification;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Notification\Notification;
use App\Services\Notification\NotificationServiceInterface;

class NotificationCotroller extends Controller
{
    protected $notificationService;

    public function __construct(NotificationServiceInterface $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index ()
    {
        return $this->notificationService->list();
    }

    public function create (Request $request) 
    {
        return $this->notificationService->create($request -> all());
    }

    public function delete (int $id) 
    {
        return $this->notificationService->delete($id);
    }
}
