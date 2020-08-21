<?php
 function signup_insert_validate($salt,$conn)
 {

	if(strlen($_POST['new_password']) >= 1 && strlen($_POST['new_email']) >= 1 && strlen($_POST['new_username']) >= 1)
		{
			  if (strpos($_POST['new_email'],'@') === false) 
					return "Email must have an at-sign (@)";
		            
		      
		      $pass = hash('md5', $salt.$_POST["new_password"]);
			  $stmt = $conn->prepare('INSERT INTO user (user_name,email,pwd)
				  VALUES ( :u, :e, :p)');
			
			  $stmt->execute(array(
			  ':u' => $_POST['new_username'],
			  ':e' => $_POST['new_email'],
			  ':p' => $pass));
		}
	
		else
			return "all fields are required";
			
}

function login_validate($salt,$conn)
{

	if ( strlen($_POST['login_password']) >= 1 && strlen($_POST['login_email']) >= 1)
	{
		
        $check = hash('md5', $salt.$_POST["login_password"]);
        //Check if input matches with registered user name
		$stmt = $conn->prepare('SELECT user_id,user_name FROM user WHERE user_name = :em AND pwd = :pw');
		$stmt->execute(array( ':em' => $_POST["login_email"], ':pw' => $check));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

           //If matches, then true
           if ( $row !== false ) 
             {
         		$_SESSION['user_name'] = $row['user_name'];
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION["login"]=true;
             }
             //else check if it matches with registered email
              else
              {
              	if (strpos($_POST['login_email'],'@') === false) 
	  				return "Invalid Email";
              	$stmt = $conn->prepare('SELECT user_id,user_name FROM user WHERE email = :em AND pwd = :pw');
              	$stmt->execute(array( ':em' => $_POST["login_email"], ':pw' => $check));
              	$row = $stmt->fetch(PDO::FETCH_ASSOC);
              	
              		//If matches good
						if ( $row !== false ) 
              		    {
              				$_SESSION['user_name'] = $row['user_name'];
              		       $_SESSION['user_id'] = $row['user_id'];
              		       $_SESSION["login"]=true;
              		    }
              	
              	else
                  return "Incorrect Credentials";
              }
    }
    else
    	return "all fields are required";
		
}
?>