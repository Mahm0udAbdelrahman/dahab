<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\RegisterRequest;
use App\Models\User;
use App\Services\Web\RegisterService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct(public RegisterService $registerService)
    {}
    public function index(Request $request)
    {
        return $this->registerService->regiser_view();
    }

    public function store(RegisterRequest $request)
    {
        $this->registerService->register($request->validated());
        return redirect()->route('view_login')->with('success', __('Registration successful!'));
    }




}
