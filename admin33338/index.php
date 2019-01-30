<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');



//p($_POST);
if(isset($_POST['log'])) {
    $user = preg_replace('/[^\w\d]/','',$_POST['user']);
    $pass = md5(preg_replace('/[^\w\d]/','',$_POST['pass']));
    $auth = authorization($user,$pass);
    @$username = $auth[0]['user'];
    @$password = $auth[0]['pass'];
    @$type = $auth[0]['type'];
    @$name = $auth[0]['username'];
    @$user_id = $auth[0]['id'];
    @$role = $auth[0]['role'];
    @$rolename = $auth[0]['rolename'];

    if($user == $username && $pass == $password) {

        $_SESSION['name'] = $name;
        $_SESSION['type'] = $type;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user'] = $username;
        $_SESSION['role'] = $role;
        $_SESSION['rolename'] = $rolename;
        if($username == 'admin'){
            echo '<script>location.assign("val.php")</script>';
        }elseif($type == 'editor'){
            echo '<script>location.assign("editors.php")</script>';
        }elseif($type == 'manager'){
            echo '<script>location.assign("manager.php")</script>';
        }elseif($type == 'marketolog'){
            echo '<script>location.assign("editors.php")</script>';
        }elseif($type == 'assistant'){
            echo '<script>location.assign("assistant.php")</script>';
        }elseif($username == 'olboss'){
            echo '<script>location.assign("val_olboss.php")</script>';
        }else{
           echo '<script>location.assign("/admin33338/")</script>';
        }
    }

}
//p($_SESSION);
if(@$_SESSION['user'] == 'admin'){
    header('location:val.php');
}elseif(@$_SESSION['type'] == 'editor'){
    header('location:editors.php');
}elseif(@$_SESSION['user'] == 'olboss'){
    header('location:val_olboss.php');
    //echo $_SESSION['user'];
}elseif(@$_SESSION['type'] == 'manager'){
    header('location:manager.php');
}elseif(@$_SESSION['type'] == 'marketolog'){
    header('location:editors.php');
}elseif(@$_SESSION['type'] == 'assistant'){
    header('location:assistant.php');
}

?>
<!DOCTYPE html>
<html>
  <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login page</title>
        <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="styles/admin.css" rel="stylesheet" type="text/css" />
        <link rel="icon" href="../favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
</head>
<body>
    <div class="container">
        <div class="jumbotron">
        <h1>Login page</h1>
        <p>Be carefull, big bro watching you!</p>

      </div>
        <div class="row">
            <div class="col-md-4">
    <form method="post" action="">
  <div class="form-group">
    <label for="exampleInputEmail1">User</label>
    <input type="user" class="form-control" id="exampleInputEmail1" placeholder="User" name="user">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass">
  </div>

  <button type="submit" class="btn btn-default" name="log">Submit</button>
</form>
</div>
</div>
</div>
 </body>
 </html>
