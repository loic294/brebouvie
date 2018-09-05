<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Thread;
use JavaScript;
use App\User;
use App\Participant;
use App\Message;
use URL;
use File;
use Session;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();
        foreach ($users as $key => $value) {
          $users[$key]['role'] = $value->role()->first();
        }

        JavaScript::put([
            'users' => $users
        ]);

        $annee = Auth::user()->annee;
        if(Session::has('annee')) {
          $annee = Session::get('annee');
        }

        $threadsList = Participant::where('user_id', Auth::user()->id)->lists('thread_id')->all();
        // return $threadsList;
        $data = [
          'threads' => Thread::whereIn('id', $threadsList)->where('annee', '=', $annee)->get()
        ];
        return view('messages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      JavaScript::put([
          'users' => User::all()
      ]);

      $threadsList = Participant::where('user_id', Auth::user()->id)->lists('thread_id');

      if(!in_array($id, $threadsList->all())) {
        return redirect('/messages');
      }

      $annee = Auth::user()->annee;
      if(Session::has('annee')) {
        $annee = Session::get('annee');
      }

      $data = [
        'threads' => Thread::whereIn('id', $threadsList)->where('annee', '=', $annee)->get(),
        'id' => $id,
        'messages' => Message::orderBy('messages.updated_at', 'DESC')->join('users', 'messages.user_id', '=', 'users.id')->where('thread_id', $id)->get()
      ];
      //return $data;
      return view('messages.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $i = $request->all();

        //return $request->file('upload')->getClientSize();

        $this->validate($request, [
          'body' => 'required',
          'upload' => 'mimes:jpeg,bmp,png,svg,psd,doc,docx,ppt,pptx,xls,xlsx,pdf,zip|max:2000'
        ]);

        $body = $i['body'];

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $newFileName =  time() . '-' . str_replace(' ', '', $file->getClientOriginalName());
            $file->move( base_path() . '/public/uploads/', $newFileName);
            $estImage = strpos($file->getClientMimeType(), "image") !== false;
            $imgLink = URL::to('uploads'). '/' . $newFileName;
            $body .= '['.($estImage ? " ![une image](".urlencode($imgLink).") " : $newFileName ).']('.urlencode($imgLink).')';
        }

        $message = new Message;
        $message->type = 1;
        $message->thread_id = $id;
        $message->user_id = Auth::user()->id;
        $message->body = $body;
        $message->annee = Auth::user()->annee;
        $message->save();

        return redirect('messages/' . $id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
