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
							 																 
							$sql = "SELECT SUM(amount) FROM incomes WHERE (MONTH(date_of_income) = MONTH(CURRENT_DATE())) AND (income_category_assigned_to_user_id = 0)";
							$rezultat = $polaczenie->query($sql);
							$sumaSalary = $rezultat->fetch_assoc();
							
							$sql = "SELECT SUM(amount) FROM incomes WHERE (MONTH(date_of_income) = MONTH(CURRENT_DATE())) AND (income_category_assigned_to_user_id = 1)";
							$rezultat = $polaczenie->query($sql);
							$sumaInterest = $rezultat->fetch_assoc();
							
							$sql = "SELECT SUM(amount) FROM incomes WHERE (MONTH(date_of_income) = MONTH(CURRENT_DATE())) AND (income_category_assigned_to_user_id = 2)";
							$rezultat = $polaczenie->query($sql);
							$sumaAllegro = $rezultat->fetch_assoc();
							
							$sql = "SELECT SUM(amount) FROM incomes WHERE (MONTH(date_of_income) = MONTH(CURRENT_DATE())) AND (income_category_assigned_to_user_id = 3)";
							$rezultat = $polaczenie->query($sql);
							$sumaOther = $rezultat->fetch_assoc();

							
							 $sql = "SELECT SUM(amount) FROM expenses WHERE MONTH(date_of_expense) = MONTH(CURRENT_DATE())";
							 $rezultat = $polaczenie->query($sql);
							 $sumaExp = $rezultat->fetch_assoc();
							 
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 0)";
							$rezultat = $polaczenie->query($sql);
							$sumaFood = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 1)";
							$rezultat = $polaczenie->query($sql);
							$sumaLiving = $rezultat->fetch_assoc();
							
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 2)";
							$rezultat = $polaczenie->query($sql);
							$sumaTransport = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 3)";
							$rezultat = $polaczenie->query($sql);
							$sumaTelCom = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 4)";
							$rezultat = $polaczenie->query($sql);
							$sumaHealth = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 5)";
							$rezultat = $polaczenie->query($sql);
							$sumaCloth = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 6)";
							$rezultat = $polaczenie->query($sql);
							$sumaHygien = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 7)";
							$rezultat = $polaczenie->query($sql);
							$sumaKids = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 8)";
							$rezultat = $polaczenie->query($sql);
							$sumaEntert = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 9)";
							$rezultat = $polaczenie->query($sql);
							$sumaTrip = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 10)";
							$rezultat = $polaczenie->query($sql);
							$sumaSchool = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 11)";
							$rezultat = $polaczenie->query($sql);
							$sumaBooks = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 12)";
							$rezultat = $polaczenie->query($sql);
							$sumaSeves = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 13)";
							$rezultat = $polaczenie->query($sql);
							$sumaReti = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 14)";
							$rezultat = $polaczenie->query($sql);
							$sumaLoan = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 15)";
							$rezultat = $polaczenie->query($sql);
							$sumaGift = $rezultat->fetch_assoc();
							 							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 16)";
							$rezultat = $polaczenie->query($sql);
							$sumaOtherExp = $rezultat->fetch_assoc();
							 
							 
							 }else if($_POST['selectTimePeriode'] == 2){
								 $sql = "SELECT SUM(amount) FROM incomes WHERE MONTH(date_of_income) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";
							 $rezultat = $polaczenie->query($sql);
							 
							$sumaInc = $rezultat->fetch_assoc();

							$sql = "SELECT SUM(amount) FROM incomes WHERE (MONTH(date_of_income) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (income_category_assigned_to_user_id = 0)";
							$rezultat = $polaczenie->query($sql);
							$sumaSalary = $rezultat->fetch_assoc();
							
							$sql = "SELECT SUM(amount) FROM incomes WHERE (MONTH(date_of_income) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (income_category_assigned_to_user_id = 1)";
							$rezultat = $polaczenie->query($sql);
							$sumaInterest = $rezultat->fetch_assoc();
							
							$sql = "SELECT SUM(amount) FROM incomes WHERE (MONTH(date_of_income) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (income_category_assigned_to_user_id = 2)";
							$rezultat = $polaczenie->query($sql);
							$sumaAllegro = $rezultat->fetch_assoc();
							
							$sql = "SELECT SUM(amount) FROM incomes WHERE (MONTH(date_of_income) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (income_category_assigned_to_user_id = 3)";
							$rezultat = $polaczenie->query($sql);
							$sumaOther = $rezultat->fetch_assoc();

							 
							 $sql = "SELECT SUM(amount) FROM expenses WHERE MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";
							 $rezultat = $polaczenie->query($sql);
							 
							 $sumaExp = $rezultat->fetch_assoc();
							 
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (expense_category_assigned_to_user_id = 0)";
							$rezultat = $polaczenie->query($sql);
							$sumaFood = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (expense_category_assigned_to_user_id = 1)";
							$rezultat = $polaczenie->query($sql);
							$sumaLiving = $rezultat->fetch_assoc();
							
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (expense_category_assigned_to_user_id = 2)";
							$rezultat = $polaczenie->query($sql);
							$sumaTransport = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (expense_category_assigned_to_user_id = 3)";
							$rezultat = $polaczenie->query($sql);
							$sumaTelCom = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (expense_category_assigned_to_user_id = 4)";
							$rezultat = $polaczenie->query($sql);
							$sumaHealth = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (expense_category_assigned_to_user_id = 5)";
							$rezultat = $polaczenie->query($sql);
							$sumaCloth = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (expense_category_assigned_to_user_id = 6)";
							$rezultat = $polaczenie->query($sql);
							$sumaHygien = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (expense_category_assigned_to_user_id = 7)";
							$rezultat = $polaczenie->query($sql);
							$sumaKids = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (expense_category_assigned_to_user_id = 8)";
							$rezultat = $polaczenie->query($sql);
							$sumaEntert = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (expense_category_assigned_to_user_id = 9)";
							$rezultat = $polaczenie->query($sql);
							$sumaTrip = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (expense_category_assigned_to_user_id = 10)";
							$rezultat = $polaczenie->query($sql);
							$sumaSchool = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (expense_category_assigned_to_user_id = 11)";
							$rezultat = $polaczenie->query($sql);
							$sumaBooks = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (expense_category_assigned_to_user_id = 12)";
							$rezultat = $polaczenie->query($sql);
							$sumaSeves = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (expense_category_assigned_to_user_id = 13)";
							$rezultat = $polaczenie->query($sql);
							$sumaReti = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (expense_category_assigned_to_user_id = 14)";
							$rezultat = $polaczenie->query($sql);
							$sumaLoan = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (expense_category_assigned_to_user_id = 15)";
							$rezultat = $polaczenie->query($sql);
							$sumaGift = $rezultat->fetch_assoc();
							 							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (MONTH(date_of_expense) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND (expense_category_assigned_to_user_id = 16)";
							$rezultat = $polaczenie->query($sql);
							$sumaOtherExp = $rezultat->fetch_assoc();
							 
							 }else if($_POST['selectTimePeriode'] == 3){
							
								$sql = "SELECT SUM(amount) FROM incomes WHERE YEAR(date_of_income) = YEAR(CURRENT_DATE())";
							 $rezultat = $polaczenie->query($sql);
							 
							 $sumaInc = $rezultat->fetch_assoc();
							 
							 $sql = "SELECT SUM(amount) FROM incomes WHERE (YEAR(date_of_income) = YEAR(CURRENT_DATE())) AND (income_category_assigned_to_user_id = 0)";
							$rezultat = $polaczenie->query($sql);
							$sumaSalary = $rezultat->fetch_assoc();
							
							$sql = "SELECT SUM(amount) FROM incomes WHERE (YEAR(date_of_income) = YEAR(CURRENT_DATE())) AND (income_category_assigned_to_user_id = 1)";
							$rezultat = $polaczenie->query($sql);
							$sumaInterest = $rezultat->fetch_assoc();
							
							$sql = "SELECT SUM(amount) FROM incomes WHERE (YEAR(date_of_income) = YEAR(CURRENT_DATE())) AND (income_category_assigned_to_user_id = 2)";
							$rezultat = $polaczenie->query($sql);
							$sumaAllegro = $rezultat->fetch_assoc();
							
							$sql = "SELECT SUM(amount) FROM incomes WHERE (YEAR(date_of_income) = YEAR(CURRENT_DATE())) AND (income_category_assigned_to_user_id = 3)";
							$rezultat = $polaczenie->query($sql);
							$sumaOther = $rezultat->fetch_assoc();
																	 
							 $sql = "SELECT SUM(amount) FROM expenses WHERE YEAR(date_of_expense) = YEAR(CURRENT_DATE())";
							 $rezultat = $polaczenie->query($sql);
							 
							 $sumaExp = $rezultat->fetch_assoc();
							 
							  $sql = "SELECT SUM(amount) FROM expenses WHERE (YEAR(date_of_expense) = YEAR(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 0)";
							$rezultat = $polaczenie->query($sql);
							$sumaFood = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (YEAR(date_of_expense) = YEAR(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 1)";
							$rezultat = $polaczenie->query($sql);
							$sumaLiving = $rezultat->fetch_assoc();
							
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (YEAR(date_of_expense) = YEAR(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 2)";
							$rezultat = $polaczenie->query($sql);
							$sumaTransport = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (YEAR(date_of_expense) = YEAR(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 3)";
							$rezultat = $polaczenie->query($sql);
							$sumaTelCom = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (YEAR(date_of_expense) = YEAR(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 4)";
							$rezultat = $polaczenie->query($sql);
							$sumaHealth = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (YEAR(date_of_expense) = YEAR(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 5)";
							$rezultat = $polaczenie->query($sql);
							$sumaCloth = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (YEAR(date_of_expense) = YEAR(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 6)";
							$rezultat = $polaczenie->query($sql);
							$sumaHygien = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (YEAR(date_of_expense) = YEAR(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 7)";
							$rezultat = $polaczenie->query($sql);
							$sumaKids = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (YEAR(date_of_expense) = YEAR(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 8)";
							$rezultat = $polaczenie->query($sql);
							$sumaEntert = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (YEAR(date_of_expense) = YEAR(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 9)";
							$rezultat = $polaczenie->query($sql);
							$sumaTrip = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (YEAR(date_of_expense) = YEAR(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 10)";
							$rezultat = $polaczenie->query($sql);
							$sumaSchool = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (YEAR(date_of_expense) = YEAR(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 11)";
							$rezultat = $polaczenie->query($sql);
							$sumaBooks = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (YEAR(date_of_expense) = YEAR(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 12)";
							$rezultat = $polaczenie->query($sql);
							$sumaSeves = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (YEAR(date_of_expense) = YEAR(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 13)";
							$rezultat = $polaczenie->query($sql);
							$sumaReti = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (YEAR(date_of_expense) = YEAR(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 14)";
							$rezultat = $polaczenie->query($sql);
							$sumaLoan = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (YEAR(date_of_expense) = YEAR(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 15)";
							$rezultat = $polaczenie->query($sql);
							$sumaGift = $rezultat->fetch_assoc();
							 							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (YEAR(date_of_expense) = YEAR(CURRENT_DATE())) AND (expense_category_assigned_to_user_id = 16)";
							$rezultat = $polaczenie->query($sql);
							$sumaOtherExp = $rezultat->fetch_assoc();
							 
							 }else if($_POST['selectTimePeriode'] == 4){
								
								$dateB = $_POST['dateBegin'];
								$dateE = $_POST['dateEnd'];			
								
								if($dateE < $dateB){
									$buffer = $dateE;
									$dateE = $dateB;
									$dateB = $buffer;
								}
								
							$sql = "SELECT SUM(amount) FROM incomes WHERE date_of_income BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')";
							
							 $rezultat = $polaczenie->query($sql);
							 
							 $sumaInc = $rezultat->fetch_assoc();
							 
							  $sql = "SELECT SUM(amount) FROM incomes WHERE (date_of_income BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (income_category_assigned_to_user_id = 0)";
							$rezultat = $polaczenie->query($sql);
							$sumaSalary = $rezultat->fetch_assoc();
							
							$sql = "SELECT SUM(amount) FROM incomes WHERE (date_of_income BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (income_category_assigned_to_user_id = 1)";
							$rezultat = $polaczenie->query($sql);
							$sumaInterest = $rezultat->fetch_assoc();
							
							$sql = "SELECT SUM(amount) FROM incomes WHERE (date_of_income BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (income_category_assigned_to_user_id = 2)";
							$rezultat = $polaczenie->query($sql);
							$sumaAllegro = $rezultat->fetch_assoc();
							
							$sql = "SELECT SUM(amount) FROM incomes WHERE (date_of_income BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (income_category_assigned_to_user_id = 3)";
							$rezultat = $polaczenie->query($sql);
							$sumaOther = $rezultat->fetch_assoc();
							 
							 $sql = "SELECT SUM(amount) FROM expenses WHERE date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')";					
							 
							 $rezultat = $polaczenie->query($sql);
							 
							 $sumaExp = $rezultat->fetch_assoc();
							 
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (expense_category_assigned_to_user_id = 0)";
							$rezultat = $polaczenie->query($sql);
							$sumaFood = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (expense_category_assigned_to_user_id = 1)";
							$rezultat = $polaczenie->query($sql);
							$sumaLiving = $rezultat->fetch_assoc();
							
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (expense_category_assigned_to_user_id = 2)";
							$rezultat = $polaczenie->query($sql);
							$sumaTransport = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (expense_category_assigned_to_user_id = 3)";
							$rezultat = $polaczenie->query($sql);
							$sumaTelCom = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (expense_category_assigned_to_user_id = 4)";
							$rezultat = $polaczenie->query($sql);
							$sumaHealth = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (expense_category_assigned_to_user_id = 5)";
							$rezultat = $polaczenie->query($sql);
							$sumaCloth = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (expense_category_assigned_to_user_id = 6)";
							$rezultat = $polaczenie->query($sql);
							$sumaHygien = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (expense_category_assigned_to_user_id = 7)";
							$rezultat = $polaczenie->query($sql);
							$sumaKids = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (expense_category_assigned_to_user_id = 8)";
							$rezultat = $polaczenie->query($sql);
							$sumaEntert = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (expense_category_assigned_to_user_id = 9)";
							$rezultat = $polaczenie->query($sql);
							$sumaTrip = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (expense_category_assigned_to_user_id = 10)";
							$rezultat = $polaczenie->query($sql);
							$sumaSchool = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (expense_category_assigned_to_user_id = 11)";
							$rezultat = $polaczenie->query($sql);
							$sumaBooks = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (expense_category_assigned_to_user_id = 12)";
							$rezultat = $polaczenie->query($sql);
							$sumaSeves = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (expense_category_assigned_to_user_id = 13)";
							$rezultat = $polaczenie->query($sql);
							$sumaReti = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (expense_category_assigned_to_user_id = 14)";
							$rezultat = $polaczenie->query($sql);
							$sumaLoan = $rezultat->fetch_assoc();
							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (expense_category_assigned_to_user_id = 15)";
							$rezultat = $polaczenie->query($sql);
							$sumaGift = $rezultat->fetch_assoc();
							 							  
							 $sql = "SELECT SUM(amount) FROM expenses WHERE (date_of_expense BETWEEN STR_TO_DATE('$dateB','%Y-%m-%d')  AND STR_TO_DATE('$dateE','%Y-%m-%d')) AND (expense_category_assigned_to_user_id = 16)";
							$rezultat = $polaczenie->query($sql);
							$sumaOtherExp = $rezultat->fetch_assoc();
				 						 
							 }	
							
							 if($sumaSalary['SUM(amount)'] == NULL)$sumaSalary['SUM(amount)'] = '0.00';	
							 if($sumaInterest['SUM(amount)'] == NULL)$sumaInterest['SUM(amount)'] = '0.00';	
							 if($sumaAllegro['SUM(amount)'] == NULL)$sumaAllegro['SUM(amount)'] = '0.00';	
							 if($sumaOther['SUM(amount)'] == NULL)$sumaOther['SUM(amount)'] = '0.00';	
							 if($sumaFood['SUM(amount)'] == NULL)$sumaFood['SUM(amount)'] = '0.00';	
							 if($sumaLiving['SUM(amount)'] == NULL)$sumaLiving['SUM(amount)'] = '0.00';	
							 if($sumaTransport['SUM(amount)'] == NULL)$sumaTransport['SUM(amount)'] = '0.00';	
							 if($sumaTelCom['SUM(amount)'] == NULL)$sumaTelCom['SUM(amount)'] = '0.00';	
							 if($sumaHealth['SUM(amount)'] == NULL)$sumaHealth['SUM(amount)'] = '0.00';	
							 if($sumaCloth['SUM(amount)'] == NULL)$sumaCloth['SUM(amount)'] = '0.00';	
							 if($sumaHygien['SUM(amount)'] == NULL)$sumaHygien['SUM(amount)'] = '0.00';	
							 if($sumaKids['SUM(amount)'] == NULL)$sumaKids['SUM(amount)'] = '0.00';	
							 if($sumaEntert['SUM(amount)'] == NULL)$sumaEntert['SUM(amount)'] = '0.00';	
							 if($sumaTrip['SUM(amount)'] == NULL)$sumaTrip['SUM(amount)'] = '0.00';	
							 if($sumaSchool['SUM(amount)'] == NULL)$sumaSchool['SUM(amount)'] = '0.00';	
							 if($sumaBooks['SUM(amount)'] == NULL)$sumaBooks['SUM(amount)'] = '0.00';	
							 if($sumaSeves['SUM(amount)'] == NULL)$sumaSeves['SUM(amount)'] = '0.00';	
							 if($sumaReti['SUM(amount)'] == NULL)$sumaReti['SUM(amount)'] = '0.00';	
							 if($sumaLoan['SUM(amount)'] == NULL)$sumaLoan['SUM(amount)'] = '0.00';	
							 if($sumaGift['SUM(amount)'] == NULL)$sumaGift['SUM(amount)'] = '0.00';	
							 if($sumaOtherExp['SUM(amount)'] == NULL)$sumaOtherExp['SUM(amount)'] = '0.00';	
							 if($sumaInc['SUM(amount)'] == NULL)$sumaInc['SUM(amount)'] = '0.00';	
							 if($sumaExp['SUM(amount)'] == NULL)$sumaExp['SUM(amount)'] = '0.00';	
							 
							 $balance = $sumaInc['SUM(amount)']-$sumaExp['SUM(amount)'];

							 $polaczenie->close();}									
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
<script src="https://code.jquery.com/jquery.min.js"></script>

<!-- Modal custom date window show -->
<script type="text/javascript">
	$(document).ready(function(){ //Make script DOM ready
			$('#myselect').change(function() {
			var opval = $(this).val();
			if(opval==4){
				$('#myModal').modal("show");
			}
		});	
	});
</script>
						
</head>

<body onload="dateselection()">
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
						<a class="nav-link" href="incomes.php" > Przychody </a>
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
				<div class="selectdiv">	
					<header >						
						<h1> Przegląd wydatków</h1>
						<p>Tu możesz przeglądać bilans swoich finansów.</p>											
					</header>					
					<form method="post">						
					    <select class="custom-select" name = "selectTimePeriode" id="myselect">
							<option value = 0>--</option>
							<option value = 1>Bieżący miesiąc</option>
							<option value = 2>Poprzedni miesiąc</option>
							<option value = 3>Bieżący rok</option>
							<option value = 4>Niestandardowy</option>						
					    </select>						
					    <input type="submit" value="Pokaż bilans">	
					</form>						
					<!-- Modal -->
					<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<form method="post">
								    <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Wybierz przedział czasowy</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
								    </div>
								    <div class="modal-body">
										<fieldset>						
											<legend> Data początku</legend>						
											<input type="date" value="<?php echo $today; ?>" name = "dateBegin" min="2000-01-01" id="dateBegin" required>						
										</fieldset>	
										<fieldset>						
											<legend> Data końca</legend>						
											<input type="date" value="<?php echo $today; ?>" name = "dateEnd" min="2000-01-01" id="dateEnd" required>				
										</fieldset>	
								    </div>
								    <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
										<button type="submit" class="btn btn-primary" name = "selectTimePeriode" value = 4>Pokaż bilans</button>								
								    </div>							  
								</form>
							</div>
						</div>						 				
					</div>		
					
					 <?php	
						if (isset($_POST['selectTimePeriode'])){
							if ($_POST['selectTimePeriode'] == 0){
							echo"<br>Wybierz przedział czasowy. <br>";
						}else if (isset($_POST['selectTimePeriode'])){	
						
						if ($_POST['selectTimePeriode'] == 1){					
							echo<<<END
								<br>
								<h4>Bieżący miesiąc</h4>
							END;
						}else if($_POST['selectTimePeriode'] == 2){
							echo<<<END
								<br>
								<h4>Poprzedni miesiąc</h4>
							END;
						}else if($_POST['selectTimePeriode'] == 3){
							echo<<<END
								<br>
								<h4>Bieżący rok</h4>
							END;
						}else if($_POST['selectTimePeriode'] == 4){
							echo<<<END
								<br>
								<h4>Wybrany okres czasu</h4>
							END;
						}?>
				</div>
		
				<div class="resultTables">
					<br>				
					<div class="selectedIncomes" style="float: left;">				
						<table width="300" align="center" border="2" bordercolor="#d5d5d5"  cellpadding="0" cellspacing="0">
							<tr>
							<?php							
							echo<<<END
							<th width="300" align="center" bgcolor="green" colspan="2">Przychody</th>				
							</tr>
							END;
						
							echo '<tr><td width="200" align="left">Suma Twoich przychodów: </td>';
							echo '<td width="100" align="center">'.$sumaInc["SUM(amount)"].' zł</td>';
							echo '</tr>';
							
							echo '<tr><td width="200" align="left">Wynagrodzenie: </td>';
							echo '<td width="100" align="center">'.$sumaSalary["SUM(amount)"].' zł</td>';
							echo '</tr>';
							
							echo '<tr><td width="200" align="left">Odsetki bankowe: </td>';
							echo '<td width="100" align="center">'.$sumaInterest["SUM(amount)"].' zł</td>';
							echo '</tr>';
							
							echo '<tr><td width="200" align="left">Sprzedaż na Allegro: </td>';
							echo '<td width="100" align="center">'.$sumaAllegro["SUM(amount)"].' zł</td>';
							echo '</tr>';
							
							echo '<tr><td width="200" align="left">Inne przychodzy: </td>';
							echo '<td width="100" align="center">'.$sumaOther["SUM(amount)"].' zł</td>';
							echo '</tr>';
							echo '</tr></table>';																				
								}}?>
					</div>
					
					<div class="selectedExpense " style="margin-left: 10px;" >						 
						<?php
						if (isset($_POST['selectTimePeriode'])){
						if ($_POST['selectTimePeriode'] != 0){
						echo '<table width="300" align="center" border="2" bordercolor="#d5d5d5"  cellpadding="0" cellspacing="0"><tr>';

						echo<<<END
						<th width="300" align="center" bgcolor="red" colspan="2">Wydatki</th>				
						</tr>
						END;
					 
						echo '<tr><td width="200" align="left">Suma Twoich wydatków: </td>';
						echo '<td width="100" align="center">'.$sumaExp['SUM(amount)'].' zł</td>';
						echo '</tr>';
						
						echo '<tr><td width="200" align="left">Jedzenie: </td>';
						echo '<td width="100" align="center">'.$sumaFood["SUM(amount)"].' zł</td>';
						echo '</tr>';
						
						echo '<tr><td width="200" align="left">Mieszkanie: </td>';
						echo '<td width="100" align="center">'.$sumaLiving["SUM(amount)"].' zł</td>';
						echo '</tr>';
						
						echo '<tr><td width="200" align="left">Transport: </td>';
						echo '<td width="100" align="center">'.$sumaTransport["SUM(amount)"].' zł</td>';
						echo '</tr>';
						
						echo '<tr><td width="200" align="left">Telekomunikacja: </td>';
						echo '<td width="100" align="center">'.$sumaTelCom["SUM(amount)"].' zł</td>';
						echo '</tr>';
						
						echo '<tr><td width="200" align="left">Opieka zdrowotna: </td>';
						echo '<td width="100" align="center">'.$sumaHealth["SUM(amount)"].' zł</td>';
						echo '</tr>';
						
						echo '<tr><td width="200" align="left">Ubranie: </td>';
						echo '<td width="100" align="center">'.$sumaCloth["SUM(amount)"].' zł</td>';
						echo '</tr>';
						
						echo '<tr><td width="200" align="left">Higiena: </td>';
						echo '<td width="100" align="center">'.$sumaHygien["SUM(amount)"].' zł</td>';
						echo '</tr>';
						
						echo '<tr><td width="200" align="left">Dzieci: </td>';
						echo '<td width="100" align="center">'.$sumaKids["SUM(amount)"].' zł</td>';
						echo '</tr>';
						
						echo '<tr><td width="200" align="left">Rozrywka: </td>';
						echo '<td width="100" align="center">'.$sumaEntert["SUM(amount)"].' zł</td>';
						echo '</tr>';
						
						echo '<tr><td width="200" align="left">Wycieczka: </td>';
						echo '<td width="100" align="center">'.$sumaTrip["SUM(amount)"].' zł</td>';
						echo '</tr>';
						
						echo '<tr><td width="200" align="left">Szkolenia: </td>';
						echo '<td width="100" align="center">'.$sumaSchool["SUM(amount)"].' zł</td>';
						echo '</tr>';
						
						echo '<tr><td width="200" align="left">Książki: </td>';
						echo '<td width="100" align="center">'.$sumaBooks["SUM(amount)"].' zł</td>';
						echo '</tr>';
						
						echo '<tr><td width="200" align="left">Oszczędności: </td>';
						echo '<td width="100" align="center">'.$sumaSeves["SUM(amount)"].' zł</td>';
						echo '</tr>';
						
						echo '<tr><td width="200" align="left">Na emeryturę: </td>';
						echo '<td width="100" align="center">'.$sumaReti["SUM(amount)"].' zł</td>';
						echo '</tr>';
						
						echo '<tr><td width="200" align="left">Spłata długów: </td>';
						echo '<td width="100" align="center">'.$sumaLoan["SUM(amount)"].' zł</td>';
						echo '</tr>';
						
						echo '<tr><td width="200" align="left">Darowizna: </td>';
						echo '<td width="100" align="center">'.$sumaGift["SUM(amount)"].' zł</td>';
						echo '</tr>';
						
						echo '<tr><td width="200" align="left">Inne wydatki: </td>';
						echo '<td width="100" align="center">'.$sumaOtherExp["SUM(amount)"].' zł</td>';
						echo '</tr>';
						
						echo '</tr></table>';
						}}
						?>																			
					</div>
				</div>	
				<div style="clear:both;"></div>					
				<br>
			
				<div class="selectedBalance" >
					<?php								
						if (isset($_POST['selectTimePeriode'])){
							if ($_POST['selectTimePeriode'] == 0){								
							}else if (isset($_POST['selectTimePeriode'])){	

								echo'<table width="300" align="center" border="2" bordercolor="#d5d5d5"  cellpadding="0" cellspacing="0">';
								echo'<tr>';
								echo'<td width="300" align="center" bgcolor="#1F2224"> Twoje saldo to: '.$balance.' zł</td>';
								echo'</tr>';
								echo'<tr>';
								if($balance > 0){
									echo'<td width="300" align="center" bgcolor="green">Brawo! Świetnie zarządzasz finansami.</td>';
								}else if($balance < 0){
									echo'<td width="300" align="center" bgcolor="red">Uważaj, wpadasz w długi!!!</td>';
								}else if($balance == 0){
									echo'<td width="300" align="center" bgcolor="blue">Spoko, ale widać lubisz życie na krawędzi!!!</td>';
								}
							}
						}?>
					</tr></table>
					<br>																									
				</div>
				
				<div class="resultChart">					
					<div id="piechart_3d_income" style="width: 610px; height: 500px;">					
						<?php 
							if (isset($_POST['selectTimePeriode'])){
							if ($_POST['selectTimePeriode'] != 0){
							if($sumaInc['SUM(amount)']=='0.00'){ $tytul='Brak danych do wyświetlenia';}
							else{$tytul='Przychody';}}}
						?>						
						<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
						<script type="text/javascript">
						  google.charts.load("current", {packages:["corechart"]});
						  google.charts.setOnLoadCallback(drawChart);						  
						  function drawChart() {							  
							var data = google.visualization.arrayToDataTable([
							  ['Suma Twoich przychodów', 'Kwota'],
							  ['Wynagrodzenie',  <?php echo $sumaSalary["SUM(amount)"];?>],
							  ['Odsetki bankowe',     <?php echo $sumaInterest["SUM(amount)"];?>],
							  ['Sprzedaż na Allegro',  <?php echo $sumaAllegro["SUM(amount)"];?>],
							  ['Inne przychodzy', <?php echo $sumaOther["SUM(amount)"];?>],
							]);							

							var options = {
							  title: '<?php echo $tytul;?>',
							  is3D: true,							  						  
							};

							var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_income'));
							chart.draw(data, options);
						}
						</script>							
					</div>	
				
					<br>
					
					<div id="piechart_3d_expense" style="width: 610px; height: 500px;">
						<?php 
							if (isset($_POST['selectTimePeriode'])){
							if ($_POST['selectTimePeriode'] != 0){
								if($sumaExp['SUM(amount)']=='0.00'){ $tytul='Brak danych do wyświetlenia';}
							else{$tytul='Wydatki';}}}
						?>
						<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
						<script type="text/javascript">
						
						  google.charts.load("current", {packages:["corechart"]});
						  google.charts.setOnLoadCallback(drawChart);
						  function drawChart() {
							var data = google.visualization.arrayToDataTable([
							  ['Suma Twoich wydatków', 'Kwota'],
							  ['Jedzenie',     <?php echo $sumaFood['SUM(amount)'];?>],
							  ['Mieszkanie',      <?php echo $sumaLiving['SUM(amount)'];?>],
							  ['Transport',  <?php echo $sumaTransport['SUM(amount)'];?>],
							  ['Telekomunikacja', <?php echo $sumaTelCom['SUM(amount)'];?>],
							  ['Opieka Zdrowotna', <?php echo $sumaHealth['SUM(amount)'];?>],
							  ['Ubranie', <?php echo $sumaCloth['SUM(amount)'];?>],
							  ['Higiena', <?php echo $sumaHygien['SUM(amount)'];?>],
							  ['Dzieci', <?php echo $sumaKids['SUM(amount)'];?>],
							  ['Rozrywka', <?php echo $sumaEntert['SUM(amount)'];?>],
							  ['Wycieczka', <?php echo $sumaTrip['SUM(amount)'];?>],
							  ['Szkolenia', <?php echo $sumaSchool['SUM(amount)'];?>],
							  ['Książki', <?php echo $sumaBooks['SUM(amount)'];?>],
							  ['Oszczędności', <?php echo $sumaSeves['SUM(amount)'];?>],
							  ['Na emeryturę', <?php echo $sumaReti['SUM(amount)'];?>],
							  ['Spłata długów', <?php echo $sumaLoan['SUM(amount)'];?>],
							  ['Darowizna',    <?php echo $sumaGift['SUM(amount)'];?>],
							  ['Inne wydatki',    <?php echo $sumaOtherExp['SUM(amount)'];?>]
							]);

							var options = {
							  title: '<?php echo $tytul;?>',
							  is3D: true,
							};							
							var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_expense'));	
							
							chart.draw(data, options);
						  }
						
						</script>
						
					</div>
					<br><br>
				</div>
				
			</div>																	
		</section>			
	</main>
	
	<footer class="navbar-text fixed-bottom text-center bg-dark">
		Aplikacja budżetowa &copy; Wszelkie prawa zastrzeżone
	</footer>
	
<script src="https://code.jquery.com/jquery.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>