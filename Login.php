<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Annual Leave Management</title>

    <link rel="stylesheet" type="text/css" href="CSS.css">
    <link rel="stylesheet" type="text/css" href="LoginCSS.css">
</head>

<body>
    <?php include "EmployeeDBConnection.php" ?>

    <!--Layout table content-->
    <table class="layoutTableLogin">

        <!--Content wide size-->
        <tr>
            <td width="15%"></td>
            <td width="70%"></td>
            <td width="15%"></td>
        </tr>

        <!--Table row for login form-->
        <tr>
            <td></td>
            <td>
                <h4>Employee Leave Management System</h4>
                <br><br><br><br>
                <fieldset>
                    <legend class="title">ADMIN LOGIN</legend>
                    <form method="POST" action="">
                        <table class="loginTable">
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <div class="col">
                                        <input class="textbox" type="text" name="empID" placeholder="Admin ID" required>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <div class="col">
                                        <input class="textbox" type="Password" name="pass" placeholder="Password"
                                            required>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>

                            <tr style="text-align: center;">
                                <td colspan="2">
                                    <br>
                                    <input type="submit" name="submit" value="Login">
                                </td>
                            </tr>
                        </table>
                    </form>
                </fieldset>

                <?php

				$adminID = "admin";
				$adminPass = "admin";
				$depC = "011";

				if (isset($_POST['submit'])) {
					if (isset($_POST['empID']) && isset($_POST['pass'])) {
						
						$empID = $_POST['empID'];
						$pass = $_POST['pass'];

						if ($adminID === $empID && $adminPass === $pass) {

							$_SESSION['empID'] = $adminID;
							$_SESSION['deptCode'] = $depC;
							header("Location: AnnualLeave.php");						
						}else{
								echo "<br><br><label style='color: red;'>Login Failed!</label>";
							}
						}else{
							echo "<br><br><label style='color: red;'>Login Failed!</label>";
						}
					}

				?>
                <br>
                <br>
                <a href="Employee/Login.php">Login as Employee</a>

            </td>
            <td></td>
        </tr>
        <!--End of table row for login form-->
    </table>

</body>

</html>