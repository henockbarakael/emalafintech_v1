<?php

namespace App\Http\Controllers\Caissier\Manage;

use App\Http\Controllers\Controller;
use App\Models\activityLog;
use App\Models\caissier;
use App\Models\chef_agence;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use App\Models\User;
use App\Models\Employee;
use App\Models\Form;
use App\Models\personnal_information;
use App\Models\ProfileInformation;
use App\Models\userActivityLog;
use App\Rules\MatchOldPassword;
use Carbon\Carbon;
use Session;
use Auth;
use Hash;

class CaissierController extends Controller
{
    // profile user
    public function profile()
    {
        $user = Auth::User();

        Session::put('user', $user);
        $user=Session::get('user');
        $profile = $user->rec_id;

        $user = DB::table('users')->get();
        $employees = DB::table('profile_information')->where('rec_id',$profile)->first();
        $gerants = DB::table('gerants')
                    ->join('agences', 'agences.id', '=', 'gerants.agence_id')
                    ->join('compte_caisses', 'compte_caisses.agence_id', '=', 'agences.id')
                    ->join('users', 'users.email', '=', 'gerants.email')
                    ->select('gerants.*', 'agences.*','users.*')
                    ->first();
        $avatars = $gerants->avatar;

        if(!empty($employees))
        {
            $rec_id = $employees->rec_id;
            $information = DB::table('profile_information')->where('rec_id',$profile)->first();
            return view('usermanagement.profile_caissier',compact('information','user','gerants','avatars'));
            //dd($information);

        }else{

            return view('usermanagement.profile_caissier',compact('user','gerants','avatars'));
            //dd("information vide");
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
                    // 'rec_id' => $request->rec_id,
                    // 'name'   => $request->name,
                    'avatar' => $image_name,
                ];
                User::where('rec_id',$request->rec_id)->update($update);
            }
            $gerants = DB::table('gerants')
                    ->join('agences', 'agences.id', '=', 'gerants.agence_id')
                    ->join('compte_caisses', 'compte_caisses.agence_id', '=', 'agences.id')
                    ->select('gerants.*', 'agences.*')
                    ->first();

            $information = ProfileInformation::updateOrCreate(['rec_id' => $request->rec_id]);
            $information->name         = $request->name;
            $information->firstname    = $request->firstname;
            $information->email        = $request->email;
            $information->birth_date   = $request->birthDate;
            $information->gender       = $request->gender;
            $information->address      = $request->address;
            $information->state        = $request->state;
            $information->country      = $request->country;
            $information->pin_code     = $request->pin_code;
            $information->phone_number = $request->phone_number;
            $information->department   = "Comptabilité";
            $information->reports_to   = $gerants->prenom." ".$gerants->nom;
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

    public function personnalInformation(Request $request){
        try {
            $personnal = personnal_information::updateOrCreate(['rec_id' => $request->rec_id]);
            $personnal->emergency_fullname1=$request->emergency_fullname1;
            $personnal->emergency_fullname2=$request->emergency_fullname2;
            $personnal->emergency_phone1=$request->emergency_phone1;
            $personnal->emergency_phone2=$request->emergency_phone2;
            $personnal->relationship1=$request->relationship1;
            $personnal->relationship2=$request->relationship2;
            $personnal->card_id=$request->card_id;
            $personnal->card_exp_date=$request->card_exp_date;
            $personnal->nationality=$request->nationality;
            $personnal->marital_status=$request->marital_status;
            $personnal->no_children= $request->no_children;
            $personnal->save();
            DB::commit();
            Toastr::success('Profile Information successfully :)','Success');
            return redirect()->back();
        } catch (\Throwable $e) {
            DB::rollback();
            Toastr::error('Add Profile Information fail :)','Error');
            return redirect()->back();
        }


    }
}
