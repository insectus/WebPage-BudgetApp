<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}else{
						require_once "connect.php";
						mysqli_report(MYSQLI_REPORT_STRICT);
							
						if (isset($_POST['selectTimePeriode']))
						{
							
							try 
							{
								$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
								if ($polaczenie->connect_errno!=0)
								{
									throw new Exception(mysqli_connect_errno());
								}
								else
								{
									if ($_POST['selectTimePeriode'] != 0){
										 
										 if($_POST['selectTimePeriode'] == 1){
										 $sql = "SELECT SUM(amount) FROM incomes WHERE MONTH(date_of_income) = MONTH(CURRENT_DATE())";
										 $rezultat = $polaczenie->query($sql);
										 
										$sumaInc = $rezultat->fetch_assoc();
										 										 
										 $sql = "SELECT SUM(amount) FROM expenses WHERE MONTH(date_of_expense) = MONTH(CURRENT_DATE())";
										 $rezultat = $polaczenie->query($sql);
										 
										 $sumaExp = $rezultat->fetch_assoc();
										 }else if($_POST['selectTimePeriode'] == 2){
											 $sql = "SELECT SUM(amount) FROM incomes WHERE MONTH(date_of_income) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";
										 $rezultat = $polaczenie->query($sql);
										 
										$sumaInc = $rezultat->fetch_assoc();										 
										 
										 $sql = "SELECT SUM(amount) FROM expenses WHERE MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";
										 $rezultat = $polaczenie->query($sql);
										 
										 $sumaExp = $rezultat->fetch_assoc();
										 }else if($_POST['selectTimePeriode'] == 3){
											$sql = "SELECT SUM(amount) FROM incomes WHERE MONTH(date_of_income) = YEAR(CURRENT_DATE())";
										 $rezultat = $polaczenie->query($sql);
										 
										 $sumaInc = $rezultat->fetch_assoc();
										 										 
										 $sql = "SELECT SUM(amount) FROM expenses WHERE MONTH(date_of_expense) = YEAR(CURRENT_DATE())";
										 $rezultat = $polaczenie->query($sql);
										 
										 $sumaExp = $rezultat->fetch_assoc();
										 }										 
																			 
										 $balance = $sumaInc['SUM(amount)']-$sumaExp['SUM(amount)'];
										 $polaczenie->close();}									
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
		
		<header>
	
			<nav class="navbar navbar-dark bg-budget navbar-expand-lg">
			
				<a class="navbar-brand" href="index.php"><img src="img/currency.png" width="30" height="30" class="d-inline-block mr-1 align-bottom" alt="">Twój budżet</a>
			
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
					<span class="navbar-toggler-icon"></span>
				</button>
			
				<div class="collapse navbar-collapse" id="mainmenu">
				
					<ul class="navbar-nav mr-auto">
					
						<li class="nav-item">
							<a class="nav-link" href="index.php"> Start </a>
						</li>
						
						<li class="nav-item">
							<a class="nav-link" href="incomes.php" > Przychodzy </a>
						</li>
						
						<li class="nav-item">
							<a class="nav-link" href="expense.php" > Wydatki </a>
						</li>
						
						<li class="nav-item active">
							<a class="nav-link active" href="balance.php" > Bilans </a>
						</li>
						
					</ul>
					
					<div class="navbar-nav">
						<a class="nav-link" href="logout.php">Wyloguj się!</a>
					</div>
				
				</div>
			
			</nav>
		
		</header>
		
		<main>
		
			<section class="budget">
		
				<div class="container-fluid">
					<form method="post">
						
						<header >
						
							<h1> Witaj drogi użytkowniku!</h1>
							<p>Ta aplikacja ma za zadanie pomóc Ci w zarządzaniu Twoim budżetem.</p>					
							
						</header>				
						
						<div class="selectdiv">	
						  <select class="custom-select" name = "selectTimePeriode">
							<option value = 0>--</option>
							<option value = 1>Bieżący miesiąc</option>
							<option value = 2>Poprzedni miesiąc</option>
							<option value = 3>Bieżący rok</option>
						  </select>											
						</div>
						<br>

						<div>
							<span><input type="submit" value="[Pokaż bilans]"></span>			
						</div>
						
					</form>	
					
					<?php	
						
						if (isset($_POST['selectTimePeriode'])){
							if ($_POST['selectTimePeriode'] == 0){
							echo"<br>Wybierz przedział czasowy. <br>";
						}else if (isset($_POST['selectTimePeriode']))	{				
							echo'<br> Przychody: '.$sumaInc['SUM(amount)']."<br>";
							echo' Wydatki: '.$sumaExp['SUM(amount)']."<br><br>";
							echo' Saldo: '.$balance."<br><br>";
							if($balance > 0){
								echo"Brawo! Świetnie zarządzasz finansami.";
							}else if($balance < 0){
								echo"Uważaj, wpadasz w długi!!!";
							}else if($balance == 0){
						echo"Spoko, ale widać lubisz życie na krawędzi!!!";}}
						}				
					?>
					
				</div>
			
			</section>
			
		</main>
		
		<div id="footer">
			Aplikacja budżetowa &copy; Wszelkie prawa zastrzeżone
		</div>
	
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	
	<script src="js/bootstrap.min.js"></script>

</html>