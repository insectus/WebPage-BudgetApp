<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}else{
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
			
		if (isset($_POST['currency-field']) && isset($_POST['date'])  && isset($_POST['comment']))
		{
			$expense_category_assigned_to_user_id = $_POST['selectCategory']; 
			$payment_method_assigned_to_user_id =  $_POST['selectPaymentMethod'];
			$amount = $_POST['currency-field'];
			$date_of_expense = $_POST['date'];
			$expense_comment = $_POST['comment'];
			$wszystko_OK = true;		
		
			try 
			{
				$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
				if ($polaczenie->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_errno());
				}
				else
				{
					$userid = $_SESSION['id'];
					if ($wszystko_OK==true)
					{
						
						if ($polaczenie->query("INSERT INTO expenses VALUES (NULL, '$userid', '$expense_category_assigned_to_user_id', '$payment_method_assigned_to_user_id', '$amount', '$date_of_expense', '$expense_comment')"))
						{
							$_SESSION['udanarejestracja']=true;
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
	
	<div id="container">
	
		<header>
	
			<nav class="navbar navbar-dark bg-budget navbar-expand-lg">
			
				<a class="navbar-brand" href="index.php"><img src="img/currency.png" width="30" height="30" class="d-inline-block mr-1 align-bottom" alt="">Twój budżet</a>
			
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
					<span class="navbar-toggler-icon"></span>
				</button>
			
				<div class="collapse navbar-collapse" id="mainmenu">
				
					<ul class="navbar-nav mr-auto">
					
						<li class="nav-item ">
							<a class="nav-link" href="index.php"> Start </a>
						</li>
						
						<li class="nav-item">
							<a class="nav-link" href="incomes.php" > Przychodzy </a>
						</li>
						
						<li class="nav-item active">
							<a class="nav-link" href="expense.php" > Wydatki </a>
						</li>
						
						<li class="nav-item">
							<a class="nav-link" href="balance.php" > Bilans </a>
						</li>

					</ul>
					
					<div class="navbar-nav">
						<a class="nav-link" href="logout.php">Wyloguj się!</a>
					</div>
				
				</div>
			
			</nav>
		
		</header>
		
		<div id="content">
		
		<main>
		
			<div class="container-fluid">
				<div id="expensecontainer">
					<form method="post">
					
						<h3> Dodaj wydatek </h3>
						
						<div>					
							<fieldset>						
								<legend> Kwota </legend>				
								<input type="number" name="currency-field" step="0.01" min="0.00"  id="currency-field" value="" data-type="currency" placeholder="1,000.00 PLN" required>					
							</fieldset>					
						</div>
						
						<div>				
							<fieldset>						
								<legend> Data </legend>						
								<input type="date" name = "date" min="" id="date" required>				
							</fieldset>				
						</div>
						
						<div>						
							<legend> Sposób płatności: </legend>
								<select class="custom-select" name = "selectPaymentMethod">
									<option value = 0>Gotówka</option>
									<option value = 1>Karta kredytowa</option>
									<option value = 2>Karta debetowa</option>
								 </select>
						</div>
						<br><br>
						<div>						
							<legend> Kategoria: </legend>
								<select class="custom-select" name = "selectCategory">
									<option value = 0>Jedzenie</option>
									<option value = 1>Mieszkanie</option>
									<option value = 2>Transport</option>
									<option value = 3>Telekomunikacja</option>
									<option value = 4>Opieka zdrowotna</option>
									<option value = 5>Ubranie</option>
									<option value = 6>Higiena</option>
									<option value = 7>Dzieci</option>
									<option value = 8>Rozrywka</option>
									<option value = 9>Wycieczka</option>
									<option value = 10>Szkolenia</option>
									<option value = 11>Książki</option>
									<option value = 12>Oszczędności</option>
									<option value = 13>Na emeryturę</option>
									<option value = 14>Spłata długów</option>
									<option value = 15>Darowizna</option>
									<option value = 16>Inne wydatki</option>
								 </select>
						</div>
						
						<br><br>
						
						<div>
							<label for="comment"> Komentarz (opcjonalnie): </label>	
						</div>
						
						<div>
							<textarea name="comment" id="comment" rows="4" cols="80" maxlength="100" minlength="5" placeholder="np.: Wydatki z Art. 197. §1 oraz Art. 282. KK"></textarea>
						</div>
						
						<div>
							<span style="margin-right:10px; padding: 0px 0px 20px 0px; "><input type="submit" value="[Dodaj]"></span>
							<span><input type="reset" value="[Anuluj]"></span>
						</div>		
						
					</form>
				</div>
			</div>
			
		</main>
			
		</div>
		
		
		<div id="footer">
			Aplikacja budżetowa &copy; Wszelkie prawa zastrzeżone
		</div>
	
	</div>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>	
	<script src="js/bootstrap.min.js"></script>
</html>