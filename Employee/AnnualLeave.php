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
						<a href="holidayDetail.php" class="menuButton">View Holidays</a>
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
				<!-- Apply leave -->
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	
					<h3>Apply Leave</h3>
					<br>

					<table class="formTable" style="margin-right: auto;margin-left: auto;">			
						<tr>
							<td>Leave Date From</td>
							<td>:<input type="date" name="dateFrom" required></td>			
						</tr>
						<tr>
							<td>Leave Date To</td>
							<td>:<input type="date" name="dateTo" required></td>			
						</tr>

						<tr>
							<td>Leave Type</td>
							<td>:<select name="typeHoliday">
									<option value="Other">Other</option>
									<option value="Sick leave">Sick leave</option>
									<option value="Casual leave">Casual leave</option>
									<option value="Public holiday">Public holiday</option>
									<option value="Religious holidays">Religious holidays</option>
									<option value="Maternity leave">Maternity leave</option>
									<option value="Bereavement leave">Bereavement leave</option>
									<option value="Compensatory leave">Compensatory leave</option>
									<option value="Sabbatical leave">Sabbatical leave</option>
									<option value="Unpaid leave">Unpaid leave</option>
								</select>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<br>
								<input type="submit" name="submitApply">
								<br><br>
							</td>
						</tr>
					</table>

					<?php 
					//calulate total day request
					function dateDiffInDays($date1, $date2){
						// Calculating the difference in timestamps
				      $diff = strtotime($date2) - strtotime($date1);
				  
				      // 1 day = 24 hours
				      // 24 * 60 * 60 = 86400 seconds
				      return abs(round($diff / 86400)) + 1;

					}

					//calculate working days except sat & sun from the request date
					function calWorkingDate($start_request_date, $end_request_date){

						// Calculating the difference in timestamps
					    $diff = strtotime($end_request_date) - strtotime($start_request_date);
					  
					    // 1 day = 24 hours
					    // 24 * 60 * 60 = 86400 seconds
					    $total_request_date = abs(round($diff / 86400)) + 1;




						$myTime = strtotime("$start_request_date");
						$daysInMonth = $total_request_date;
						$workDays = 0;

						while($daysInMonth > 0)
						{
						    $day = date("D", $myTime); // Sun - Sat
						    if($day != "Sun" && $day != "Sat")
						        $workDays++;

							    $daysInMonth--;
							    $myTime += 86400; // 86,400 seconds = 24 hrs.
						}
						return $workDays;
					}


					//Button Apply Leave date
					if (isset($_POST['submitApply'])) {
						if (isset($_POST['dateFrom']) && isset($_POST['dateTo']) && isset($_POST['typeHoliday'])) {

							$dateFrom = $_POST['dateFrom'];
							$dateTo = $_POST['dateTo'];
							$typeHoliday = $_POST['typeHoliday'];
							$empID = $_SESSION['empID'];

							$countDay = dateDiffInDays($dateFrom, $dateTo);
							$calWorking = calWorkingDate($dateFrom, $dateTo);


							$sqlInsert = "INSERT INTO `employee leave` (`Employee ID`, `Leave Date From`, `Leave Date To`, `Number of Days Applied For`, `Leave Type`) VALUES ('$empID', '$dateFrom', '$dateTo', '$calWorking', '$typeHoliday')";

							$res = mysqli_query($conn, $sqlInsert);

							if ($res) {

								echo "<br><span style='color:#4BB543;text-align:center;'>$typeHoliday from $dateFrom to $dateTo has been successfully add! Count day: $countDay, countHoliday: $calWorking</span>";

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

		<tr height = 50px;>
			<td></td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td></td>
			<td>
				<h3>Employee Annual Request Details</h3><br>
				<h5>Note: The number of days applied on Saturday and Sunday is not count.</h5>
				<br>
				<?php 

				//Annual request table
				employeeTable();

				$empID = $_SESSION['empID'];

				$sqlViewLeave = "Select * FROM `employee leave` WHERE `Employee ID` = '$empID'";
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
			  				<td><?= $row['Number of Days Applied For'] ?></td>
			  				<td><?= $row['Leave Type'] ?></td>
			  				<td><?= $row['Status'] ?></td>
			  				<td>
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

					if(isset($_GET['empID']) && isset($_GET['dateFrom']) && isset($_GET['dateTo']) && isset($_GET['leaveType'])) {

						$empID = $_GET['empID'];
						$dateFrom = date($_GET['dateFrom']);
						$dateTo = date($_GET['dateTo']);
						$leaveType = $_GET['leaveType'];
						
						$sqlDel = "DELETE FROM `employee leave` WHERE `Employee ID` = '$empID'AND `Leave Date From` = '$dateFrom' AND `Leave Date To` = '$dateTo'AND `Leave Type` = '$leaveType'";
						$resDel = mysqli_query($conn, $sqlDel);
						$affCheck = mysqli_affected_rows($conn);
				
						if($resDel){
							echo "<span style='color:#4BB543;text-align:center;'>Employee ID $empID, for $leaveType from Date: $dateFrom to $dateTo has been cancel</span>";
							echo "<br><span style='color:#4BB543;text-align:center;'>Effect row: $affCheck</span>";
						}else{
							echo "Delete failed";
						}
						mysqli_close($conn);
					}
				 ?>
			</td>
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