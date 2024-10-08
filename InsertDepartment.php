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
	<link rel="stylesheet" type="text/css" href="InsertDepartmentCSS.css">
</head>
<body>
	<?php include "EmployeeDBConnection.php" ?>

	<header>
		<h4>Insert Department Page</h4>
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
				</ul>
	</header>

	<table class="layoutTable">
		<!--Content wide size-->
		<tr>
			<td width="20%"></td>
			<td width="65%"></td>
			<td width="15%"></td>
		</tr>

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
				<form method="POST" action="">

					<h3>Department Details</h3>
					<br>

					<table class="formTable">
						<tr>
							<td>Department Code:</td>
							<td><input type="text" name="departmentCode" required></td>
						</tr>
						<tr>
							<td>Department Name:</td>
							<td><input type="text" name="departmentName" required></td>
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
				<?php 


				if (isset($_POST['submit'])) {
					if (isset($_POST['departmentCode']) && isset($_POST['departmentName'])) {

						$dpCode = $_POST['departmentCode'];
						$dpName = $_POST['departmentName'];

						$sqlInsert = "INSERT INTO `department table`(`Dept Code`, `Dept Name`) VALUES ('$dpCode', '$dpName')";
						$result = mysqli_query($conn , $sqlInsert);

						if ($result) {
							echo "<p style='color:green;'>$dpCode and $dpName information is successfully added</p>";
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