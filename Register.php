<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>

	<link rel="stylesheet" type="text/css" href="CSS.css">
	<link rel="stylesheet" type="text/css" href="RegisterCSS.css">
</head>
<body>

	<?php include "EmployeeDBConnection.php" ?>

	<header>
		Register Page
	</header>

	<br>
	<a href="Login.php">Login Page</a>
	<br>

	<table class="layoutTable">
		<tr>
			<td width="20%">Left</td>
			<td width="60%">Center</td>
			<td width="20%">Right</td>
		</tr>
		<!--Table row for register form-->
		<tr>
			<td width="20%"></td>
			<td width="60%">
				
				<fieldset>
					<legend>Register Form</legend>
					<form method="POST" action="">
						<table class="registerTable">
							<tr>
								<td>
									<label>
										Employee ID
									</label>
								</td>
								<td>
									: <input type="text" name="">
								</td>
							</tr>
							<tr>
								<td>
									<label>
										Password
									</label>
								</td>
								<td>
									: <input type="text" name="">
								</td>
							</tr>
						</table>

						<input type="submit" name="">
					</form>
				</fieldset>

			</td>
			<td width="20%"></td>
		</tr> <!--End of table row for login form-->
	</table>

	<footer>
		Footer
	</footer>

</body>
</html>