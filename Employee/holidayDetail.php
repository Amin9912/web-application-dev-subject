<?php session_start(); ?>
<?php 

if (isset($_SESSION['empID']) && isset($_SESSION['deptCode'])) {
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Employee Annual Leave Management</title>

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
					<a href="holidayDetail.php" class="menuButton">View Holidays</a>
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
							<td>Employee ID</td>
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

		<tr style="height: 50px;">
			<td></td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td></td>
			<td>
				
			</td>
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