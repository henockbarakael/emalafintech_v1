<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
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

    }

    public function mobilemoney()
    {
        // $mobilemoney= DB::table('mobilemoney')->get();
        $mobilemoney= DB::table('transactions')->where('operator','Mobile money')->get();
        return view('admin.mobilemoney.all',compact(['mobilemoney']));
    }

    public function all()
    {
        $transaction= DB::table('transactions')->get();
        return view('admin.transaction.all',compact(['transaction']));
    }
    public function emala()
    {
        // $emala= DB::table('journal')->where('type_journal','1')->get();
        $emala= DB::table('transactions')->where('operator','Emala')->get();
        return view('admin.emala.all',compact(['emala']));
    }
    public function retrait()
    {
        $retrait= DB::table('journal')->where('type_journal','2')->get();
        return view('admin.retrait.all',compact(['retrait']));
    }
    public function emprunt()
    {
        $emprunt= DB::table('journal')->where('type_journal','3')->get();
        return view('admin.emprunt.all',compact(['emprunt']));
    }
    public function moneygram()
    {
        // $moneygram= DB::table('moneygram')->get();
        $moneygram= DB::table('transactions')->where('operator','Moneygram')->get();
        return view('admin.moneygram.all',compact(['moneygram']));
    }
    public function paytv()
    {
        $paytv= DB::table('reabonnement')->get();
        return view('admin.paytv.all',compact(['paytv']));
    }
    public function solde()
    {
        $solde= DB::table('agences')->get();
        return view('admin.solde.all',compact(['solde']));
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
