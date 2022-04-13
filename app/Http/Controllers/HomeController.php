<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\DB as FacadesDB;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // main dashboard
    public function index()
    {
        $data = User::all();
        $user = DB::table('users')->count();
        $comcdf= DB::table('transactions')->select('commission')->where('currency','=','CDF')->sum('commission');
        $comusd= DB::table('transactions')->select('commission')->where('currency','=','USD')->sum('commission');
        $transaction = DB::table('journal')->count();
        $req = DB::table('transactions')
        ->select(DB::raw('count(*) as number, sum(amount) as amount, operator, currency, transaction_type'))
        ->groupBy('operator','transaction_type','currency')
        ->get();
        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('d-m-Y H:i:s');
        return view('dashboard.dashboard',compact(['todayDate','data', 'user', 'comcdf','comusd', 'transaction','req']));
    }
    // employee dashboard
    public function caDashboard()
    {
        $data = User::all();
        $user = DB::table('users')->count();
        $commission = DB::table('users')->count();
        $transaction = DB::table('journal')->count();

        // $user = Auth::User();

        // Session::put('user', $user);
        // $user=Session::get('user');
        // $email = $user->email;

        // $gerants = DB::table('gerants')
        //             ->join('compte_caisses', 'compte_caisses.agence_id', '=', 'agences.id')
        //             ->join('agences', 'agences.id', '=', 'gerants.agence_id')
        //             ->select('gerants.*', 'agences.*')
        //             ->first();



        Carbon::setLocale('fr');


        $todayDate = Carbon::now()->format('d-m-Y H:i:s');
        return view('dashboard.caissier',compact(['todayDate','data', 'user', 'commission', 'transaction']));
    }
    public function geDashboard()
    {
        $data = User::all();
        $user = DB::table('users')->count();
        $caissier = DB::table('compte_caisses')
        ->join('agences', 'agences.id', '=', 'compte_caisses.agence_id')
        ->join('gerants', 'gerants.agence_id', '=', 'agences.id')
        ->select('compte_caisses.*')
        ->count();
        $solde_cdf = DB::table('agences')
        ->join('compte_caisses', 'compte_caisses.agence_id', '=', 'agences.id')
        ->join('gerants', 'gerants.agence_id', '=', 'agences.id')
        ->select('agences.solde_cdf')
        ->first();
        $solde_usd = DB::table('agences')
        ->join('compte_caisses', 'compte_caisses.agence_id', '=', 'agences.id')
        ->join('gerants', 'gerants.agence_id', '=', 'agences.id')
        ->select('agences.solde_usd')
        ->first();
        $commission = DB::table('users')->count();
        $transaction = DB::table('compte_caisses')
        ->join('transactions', 'transactions.agent_id', '=', 'compte_caisses.compte_id')
        ->join('agences', 'agences.id', '=', 'compte_caisses.agence_id')
        ->select('transactions.agent_id')
        ->first();

        $stransact = DB::table('transactions')
        ->where('agent_id',$transaction->agent_id)
        ->count();

        $emala = DB::table('transactions')
        ->where('operator','=','Emala')
        ->count();

        $moneygram = DB::table('transactions')
        ->where('operator','=','Moneygram')
        ->count();

        $mobilemoney = DB::table('transactions')
        ->where('operator','=','Mobile money')
        ->count();

        $req = DB::table('transactions')
        ->select(DB::raw('count(*) as number, sum(amount) as amount, operator, currency, transaction_type'))
        ->groupBy('operator','transaction_type','currency')
        ->get();

        // $req_retrait = DB::table('transactions')
        // ->select(DB::raw('sum(amount) as amount, operator'))
        // ->where('transaction_type','=','Retrait')
        // ->get();
        // $e_amount =0;
        //         $m_amount =0;
        //         $mm_amount =0;
        //         $mm_amount =0;
        //         $number = 0;
        //         $data_transfert = '';
        // foreach ($req as $value) {
        //     if($value->operator=="Emala" && $value->transaction_type=="Transfert"){
        //         $e_amount = $value->amount;
        //         $number = $value->number;
        //      }
        //      elseif($value->operator=="Moneygram" && $value->transaction_type=="Transfert"){
        //         $m_amount = $value->amount;
        //         $number = $value->number;
        //      }
        //      elseif($value->operator=="Mobile money" && $value->transaction_type=="Transfert"){
        //         $mm_amount = $value->amount;
        //         $number = $value->number;
        //      }
        //      $data_transfert .= '{ y: '.$number.', a: '.$e_amount.', b: '.$m_amount.', c: '.$mm_amount.' },';
        // }

// var_dump($data_transfert);


        Carbon::setLocale('fr');
        $todayDate = Carbon::now()->format('d-m-Y H:i:s');
        return view('dashboard.gerant',compact(['req','emala','mobilemoney','moneygram','todayDate','data','solde_usd','solde_cdf', 'caissier', 'commission', 'stransact']));
    }

    public function generatePDF(Request $request)
    {
        // $data = ['title' => 'Welcome to ItSolutionStuff.com'];
        // $pdf = PDF::loadView('payroll.salaryview', $data);
        // return $pdf->download('text.pdf');
        // selecting PDF view
        $pdf = PDF::loadView('payroll.salaryview');
        // download pdf file
        return $pdf->download('pdfview.pdf');
    }
}
