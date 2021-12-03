<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

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
        $users = User::all()->Where('manager_id', '=', $id)->WhereNotIn('id', $id);

        if(count($users) == 0) {
            $message = '未登録です';
        } else {
            $message = '';
        }

        return view('services.index', compact('users'))->with('message', $message);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $loginId = Auth::id();
        $search = $request->input('search');
        $query = User::query()->where('manager_id', '!=', $loginId)->WhereNotIn('id', [$loginId]);

        if ($search !== null) {
            $spaceConversion = mb_convert_kana($search, 's');
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);



            foreach($wordArraySearched as $value) {
                $query->where('name', 'like', '%'.$value.'%');
            }

            $users = $query->paginate(2);
            $resultMessage = '検索結果';

            if (!User::where('manager_id', '!=', $loginId)->Where('name', 'like', '%'.$value.'%')->exists()) {
                $resultMessage = '該当者なし';
            }

        } else {
            $users = User::select('*')->whereNotIn('manager_id', [$loginId])->simplePaginate(2);
            $resultMessage = '全件表示';
        }

        return view('services.seniorList', compact('users'))->with('resultMessage', $resultMessage)->with('loginId', $loginId);
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
        $user -> manager_id = 0;
        $user -> save();

        return redirect()->route('seniorList.index');
    }
}
