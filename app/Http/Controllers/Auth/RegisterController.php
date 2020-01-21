<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notifiable;
use App\Notifications\WelcomeCustomer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required','unique:users',],
            'country' => ['string']
        ]);
    }
    
    protected function create(array $data)
    {
        $customerEmail = $data["email"];
        $customerName = $data["name"];
        $user = new User();
		$user->email = $customerEmail;
        $arr = array("user" => $customerName);
        $user->notify(new WelcomeCustomer($arr));

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'country'=> $data['country'],
            'phone' => $data['phone'],
            'role' => "Customer",
            'category' => 3,
            'status' => 1,
            'password' => Hash::make($data['password'])
        ]);
    }

}
