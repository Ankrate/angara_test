<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1);
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');

p($_POST);
if(isset($_POST['log'])) {
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);
    $auth = authorization($user,$pass);
    $username = $auth[0]['user'];
    $password = $auth[0]['pass'];
    $type = $auth[0]['type'];
    $name = $auth[0]['username'];
    $user_id = $auth[0]['id'];
    if($user == $username && $pass == $password) {
        session_start();
        $_SESSION['name'] = $name;
        $_SESSION['type'] = $type;
        $_SESSION['user_id'] = $user_id;
        if($type == 'admin'){
            echo '<script>location.assign("val.php")</script>';
        }elseif($type == 'editor'){
            echo '<script>location.assign("content_manager.php")</script>';
        }else{
            echo '<script>location.assign("user.php")</script>';
        }
    }
    p($auth);
}

?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
    <div class="container">
        <div class="jumbotron">
        <h1>Login page</h1>
        <p>This example is a quick exercise to illustrate how the default, static and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
        <p>To see the difference between static and fixed top navbars, just scroll.</p>
      </div>
        <div class="row">
            <div class="col-md-4">
    <form method="post" action="">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
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
    
