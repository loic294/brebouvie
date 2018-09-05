<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use JavaScript;
use App\Participant;
use App\Thread;
use App\User;
use App\Message;
use Auth;

use Session;

class AdminMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      JavaScript::put([
          'users' => User::where('annee', '=', Session::get('annee'))->get()
      ]);

      $threadsList = Participant::all()->lists('thread_id');
      $data = [
        'threads' => Thread::whereIn('id', $threadsList)->where('annee', '=', Session::get('annee'))->get()
      ];
      return view('admin.messages.index', $data);
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
          'users' => User::where('annee', '=', Session::get('annee'))->get()
      ]);

      $threadsList = Participant::all()->lists('thread_id');

      if(!in_array($id, $threadsList->all())) {
        return redirect('/gestion/messages');
      }

      $data = [
        'threads' => Thread::whereIn('id', $threadsList)->where('annee', '=', Session::get('annee'))->get(),
        'id' => $id,
        'messages' => Message::orderBy('messages.updated_at', 'DESC')->join('users', 'messages.user_id', '=', 'users.id')->where('thread_id', $id)->get()
      ];
      //return $data;
      return view('admin.messages.index', $data);

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
        //
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
