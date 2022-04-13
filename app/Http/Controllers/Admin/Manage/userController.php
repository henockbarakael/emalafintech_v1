<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Http\Controllers\Controller;
use App\Models\agence;
use App\Models\caisse;
use App\Models\gerant;
use App\Models\User;
use App\Models\wallet;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Client;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listGerant()
    {
        $gerants = gerant::all();
        $agences = agence::all();
        $status_user = DB::table('user_types')->get();
        $data = DB::table('gerants')
        ->join('users', 'users.email', '=', 'gerants.email')
        ->join('agences', 'agences.id', '=', 'gerants.agence_id')
        ->select('gerants.*', 'users.user_status','agences.code_a')
        ->get();
        return view('admin.manage.gerant.liste',compact(['data','status_user','agences']));
    }

    public function listAdmin()
    {
        $admins = DB::table('users')->where('role_name','Admin')->get();
        $type = DB::table('user_types')->get();
        return view('admin.manage.admin.liste',compact(['admins','type']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGerant(Request $request)
    {
        $request->validate([
            'prenom'        => 'required|string|max:255',
            'nom'        => 'required|string|max:255',
            'phone'        => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'sexe'        => 'required|string|max:255',
            'status'        => 'required|string|max:255',
            'agence'        => 'required|string|max:255',
        ]);
       DB::beginTransaction();
       $id_agence = DB::table('agences')->where('code_a',$request->agence)->get();
       $dt = Carbon::now();
       $todayDate = $dt->toDayDateTimeString();
       function randString($length = 5) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = 'GER_';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

       try{
               foreach ($id_agence as $user) {
                $agence = $user->id;
            }
               $code = random_int(100000, 999999);

               $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_TOKEN");
        $twilio_number = getenv("TWILIO_FROM");
        $receiverNumber = $request->phone;
        $code = random_int(100000, 999999);
        $link_address="https:/dashboard.emalafintech.net";
        $message = "Bonjour ".$request->prenom." ".$request->nom.", "."Nous vous notifions de la création de votre compte dashboard.emalafintech.net en tant que Chef d'agence.\n\nE-mail:.$request->email\nMot de passe est: ".$code;

        $client = new Client($account_sid, $auth_token);
        $client->messages->create($receiverNumber, [
            'from' => $twilio_number,
            'body' => $message]);
               $donnees = [
                   'code_g'=>randString(),
                   'prenom'=>$request->prenom,
                   'nom'=>$request->nom,
                   'phone'=>$request->phone,
                   'email'=> $request->email,
                   'sexe'=> $request->sexe,
                   'avatar'=>'gerant.png',
                   'agence_id'=>$agence,
                   'password'=>$code,
                   'hash'   => Hash::make($code),
               ];
               DB::table('gerants')->insert($donnees);

               $utilisateurs =[
                    'name'    => $request->nom,
                    'firstname'    => $request->prenom,
                    'email'   => $request->email,
                    'telephone'   => $request->phone,
                    'sexe'   => $request->sexe,
                    'join_date'    => $todayDate,
                    'avatar'   => "user.png",
                    'role_name'   => "Gérant",
                    'password'   => Hash::make($code),
                    'status'   => $request->status,
               ];
               DB::table('users')->insert($utilisateurs);
               DB::commit();
               Toastr::success('Gérant ajouté avec succès :)','Success');
               return redirect()->route('gerant.list');

        }catch(\Exception $e){
              DB::rollback();
              Toastr::error('Une erreur est survenue, veuillez reprendre ou contacter le webmaster :)','Error');
              return redirect()->back();
       }
    }


    public function createAdmin(Request $request)
    {

        $dt = Carbon::now();
       $todayDate = $dt->toDayDateTimeString();

        $request->validate([
            'nom'        => 'required|string|max:255',
            'phone'      => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'prenom'     => 'required|string|max:255',
            'status'    => 'required|string|max:255',
            'sexe'      => 'required|string|max:255',
        ]);
       DB::beginTransaction();

       try{

        //dd($receiverNumber);
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_TOKEN");
        $twilio_number = getenv("TWILIO_FROM");
        $receiverNumber = $request->phone;
        $code = random_int(100000, 999999);
        $link_address="https:/dashboard.emalafintech.net";
        $message = "Bonjour ".$request->prenom." ".$request->nom.", "."Nous vous notifions de la création de votre compte dashboard.emalafintech.net en tant qu'administrateur.\n\nE-mail:.$request->email\nMot de passe est: ".$code;

        $client = new Client($account_sid, $auth_token);
        $client->messages->create($receiverNumber, [
            'from' => $twilio_number,
            'body' => $message]);


        $utilisateurs =[
            'name'    => $request->nom,
            'firstname'    => $request->prenom,
            'email'   => $request->email,
            'telephone'   => $request->phone,
            'sexe'   => $request->sexe,
            'join_date'    => $todayDate,
            'avatar'   => "user.png",
            'role_name'   => "Admin",
            'password'   => Hash::make($code),
            'status'   => $request->status,
       ];

                DB::table('users')->insert($utilisateurs);
               DB::commit();
               Toastr::success('Administrateur créée avec succès :)','Success');
               return redirect()->route('admin.list');

        }catch(\Exception $e){
             DB::rollback();
             Toastr::error('Opération échouée :)','Error');
             return redirect()->back();
       }
    }

    public function updateAdmin(Request $request)
    {
        DB::beginTransaction();
        try{
            $update = [
                'id'      => $request->id,
                'name'      => $request->nom,
                'firstname'    => $request->prenom,
                'email'  => $request->email,
                'telephone'   => $request->telephone,
                'sexe'      => $request->sexe,
                'status'     => $request->status,
            ];
// dd($update);

            User::where('id',$request->id)->update($update);
            DB::commit();
            Toastr::success('Admin updated successfully :)','Success');
            return redirect()->back();

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Admin update fail :)','Error');
            return redirect()->back();
        }
    }


    // approvisionnement des agences
    public function approAgence($numero_a)
    {
        $dt = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        $agence = DB::table('agences')->where('numero_a',$numero_a)->get();
        return view('configuration.approvisionnement.index',compact('agence','todayDate'));
    }
    public function approvisionner(Request $request)
    {
        $agence = DB::table('agences')->where('code_a',$request->code_a)->first();
        $wallet = DB::table('wallets')->where('balance_for',"Emala")->first();


        if (!empty($request->amount) && $request->currency=="CDF") {
            $update = [
                'solde_cdf' => $agence->solde_cdf + $request->amount,
            ];
            $data = [
                'balance_cdf' => $wallet->balance_cdf - $request->amount,
            ];
        }
        elseif (!empty($request->amount) && $request->currency=="USD") {
            $update = [
                'solde_usd' => $agence->solde_usd + $request->amount,
            ];
            $data = [
                'balance_usd' => $wallet->balance_usd - $request->amount,
            ];
        }
        elseif (empty($request->amount) && empty($request->currency)) {
            Toastr::error('Aucun montant n\'a été specifié','Error');
            return redirect()->back();
        }
        elseif (empty($request->amount) || empty($request->currency)) {
            Toastr::error('Aucun montant n\'a été specifié','Error');
            return redirect()->back();
        }

        agence::where('code_a',$request->code_a)->update($update);
        wallet::where('balance_for','Emala')->update($data);
        DB::commit();
        Toastr::success('Updated Training Type successfully :)','Success');
        return redirect()->route('solde/agences');
    }

    // approvisionnement des caisses
    public function approCaisse($compte_id)
    {
        $dt = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        $caisse = DB::table('compte_caisses')->where('compte_id',$compte_id)->first();
        return view('configuration.approvisionnement.caisse',compact('caisse','todayDate'));
    }

    public function approCaisseDone(Request $request)
    {
        $agence = DB::table('agences')
                    ->join('compte_caisses', 'compte_caisses.agence_id', '=', 'agences.id')
                    ->select('agences.*','compte_caisses.compte_id')->first();
                 // dd($agence);

        if (empty($request->amount) && !empty($request->amount)) {
            $new_solde_agence_cdf = $agence->solde_cdf - $request->amount;
            $update_agence = [
                'solde_cdf' => $new_solde_agence_cdf,
            ];
            $update = [
                'cdf_c' => $request->amount,
            ];
        }
        elseif (!empty($request->amount) && empty($request->amount)) {
            $new_solde_agence_usd = $agence->solde_usd - $request->amount;
            $update_agence = [
                'solde_usd' => $new_solde_agence_usd,
            ];
            $update = [
                'usd_c' => $request->amount,
            ];
        }
        elseif (!empty($request->amount) && !empty($request->amount)) {
            $new_solde_agence_cdf = $agence->solde_cdf - $request->amount;
            $new_solde_agence_usd = $agence->solde_usd - $request->amount;
            $update_agence = [
                'solde_usd' => $new_solde_agence_usd,
                'solde_cdf' => $new_solde_agence_cdf,
            ];
            $update = [
                'usd_c' => $request->amount,
                'cdf_c' => $request->amount,
            ];
        }
        elseif (empty($request->amount) && empty($request->amount)) {
            Toastr::error('Aucun montant n\'a été specifié','Error');
            return redirect()->back();

        }
// var_dump($update );
// var_dump($update_agence );
        // agence::where('code_a',$agence->code_a)->update($update_agence);
        caisse::where('code_c',$request->code_c)->update($update);
        DB::commit();
        Toastr::success('Updated Training Type successfully :)','Success');
        return redirect()->back();

}


}
