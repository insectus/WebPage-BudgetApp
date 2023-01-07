<?php

	session_start();
	
	if (isset($_POST['email']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		//Sprawdź poprawność nickname'a
		$username = $_POST['username'];
		
		//Sprawdzenie długości nicka
		if ((strlen($username)<3) || (strlen($username)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_username']="Nick musi posiadać od 3 do 20 znaków!";
		}
		
		if (ctype_alnum($username)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_username']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		
		// Sprawdź poprawność adresu email
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}
		
		//Sprawdź poprawność hasła
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
		}
		
		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne!";
		}	

		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		
		//Czy zaakceptowano regulamin?
		if (!isset($_POST['regulamin']))
		{
			$wszystko_OK=false;
			$_SESSION['e_regulamin']="Potwierdź akceptację regulaminu!";
		}				
		
		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_username'] = $username;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_haslo1'] = $haslo1;
		$_SESSION['fr_haslo2'] = $haslo2;
		if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//Czy email już istnieje?
				$rezultat = $polaczenie->query("SELECT id FROM users WHERE email='$email'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
				}		
				
				if ($wszystko_OK==true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
					
					if ($polaczenie->query("INSERT INTO users VALUES (NULL, '$username', '$haslo_hash', '$email')"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: index.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}		
	}	
?>


<!DOCTYPE HTML>
<html lang = "pl">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Aplikacja do zarządzania finansami osobistymi</title>
	<meta name = "description" content = "Zapanuj nad swoimi finansami">
	<meta name = "keywords"	content = "budżet, finanse, oszczędzanie, pieniądze, wydatki, przychody, szczęście">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="main.css" type="text/css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
</head>

<body>
	<header>
		<nav class="navbar navbar-dark bg-budget navbar-expand-lg">
		
			<a class="navbar-brand" href="index.php"><img src="img/currency.png" width="30" height="30" class="d-inline-block mr-1 align-bottom" alt="">Twój budżet</a>
			
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
			<span class="navbar-toggler-icon"></span>
			</button>
			
		</nav>
	</header>
	
	<main>
		<section class="budget">
			<div class="container-fluid">

			
				<h1> Formularz rejestracji</h1>
				<p>Zarejestruj się aby odkryć jakie możliwości daje aplikacja</p>
			
				<div class="row">	
					<div id="registrationcontainer">
						<div class="col-sm-12 col-md-5">
						
							<form method="post">
								<input type="text" value="<?php
									if (isset($_SESSION['fr_username']))
										{
											echo $_SESSION['fr_username'];
											unset($_SESSION['fr_username']);
										} 
								?>" name="username" placeholder="Imię" onfocus="this.placeholder=''" onblur="this.placeholder='Imię'" required>

								<?php
									if (isset($_SESSION['e_username']))
									{
										echo '<div class="error">'.$_SESSION['e_username'].'</div>';
										unset($_SESSION['e_username']);
									}
								?>

								<input type="email" value="<?php
									if (isset($_SESSION['fr_email']))
									{
										echo $_SESSION['fr_email'];
										unset($_SESSION['fr_email']);
									}
								?>" name="email" placeholder="E-mail" onfocus="this.placeholder=''" onblur="this.placeholder='E-mail'" required>

								<?php
									if (isset($_SESSION['e_email']))
									{
										echo '<div class="error">'.$_SESSION['e_email'].'</div>';
										unset($_SESSION['e_email']);
									}
								?>

								<input type="password" value="<?php
									if (isset($_SESSION['fr_haslo1']))
									{
										echo $_SESSION['fr_haslo1'];
										unset($_SESSION['fr_haslo1']);
									}
								?>" name="haslo1" placeholder="Hasło" onfocus="this.placeholder=''" onblur="this.placeholder='Hasło'" required>

								<?php
									if (isset($_SESSION['e_haslo']))
									{
										echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
										unset($_SESSION['e_haslo']);
									}
								?>

								<input type="password" value="<?php
									if (isset($_SESSION['fr_haslo2']))
									{
										echo $_SESSION['fr_haslo2'];
										unset($_SESSION['fr_haslo2']);
									}
								?>" name="haslo2" placeholder="Powtórz hasło" onfocus="this.placeholder=''" onblur="this.placeholder='Powtórz hasło'" required>

								
								<label id="checklabel">
									<input type="checkbox" name="regulamin" 
									<?php
										if (isset($_SESSION['fr_regulamin']))
										{
											echo "checked";
											unset($_SESSION['fr_regulamin']);
										}
									?>/> Akceptuję regulamin
								</label>
								
													
								<?php
									if (isset($_SESSION['e_regulamin']))
									{
										echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
										unset($_SESSION['e_regulamin']);
									}
								?>	
								
								<br/>
								
								<input type="submit" value="Zarejestruj się!">
							
							</form>
							
						</div>
					
					</div>
				
				</div>
			
			</div>
		
		</section>
	
	</main>
	
		<footer class="navbar-text fixed-bottom text-center bg-dark">
			Aplikacja budżetowa &copy; Wszelkie prawa zastrzeżone
		</footer>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>