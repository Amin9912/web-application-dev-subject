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
	<link rel="stylesheet" type="text/css" href="themeCSS.css">
</head>
<body>
	<?php include "EmployeeDBConnection.php" ?>

	<header>
		<h4>Annual Leave Page</h4>
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

	function employeeTable(){
		?>
		<table class="viewTable">
			<tr style="background-color: #022954; color: white;">
				<td>No.</td>
				<td>Employee ID</td>
				<td>Leave Date From</td>
				<td>Leave Date To</td>
				<td>Number of Days Applied For</td>
				<td>Leave Type</td>
				<td>Status</td>
				<td>Action</td>
			</tr>
		<?php
	}

	?>

	<table class="layoutTable" style="border: none;">
		<!--Content wide size-->
		<tr>
			<td width="20%"></td>
			<td width="65%"></td>
			<td width="15%"></td>
		</tr>

		<tr style="height: 250px;">
			<td style=" vertical-align: top;">
				<br><br>
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
				<h3>Employee Annual Request Details</h3>
				<br>
				<?php 

				employeeTable();

				$sqlViewLeave = "Select * FROM `employee leave`";
				$resLeave = mysqli_query($conn, $sqlViewLeave);
				$sqlCountLeave = mysqli_num_rows($resLeave);

				$i = 1;

				if ($sqlCountLeave > 0) {
			  		foreach ($resLeave as $row) {
			  			?>
			  			<tr style="background-color: #cbcbcb">
			  				<td><?= $i++;?>.</td>
			  				<td><?= $row['Employee ID'] ?></td>
			  				<td><?= $row['Leave Date From'] ?></td>
			  				<td><?= $row['Leave Date To'] ?></td>
			  				<td width="15%"><?= $row['Number of Days Applied For'] ?></td>
			  				<td><?= $row['Leave Type'] ?></td>
			  				<td><?= $row['Status'] ?></td>
			  				<td>
			  					<a class="approve" href="?empIDApp=<?= $row['Employee ID'] ?>&dateFromApp=<?= date($row['Leave Date From']) ?>&dateToApp=<?= date($row['Leave Date To']) ?>&leaveTypeApp=<?= $row['Leave Type'] ?>&statApp=<?= $row['Status'] ?>">
			  					Approve
			  					</a><br>
			  					<a class="reject" href="?empIDRej=<?= $row['Employee ID'] ?>&dateFromRej=<?= date($row['Leave Date From']) ?>&dateToRej=<?= date($row['Leave Date To']) ?>&leaveTypeRej=<?= $row['Leave Type'] ?>&statRej=<?= $row['Status'] ?>">
			  					Reject
			  					</a><br>
			  					<a class="del" href="AnnualLeave.php?empID=<?= $row['Employee ID'] ?>&dateFrom=<?= date($row['Leave Date From']) ?>&dateTo=<?= date($row['Leave Date To']) ?>&leaveType=<?= $row['Leave Type'] ?>">
			  					Cancel
			  					</a>
			  				</td>
			  			</tr>
			  			<?php
			  		}
			  	}

				echo "</table>";
				?>
			</td>
			<td>
				<?php
					
					if(isset($_GET['empIDApp']) && isset($_GET['dateFromApp']) && isset($_GET['dateToApp']) && isset($_GET['leaveTypeApp']) && isset($_GET['statApp'])) {

						$empID = $_GET['empIDApp'];
						$dateFrom = date($_GET['dateFromApp']);
						$dateTo = date($_GET['dateToApp']);
						$leaveType = $_GET['leaveTypeApp'];
						$status = "Approved";
						
						$sqlUpdate = "UPDATE `employee leave` SET `Status` = '$status' WHERE `Employee ID` = '$empID'AND `Leave Date From` = '$dateFrom' AND `Leave Date To` = '$dateTo' AND `Leave Type` = '$leaveType'";
						$res = mysqli_query($conn, $sqlUpdate);
						$affCheck = mysqli_affected_rows($conn);
				
						if($res){
							echo "<span style='color:#4BB543;text-align:center;'>Employee ID $empID, for $leaveType from Date: $dateFrom to $dateTo has been Approved!</span>";
							echo "<br><span style='color:#4BB543;text-align:center;'>Effect row: $affCheck</span>";
						}else{
							echo "failed";
						}
						mysqli_close($conn);
					}

				 ?>

				 <?php
					
					if(isset($_GET['empIDRej']) && isset($_GET['dateFromRej']) && isset($_GET['dateToRej']) && isset($_GET['leaveTypeRej']) && isset($_GET['statRej'])) {

						$empID = $_GET['empIDRej'];
						$dateFrom = date($_GET['dateFromRej']);
						$dateTo = date($_GET['dateToRej']);
						$leaveType = $_GET['leaveTypeRej'];
						$status = "Reject";
						
						$sqlUpdate = "UPDATE `employee leave` SET `Status` = '$status' WHERE `Employee ID` = '$empID'AND `Leave Date From` = '$dateFrom' AND `Leave Date To` = '$dateTo' AND `Leave Type` = '$leaveType'";
						$res = mysqli_query($conn, $sqlUpdate);
						$affCheck = mysqli_affected_rows($conn);
				
						if($res){
							echo "<span style='color:#4BB543;text-align:center;'>Employee ID $empID, for $leaveType from Date: $dateFrom to $dateTo has been Reject!</span>";
							echo "<br><span style='color:#4BB543;text-align:center;'>Effect row: $affCheck</span>";
						}else{
							echo "failed";
						}
						mysqli_close($conn);
					}

				 ?>

				<?php
					
					if(isset($_GET['empID']) && isset($_GET['dateFrom']) && isset($_GET['dateTo']) && isset($_GET['leaveType'])) {

						$empID = $_GET['empID'];
						$dateFrom = date($_GET['dateFrom']);
						$dateTo = date($_GET['dateTo']);
						$leaveType = $_GET['leaveType'];
						
						$sqlDel = "DELETE FROM `employee leave` WHERE `Employee ID` = '$empID'AND `Leave Date From` = '$dateFrom' AND `Leave Date To` = '$dateTo'AND `Leave Type` = '$leaveType'";
						$resDel = mysqli_query($conn, $sqlDel);
						$affCheck = mysqli_affected_rows($conn);
				
						if($resDel){
							echo "<span style='color:#00FF00;text-align:center;'>Employee ID $empID, for $leaveType from Date: $dateFrom to $dateTo has been cancel</span>";
							echo "<br><span style='color:#00FF00;text-align:center;'>Effect row: $affCheck</span>";
						}else{
							echo "Delete failed";
						}
						mysqli_close($conn);
					}

				 ?>
			</td>
			<td></td>
		</tr>

		<tr height = 50px;>
			<td></td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td></td>
			<td>
				
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