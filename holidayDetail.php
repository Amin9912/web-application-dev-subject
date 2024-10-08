<?php session_start(); ?>
<?php 

if (isset($_SESSION['empID']) && isset($_SESSION['deptCode'])) {
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Annual Leave Management</title>

	<link rel="stylesheet" type="text/css" href="CSS.css">
</head>
<body>
	<?php include "EmployeeDBConnection.php" ?>

	<header>
		<h4>Holidays & Annual Request Details Page</h4>
		<br>
			<!--Navigation bar-->
				<ul class="menu">
					<li class="dropdown">
						<a href="AnnualLeave.php" class="menuButton">Home</a>
					</li>
					<li class="dropdown">
						<a href="" class="menuButton">
						Add Employee & Department
						</a>
						<ul class="dropdown-content">
							<li><a href="InsertEmployee.php" class="menuButton">Add new Employee</a></li>
							<li><a href="InsertDepartment.php" class="menuButton">Add new Department</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="" class="menuButton">View Information</a>
						<ul class="dropdown-content">
							<li><a href="employeeDetail.php" class="menuButton">Employee & department</a></li>
							<li><a href="holidayDetail.php" class="menuButton">Holidays</a></li>
						</ul>
					</li>
					</li>
				</ul>
	</header>

	<?php

	function departmentTable(){
		?>
		<table class="viewTable">
			<tr style="background-color: #022954; color: white;">
				<td>No.</td>
				<td>Date From</td>
				<td>Date To</td>
				<td>Type of Public Holiday</td>
			</tr>
		<?php
	}

	?>

	<table class="layoutTable">
		<!--Content wide size-->
		<tr>
			<td width="20%"></td>
			<td width="65%"></td>
			<td width="15%"></td>
		</tr>

		<!-- Insert Holiday -->
		<tr style="height: 250px;">
			<td>			
				<!--User profile-->
				<form method="POST" action="">
					<table class="userInfoTable">
						<tr style="background-color: #3d3a3a;">
							<td colspan="2">
								<h3 class="textUserInfo">User Info</h3>
								<br>
							</td>
						</tr>
						<tr>
							<td>Admin ID</td>
							<td>:<?php echo $_SESSION['empID']; ?></td>
						</tr>
						<tr>
							<td>Department Code</td>
							<td>:<?php echo $_SESSION['deptCode']; ?></td>
						</tr>
						<tr>
							<td colspan="2">
								<br>
								<input class="logout" type="submit" name="btnLogout" value="Logout">
								<br><br>
							</td>
						</tr>
					</table>
				</form>

				<?php 

				if (isset($_POST['btnLogout'])) {
					session_unset();
					session_destroy();

					header("Location: Login.php");
				}

				?>

			</td>
			<td>
				<!-- Form Insert Holiday -->
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	
					<h3>Insert Holiday</h3>
					<br>

					<table class="formTable">			
						<tr>
							<td>Date From</td>
							<td>:<input type="date" name="dateFrom" required></td>			
						</tr>
						<tr>
							<td>Date To</td>
							<td>:<input type="date" name="dateTo" required></td>			
						</tr>

						<tr>
							<td style="vertical-align: text-top;">Type of Public Holiday</td>
							<td><textarea  type="text" name="typeOfPublicHoliday" rows="4" cols="50" max-width= "50%" required></textarea> 
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<br>
								<input type="submit" name="submitHoliday">
								<br><br>
							</td>
						</tr>
					</table>

					<?php 

				if (isset($_POST['submitHoliday'])) {
					if (isset($_POST['dateFrom']) && isset($_POST['dateTo']) && isset($_POST['typeOfPublicHoliday'])) {

						$dateFrom = $_POST['dateFrom'];
						$dateTo = $_POST['dateTo'];
						$typeOfPublicHoliday = $_POST['typeOfPublicHoliday'];

						$sqlInsert = "INSERT INTO `holiday table`(`Date From`, `Date To`, `Type of Public Holiday`) VALUES ('$dateFrom', '$dateTo', '$typeOfPublicHoliday')";

						$res = mysqli_query($conn, $sqlInsert);

						if ($res) {

							echo "$typeOfPublicHoliday from $dateFrom to $dateTo has been successfully add!";

						}else{
							echo "Error" . $sqlInsert . "<br />" . mysqli_error($conn);
						}
					}
				}
				 ?>
				</form>
			</td>
			<td></td>
		</tr>

		<tr style="height: 50px;">
			<td></td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td></td>
			<td>
				<h3>Holidays Details</h3>
				<br>
				<?php 

				departmentTable();

				$sqlViewHoliday = "Select * FROM `holiday table`";
				$resHoliday = mysqli_query($conn, $sqlViewHoliday);
				$sqlCountHoliday = mysqli_num_rows($resHoliday);

				$i = 1;

				if ($sqlCountHoliday > 0) {
			  		foreach ($resHoliday as $row) {
			  			?>
			  			<tr style="background-color: #cbcbcb">
			  				<td><?= $i++;?>.</td>
			  				<td><?= $row['Date From'] ?></td>
			  				<td><?= $row['Date To'] ?></td>
			  				<td><?= $row['Type of Public Holiday'] ?></td>
			  			</tr>
			  			<?php
			  		}
			  	}

			  	mysqli_close($conn);

				echo "</table>";
				?>
			</td>
			<td></td>
		</tr>
		<tr height = 100px;>
			<td></td>
			<td></td>
			<td></td>
		</tr>	
	</table>

</body>
</html>

<?php 
}else{
	header("Location: Login.php");
	exit();
}

 ?>