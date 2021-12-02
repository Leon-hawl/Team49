<!DOCTYPE html>
<html lang="ja">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="../Views/css/style.css">
 
    <title>アカウント登録画面</title>
    <meta name="description" content="アカウント登録画面です">
</head>
 
<body class="signup text-center">
    <main class="form-signup">
        <form action="signup" method="post">
        {{ csrf_field() }}   
        　  <h1>アカウント作る</h1>
         <div class="mx-auto" style="width:300px;">
           <div class="col-sm-20">
           <input type="text" class="form-control" name="name" placeholder="ユーザー名、例)techis132" maxlength="50" required>
           </div>
           <div class="col-sm-20">
           <input type="email" class="form-control" name="email" placeholder="メールアドレス" maxlength="254" required>
           </div>
           <div class="col-sm-20">
           <input type="password" class="form-control" name="password" placeholder="パスワード" minlength="4" maxlength="20" required>
           </div>
         </div>
           <br><input type="checkbox" id="manager" value=1 name="manager" checked>
            <label for="manager">管理者の方はこちら</label>
           <br><br><input type="submit" name="button1" value="登録" class="btn btn-primary btn-wide" />   
            <p class="mt-3 mb-2"><a href="signin">ログイン画面へ</a></p>
            
        </form>
    </main>
</body>
 
</html>
