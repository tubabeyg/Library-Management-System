<?php
session_start();
if(isset($_POST['submit']) )
{
  
  $host="remotemysql.com";
  $port=3306;
  $socket="";
  $user="sLNIZ77zSi";
  $password="mvTko0S5qp";
  $dbname="sLNIZ77zSi";

  try {
      $con = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
      $loginid_ = $_POST['loginid'];
      $pass = $_POST['password'];
  
      $sql = "SELECT login_id,passcode FROM library_account WHERE login_id=? AND passcode=? AND is_student='false'";
      $stmt= $con->prepare($sql);
      $stmt->execute([$loginid_,$pass]);
    
      $result = $stmt->fetch();
      if(gettype($result)=="boolean"){
        echo "<script>alert('Invalid Credentials')</script>";
        header( "Refresh:1; url=index.php", true, 303);

      }
      else{
        echo "<script>alert('Logged in successfully')</script>";
        $_SESSION['user'] = $loginid_;
        header( "Refresh:1; url=homelogin.php", true, 303);
      }
    
  }

  catch (PDOException $e) {
    echo "<script>alert('Error')</script>";
    header( "Refresh:1; url=index.php", true, 303);
  }


  
 
}

?>


