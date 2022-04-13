<?php

namespace App\Http\Controllers\role;

use App\Http\Controllers\Controller;
use App\Models\roleTypeUser;
use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\User;
use App\Models\module_permission;
use Carbon\Carbon;

class roleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    // liste role
    public function listeRole()
    {
        $roles = roleTypeUser::all();
        return view('configuration.roles.all',compact(['roles']));
    }

    // save data role
    public function saveRecord(Request $request)
    {
        $request->validate([
            'role_type'        => 'required|string|max:255',
        ]);
        DB::beginTransaction();
        try{

                $roles = new roleTypeUser();
                $dt       = Carbon::now();
                $todayDate = $dt->toDayDateTimeString();
                $roles->role_type    = $request->role_type;
                $roles->created_at   = $todayDate;
                $roles->updated_at   = $todayDate;
                $roles->save();
                DB::commit();
                Toastr::success('Rôle crée avec succès :)','Success');
                return redirect()->route('all/roles');

         }catch(\Exception $e){
             DB::rollback();
             Toastr::error('Ajout d\'un nouveau rôle echoué :)','Error');
             return redirect()->back();
        }

    }
    // delete record
    public function deleteRecord(Request $request)
    {
        DB::beginTransaction();
        try{

            roleTypeUser::destroy($request->id);
            //module_permission::where('employee_id',$roles_id)->delete();

            DB::commit();
            Toastr::success('Rôle supprimé avec succès :)','Success');
            return redirect()->route('all/roles');

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Echec de suppression :)','Error');
            return redirect()->back();
        }
    }
    // view edit record
    public function viewRecord($roles_id)
    {
        $permission = DB::table('employees')
            ->join('module_permissions', 'employees.employee_id', '=', 'module_permissions.employee_id')
            ->select('employees.*', 'module_permissions.*')
            ->where('employees.employee_id','=',$roles_id)
            ->get();
        $roles = DB::table('employees')->where('employee_id',$roles_id)->get();
        return view('form.edit.editemployee',compact('employees','permission'));
    }
    // update record employee
    public function updateRecord( Request $request)
    {
        DB::beginTransaction();
        try{

            // update table role_types
            $updateRole= [
                'id'=>$request->id,
                'role_type'=>$request->role_type,
            ];

            roleTypeUser::where('id',$request->id)->update($updateRole);

            DB::commit();
            Toastr::success('Mise à jour du rôle avec succès :)','Success');
            return redirect()->route('all/roles');
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('échec de la mise à jour du rôle :)','Error');
            return redirect()->back();
        }
    }

    // employee search
    public function employeeSearch(Request $request)
    {
        $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                    ->get();
        $permission_lists = DB::table('permission_lists')->get();
        $userList = DB::table('users')->get();

        // search by id
        if($request->employee_id)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->get();
        }
        // search by name
        if($request->name)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->get();
        }
        // search by name
        if($request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }

        // search by name and id
        if($request->employee_id && $request->name)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->get();
        }
        // search by position and id
        if($request->employee_id && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }
        // search by name and position
        if($request->name && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }
         // search by name and position and id
         if($request->employee_id && $request->name && $request->position)
         {
             $users = DB::table('users')
                         ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                         ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                         ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                         ->where('users.name','LIKE','%'.$request->name.'%')
                         ->where('users.position','LIKE','%'.$request->position.'%')
                         ->get();
         }
        return view('form.allemployeecard',compact('users','userList','permission_lists'));
    }
    public function employeeListSearch(Request $request)
    {
        $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                    ->get();
        $permission_lists = DB::table('permission_lists')->get();
        $userList = DB::table('users')->get();

        // search by id
        if($request->employee_id)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->get();
        }
        // search by name
        if($request->name)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->get();
        }
        // search by name
        if($request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }

        // search by name and id
        if($request->employee_id && $request->name)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->get();
        }
        // search by position and id
        if($request->employee_id && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }
        // search by name and position
        if($request->name && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }
        // search by name and position and id
        if($request->employee_id && $request->name && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }
        return view('form.employeelist',compact('users','userList','permission_lists'));
    }

    // employee profile
    public function profileEmployee($rec_id)
    {
        $users = DB::table('profile_information')
                ->join('users', 'users.rec_id', '=', 'profile_information.rec_id')
                ->select('profile_information.*', 'users.*')
                ->where('profile_information.rec_id','=',$rec_id)
                ->first();
        $user = DB::table('users')->where('rec_id',$rec_id)->get();
        return view('form.employeeprofile',compact('user','users'));
    }



}
        // all employee card view
    // public function cardAllEmployee(Request $request)
    // {
    //     $users = DB::table('users')
    //                 ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
    //                 ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
    //                 ->get();
    //     $userList = DB::table('users')->get();
    //     $permission_lists = DB::table('permission_lists')->get();
    //     return view('form.allemployeecard',compact('users','userList','permission_lists'));
//}
// all employee list
// public function listAllEmployee()
// {
//     $users = DB::table('users')
//                 ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
//                 ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
//                 ->get();
//     $userList = DB::table('users')->get();
//     $permission_lists = DB::table('permission_lists')->get();
//     return view('form.employeelist',compact('users','userList','permission_lists'));
// }
