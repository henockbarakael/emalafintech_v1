<?php

namespace App\Http\Controllers\agence;

use App\Http\Controllers\Controller;
use App\Models\agence;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use DB;
use App\Http\Controllers\agence\Session;
use App\Models\User;
use App\Models\module_permission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Session as FacadesSession;

class agenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listeAgence()
    {
        $agences = agence::all();
        $datas = DB::table('gerants')
        ->join('agences', 'agences.id', '=', 'gerants.agence_id')
        ->select('gerants.*', 'agences.*')
        ->get();
        return view('configuration.agences.all',compact(['agences', 'datas']));
    }

    public function soldeAgence()
    {
        $agences = agence::all();
        $datas = DB::table('gerants')
        ->join('agences', 'agences.id', '=', 'gerants.agence_id')
        ->select('gerants.*', 'agences.*')
        ->get();
        return view('admin.solde.agence',compact(['agences', 'datas']));
    }



    public function pageAgence($code)
    {
        //$code = FacadesSession::get('code');
        //Session::get('code');
        $resulta = DB::table('agences')->where('code', $code)->get();

        $usd= DB::table('soldes')->where('code', $code)->sum('solde_usd');
        $cdf= DB::table('soldes')->where('code', $code)->sum('solde_cdf');
        $ouverture= DB::table('soldes')->where('code', $code)->sum('ouverture');
        $cloture= DB::table('soldes')->where('code', $code)->sum('cloture');

       return view('configuration.agences.page',compact(['resulta','usd','cdf','ouverture','cloture']));
    }

    // save data agence
    public function addAgence(Request $request)
    {
         $request->validate([

             'phone'        => 'required|string|max:255',
             'province'        => 'required|string|max:255',
             'commune'        => 'required|string|max:255',
             'ville'        => 'required|string|max:255',
         ]);

         function randString($length = 5) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = 'AGC_';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        DB::beginTransaction();
        try{

                $agences = new agence();


                $agences->code_a   = randString();
                $agences->numero_a   = $request->phone;
                $agences->commune_a   = $request->commune;
                $agences->province_a   = $request->province;
                $agences->ville_a   = $request->ville;
                $agences->solde_usd   = 0;
                $agences->solde_cdf  = 0;
                $agences->save();
                FacadesDB::commit();
                Toastr::success('Agence créée avec succès :)','Success');
                return redirect()->route('all/agences');

         }catch(\Exception $e){
              DB::rollback();
              Toastr::error('Ajout d\'une nouvelle agence echouée :)','Error');
              return redirect()->back();
        }

    }
    // delete record
    public function deleteAgence(Request $request)
    {
        DB::beginTransaction();
        try{

            agence::destroy($request->id);
            DB::commit();
            Toastr::success('Agence supprimée avec succès :)','Success');
            return redirect()->route('solde/agences');

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Echec de suppression :)','Error');
            return redirect()->back();
        }
    }
    public function updateAgence( Request $request)
    {
        DB::beginTransaction();
        try{

            // update table role_types
            $updateAgence= [
                'id'=>$request->id,
            ];

            agence::where('id',$request->id)->update($updateAgence);

            DB::commit();
            Toastr::success('Mise à jour du rôle avec succès :)','Success');
            return redirect()->route('all/agences');
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('échec de la mise à jour du rôle :)','Error');
            return redirect()->back();
        }
    }
}
