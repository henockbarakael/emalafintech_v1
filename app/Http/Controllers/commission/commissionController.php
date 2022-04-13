<?php

namespace App\Http\Controllers\commission;

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

class commissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commissions = DB::table('commissions')->get();
        return view('configuration.commissions.all',compact('commissions'));
    }

 // save data role
 public function saveRecord(Request $request)
 {
     $request->validate([
         'commission'        => 'required|string|max:255',
         'type_commission'        => 'required|string|max:255',
         'pourcentage'        => 'required|string|max:255',
     ]);
     DB::beginTransaction();
     try{

        $donnees = [
            'type_commission'=>$request->type_commission,
            'nom_commission'=>$request->commission,
            'pourcentage'=>$request->pourcentage,
        ];
        DB::table('commissions')->insert($donnees);
             DB::commit();
             Toastr::success('Commission crée avec succès :)','Success');
             return redirect()->route('all/commissions');

      }catch(\Exception $e){
          DB::rollback();
          Toastr::error('Ajout d\'une nouvelle commission echouée :)','Error');
          return redirect()->back();
     }

 }
    // delete record
    public function deleteRecord(Request $request)
    {
        DB::beginTransaction();
        try{

            DB::table('commissions')->destroy($request->id);
            //module_permission::where('employee_id',$roles_id)->delete();

            DB::commit();
            Toastr::success('Commission supprimée avec succès :)','Success');
            return redirect()->back();

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Echec de suppression :)','Error');
            return redirect()->back();
        }
    }

}
