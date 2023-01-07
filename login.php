<?php

	session_start();
	
	if ((!isset($_POST['lgn'])) || (!isset($_POST['pwd'])))
	{
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$lgn = $_POST['lgn'];
		$pwd = $_POST['pwd'];
		
		
		$lgn = htmlentities($lgn, ENT_QUOTES, "UTF-8");
		$pwd = htmlentities($pwd, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM users WHERE email='%s'",
		mysqli_real_escape_string($polaczenie,$lgn))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$_SESSION['zalogowany'] = true;
				
				$wiersz = $rezultat->fetch_assoc();
				$_SESSION['id'] = $wiersz['id'];
				$_SESSION['username'] = $wiersz['username'];
				$_SESSION['email'] = $wiersz['email'];
				
				unset($_SESSION['blad']);
				$rezultat->free_result();
				header('Location: index.php');
				
			} else {
				
				$_SESSION['blad'] = '<div class="error">Nieprawidłowy login lub hasło!</div>';
				header('Location: login_page.php');
				
			}
			
		}
		
		$polaczenie->close();
	}
	
?>