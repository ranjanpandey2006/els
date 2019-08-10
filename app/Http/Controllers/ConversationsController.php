<?php

namespace App\Http\Controllers;

use App\Chat;
use App\conver_users;
use App\Conversations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationsController extends Controller
{
    public function createConv(Request $request){
        error_log("Reqeust for a new convesation is just came here");
        $data=$request->all();
        $students=$data['students'];
        //creating the converstation
        error_log($data['slot']);
        $conversation=Conversations::create([
            'slot_id'=>$data['slot']
        ]);
        //adding himself
        conver_users::create([
            'user_id'=>Auth::user()->id,
            'conver_id'=>$conversation->id,
        ]);
        //adding each students to the converstation.
        foreach ($students as $student){
            conver_users::create([
                'user_id'=>$student,
                'conver_id'=>$conversation->id,
            ]);
        }
        return redirect()->route('teacherMySlot', ['id' => $data['slot']]);

        //
    }
    public function getConv($id){
        error_log("Reqeust for a new convesation is just came here".$id);
        //check the user has the authority to the chat
        error_log($id." ".Auth::user()->id);
        $conversation=conver_users::where('conver_id','=',$id)->where('user_id','=',Auth::user()->id)->get();
        if(sizeof($conversation)==0){
            error_log(" Zero size coversation");
        }
        else{
            $chat=Chat::where('conv_id','=',$id)->get();
            error_log(sizeof($chat)." The fuck". $id);
            $channel="channel".$id;
            return view('auth.chat')->with('chat',$chat)->with('conv_id',$id)->with('channel',$channel);
        }
    }
}
