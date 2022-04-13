<?php

namespace App\Http\Controllers;

use App\Models\agence;
use App\Models\wallet;
use Illuminate\Support\Facades\DB;
Use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class walletController extends Controller
{
    public function soldeWallet()
    {
        $emala = DB::table('wallets')->where('balance_for', 'Emala')->first();
        $mobilemoney = DB::table('wallets')->where('balance_for', 'Mobile money')->first();
        $moneygram = DB::table('wallets')->where('balance_for', 'Moneygram')->first();
        $dataAll = DB::table('wallets')->get();
        return view('admin.solde.wallet',compact(['dataAll','emala','mobilemoney','moneygram']));
    }

        // approvisionnement des agences
        public function approWallet($id)
        {
            $dt = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();
            $wallet = DB::table('wallets')->where('id',$id)->get();
            return view('configuration.approvisionnement.wallet',compact('wallet','todayDate'));
        }
        public function approvisionner(Request $request)
        {
            $wallet = DB::table('wallets')->where('id',$request->id)->first();


            if (!empty($request->amount) && $request->currency=="CDF") {
                $update = [
                    'balance_cdf' => $wallet->balance_cdf + $request->amount,
                ];
            }
            elseif (!empty($request->amount) && $request->currency=="USD") {
                $update = [
                    'balance_usd' => $wallet->balance_usd + $request->amount,
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

            wallet::where('id',$request->id)->update($update);
            DB::commit();
            Toastr::success('Updated Training Type successfully :)','Success');
            return redirect()->route('solde/wallet');
        }
}
