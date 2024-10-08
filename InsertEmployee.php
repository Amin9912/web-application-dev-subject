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
	<link rel="stylesheet" type="text/css" href="InsertEmployeeCSS.css">
</head>
<body>
	<?php include "EmployeeDBConnection.php" ?>

	<header>
		<h4>Insert Employee Page</h4>
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
				
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	
					<h3>Employee Details</h3>
					<br>

					<table class="formTable">			
						<tr>
							<td>Employee ID</td>
							<td>:<input type="text" name="employeeID" required></td>			
						</tr>
						<tr>
							<td>First and Last Name</td>
							<td>:<input type="text" name="fname"required> <input type="text" name="lname" required></td>			
						</tr>

						<tr>
							<td>Phone Number</td>
							<td>:<input type="tel" name="phoneNo" required></td>
						</tr>

						<tr>
							<td>Birthdate</td>
							<td>:<input type="date" name="birthdate" required></td>
						</tr>

						<tr>
							<td>Salary</td>
							<td>:<input type="text" name="salary" required></td>
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

				<!--PHP Insert Employee Details-->

				<?php /*

					if (isset($_POST['btnDelete'])) {
						
						$sqlDel = "DELETE FROM `employee details table`";
						$resDel = mysqli_query($conn, $sqlDel);
						$affCheck = mysqli_affected_rows($conn);
				
						if($resDel){
							echo "All data has been deleted";
						}else
							echo "Delete failed";
							}*/
				 ?>

				<?php 

				if (isset($_POST['submit'])) {
					if (isset($_POST['employeeID']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['phoneNo']) && isset($_POST['birthdate']) && isset($_POST['salary'])) {

						$empID = $_POST['employeeID'];
						$fname = $_POST['fname'];
						$lname = $_POST['lname'];
						$phoneNo = $_POST['phoneNo'];
						$birthdate = $_POST['birthdate'];
						$salary = $_POST['salary'];

						$sqlcheck = "SELECT `Employee ID` FROM `Employee Details Table` WHERE `Employee ID` = '$empID'";
						$res = mysqli_query($conn, $sqlcheck);
						$count = mysqli_num_rows($res);

						if ($count == 0) {
							$_SESSION['RegempID'] = $empID;
						$_SESSION['Regfname'] = $fname;
						$_SESSION['Reglname'] = $lname;
						$_SESSION['RegphoneNo'] = $phoneNo;
						$_SESSION['Regbirthdate'] = $birthdate;
						$_SESSION['Regsalary'] = $salary;
						header("Location: createAcc.php");
						exit();
						}else{
							echo "<br><br><label style='color: red;'>This ID has been used!</label>";
						}

						
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