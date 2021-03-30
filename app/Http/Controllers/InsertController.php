<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\Temans as TemanCollectionResource;
use Illuminate\Support\Facades\Hash;
use App\Teman;
use Illuminate\Support\Facades\Validator;

class InsertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct(){
    //     // OTORISASI GATE
 
    //    $this->middleware(function($request, $next){
 
    //      if(Gate::allows('manage-fields')) return $next($request);
 
    //      abort(403, 'Anda tidak memiliki cukup hak akses');
    //    }, ['except' => ['temans', 'temanAll']]);
    //  }
 
     public function index(Request $request)
     {
       $keyword = $request->get('keyword') ? $request->get('keyword') : '';
       $temans = \App\Teman::where("name", "LIKE", "%$keyword%")->paginate(10);
 
       return view('insertteman.index', ['temans' => $temans]);
     }
 
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
       return view('insertteman.index');
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
       \Validator::make($request->all(), [
         "name" => "required|min:5|max:200",
        //  "category" => "required",
        "umur" => "required",
        "username" => "required",
         "location" => "required",
         "open" => "required",
         "address" => "required",
         "price" => "required|digits_between:0,10",
         "close" => "required",
         "picture" => "required",
         "email" => "required",
       ])->validate();
 
       $new_temans = new \App\Teman;
 
       $new_temans->name = $request->get('name');
       $new_temans->umur = $request->get('umur');
       $new_temans->username = $request->get('username');
      //  $new_temans->category = $request->get('category');
       $new_temans->open = $request->get('open');
       $new_temans->close = $request->get('close');
       $new_temans->price = $request->get('price');
       $new_temans->location = $request->get('location');
       $new_temans->address = $request->get('address');
       $new_temans->email = $request->get('email');
 
       if($request->file('picture')){
           $file = $request->file('picture')->store('pictures', 'public');
 
           $new_temans->picture = $file;
       }
 
       $new_temans->save();
 
       return redirect()->route('insertteman.index')->with('status', 'temans successfully added.');
     }
 
     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show()
     {
      return view('insertteman.loginteman');
     }
 
     public function register(Request $request)
    {
            \Validator::make($request->all(), [
              "name" => "required|min:5|max:200",
            "umur" => "required",
            "username" => "required",
              "location" => "required",
              "open" => "required",
              "address" => "required",
              "price" => "required|digits_between:0,10",
              "close" => "required",
              "picture" => "required",
              "email" => "required",
              "password" => "required|min:5|max:200",
            ])->validate();

          $temans = \App\Teman::create([
              'name' => $request->name, 
              'username' => $request->username,
              'umur' => $request->umur, 
              'location' => $request->location,
              'open' => $request->open,
              'address' => $request->address,
              'price' => $request->price,
              'close' => $request->close,
              'picture' => $request->picture,
              'email' => $request->email,
              'token' => $request->token,
              'password' => Hash::make($request->password),
              'roles'    => "json_encode(['USERTEMAN'])",
          ]);

          if($request->file('picture')){
            $file = $request->file('picture')->store('pictures', 'public');
  
            $temans->picture = $file;
        }
  
        $temans->save();
          return redirect('/loginteman')->with('status', 'temans successfully added.');
      }
  
    

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
       $temans = \App\Teman::findOrFail($id);
 
       return view('temans.edit', ['temans' => $temans]);
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
       \Validator::make($request->all(), [
         "name" => "required|min:5|max:200",
         "umur" => "required",
         "username" => "required",
        //  "category" => "required",
         "location" => "required",
         "open" => "required",
         "address" => "required",
         "price" => "required|digits_between:0,10",
         "close" => "required",
         "picture" => "required",
         "email" => "required",
       ])->validate();
 
       $temans = \App\Teman::findOrFail($id);
 
       $temans->name = $request->get('name');
       $new_temans->umur = $request->get('umur');
       $new_temans->username = $request->get('username');
      //  $temans->category = $request->get('category');
       $temans->open = $request->get('open');
       $temans->close = $request->get('close');
       $temans->location = $request->get('location');
       $temans->price = $request->get('price');
       $temans->address = $request->get('address');
       $temans->email = $request->get('email');
 
       if($request->file('picture')){
           if($temans->avatar && file_exists(storage_path('app/public/' . $temans->picture))){
               \Storage::delete('public/'.$temans->picture);
           }
           $file = $request->file('picture')->store('pictures', 'public');
           $temans->picture = $file;
       }
 
       $temans->save();
 
       return redirect()->route('insertteman.index', [$id])->with('status', 'temans succesfully updated');
     }
 
     public function login(Request $request)
    {
      $this->validate($request, [
        'email' => 'required',
        'password' => 'required',
    ]);

      $temans = Teman::where('email', '=', $request->email)->where('roles', '["USERTEMAN"]')->first();
      $status = "error";
      $message = "";
      $data = null;
      $code = 302;

      if($temans){
        if(Hash::check($request->password, $temans->password)){
          $status = 'success';
          $message = 'Login sukses';
          $temans->token = $request->token;
          $temans->save();
          // tampilkan data temans menggunakan method toArray
          $data = $temans->toArray();
          $code = 200;
        }else{
          $message = "Login gagal, password salah";
        }
      }else {
        $message = "Login gagal, user " . $request->email . " tidak ditemukan";
      }

      return redirect('/userteman')->with('status', "welcome " . $request->username);
    }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
       $temans = \App\Teman::findOrFail($id);
 
       $temans->delete();
 
       return redirect()->route('insertteman.index')->with('status', 'temans successfully delete');
     }
 
     public function temans(Request $request)
     {
         $temans = new TemanCollectionResource(\App\Teman::get());
         return $temans;
     }
 
     public function temanAll(Request $request)
     {
         $temans = new TemanCollectionResource(\App\Teman::get());
         return $temans;
     }
}
