<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Service;

class UserController extends Controller
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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:20', 'confirmed'],
            'manager_flg' => ['required'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function update(UserRequest $request, $id)
    {

        $user = User::find($id);

        if($request -> manager_flg == 1) {
            $user -> manager_flg = $request -> manager_flg;
        } else {
            $user -> manager_flg = $request -> manager_flg;
        }

        $user -> name = $request -> name;
        $user -> email = $request -> email;
        $user -> password = bcrypt($request->password);
        $user -> save();

        return redirect()->route('seniorList.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $managedUser = [];

        $services = Service::select('*')->where('user_id', '=', $user->id);

        if ($user -> manager_flg == 1) {
            $managedUser = User::all()->where('manager_id', '=', $user->id);
            foreach ($managedUser as $managedUser) {
                $managedUser -> manager_id = null;
                $managedUser -> save();
            }
        }
        $services ->delete();
        $user -> delete();

        if (Auth::id() == null) {
            return redirect('/welcome');
        }

        return redirect()->route('seniorList.index');
    }

}
