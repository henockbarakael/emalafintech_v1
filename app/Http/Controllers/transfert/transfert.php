<?php

namespace App\Http\Controllers\transfert;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class transfert extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function withdrawalForm()
    {
        $dt       = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        return view('dashboard.caissier.transfert.retraits.form', compact(['todayDate']));
    }
    public function printPDF($transaction_id)
    {
        $dt       = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        $transactions = DB::table('transactions')
            ->where('transaction_id',$transaction_id)
            ->first();
        return view('dashboard.caissier.transfert.retraits.invoice', compact(['dt','transactions']));
    }
    public function emalaWithdrawal(Request $request)
    {
        DB::beginTransaction();
        try {

            $dt      = Carbon::now();
            $comptes = DB::table('compte_caisses')
            ->join('users', 'users.email', '=', 'compte_caisses.a_email')
            ->select('compte_caisses.*')
            ->first();

            $transactions = DB::table('transactions')
            ->where('transaction_id',$request->transaction_id)
            ->first();

            $compte_caisses = DB::table('compte_caisses')
            ->select('debit')
            ->where('compte_id',$comptes->compte_id)
            ->where('currency',$request->currency)
            ->first();

            $commission = 0;
            $fullname = $request->firstname." ".$request->name." ".$request->middlename;

            if (!empty($transactions)) {
                if ($transactions->transaction_id == $request->transaction_id && $transactions->amount == $request->amount) {
                    $solde_debit = $compte_caisses->debit - $request->amount;
                    $solde = [
                        'debit'=>$solde_debit,
                    ];
                    $comment = "Transaction trouvée, le client peut retirer l'argent";
                    $data =[
                        'receiver_fullname'=>$fullname,
                        'receiver_phone'=>$request->phone,
                        'sender_phone'=>$transactions->sender_phone,
                        'amount'=>$transactions->amount,
                        'transaction_type'=>"Retrait",
                        'operator'=>"Emala",
                        'transaction_id'=>$transactions->transaction_id,
                        'details'=>$comment,
                        'agent_id'=>$comptes->compte_id,
                        'commission'=>$commission,
                        'created_at'   => $dt,
                        'updated_at'   => $dt
                    ];
                DB::table('retraits')->insert($data);
                DB::table('compte_caisses')
                ->where('compte_id',$comptes->compte_id)
                ->where('currency',$request->currency)
                ->update($solde);
                DB::commit();
                Toastr::success($comment,'Success');
                return view('dashboard.caissier.transfert.retraits.list', compact(['dt','transactions','comptes']));
                }
                elseif ($transactions->transaction_id == $request->transaction_id && $transactions->amount != $request->amount) {
                    $comment = "Impossible de faire le retrait, le montant specifié ne correspond pas.";
                    Toastr::success($comment,'Error');
                    return redirect()->back();
                }
                elseif ($transactions->transaction_id != $request->transaction_id && $transactions->amount == $request->amount) {
                    $comment = "Impossible de faire le retrait, la reférence specifiée ne correspond pas.";
                    Toastr::success($comment,'Error');
                    return redirect()->back();
                }
                elseif ($transactions->transaction_id != $request->transaction_id && $transactions->amount != $request->amount) {
                    $comment = "Impossible de faire le retrait, aucne information fournie n'est correcte";
                    Toastr::success($comment,'Error');
                    return redirect()->back();
                }

            }
            else {
                Toastr::error('Retrait impossible :)','Error');
                return redirect()->back();
            }

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Echec de retrait','Error');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendingForm()
    {
        $dt       = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        return view('dashboard.caissier.transfert.envois.form', compact(['todayDate']));
    }
    // Envoi d'argent | Le caissier recupère l'argent et le frais d'envoie
    // auprès du client.
    // Il fait un dépot dans la caisse (CREDIT)
    public function emalaSending(Request $request)
    {
        DB::beginTransaction();
        try {
            function code($length = 8) {
                $characters = '0123456789';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }

            $dt       = Carbon::now();

            $s_fullname = $request->firstname." ".$request->name;
            $d_fullname = $request->firstname." ".$request->name;
            $commission = ($request->amount * 2)/100;

            $comptes = DB::table('compte_caisses')
            ->join('users', 'users.email', '=', 'compte_caisses.a_email')
            ->select('compte_caisses.*')
            ->first();

            $compte_caisses = DB::table('compte_caisses')
            ->select('credit')
            ->where('compte_id',$comptes->compte_id)
            ->where('currency',$request->currency)
            ->first();


            $solde_credit = $compte_caisses->credit + $request->amount;

            $solde = [
                'credit'=>$solde_credit,
            ];

            $dt       = Carbon::now();
            $data =
                [
                    'sender_fullname'=>$s_fullname,
                    'sender_phone'=>$request->phone,
                    'sender_birthday'=>$request->birthday,
                    'sender_country'=>$request->country_sender,
                    'sender_address'=>$request->address,
                    'sender_card'=>$request->identity_card,
                    'sender_card_id'=>$request->id_number,
                    'amount'=>$request->amount,
                    'currency'=>$request->currency,
                    'transaction_type'=>"Transfert",
                    'operator'=>"Emala",
                    'transaction_id'=>code(),
                    'receiver_fullname'=>$d_fullname,
                    'receiver_phone'=>$request->d_phone,
                    'receiver_city'=>$request->d_city,
                    'receiver_country'=>$request->country_dest,
                    'details'=>$request->motif,
                    'agent_id'=>$comptes->compte_id,
                    'commission'=>$commission,
                    'created_at'   => $dt,
                    'updated_at'   => $dt
                ];

            DB::table('transactions')->insert($data);
            DB::table('compte_caisses')
            ->where('compte_id',$comptes->compte_id)
            ->where('currency',$request->currency)
            ->update($solde);
            DB::commit();
            Toastr::success('Compte créé avec succès :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Echec de création du compte :)','Error');
            return redirect()->back();
        }
    }

}
