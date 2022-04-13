<?php

namespace App\Http\Controllers\approvisionnement;

use App\Http\Controllers\Controller;
use App\Models\agence;
use App\Models\approvisionnement;
use App\Models\solde;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;

class approvisionnementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appros = approvisionnement::all();
        $soldes = solde::all();
        return view('configuration.approvisionnement.all',compact(['appros','soldes']));
    }
// save data role
public function up(Request $request)
{
     DB::beginTransaction();
     try{
            $code = $request->code;
            $montant = $request->montant;
            $devise = $request->devise;
            // if ($devise == "CDF") {
            //     $amount_cdf = $montant;
            //     $amount_usd = 0;
            // }
            // elseif ($devise == "CDF")  {
            //     $amount_cdf = 0;
            //     $amount_usd = $montant;
            // }

            $soldes = new solde();
            $soldes->code   = $code ;
            $soldes->solde_usd   = $montant ;
            $soldes->solde_cdf   = $montant;
            $soldes->save();
            DB::commit();
            Toastr::success('Rôle crée avec succès :)','Success');
            return view('configuration.approvisionnement.all');

      }catch(\Exception $e){
           DB::rollback();
           Toastr::error('Ajout d\'un nouveau rôle echoué :)','Error');
           return redirect()->back();
    }
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
