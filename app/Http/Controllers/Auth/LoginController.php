<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Brian2694\Toastr\Facades\Toastr;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock'
        ]);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $stmt = DB::table('users')->where('email',$request->email)->first();

        $prenom = $stmt->firstname;
        $nom = $stmt->name;
        $telephone = $stmt->telephone;
        $email    = $request->email;
        $password = $request->password;

        $dt         = Carbon::now();
        $todayDate  = $dt->toDayDateTimeString();

        $activityLog = [
            'firstname'       => $prenom,
            'name'       => $nom,
            'telephone'       => $telephone,
            'email'       => $email,
            'description' => 'has log in',
            'date_time'   => $todayDate,
        ];
        $user_status = [
                'user_status' => 'En ligne',
        ];

        //DB::commit();
        if (Auth::attempt(['email'=>$email,'password'=>$password])) {
            if (Auth::user()->role_name == "Admin") {
                DB::table('activity_logs')->insert($activityLog);
                DB::table('users')->where('email',$request->email)->update($user_status);
                Toastr::success('Login successfully :)','Success');
                return redirect()->intended('home');
            }
            elseif (Auth::user()->role_name == "Caissier") {
                DB::table('activity_logs')->insert($activityLog);
                DB::table('users')->where('email',$request->email)->update($user_status);
                Toastr::success('Login successfully :)','Success');
                return redirect()->intended('caissier/dashboard');
            }
            elseif (Auth::user()->role_name == "Gérant") {
                DB::table('activity_logs')->insert($activityLog);
                DB::table('users')->where('email',$request->email)->update($user_status);
                Toastr::success('Login successfully :)','Success');
                return redirect()->intended('gerant/dashboard');
            }

        }elseif (Auth::attempt(['email'=>$email,'password'=>$password,'status'=> null])) {
            if (Auth::user()->role_name == "Admin") {
                DB::table('activity_logs')->insert($activityLog);
                DB::table('users')->where('email',$request->email)->update($user_status);
                Toastr::success('Login successfully :)','Success');
                return redirect()->intended('home');
            }
            elseif (Auth::user()->role_name == "Caissier") {
                DB::table('activity_logs')->insert($activityLog);
                DB::table('users')->where('email',$request->email)->update($user_status);
                Toastr::success('Login successfully :)','Success');
                return redirect()->route('caissier.dashboard');
            }
            elseif (Auth::user()->role_name == "Gérant") {
                DB::table('activity_logs')->insert($activityLog);
                DB::table('users')->where('email',$request->email)->update($user_status);
                Toastr::success('Login successfully :)','Success');
                return redirect()->route('gerant.dashboard');
            }
        }
        else{
            Toastr::error('fail, WRONG USERNAME OR PASSWORD :)','Error');
            return redirect('login');
        }

    }

    public function logout()
    {

        $user = Auth::User();
        Session::put('user', $user);
        $user=Session::get('user');

        $email      = $user->email;
        $dt         = Carbon::now();
        $todayDate  = $dt->toDayDateTimeString();

        $activityLog = [
            'email'       => $email,
            'description' => 'has logged out',
            'date_time'   => $todayDate,
        ];

        $user_status = [
            'user_status' => 'Hors ligne',
        ];

        DB::table('activity_logs')->insert($activityLog);
        DB::table('users')->where('email',$email)->update($user_status);
        Auth::logout();
        Toastr::success('Logout successfully :)','Success');
        return redirect('login');
    }

}
