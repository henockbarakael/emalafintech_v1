<?php

namespace App\Http\Controllers\banking;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProfileInformation;
use App\Models\User;
use Twilio\Rest\Client;
use Session;
use Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;

class compte_caisse extends Controller
{
    /**
     * Afficher le formulaire de création de comptes
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectPage()
    {
        $agences = DB::table('agences')
        ->join('gerants', 'gerants.agence_id', '=', 'agences.id')
        ->select('agences.code_a','agences.id','agences.commune_a')->get();
        return view('banking.compte.form',compact(['agences']));
    }

    /**
     * Création de compte caisse
     *
     * @return \Illuminate\Http\Response
     */
    public function createCompte(Request $request)
    {
        DB::beginTransaction();
        try {
            function code($length = 5) {
                $characters = '0123456789';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }

            //$code = random_int(100000, 999999);

            $dt       = Carbon::now();

            // Par défaut, un compte est creé avec un solde intitial en $ et cdf
            //dd($receiverNumber);
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_TOKEN");
        $twilio_number = getenv("TWILIO_FROM");
        $receiverNumber = $request->phone;
        $code = random_int(100000, 999999);
        $link_address="https:/dashboard.emalafintech.net";
        $message = "Bonjour ".$request->firstname." ".$request->name.", "."Nous vous notifions de la création de votre compte dashboard.emalafintech.net en tant que Caissier.\n\nE-mail:.$request->email\nMot de passe est: ".$code;

        $client = new Client($account_sid, $auth_token);
        $client->messages->create($receiverNumber, [
            'from' => $twilio_number,
            'body' => $message]);

            $fullname = $request->firstname." ".$request->name;
            $email = $request->email;
            $phone = $request->phone;
            $code = code();
            $status = $request->status;
            $agences = DB::table('agences')
            ->join('gerants', 'gerants.agence_id', '=', 'agences.id')
            ->select('agences.code_a','agences.id','agences.commune_a')->get();
            foreach ($agences as $agence) {
                $agence_id = $agence->id;
            }

            $password = random_int(100000, 999999);
            $dt       = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();
            $data =[
                [
                    'compte_id'    => $code,
                    'a_fullname'    => $fullname,
                    'a_email'    => $email,
                    'a_phone'    => $phone,
                    'a_password'    => $password,
                    'debit'   => 0,
                    'credit'   => 0,
                    'solde'   => 0,
                    'currency'   => "USD",
                    'agence_id'   => $agence_id,
                    'status'   => $status,
                    'created_at'   => $dt,
                    'updated_at'   => $dt
                ],
                [
                    'compte_id'    => $code,
                    'a_fullname'    => $fullname,
                    'a_email'    => $email,
                    'a_phone'    => $phone,
                    'a_password'    => $password,
                    'debit'   => 0,
                    'credit'   => 0,
                    'solde'   => 0,
                    'currency'   => "CDF",
                    'agence_id'   => $agence_id,
                    'status'   => $status,
                    'created_at'   => $dt,
                    'updated_at'   => $dt,
                ]
            ];

            $utilisateurs =[
                'name'    => $request->name,
                'firstname'    => $request->firstname,
                'email'   => $request->email,
                'telephone'   => $request->phone,
                'join_date'    => $todayDate,
                'avatar'   => "user.png",
                'role_name'   => "Caissier",
                'password'   => FacadesHash::make($password),
                'status'   => "Actif",
           ];

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

            // $information = ProfileInformation::updateOrCreate(['rec_id' => $request->rec_id]);
            // $information->name         = $request->name;
            // $information->$request->$request->id       = $request->rec_id;
            // $information->email        = $request->email;
            // $information->birth_date   = $request->birthDate;
            // $information->gender       = $request->gender;
            // $information->address      = $request->address;
            // $information->state        = $request->state;
            // $information->country      = $request->country;
            // $information->pin_code     = $request->pin_code;
            // $information->phone_number = $request->phone_number;
            // $information->department   = $request->department;
            // $information->designation  = $request->designation;
            // $information->reports_to   = $request->reports_to;
            // $information->save();
           //var_dump($status);
            DB::table('compte_caisses')->insert($data);
            DB::table('users')->insert($utilisateurs);
            DB::commit();
            Toastr::success('Compte créé avec succès :)','Success');
            return redirect()->route('management.caissier.liste');

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Echec de création du compte :)','Error');
            return redirect()->back();
        }
    }

}
