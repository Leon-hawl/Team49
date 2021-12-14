<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Hash;
use App\Models\Services;
use App\Models\User;
use Auth;
class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Services::orderBy('created_at', 'asc')->get();
        return view('services.signin', [
            'services' => $services,
        ]);
    }
   
    public function signup(Request $request)
    {
        return view('services.signup');
          
    }
    
    
    public function store(Request $request)
   
   {
   
    $this->validate($request,[
        'email' => 'email|required|unique:users',
    ],
    [
        'email.unique' => 'メールアドレスが使用されているため登録できません。',
  
       ]);
   
      $user = new User();
             
        // 値の登録
        //$user->user_id = 1;
        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        if($request->manager){
            $user->manager_flg = $request->manager; 
        
        }
         
        
        
        // 保存
        $user->save();
        
               
        // ログイン画面にリダイレクト
        return redirect()->to('services/signin');
    }  
    
   
   
    public function postSignin(Request $request)
    {
         $this->validate($request,[
         'email' => 'email|required',
         'password' => 'required|min:5'
   
        ]);
    $email = $request->email;
    $password = $request->password;
    
    
    if (isset($_POST['email']) && isset($_POST['password'])) 
        // ログインチェック実行
        
        $user = User::where('email', $request->email)->get();{
       
        //email不一致
        }if (count($user) === 0){
           return redirect('services/signup')->with('message', 'メールアドレスがが違います');
        
        
        // manager一致
        }else if ($request->password == $user[0]->password && $user[0]->manager_flg == 1){ 
            
            session(['manager_flg' => $user[0]->manager_flg]);      
            return redirect('https://laravel.bigcartel.com/');///->with('message', 'ログインしました。');
        
         //一般会員   
        }else if ($request->password == $user[0]->password) {
        
             session(['email' => $user[0]->email]);
             session(['password'  => $user[0]->password]);
             return redirect('/');  // ->with('message', 'ログインしました。');      
        
         // Password不一致    
        }else{
             return redirect('services/signin')->with('message', 'パスワードが違います');
        }
        
    }
}        