<!DOCTYPE html>
<html lang="ja"> 

<head>    
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="../Views/css/style.css">
   
    <title>ログイン画面 </title>
    <meta name="description" content="ログイン画面です">
</head>

<body class="signin text-center"> 
<main class="form-signin">
        <form action="/services/signin" method="post" class="form-horizontal">
        {{ csrf_field() }} 
           <br><h2>お気に入り<br>サービス登録システム</h2>
            
            <div class="mx-auto" style="width:300px;">
            <div class="col-sm-20">   
            <input type="email" class="form-control" name="email" placeholder="メールアドレス" required autofocus>
            </div>
            <div class="col-sm-20">
            <input type="password" class="form-control" name="password" placeholder="パスワード" required></div>
            </div>
        <br><button class="btn btn-primary btn-wide" type="submit">ログイン</button>
            <p class="mt-3 mb-2"><a href="signup">アカウント登録する</a></p>
            
            @if (session('message'))
            <div class="alert alert-danger">
            {{ session('message') }}
            </div>
            @endif

            
        </form>
    </main>
    
</body>
 
</html>