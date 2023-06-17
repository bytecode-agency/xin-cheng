<?php
use App\Models\LogActivity;
use App\Models\User;
use Illuminate\Http\Request;


 function activity_log($request){ 

       $roles = User::with('roles')->where('id',$request->id)->get();
       foreach($roles as $role)
       {
        $user_role= $role->name;
       }
       LogActivity::create(['user_id' => $request->id, 
       'name' => $request->name,
       'role'=>$user_role,
       'userID'=> $request->userID,   //module application_id
       'module_name'=> $request->module_name,
       'old_action'=>$request->old_action,
       'action_perform'=>$request->action_perform,
       'message'=>$request->message]);
       
    }

    function convertDate($date, $format = "Y-m-d",$tz = 'Asia/Singapore')
    {      
      if( empty($date) || $date == ""){
        return "";
      }
      $dt = new DateTime();
      $dt->setTimezone(new DateTimeZone($tz));
      $dt->setTimestamp(strtotime(str_replace("/","-",$date)));
      return $dt->format($format);
    }
    function isJson($string) {
      return ((is_string($string) &&
              (is_object(json_decode($string)) ||
              is_array(json_decode($string))))) ? true : false;
    }