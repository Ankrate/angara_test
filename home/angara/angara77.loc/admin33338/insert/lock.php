<?php
require_once('../../app/config.php');
$con=mysqli_connect(ANG_HOST,ANG_DBUSER,ANG_DBPASS,ANG_DBNAME);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

if (!isset($_SERVER['PHP_AUTH_USER']))

{
        Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
        Header ("HTTP/1.0 401 Unauthorized");
        exit();
}

else {
        if (!get_magic_quotes_gpc()) {
                $_SERVER['PHP_AUTH_USER'] = mysqli_escape_string($con,$_SERVER['PHP_AUTH_USER']);
                $_SERVER['PHP_AUTH_PW'] = mysqli_escape_string($con,$_SERVER['PHP_AUTH_PW']);
        }

        $query = "SELECT pass FROM ang_userlist WHERE user='".$_SERVER['PHP_AUTH_USER']."'";
        $lst = mysqli_query($con,$query);
        

        if (!$lst)
        {
            Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
        Header ("HTTP/1.0 401 Unauthorized");
        exit();
        }

        if (mysqli_num_rows($lst) == 0)
        {
           Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
           Header ("HTTP/1.0 401 Unauthorized");
           exit();
        }

        $pass =  mysqli_fetch_array($lst);
        
        if ($_SERVER['PHP_AUTH_PW']!= $pass['pass'])
        {
            Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
           Header ("HTTP/1.0 401 Unauthorized");
           exit();
        }


}

