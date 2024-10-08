<?php session_start(); ?>
<?php 

if (isset($_SESSION['empID']) && isset($_SESSION['deptCode']) && isset($_SESSION['RegempID'])) {
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Annual Leave Management</title>

	<link rel="stylesheet" type="text/css" href="CSS.css">
	<link rel="stylesheet" type="text/css" href="InsertEmployeeCSS.css">
</head>
<body>
	<?php include "EmployeeDBConnection.php" ?>

	<header>
		<h4>Register Employee Account Page</h4>
		<br>
	</header>

	<table class="layoutTable">

		<!--Content wide size-->
		<tr>
			<td width="20%"></td>
			<td width="65%"></td>
			<td width="15%"></td>
		</tr>
		<tr>
			<td></td>
			<td>
				
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	
					<h3>Employee Details</h3><br>
					<h4>Please fill in this form to complete adding new staff.</h4>
					<br>

					<table class="formTable">			
						<tr>
							<td>Employee ID</td>
							<td>:<input type="text" name="employeeID" value="<?= $_SESSION['RegempID'] ?>" readonly></td>			
						</tr>
						<tr>
							<td>First and Last Name</td>
							<td>:<input type="text" name="fname" value="<?= $_SESSION['Regfname'] ?>" readonly> <input type="text" name="lname" value="<?= $_SESSION['Reglname'] ?>" readonly></td>			
						</tr>

						<tr>
							<td>Password</td>
							<td>:<input type="text" name="pass" required></td>
						</tr>

						<tr>
							<td>Dept Code</td>
							<td>:<select name="deptCode">
									<?php

									$sqlSelect = "SELECT `Dept Code` FROM `department table`";
									$res = mysqli_query($conn, $sqlSelect);
									$row = mysqli_fetch_row($res);
									while ($row) {
										echo "<option value ='$row[0]'>$row[0]</option>";
										$row = mysqli_fetch_row($res);
									}
									?>
								</select>

							</td>
						</tr>

						<tr>
							<td></td>
							<td>
								<br>
								<input type="submit" name="submit">
								<br><br>
							</td>
						</tr>
					</table>
				</form>

				<br><br>
				<a class="back" href="InsertEmployee.php">Back</a>	

				<!--PHP Insert Employee Details-->

				<?php 

				if (isset($_POST['submit'])) {
					if (isset($_POST['pass']) && isset($_POST['deptCode'])) {

						$password = md5($_POST['pass']);
						$deptCode = $_POST['deptCode'];

						$empID = $_SESSION['RegempID'];
						$fname = $_SESSION['Regfname'];
						$lname = $_SESSION['Reglname'];
						$phoneNo = $_SESSION['RegphoneNo'];
						$birthdate = $_SESSION['Regbirthdate'];
						$salary = $_SESSION['Regsalary'];

						$sqlInsert = "INSERT INTO `employee details table`(`Employee ID`, `First Name`, `Last Name`, `Phone Number`, `Birthdate`, `Salary`) VALUES ('$empID', '$fname', '$lname', '$phoneNo', '$birthdate', '$salary')";

						$sqlCreateAcc = "INSERT INTO `employee table` (`Employee ID`, `Password`, `Dept Code`) VALUES ('$empID', '$password', '$deptCode')";

						$res = mysqli_query($conn, $sqlCreateAcc);


						if ($res) {

							$resInsert = mysqli_query($conn , $sqlInsert);
							header("Location: InsertEmployee.php");
							exit();

						}else{
							echo "Error" . $sqlInsert . "<br />" . mysqli_error($conn);
						}
						mysqli_close($conn);
					}
				}

				 ?>	
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