<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;
use Auth;

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
    public function index()
    {
        return view('home');
    }

    public function createnotes(Request $request){
        // dd($request);
         $notes = new Notes;
         $notes->module_name = $request->tbl_name;
         $notes->application_id = $request->application_id;
         $notes->notes_description = $request->notes;
         $notes->created_by = $request->created_by_name;
         $notes->save();
        //  return redirect()->back()->with('status', 'Notes saved');
        $data = (object)(['id'=> Auth::user()->id,
        'name'=> Auth::user()->name,
        'userID' =>  $request->application_id,
        'module_name' => $request->tbl_name,
        'old_action' => null,
        'action_perform'=> serialize($request->toArray()),
        'message'=>'Notes Created',
        ]); 
        activity_log($data);
        return response()->json([
            "notes_description" => $request->notes,
            "created_by" => $request->created_by_name,
            "created_date" => \Carbon\Carbon::now()->format('d/m/Y h:m a'),

        ]);
    }
    public function removeNote(Request $request){
        $id = $request->id;
        if(empty($id)){
            return response()->json();
        }
        $notes = Notes::find($id);
        $data = (object)(['id'=> Auth::user()->id,
        'name'=> Auth::user()->name,
        'userID' =>  0,
        'module_name' => "notes",
        'old_action' => null,
        'action_perform'=> serialize($request->toArray()),
        'message'=>'Notes Removed',
        ]); 
        activity_log($data);
        $notes->delete();
        return response()->json();
    }

}
