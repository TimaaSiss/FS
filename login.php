<?php
include"db_conn.php";
if(isset($_POST['username']) && isset($_POST['password'])){
	function validate($data){
		$data=trim($data);
		$data=stripcslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
   $username= validate($_POST['username']);
   $password= validate($_POST['password']);

   if(empty($username)){
   	  header("Location: index.php?error=User Name is required");
	exit();

   }else if(empty($password)){
        header("Location: index.php?error=Password is required");
	exit();
   }else{
   	  $sql= "SELECT * FROM users WHERE user_name='$username' AND password= '$password'";

   	  $result= mysqli_query($conn, $sql);

   	  if(mysqli_num_rows($result)){
   	  	echo "Hello";
   	  }

   }

}else{
	header("Location: index.php");
	exit();
}
?>