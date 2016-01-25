<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\RegisterRequest;

use Auth;
use App\SecretKey;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'admin';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'username' => 'required', 'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('auth/login')
                        ->withErrors($validator)
                        ->withInput();
        }


        $credentials = ['username' => $request->input('username'), 'password' => $request->input('password')];

        if(Auth::validate($credentials))
        {
            $credentials['active'] = 1;
            if (Auth::attempt($credentials))
            {
                    return redirect('admin');    
            }else{
                $message = 'These credentials do not match our records.';
                return redirect('auth/login')
                    ->withInput()
                    ->withErrors($message);
            }
        }       
        else{
            
            return redirect('auth/login')
                    ->withInput($request->only('username'))
                    ->withErrors([
                        'username' => $this->getFailedLoginMessage(),
                    ]);
        }

        
    }


    /**
     * Store the member information
     *
     * @return success message
     * @param name, email, password
     */
    public function postRegister(
        RegisterRequest $request
        )
    {

        try{
            $keys = SecretKey::where('key', $request->input('your_key'))->where('status', 0)->first();
            if(!$keys){
                return redirect('auth/register')->with(['message'=>'Invalid Key.', 'type'=>'danger']);
            }
            $faculty = 0;
            if($keys->type == 1){ //teacher
                $role = 2;
            }else if($keys->type == 2){ //student
                if($request->input('faculty') == 0){
                    return redirect()->back()->withErrors(['faculty'=>'Students must select their faculty.']);
                }
                $faculty = $request->input('faculty');
                $role = 3;
            }

            $keys->status = 1;
            $keys->save();

            $user = new User;
            $user->role_id = $role;
            $user->clz_key = $request->input('your_key');
            $user->username = $request->input('username');
            $user->password = \Hash::make($request->input('password'));
            $user->active = 0;

            $user->save();

            $profile = new Profile;

            $profile->user_id = $user->id;
            $profile->faculty_id = $faculty;
            $profile->name = $request->input('name');
            $profile->email = $request->input('email');
            $profile->save();
            return redirect('auth/register')->with(['message' => 'Success', 'type' => 'success']);
            return view('thankyou');
            
        }
        catch(\Exception $e)
        {
            // return redirect('auth/register')->with(['message' => 'Registration Failed. Try Again!', 'type' => 'danger']);
            return redirect('/')->with(['message' => $e->getMessage(), 'type' => 'danger']);
        }
    }
}
