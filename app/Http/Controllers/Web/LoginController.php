<?php
namespace App\Http\Controllers\Web;

use App\Services\Web\LoginService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\LoginRequest;
use App\Http\Requests\Web\ComplecetInfoRequest;

class LoginController extends Controller
{
    public function __construct(public LoginService $loginService)
    {}
    public function index()
    {
        return $this->loginService->login_view();
    }

    public function store(LoginRequest $request)
    {
        return $this->loginService->login($request->validated());
    }

    public function logout()
    {
        return $this->loginService->logout();
    }


}
