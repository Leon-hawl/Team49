<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;


class SeniorListController extends Controller
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
        $id = Auth::id();
        $loginUser = User::find($id);


        if ($loginUser -> manager_flg == 0) {
            $user = $loginUser;

            return redirect()->route('fav.show',['fav' => $user -> id]);
        }

        if (!isset($id)) {
            return redirect('/');
        }

        $users = User::all()->Where('manager_id', '=', $id)->WhereNotIn('id', $id);

        return view('services.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $loginId = Auth::id();
        $loginUser = User::find($loginId);
        $message = '';

        $search = $request->input('search');
        $query = User::query()->WhereNotIn('id', [$loginId])->where('manager_flg', '!=', '1')->where('manager_id', '=', null);

        if ($search !== null) {
            $spaceConversion = mb_convert_kana($search, 's');
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            foreach($wordArraySearched as $value) {
                $query->where('name', 'like', '%'.$value.'%');
            }

            $users = $query->get();

        } else {
            $users = User::all()->where('id', '!=', $loginId)->where('manager_flg', '!=', '1')->where('manager_id', '=', null);
            $message = '全件表示しています';
        }

        return view('services.seniorList', compact('users'))->with('message', $message);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        $authorId = Auth::id();

        return view('services.showAndEdit', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $authorId = Auth::id();

        if($user -> manager_id !== $authorId && $authorId !== $user -> id){
            return abort(404);
        }

        $user -> save();

        return redirect()->route('seniorList.index');
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
        $user = User::find($id);
        $user -> manager_id = $request -> manager_id;

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

        $authorId = Auth::id();
        if($user -> manager_id !== $authorId && $authorId !== $user -> id){
            return abort(404);
        }

        $user -> manager_id = null;
        $user -> save();

        return redirect()->route('seniorList.index');
    }
}
