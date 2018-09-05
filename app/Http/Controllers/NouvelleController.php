<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Message;
use URL;
use Session;

class NouvelleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $annee = Auth::user()->annee;
        if(Session::has('annee')) {
          $annee = Session::get('annee');
        }

        $messages = Message::where('type', '=', '2')->where('annee', '=', $annee)->get();
        return view('nouvelles/index', ['messages' => $messages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nouvelles/create');
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

        return $i;

        $this->validate($request, [
          'nom' => 'required|max:255',
          'body' => 'required',
          'upload' => 'mimes:jpeg,bmp,png,svg,psd,doc,docx,ppt,pptx,xls,xlsx,pdf,zip|max:4000'
        ]);

        $body = $i['body'];

        return $body;

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $newFileName = time() . '-' . str_replace(' ', '', $file->getClientOriginalName());
            $file->move( base_path() . '/public/uploads/', $newFileName);
            $estImage = strpos($file->getClientMimeType(), "image") !== false;
            $imgLink = URL::to('uploads'). '/' . $newFileName;
            $body .= '

_Fichier joint :_ ['.($estImage ? " ![une image](".urlencode($imgLink).") " : $newFileName ).']('.urlencode($imgLink).')';
        }

        $annee = Auth::user()->annee;
        if(Session::has('annee')) {
          $annee = Session::get('annee');
        }

        $message = new Message;
        $message->type = 2;
        $message->nom = $i['nom'];
        $message->thread_id = 0;
        $message->user_id = Auth::user()->id;
        $message->body = $body;
        $message->annee = $annee;
        $message->save();

        return redirect('/nouvelles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = [
        'message' => Message::find($id)
      ];
      return view('nouvelles/create', $data);
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

      $this->validate($request, [
        'nom' => 'required|max:255',
        'body' => 'required',
      ]);

      // return $i['body'];

      $message = Message::find($id);
      $message->nom = $i['nom'];
      $message->thread_id = 0;
      $message->user_id = Auth::user()->id;
      $message->body = $i['body'];
      $message->save();

      // return $message;

      return redirect('/nouvelles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();
        return redirect('/nouvelles');
    }
}
