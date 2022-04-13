<?php

namespace App\Http\Controllers;

use App\Models\activityLog;
use App\Models\caissier;
use App\Models\chef_agence;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use App\Models\User;
use App\Models\Employee;
use App\Models\Form;
use App\Models\ProfileInformation;
use App\Models\userActivityLog;
use App\Rules\MatchOldPassword;
use Carbon\Carbon;
use Session;
use Auth;
use Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_name=='Admin')
        {
            $result      = DB::table('users')->get();
            $role_name   = DB::table('role_type_users')->get();
            $position    = DB::table('position_types')->get();
            $department  = DB::table('departments')->get();
            $status_user = DB::table('user_types')->get();
            return view('usermanagement.user_control',compact('result','role_name','position','department','status_user'));
        }
        else
        {
            return redirect()->route('home');
        }

    }
    // search user
    public function searchUser(Request $request)
    {
        if (Auth::user()->role_name=='Admin')
        {
            $users      = DB::table('users')->get();
            $result     = DB::table('users')->get();
            $role_name  = DB::table('role_type_users')->get();
            $position   = DB::table('position_types')->get();
            $department = DB::table('departments')->get();
            $status_user = DB::table('user_types')->get();

            // search by name
            if($request->name)
            {
                $result = User::where('name','LIKE','%'.$request->name.'%')->get();
            }

            // search by role name
            if($request->role_name)
            {
                $result = User::where('role_name','LIKE','%'.$request->role_name.'%')->get();
            }

            // search by status
            if($request->status)
            {
                $result = User::where('status','LIKE','%'.$request->status.'%')->get();
            }

            // search by name and role name
            if($request->name && $request->role_name)
            {
                $result = User::where('name','LIKE','%'.$request->name.'%')
                                ->where('role_name','LIKE','%'.$request->role_name.'%')
                                ->get();
            }

            // search by role name and status
            if($request->role_name && $request->status)
            {
                $result = User::where('role_name','LIKE','%'.$request->role_name.'%')
                                ->where('status','LIKE','%'.$request->status.'%')
                                ->get();
            }

            // search by name and status
            if($request->name && $request->status)
            {
                $result = User::where('name','LIKE','%'.$request->name.'%')
                                ->where('status','LIKE','%'.$request->status.'%')
                                ->get();
            }

            // search by name and role name and status
            if($request->name && $request->role_name && $request->status)
            {
                $result = User::where('name','LIKE','%'.$request->name.'%')
                                ->where('role_name','LIKE','%'.$request->role_name.'%')
                                ->where('status','LIKE','%'.$request->status.'%')
                                ->get();
            }

            return view('usermanagement.user_control',compact('users','role_name','position','department','status_user','result'));
        }
        else
        {
            return redirect()->route('home');
        }

    }

    // use activity log
    public function activityLog()
    {
        $activityLog = DB::table('user_activity_logs')->get();
        return view('usermanagement.user_activity_log',compact('activityLog'));
    }
    // activity log
    public function activityLogInLogOut()
    {
        $activityLog = DB::table('activity_logs')->get();
        return view('usermanagement.activity_log',compact('activityLog'));
    }

    // profile user
    public function profile()
    {
        $user = Auth::User();

        Session::put('user', $user);
        $user=Session::get('user');
        $profile = $user->rec_id;

        $user = DB::table('users')->get();
        $employees = DB::table('profile_information')->where('rec_id',$profile)->first();

        if(empty($employees))
        {
            $information = DB::table('profile_information')->where('rec_id',$profile)->first();
            return view('usermanagement.profile_user',compact('information','user'));

        }else{
            $rec_id = $employees->rec_id;
            if($rec_id == $profile)
            {
                $information = DB::table('profile_information')->where('rec_id',$profile)->first();
                return view('usermanagement.profile_user',compact('information','user'));
            }else{
                $information = ProfileInformation::all();
                return view('usermanagement.profile_user',compact('information','user'));
            }
        }

    }

    // save profile information
    public function profileInformation(Request $request)
    {
        try{
            if(!empty($request->images))
            {
                $image_name = $request->hidden_image;
                $image = $request->file('images');
                if($image_name =='photo_defaults.jpg')
                {
                    if($image != '')
                    {
                        $image_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('/assets/images/'), $image_name);
                    }
                }
                else{
                    if($image != '')
                    {
                        $image_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('/assets/images/'), $image_name);
                    }
                }
                $update = [
                    'rec_id' => $request->rec_id,
                    'name'   => $request->name,
                    'avatar' => $image_name,
                ];
                User::where('rec_id',$request->rec_id)->update($update);
            }

            $information = ProfileInformation::updateOrCreate(['rec_id' => $request->rec_id]);
            $information->name         = $request->name;
            $information->$request->$request->id       = $request->rec_id;
            $information->email        = $request->email;
            $information->birth_date   = $request->birthDate;
            $information->gender       = $request->gender;
            $information->address      = $request->address;
            $information->state        = $request->state;
            $information->country      = $request->country;
            $information->pin_code     = $request->pin_code;
            $information->phone_number = $request->phone_number;
            $information->department   = $request->department;
            $information->designation  = $request->designation;
            $information->reports_to   = $request->reports_to;
            $information->save();

            DB::commit();
            Toastr::success('Profile Information successfully :)','Success');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Add Profile Information fail :)','Error');
            return redirect()->back();
        }
    }

    // save new user
    public function addNewUserSave(Request $request)
    {
        $request->validate([
            'firstname'      => 'required|string|max:255',
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'telephone'     => 'required|min:11|numeric',
            'role_name' => 'required|string|max:255',
            'status'    => 'required|string|max:255',
            'image'     => 'required|image',
            'password'  => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        DB::beginTransaction();

            $dt       = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();
            // Création d'un Gérant
            if ($request->role_name == "Gérant") {
                $image = time().'.'.$request->image->extension();
                $request->image->move(public_path('assets/images'), $image);
                $chef_agence = new chef_agence();
                $chef_agence->firstname         = $request->firstname;
                $chef_agence->name         = $request->name;
                $chef_agence->email        = $request->email;
                $chef_agence->join_date    = $todayDate;
                $chef_agence->telephone = $request->telephone;
                $chef_agence->role_name    = $request->role_name;
                $chef_agence->status       = $request->status;
                $chef_agence->avatar       = $image;
                $chef_agence->password     = Hash::make($request->password);
                $chef_agence->save();
            }
            // Création d'un Caissier
            elseif ($request->role_name == "Caissier") {
                $image = time().'.'.$request->image->extension();
                $request->image->move(public_path('assets/images'), $image);
                $caissier = new caissier();
                $caissier->firstname         = $request->firstname;
                $caissier->name         = $request->name;
                $caissier->email        = $request->email;
                $caissier->join_date    = $todayDate;
                $caissier->telephone = $request->telephone;
                $caissier->role_name    = $request->role_name;
                $caissier->status       = $request->status;
                $caissier->avatar       = $image;
                $caissier->password     = Hash::make($request->password);
                $caissier->save();
            }
            // Création d'un utilisateur normal
            elseif($request->role_name == "Gérant" || $request->role_name == "Caissier" || $request->role_name == "Normal") {
                $image = time().'.'.$request->image->extension();
                $request->image->move(public_path('assets/images'), $image);
                $user = new User;
                $user->firstname    = $request->firstname;
                $user->name         = $request->name;
                $user->email        = $request->email;
                $user->join_date    = $todayDate;
                $user->telephone = $request->telephone;
                $user->role_name    = $request->role_name;
                $user->status       = $request->status;
                $user->avatar       = $image;
                $user->password     = Hash::make($request->password);
                $user->save();
            }
            DB::commit();
            Toastr::success('Create new account successfully :)','Success');
            return redirect()->route('userManagement');

    }
    public function storeUser(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'telephone' => 'required|string|max:15|unique:users',
            'email'     => 'required|string|email|max:255|unique:users',
            'role_name' => 'required|string|max:255',
            'password'  => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $dt       = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();


        if ($request->role_name == "Caissier") {
            caissier::create([
                'name'      => $request->name,
                'firstname'      => $request->firstname,
                'telephone'      => $request->telephone,
                'avatar'    => $request->image,
                'email'     => $request->email,
                'join_date' => $todayDate,
                'role_name' => $request->role_name,
                'password'  => Hash::make($request->password),
            ]);
        }
        elseif ($request->role_name == "Gérant") {
            chef_agence::create([
                'name'      => $request->name,
                'firstname'      => $request->firstname,
                'telephone'      => $request->telephone,
                'avatar'    => $request->image,
                'email'     => $request->email,
                'join_date' => $todayDate,
                'role_name' => $request->role_name,
                'password'  => Hash::make($request->password),
            ]);
        }
        else {
            User::create([
                'name'      => $request->name,
                'firstname'      => $request->firstname,
                'telephone'      => $request->telephone,
                'avatar'    => $request->image,
                'email'     => $request->email,
                'join_date' => $todayDate,
                'role_name' => $request->role_name,
                'password'  => Hash::make($request->password),
            ]);
        }




        Toastr::success('Create new account successfully :)','Success');
        return redirect('login');
    }
    // update
    public function update(Request $request)
    {
        DB::beginTransaction();
        try{
            $id       = $request->id;
            $rec_id       = $request->rec_id;
            $name         = $request->name;
            $firstname      = $request->firstname;
            $email        = $request->email;
            $role_name    = $request->role_name;
            $phone        = $request->telephone;
            $status       = $request->status;

            $dt       = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();
            $image_name = $request->hidden_image;
            $image = $request->file('images');
            if($image_name =='photo_defaults.jpg')
            {
                if($image != '')
                {
                    $image_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/assets/images/'), $image_name);
                }
            }
            elseif($image_name =='user.png')
            {
                if($image != '')
                {
                    $image_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/assets/images/'), $image_name);
                }
            }
            else{

                if($image != '')
                {
                    $image_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/assets/images/'), $image_name);
                }
            }

            $datauser = [
                'id'          => $id,
                'name'         => $name,
                'firstname'     => $firstname,
                'rec_id'       => $rec_id,
                'email'        => $email,
                'telephone' => $phone,
                'status'       => $status,
                'role_name'    => $role_name,
                'avatar'       => $image_name,
            ];

            $activityLog = [
                'user_name'    => $name,
                'email'        => $email,
                'telephone' => $phone,
                'status'       => $status,
                'role_name'    => $role_name,
                'modify_user'  => 'Mise à jour des information sur l\'adresse ' .$email,
                'date_time'    => $todayDate,
            ];

             DB::table('user_activity_logs')->insert($activityLog);
             User::where('id',$request->id)->update($datauser);
             DB::commit();
            Toastr::success('User updated successfully :)','Success');
            return redirect()->route('userManagement');

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('User update fail :)','Error');
            return redirect()->back();

        }
    }
    // delete
    public function delete(Request $request)
    {
        DB::beginTransaction();
        try{

            $user = Auth::User();
            Session::put('user', $user);
            $roles = new activityLog();
            $dt       = Carbon::now();
            $description = "Suppression de l'utilisateur ".$user->firstname. " " .$user->name;
            $roles->date_time = $dt->toDayDateTimeString();
            $activityLog = [
                'name'    => $user->name,
                'firstname'    => $user->firstname,
                'telephone'        => $user->telephone,
                'email'        => $user->email,
                'description' => $description,
                'date_time'       => $roles->date_time,
            ];

            DB::table('activity_logs')->insert($activityLog);


                   User::destroy($request->id);
            //    }else{
            //       User::destroy($request->id);
            //       unlink('assets/images/'.$request->avatar);
            //    }
            DB::commit();
            Toastr::success('Utilisateur supprimé avec succès :)','Success');
            return redirect()->route('userManagement');

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Echec de suppression :)','Error');
            return redirect()->back();
        }
        // DB::beginTransaction();
        // try{
        //     $roles->firstname = $user->firstname;
        //     $roles->name = $user->name;
        //     $roles->email = $user->email;
        //     $roles->telephone = $user->telephone;
        //     $roles->description = "Suppression de l'utilisateur".$user->firstname. " " .$user->name;
        //     $dt       = Carbon::now();
        //     $roles->date_time = $dt->toDayDateTimeString();
        //     $roles->save();

        //     if($request->avatar =='photo_defaults.jpg'){
        //            User::destroy($request->id);
        //        }else{
        //           User::destroy($request->id);
        //           unlink('assets/images/'.$request->avatar);
        //        }
        //       DB::commit();

        //       Toastr::success('User deleted successfully :)','Success');
        //       return redirect()->route('userManagement');

        //  }catch(\Exception $e){
        //       DB::rollback();
        //       Toastr::error('User deleted fail :)','Error');
        //       return redirect()->back();
        //  }
    }

    // view change password
    public function changePasswordView()
    {
        return view('settings.changepassword');
    }

    // change password in db
    public function changePasswordDB(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        DB::commit();
        Toastr::success('User change successfully :)','Success');
        return redirect()->intended('home');
    }
}









