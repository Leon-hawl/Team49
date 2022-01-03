<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Service;




class FavController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
    public function create($id)
    {
        $user = User::find($id);

        return view('services.fav', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $service = new Service;

        $service -> site_name = $request ->site_name;
        $service -> site_url = $request ->site_url;
        $service -> user_id = $request -> user_id;
        $service -> memo = $request -> memo;

        $service -> save();
        $user = User::find($service['user_id']);

        return redirect()->route('fav.show',['fav' => $user -> id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $services = Service::all()->where('user_id', '=', $user['id']);

        return view('services.fav', compact('user', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        $user = User::find($service['user_id']);

        if(Auth::id() == $user -> manager_id) {
            return view('services.favEdit', compact('service'));
        } else if(Auth::id() !== $service -> user_id) {
            return redirect()->route('seniorList.index');
        }

        return view('services.favEdit', compact('service'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {

        $service = Service::find($id);

        $service -> update($request->all());
        $user = User::find($service['user_id']);

        if(Auth::id() == $user -> manager_id) {
            $service -> update($request->all());
            return redirect()->route('fav.show',['fav' => $user -> id]);
        } else if(Auth::id() == $service -> user_id) {
            $service -> update($request->all());
            return redirect()->route('fav.show',['fav' => $user -> id]);
        } else {
            return redirect()->route('seniorList.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        $user = User::find($service['user_id']);

        if(Auth::id() == $user -> manager_id) {
            $service -> delete();
            return redirect()->route('fav.show',['fav' => $user -> id]);
        } else if(Auth::id() == $service -> user_id) {
            $service -> delete();
            return redirect()->route('fav.show',['fav' => $user -> id]);
        } else {
            return redirect()->route('seniorList.index');
        }

    }

    public function favAdd($id)
    {
        $user = User::find($id);

        return view('services.favAdd', compact('user'));
    }

}
