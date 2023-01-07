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
			$incomes_category_assigned_to_user_id = $_POST['selectCategory']; 
			$amount = $_POST['currency-field'];
			$date_of_income = $_POST['date'];
			$income_comment = $_POST['comment'];
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
						
						if ($polaczenie->query("INSERT INTO incomes VALUES (NULL, '$userid', '$incomes_category_assigned_to_user_id', '$amount', '$date_of_income', '$income_comment')"))
						{					
							$_SESSION['komunikat'] = 'Dane zapisane! :)';			
						}
						else
						{
							throw new Exception($polaczenie->error);
							$_SESSION['komunikat'] = 'Coś się nie udało :(';
						}
						
					}
					header('Location: ' . $_SERVER['REQUEST_URI']);
					$polaczenie->close();
					exit;					
				}
				
			}
			catch(Exception $e)
			{
				echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności!</span>';
				echo '<br />Informacja developerska: '.$e;
			}
		}
	}
	
	$month = date('m');
	$day = date('d');
	$year = date('Y');

	$today = $year . '-' . $month . '-' . $day;	

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

<style>
	textarea {
	  resize: none;
	  width: 300px;
	}
</style>
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
						
						<li class="nav-item active">
							<a class="nav-link" href="incomes.php" > Przychody </a>
						</li>
						
						<li class="nav-item">
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
			
				<div class="selectdiv">

					<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">
					<br>
					<?php 
						
						if(isset($_SESSION['komunikat']))
						{
							?>
								<div class="alert alert-warning alert-dismissible fade show" role="alert">
								  <?= $_SESSION['komunikat']; ?>
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
								</div>
							<?php 
							unset($_SESSION['komunikat']);
						}

					?>
						
						<h3> Dodaj przychód </h3>
						
						<div>					
							<fieldset>						
								<legend> Kwota: </legend>				
								<input type="number" name="currency-field" step="0.01" min="0.00" id="currency-field" value="" data-type="currency" placeholder="10.00 PLN" required>					
							</fieldset>					
						</div>
						
						<div>				
							<fieldset>						
								<legend> Data: </legend>						
								<input type="date" value="<?php echo $today; ?>" name = "date" min="2000-01-01" id="date" required>				
							</fieldset>				
						</div>
						
						<div>		
							<legend> Kategoria: </legend>
								<select class="custom-select"  name = "selectCategory">
									<option value = 0>Wynagrodzenie</option>
									<option value = 1>Odsetki bankowe</option>
									<option value = 2>Sprzedaż na allegro</option>
									<option value = 3>Inne</option>
								</select>
						</div>
						
						<br><br>
						
						<div>
							<label for="comment"> Komentarz (opcjonalnie): </label>
						</div>
						
						<div>
							<textarea name="comment" id="comment" rows="2" maxlength="100" minlength="5"  placeholder="To jest miejsce na Twoje notatki"></textarea>
						</div>
						
						<div>
							<span style="margin-right:14px; padding: 0px 0px 20px 0px; "><input type="submit" value="Dodaj"></span>
							<br>
							<span><input type="reset" value="Anuluj"></span>
						</div>		
						
					</form>
					
					
				</div>
			</div>
			
		</main>
		</div>
	</div>
	
	<footer class="navbar-text fixed-bottom text-center bg-dark">
			Aplikacja budżetowa &copy; Wszelkie prawa zastrzeżone
		</footer>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>	
	<script src="js/bootstrap.min.js"></script>
	</body>
</html>