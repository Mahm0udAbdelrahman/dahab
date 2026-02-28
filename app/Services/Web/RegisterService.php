<?php
namespace App\Services\Web;

use App\Models\User;
use App\Traits\HasImage;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    use HasImage;

    public function __construct(public User $model)
    {}

    public function regiser_view()
    {
        return view('web.auth.register');
    }

    public function register($data)
    {

        if (isset($data['image'])) {
            $data['image'] = $this->saveImage($data['image'], 'user');
        } else {
            $data['image'] = asset('default/default.png');
        }

        $data['password'] = Hash::make($data['password']);

        $user = $this->model->create($data);

        return $user;
    }

}
