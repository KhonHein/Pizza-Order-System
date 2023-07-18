<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
        //contact direct page
        public function contactToAdimn(){
            return view('user.contact.contact');
        }

        //contact to Admin
        public function sendToAdimn(Request $request){
        $sendData = $this->dataRequest($request);
        //dd($sendData);
        Contact::create($sendData);
        return redirect()->route('user#home')->with(['send' => 'your message send to admin successfully']);
        }

        //admin message lists
        public function messageList(){
        $messages = Contact::paginate(5);
        //dd($messages->toArray());
        return view('admin.user.contact',compact('messages'));
        }

        // admin delete message
        public function deleteMessage(Request $request){
        // logger($request->all());
        Contact::where('id',$request->messageId)->delete();
        return redirect()->route('admin#messageList')->with(['deleteMessage' => 'You deleted one of customer message']);
        }
        //request data
        private function dataRequest($request){
        $data = [

            'name' =>$request->name,
            'email' =>$request->email,
            'message' =>$request->message,
        ];
        return $data;

        }

}
