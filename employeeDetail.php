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
		<h4>Employee & Department Details Page</h4>
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
				<td>Dept Code</td>
				<td>Dept Name</td>
			</tr>
		<?php
	}

	function employeeTable(){
		?>
		<table class="viewTable">
			<tr style="background-color: #022954; color: white;">
				<td>No.</td>
				<td>Employee ID</td>
				<td>First Name</td>
				<td>Last Name</td>
				<td>Phone Number</td>
				<td>Birthdate</td>
				<td>Salary(RM)</td>
				<td>Action</td>
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
				<h3>Department Details</h3>
				<br>
				<?php 

				departmentTable();

				$sqlViewDept = "Select * FROM `department table`";
				$resDept = mysqli_query($conn, $sqlViewDept);
				$sqlCountDept = mysqli_num_rows($resDept);

				$i = 1;

				if ($sqlCountDept > 0) {
			  		foreach ($resDept as $row) {
			  			?>
			  			<tr style="background-color: #cbcbcb">
			  				<td><?= $i++;?>.</td>
			  				<td><?= $row['Dept Code'] ?></td>
			  				<td><?= $row['Dept Name'] ?></td>
			  			</tr>
			  			<?php
			  		}
			  	}

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
				<h3>Employee Details</h3>
				<br>

				<form method="POST" action="">				

				<?php 

				employeeTable();

				$sqlViewEmp = "Select * FROM `employee details table`";
				$resEmp = mysqli_query($conn, $sqlViewEmp);
				$sqlCountEmp = mysqli_num_rows($resEmp);

				$i = 1;

				if ($sqlCountEmp > 0) {
			  		foreach ($resEmp as $row) {
			  			?>
			  			<tr style="background-color: #cbcbcb">
			  				<td><?= $i++;?>.</td>
			  				<td><?= $row['Employee ID'] ?></td>
			  				<td><?= $row['First Name'] ?></td>
			  				<td><?= $row['Last Name'] ?></td>
			  				<td><?= $row['Phone Number'] ?></td>
			  				<td><?= $row['Birthdate'] ?></td>
			  				<td><?= $row['Salary'] ?></td>
			  				<td>
			  					<a class="del" href="employeeDetail.php?delete=<?= $row['Employee ID'] ?>">
			  					Delete
			  				</a>
			  				</td>
			  			</tr>
			  			<?php
			  		}
			  	}

				echo "</table>";
				?>
				</form>

			</td>
			<td>
				<?php

					if(isset($_GET['delete'])) {

						$empID = $_GET['delete'];
						
						$sqlDel = "DELETE FROM `employee details table` WHERE `Employee ID` = '$empID'";
						$resDel = mysqli_query($conn, $sqlDel);
						$affCheck = mysqli_affected_rows($conn);
				
						if($resDel){
							echo "<span style='color:#00FF00;text-align:center;'>Employee ID $empID has been deleted</span>";
							echo "<br><span style='color:#00FF00;text-align:center;'>Effect row: $affCheck</span>";
						}else{
							echo "Delete failed";
						}
					}
				 ?>
			</td>
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