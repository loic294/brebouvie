<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Role;
use Auth;
use App\Thread;
use JavaScript;
use App\User;
use App\Participant;
use App\Message;
use URL;
use File;

use Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
          'users' => User::where('annee', '=', Session::get('annee'))->orWhere('userType', '=', 1)->get(),
          'roles' => Role::all()
        ];
        return view('admin.users.index', $data);
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

        $i = $request->all();

        $user = new User;
        $user->da = $i['da'];
        $user->userType = $i['role'];
        $user->annee = Session::get('annee');
        $user->save();

        return redirect()->back()->with('success_message', 'L\'utilisateur a été ajouté.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // return Session::get('annee');

      $threadsList = Participant::where('user_id', $id)->lists('thread_id');
      $threads = Thread::whereIn('id', $threadsList)->where('annee', '=', Session::get('annee'));
      $messages = Message::whereIn('thread_id', $threads->lists('id')->all());

      // return ;

      // return $threadsList->all();

      $word_count = 0;

      foreach ($messages->get() as $key => $message) {
        $word_count += str_word_count($message->body, 0);
      }

      $data = [
        'user' => User::find($id),
        'roles' => Role::all(),
        'threads' => Thread::whereIn('id', $threadsList)->where('annee', '=', Session::get('annee'))->get(),
        'messages' => $messages->get(),
        'stats' => [
          'threads' => $threads->count(),
          'messages' => $messages->count(),
          'words' => $word_count
        ]
      ];
      return view('admin.users.show', $data);
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

      $user = User::find($id);
      $user->da = $i['da'];
      $user->prenom = $i['prenom'];
      $user->nom = $i['nom'];
      $user->email = $i['email'];
      $user->userType = $i['role'];
      $user->save();

      return redirect()->back()->with('success_message', 'L\'utilisateur a été modifié.');

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
