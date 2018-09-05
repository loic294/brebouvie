<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Thread;
use App\Participant;
use Auth;
use Session;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $this->validate($request, [
          'name' => 'required|max:255'
        ]);

        if(count($i) < 5) {
          return redirect('messages')->with('status', 'Vous ne pouvez pas créer une conversation avec vous seul.');
        }

        $annee = Auth::user()->annee;
        if(Session::has('annee')) {
          $annee = Session::get('annee');
        }

        $thread = new Thread;
        $thread->subject = $i['name'];
        $thread->annee = $annee;
        $thread->save();

        foreach ($i as $key => $user) {
          if(is_numeric($user)) {
            $participant = new Participant;
            $participant->thread_id = $thread->id;
            $participant->user_id = $user;
            $participant->save();
          }
        }

        return redirect('messages/' . $thread->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
