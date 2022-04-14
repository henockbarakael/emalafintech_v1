<?php

namespace App\Http\Controllers;

use App\Models\activityLog;
use App\Models\bank_information;
use App\Models\caissier;
use App\Models\emergency_information;
use App\Models\family_information;
use App\Models\gerant;
use App\Models\personnal_information;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use App\Models\User;
use Twilio\Rest\Client;
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
            $result      = DB::table('users')->orderBy('id','desc')->get();
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
        $activityLog = DB::table('user_activity_logs')->orderBy('id','desc')->get();
        return view('usermanagement.user_activity_log',compact('activityLog'));
    }
    // activity log
    public function activityLogInLogOut()
    {
        $activityLog = DB::table('activity_logs')->orderBy('id','desc')->get();
        return view('usermanagement.activity_log',compact('activityLog'));
    }
    // profile user
    public function profile()
    {
        $user = Auth::User();
        Session::put('user', $user);
        $user=Session::get('user');
        $profile = $user->rec_id;
        $user = DB::table('users')->orderBy('id','desc')->get();
        $employees = DB::table('profile_information')->where('rec_id',$profile)->first();
        if(empty($employees))
        {
            $information = DB::table('profile_information')->where('rec_id',$profile)->first();
            $personnal_information = DB::table('personnal_informations')->where('rec_id',$profile)->first();
            $bank_information = DB::table('bank_informations')->where('rec_id',$profile)->first();
            $family_information = DB::table('family_informations')->where('rec_id',$profile)->get();
            return view('usermanagement.profile_user',compact('family_information','bank_information','information','user','personnal_information'));

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
            $information->phone   = $request->birthDate;
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

            $dt         = Carbon::now();
            $todayDate  = $dt->toDayDateTimeString();
            $user = Auth::User();
            $name = $user->name;
            $email= $user->email;
            $role_name= $user->role_name;
            $activityLog = [
                'user_name'    => $name,
                'email'        => $email,
                'role_name'    => $role_name,
                'modify_user'  => $name.' a modifié les informations sur son profil',
                'date_time'    => $todayDate,
            ];

            DB::table('user_activity_logs')->insert($activityLog);
            DB::commit();
            Toastr::success('Profile Information successfully :)','Success');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Add Profile Information fail :)','Error');
            return redirect()->back();
        }
    }
    // save family information
    public function familyInformation(Request $request)
    {
        try{
            $information = family_information::updateOrCreate(['rec_id' => $request->rec_id]);
            $information->$request->$request->id       = $request->rec_id;
            $information->fullname        = $request->fullname;
            $information->phone   = $request->phone;
            $information->relationship       = $request->relationship;
            $information->save();

            $dt         = Carbon::now();
            $todayDate  = $dt->toDayDateTimeString();
            $user = Auth::User();
            $name = $user->name;
            $email= $user->email;
            $role_name= $user->role_name;
            $activityLog = [
                'user_name'    => $name,
                'email'        => $email,
                'role_name'    => $role_name,
                'modify_user'  => $name.' a ajouté les informations sur sa famille',
                'date_time'    => $todayDate,
            ];

            DB::table('user_activity_logs')->insert($activityLog);
            DB::commit();
            Toastr::success('Information ajoutée avec succès :)','Success');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Une erreur est survenue lors de l\'enregistrement des informations :)','Error');
            return redirect()->back();
        }
    }
    // save bank information
    public function bankInformation(Request $request)
    {
        try{
            $information = bank_information::updateOrCreate(['rec_id' => $request->rec_id]);
            $information->$request->$request->id       = $request->rec_id;
            $information->bank_name        = $request->bank_name;
            $information->account_no   = $request->account_no;
            $information->ifsc_code       = $request->ifsc_code;
            $information->pan_no       = $request->pan_no;
            $information->save();

            $dt         = Carbon::now();
            $todayDate  = $dt->toDayDateTimeString();
            $user = Auth::User();
            $name = $user->name;
            $email= $user->email;
            $role_name= $user->role_name;
            $activityLog = [
                'user_name'    => $name,
                'email'        => $email,
                'role_name'    => $role_name,
                'modify_user'  => $name.' a ajouté ses informations bancaire',
                'date_time'    => $todayDate,
            ];

            DB::table('user_activity_logs')->insert($activityLog);
            DB::commit();
            Toastr::success('Information ajoutée avec succès :)','Success');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Une erreur est survenue lors de l\'enregistrement des informations :)','Error');
            return redirect()->back();
        }
    }
    // save personnal information
    public function personnalInformation(Request $request)
    {
        try{
            $information = personnal_information::updateOrCreate(['rec_id' => $request->rec_id]);
            $information->$request->$request->id       = $request->rec_id;
            $information->card_type        = $request->card_type;
            $information->card_id   = $request->card_id;
            $information->card_exp_date       = $request->card_exp_date;
            $information->township       = $request->township;
            $information->city       = $request->city;
            $information->nationality       = $request->nationality;
            $information->marital_status       = $request->marital_status;
            $information->no_children       = $request->no_children;
            $information->save();

            $dt         = Carbon::now();
            $todayDate  = $dt->toDayDateTimeString();
            $user = Auth::User();
            $name = $user->name;
            $email= $user->email;
            $role_name= $user->role_name;
            $activityLog = [
                'user_name'    => $name,
                'email'        => $email,
                'role_name'    => $role_name,
                'modify_user'  => $name.' a ajouté mis à jour ses informations personnelles',
                'date_time'    => $todayDate,
            ];

            DB::table('user_activity_logs')->insert($activityLog);
            DB::commit();
            Toastr::success('Information ajoutée avec succès :)','Success');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Une erreur est survenue lors de l\'enregistrement des informations :)','Error');
            return redirect()->back();
        }
    }
    // save emergency information
    public function emergencyInformation(Request $request)
    {
        try{
            $information = emergency_information::updateOrCreate(['rec_id' => $request->rec_id]);
            $information->$request->$request->id       = $request->rec_id;
            $information->emergency_fullname1        = $request->emergency_fullname1;
            $information->emergency_fullname2   = $request->emergency_fullname2;
            $information->emergency_phone1       = $request->emergency_phone1;
            $information->emergency_phone2       = $request->emergency_phone2;
            $information->relationship1       = $request->relationship1;
            $information->relationship2       = $request->relationship2;
            $information->save();

            $dt         = Carbon::now();
            $todayDate  = $dt->toDayDateTimeString();
            $user = Auth::User();
            $name = $user->name;
            $email= $user->email;
            $role_name= $user->role_name;
            $activityLog = [
                'user_name'    => $name,
                'email'        => $email,
                'role_name'    => $role_name,
                'modify_user'  => $name.' a ajouté les contacts d\'urgence',
                'date_time'    => $todayDate,
            ];

            DB::table('user_activity_logs')->insert($activityLog);
            DB::commit();
            Toastr::success('Information ajoutée avec succès :)','Success');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Une erreur est survenue lors de l\'enregistrement des informations :)','Error');
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
            'telephone'     => 'required|string|max:15',
            'role_name' => 'required|string|max:255',
            'status'    => 'required|string|max:255',
            'sexe'    => 'required|string|max:255',
        ]);
        DB::beginTransaction();
        try {
                $dt         = Carbon::now();
                $todayDate  = $dt->toDayDateTimeString();
            // $image = time().'.'.$request->image->extension();
            // $request->image->move(public_path('assets/images'), $image);
                if ($request->sexe == "Masculin") {
                    $image = "boy.png";
                }else {
                        $image = "girl.png";
                }
                $user = new User;
                $code           = random_int(100000, 999999);
                $user->firstname    = $request->firstname;
                $user->name         = $request->name;
                $user->email        = $request->email;
                $user->join_date    = $todayDate;
                $user->telephone    = $request->telephone;
                $user->role_name    = $request->role_name;
                $user->status       = $request->status;
                $user->avatar       = $image;
                // $user->password     = Hash::make($request->password);
                $user->confirmation_code     = $code;
                $user->save();
                // Twilio send SMS for confirmation code
                $account_sid    = getenv("TWILIO_SID");
                $auth_token     = getenv("TWILIO_TOKEN");
                $twilio_number  = getenv("TWILIO_FROM");
                $receiverNumber = $request->telephone;
                $message        = "Bonjour ".$request->firstname." ".$request->name." votre code de confirmation est: ".$code;
                if (!$user->save()) {
                    DB::rollback();
                    Toastr::error('L\'utilisateur n\'a pas pu être enregistré!','Error');
                    return redirect()->back();
                }
                else {
                    DB::commit();
                    $client         = new Client($account_sid, $auth_token);
                    $client->messages->create($receiverNumber, [
                        'from' => $twilio_number,
                        'body' => $message]);
                    Toastr::success('Nouvel utilisateur enregistré avec succès!','Success');
                    return redirect()->route('userManagement');
                }
        } catch(\Exception $e){
            DB::rollback();
            Toastr::error('Opération échouée :)','Error');
            return redirect()->back();
      }
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
            gerant::create([
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









