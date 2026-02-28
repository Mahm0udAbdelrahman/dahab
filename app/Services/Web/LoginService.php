<?php
namespace App\Services\Web;

use App\Models\User;
use App\Traits\HasImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginService
{
    use HasImage;

    public function __construct(public User $user)
    {}

    public function login_view()
    {
        return view('web.auth.login');
    }

    public function login($data)
    {
        if (! Auth::attempt([
            'phone'    => $data['phone'],
            'password' => $data['password'],
        ])) {
            Session::flash('message', [
                'type' => 'error',
                'text' => __('The data is incorrect!'),
            ]);
            return redirect()->back();
        }

        $user = Auth::user();

        if ($user->hasRole('admin')) {
            Auth::logout();

            Session::flash('message', [
                'type' => 'error',
                'text' => __('Admins cannot log in here!'),
            ]);

            return redirect()->back();
        }

        Session::flash('message', [
            'type' => 'success',
            'text' => __('Welcome Home!'),
        ]);

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }

}
