<?php

   
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LogActivity;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Auth;
use DataTables;
    
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
       $data =  User::with('roles')->where('id','!=',Auth::user()->id)->orderBy('id','DESC')->get();   
        // dd($data);      
        if ($request->ajax()) {             
            return Datatables::of($data)   
                    // ->addIndexColumn()
                    ->editcolumn('id',function($query){
                        return str_pad($query->id, 3, '000', STR_PAD_LEFT);
                    })
                    ->editColumn('roles', function ($query) { 
                        $roles= "";                              
                        foreach ($query->roles as $rolename) {
                            $roles = $rolename->name;
                        }   
                        return $roles;  
                    })                    
                    ->addColumn('action','users.action')
                    ->rawColumns(['action'])    
                    ->make(true);                         
        } 
        return view('users.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
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
            'name' => 'required',
            // 'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required'
        ]);
    
        $input = $request->all();        
        $input['password'] = Hash::make($input['password']);    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
       
        $data = (object)(['id'=> $request->id,        
        'name'=> $request->create_by,
        'userID' => $user->id,
        'module_name' => 'User Account',
        'old_action' => null,       
        'action_perform'=>serialize($request->toArray()),
        'message'=>'User Created',
        ]);
        activity_log($data);
        return response()->json();        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $action_log = LogActivity::where('module_name','=','User Account')->where('userID','=',$id)->orderBy('id','desc')->get(); 
         
        return view('users.show',compact('user','action_log'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name');
        
        $userRole = $user->roles->pluck('name','name')->first();    
        // dd($userRole);
        return view('users.edit',compact('user','roles','userRole'));
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
            // 'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required'
        ]);
        // dd($request);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }    
        $user = User::with('roles')->find($id);
        $old_user_data = serialize($user->toArray());
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));
        
        $data = (object)(['id'=> $request->id,        
        'name'=>$request->create_by,
        'userID' => $user->id,
        'module_name' => 'User Account',
        'old_action' => $old_user_data,       
        'action_perform'=>serialize($request->toArray()),
        'message'=>'User Update',
        ]);
        activity_log($data);
    
        return response()->json();
        // return redirect()->route('users.index')
        //                 ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $user = User::with('roles')->find($id);
        $old_user_data = serialize($user->toArray());
        $user->delete();

        $data = (object)(['id'=> Auth::user()->id,        
        'name'=> Auth::user()->name,
        'userID' => $id,
        'module_name' => 'User Account',
        'old_action' => $old_user_data,       
        'action_perform'=> null,
        'message'=>'User Delete',
        ]);
        activity_log($data);
        $success = ['success'=> '<i class="fa-regular fa-circle-check"></i> '.str_pad($id, 3, '000', STR_PAD_LEFT).' has been deleted.'];
        return response()->json($success);
        // return redirect()->route('wealth.index')->with('success',str_pad($id, 3, '000', STR_PAD_LEFT).' has been deleted.');
    }
}