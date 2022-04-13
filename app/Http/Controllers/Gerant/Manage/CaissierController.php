<?php

namespace App\Http\Controllers\Gerant\Manage;

use App\Http\Controllers\Controller;
use App\Models\agence;
use App\Models\banque;
use App\Models\caisse;
use Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\caissier;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaissierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCaissier(Request $request)
    {
        $request->validate([
            'nom'      => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:15',
            'email'     => 'required|string|email|max:255',
            'sexe' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        function randString($length = 5) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = 'CA.';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $dt       = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        try {

        //     $caisse = DB::table('caisses')
        // ->join('caissiers', 'caissiers.caisse_id', '=', 'caisses.id')
        // ->select('caisse_id')
        // ->first();

            $code = random_int(100000, 999999);


            $data =[
                'code_caissier' => randString(),
                'prenom'      => $request->prenom,
                'nom'      => $request->nom,
                'phone'      => $request->telephone,
                'email'    => $request->email,
                'adresse' => $request->adresse,
                'avatar' => "caissier.png",
                'caisse_id' => $request->id_caisse,
                'sexe'     => $request->sexe,
                'password'=>$code,
                'hash'   => Hash::make($code),

           ];

           $utilisateurs =[
            'name'    => $request->nom,
            'firstname'    => $request->prenom,
            'email'   => $request->email,
            'telephone'   => $request->telephone,
            'sexe'   => $request->sexe,
            'join_date'    => $todayDate,
            'avatar'   => "user.png",
            'role_name'   => "Caissier",
            'password'   => Hash::make($code),
            'status'   => $request->status,
       ];


           //dd($data);
           DB::table('caissiers')->insert($data);
           DB::table('users')->insert($utilisateurs);
           DB::commit();
            Toastr::success('Create new holiday successfully :)','Success');
            return redirect()->route('management.caissier.form');

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Holiday fail :)','Error');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $code_caisse = DB::table('caisses')->select('code_c','id')->get();
        return view('dashboard.gerant.management.form', compact('code_caisse'));
    }
    public function caisse()
    {
        return view('dashboard.gerant.management.caisse_form');
    }



    public function createCaisse(Request $request)
    {
        // $request->validate([
        //     'solde_cdf'      => 'required|string|max:255',
        //     'solde_usd' => 'required|string|max:255',
        // ]);

        DB::beginTransaction();
        try {
            function code($length = 5) {
                $characters = '0123456789';
                $charactersLength = strlen($characters);
                $randomString = 'C';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
            $gerant = DB::table('gerants')
                    ->join('users', 'users.email', '=', 'gerants.email')
                    ->select('gerants.id')
                    ->first();
            $dt       = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();

            $data =[
                'code_c'    => code(),
                'usd_c'    => 0,
                'cdf_c'   => 0,
                'gerant_id'   => $gerant->id,
                'created_at'   => $dt,
                'updated_at'   => $dt,
           ];

            DB::table('caisses')->insert($data);
            DB::commit();
            Toastr::success('Caisse créée avec succès :)','Success');
            return redirect()->route('management.caisse.liste');

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Echec de création :)','Error');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $caissiers= DB::table('compte_caisses')->get();
        $compte = DB::table('compte_caisses')
        ->join('agences', 'agences.id', '=', 'compte_caisses.agence_id')
        ->join('gerants', 'gerants.agence_id', '=', 'agences.id')
        ->select('compte_caisses.*')
        ->get();
        $gerants = DB::table('compte_caisses')
        ->join('agences', 'agences.id', '=', 'compte_caisses.agence_id')
        ->join('gerants', 'gerants.agence_id', '=', 'agences.id')
        ->select('gerants.*','agences.*')
        ->first();
        //dd($compte);
        return view('dashboard.gerant.management.liste',compact(['compte','gerants']));
    }

    public function caisseshow()
    {
        $caisses= DB::table('caisses')->get();
        return view('dashboard.gerant.management.caisse-liste',compact(['caisses']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCaissier(Request $request)
    {
        DB::beginTransaction();
        try{

            caissier::destroy($request->id);
            DB::commit();
            Toastr::success('Agence supprimée avec succès :)','Success');
            return redirect()->route('dashboard.gerant.management.liste');

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Echec de suppression :)','Error');
            return redirect()->back();
        }
    }

    public function solde()
    {
        // $solde = DB::table('caisses')
        // ->join('gerants', 'gerants.id', '=', 'caisses.gerant_id')
        // ->join('agences', 'agences.id', '=', 'gerants.agence_id')
        // ->join('caissiers', 'caissiers.caisse_id', '=', 'caisses.id')
        // ->select('caissiers.prenom','caissiers.nom','agences.*','caisses.usd_c','caisses.cdf_c','caisses.code_c')
        // ->get();

        $solde = DB::table('compte_caisses')
        ->join('agences', 'agences.id', '=', 'compte_caisses.agence_id')
        // ->join('gerants', 'gerants.agence_id', '=', 'agences.id')
        ->select('compte_caisses.*')
        ->get();

        $sum_credit_usd = DB::table('compte_caisses')
        ->join('agences', 'agences.id', '=', 'compte_caisses.agence_id')
        ->join('gerants', 'gerants.agence_id', '=', 'agences.id')
        ->select('compte_caisses.*')
        ->where('compte_caisses.currency','=','USD')
        ->sum('compte_caisses.credit');

        $sum_credit_cdf = DB::table('compte_caisses')
        ->join('agences', 'agences.id', '=', 'compte_caisses.agence_id')
        ->join('gerants', 'gerants.agence_id', '=', 'agences.id')
        ->select('compte_caisses.*')
        ->where('compte_caisses.currency','=','CDF')
        ->sum('compte_caisses.credit');

        $sum_debit_usd = DB::table('compte_caisses')
        ->join('agences', 'agences.id', '=', 'compte_caisses.agence_id')
        ->join('gerants', 'gerants.agence_id', '=', 'agences.id')
        ->select('compte_caisses.*')
        ->where('compte_caisses.currency','=','USD')
        ->sum('compte_caisses.debit');

        $sum_debit_cdf = DB::table('compte_caisses')
        ->join('agences', 'agences.id', '=', 'compte_caisses.agence_id')
        ->join('gerants', 'gerants.agence_id', '=', 'agences.id')
        ->select('compte_caisses.*')
        ->where('compte_caisses.currency','=','CDF')
        ->sum('compte_caisses.debit');


        return view('dashboard.gerant.management.solde',compact(['solde','sum_credit_usd','sum_credit_cdf','sum_debit_usd','sum_debit_cdf']));
    }
}
