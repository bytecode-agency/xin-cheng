<?php

    
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\LogActivity;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use DataTables;
use Auth;
    
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */  
   
    public function index(Request $request)
    {
        // $roles = Role::orderBy('id','DESC')->paginate(5);
        // return view('roles.index',compact('roles'))->with('i', ($request->input('page', 1) - 1) * 5);
        $data = Role::where('name','!=','Super Admin')->orderBy('id','desc')->get();  
            if ($request->ajax()) {             
               return Datatables::of($data)  
                        ->editcolumn('id',function($query){
                            return str_pad($query->id, 3, '000', STR_PAD_LEFT);
                        })
                       ->editColumn('status', function ($query) {                               
                           if($query->status == 1)
                            return 'Active';
                            else
                            return 'Inactive';
                        })
                        ->addColumn('action','roles.action')
                        ->rawColumns(['action'])                        
                        ->make(true);                         
            } 
           return view('roles.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);     
    
        $role = Role::create(['name' => $request->input('name'),'status' => ($request->input('status'))? $request->input('status') : 0 ,'create_by'=> Auth::user()->name]);
        $role->syncPermissions($request->input('permission'));
       
        $data = (object)(['id'=> $request->id,        
        'name'=> $request->create_by,
        'userID' => $role->id,
        'module_name' => 'User Role',
        'old_action' => null,       
        'action_perform'=>serialize($request->toArray()),
        'message'=>'Role Created',
        ]);
        activity_log($data);
    
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
        $action_log = LogActivity::where('module_name','=','User Role')->where('userID','=',$id)->orderBy('id','desc')->get(); 
        return view('roles.show',compact('role','rolePermissions','action_log'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

    
        return view('roles.edit',compact('role','permission','rolePermissions'));
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
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        
    
        $role = Role::find($id);
        $old_role_data = $role;
        $role->name = $request->input('name');
        $role->status = ($request->input('status') == 'on') ? 1 : 0 ;
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
        
        $data = (object)(['id'=> $request->id,        
        'name'=>$request->create_by,
        'userID' => $role->id,
        'module_name' => 'User Role',
        'old_action' => $old_role_data,       
        'action_perform'=>serialize($request->toArray()),
        'message'=>'Role Update',
        ]);
        activity_log($data);

        return response()->json();
       
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role =  Role::find($id);
        $old_role_data = serialize($role->toArray());
        $role->delete();
        
        $data = (object)(['id'=> Auth::user()->id,        
        'name'=> Auth::user()->name,
        'userID' => $id,
        'module_name' => 'User Role',
        'old_action' => $old_role_data,       
        'action_perform'=> null,
        'message'=>'User Delete',
        ]);
        activity_log($data);
        $success = ['success'=> '<i class="fa-regular fa-circle-check"></i> '.str_pad($id, 3, '000', STR_PAD_LEFT).' has been deleted.'];

        return response()->json($success);
       
    }
}
