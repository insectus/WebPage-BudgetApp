<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
		{
			header('Location: balance.php');
			exit();
		}
?>

<!DOCTYPE HTML>

<html lang = "pl">

<head>
	<meta charset ="utf-8"/>
	<title>Aplikacja do zarządzania finansami osobistymi</title>
	<meta name = "description" content = "Zapanuj nad swoimi finansami"/>
	<meta name = "keywords"	content = "budżet, finanse, oszczędzanie, pieniądze, wydatki, przychody, szczęście"/>
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="main.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
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
						
						<?php
							if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
							{											
								'<li class="nav-item">
									<a class="nav-link" href="expense.php" > Wydatki </a>
								</li>
								
								<li class="nav-item">
									<a class="nav-link" href="balance.php" > Bilans </a>
								</li>';
							}
						?>

					</ul>
				
				</div>
			
			</nav>
		
		</header>
		
		<main>
		
			<section class="budget">
		
				<div class="container-fluid">
					
						<header >
						
							<h1> Formularz logowania</h1>
							<p>Zaloguj się aby w pełni korzystać z wszystkich funkcji.</p>
							
						</header>
						
					<div class="row">	
					
						<div id="logincontainer">
						
							<div class="col-sm-12 col-md-5">
					
								<form action="login.php" method="post">
	
									<input type="text" name="lgn" placeholder="E-mail" onfocus="this.placeholder=''" onblur="this.placeholder='E-mail'" required>
																
									<input type="password" name="pwd" placeholder="Hasło" onfocus="this.placeholder=''" onblur="this.placeholder='Hasło'" required>
									
									<?php
										if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
									?>
								
									<input type="submit" value="Zaloguj się">
	
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
	
	</div>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	
	<script src="js/bootstrap.min.js"></script>

	</body>

</html>