<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class UsersController extends Controller
{
    public function __construct(protected UserService $userService) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        try {
            $details = $this->userService->getUserDetails(10);
            return $this->apiResponse($details,'user', '<usersXml></usersXml>');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
