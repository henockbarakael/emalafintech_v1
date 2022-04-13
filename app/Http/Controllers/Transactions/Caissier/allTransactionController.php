<?php

namespace App\Http\Controllers\Transactions\Caissier;

use App\Http\Controllers\Controller;
use App\Models\transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class allTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = transaction::all();
        return view('dashboard.caissier.all',compact(['transaction']));

    }

    public function mobilemoney()
    {
        $mobilemoney= DB::table('mobilemoney')->get();
        return view('dashboard.caissier.mobilemoney.all',compact(['mobilemoney']));
    }
    public function emala()
    {
        $emala= DB::table('journal')->get();
        return view('dashboard.caissier.emala.all',compact(['emala']));
    }
    public function retrait()
    {
        $retrait= DB::table('journal')->where('type_journal','2')->get();
        return view('dashboard.caissier.retrait.all',compact(['retrait']));
    }
    public function emprunt()
    {
        $emprunt= DB::table('journal')->where('type_journal','3')->get();
        return view('dashboard.caissier.emprunt.all',compact(['emprunt']));
    }
    public function moneygram()
    {
        $moneygram= DB::table('moneygram')->get();
        return view('dashboard.caissier.moneygram.all',compact(['moneygram']));
    }
    public function paytv()
    {
        $paytv= DB::table('reabonnement')->get();
        return view('dashboard.caissier.paytv.all',compact(['paytv']));
    }
    public function solde()
    {
        $solde= DB::table('agences')->get();
        return view('dashboard.caissier.solde.all',compact(['solde']));
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
