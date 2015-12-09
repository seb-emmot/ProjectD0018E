<?php session_start(); ?>
						<?php 
							$name = $_POST["name"];
							$userpassword = $_POST["password"];
							
							include '../resources/connect.php';
							$sql = "INSERT INTO ACCOUNTS (e_mail, password)
							VALUES ('$name', '$userpassword')";
								
							if ($conn->query($sql) == TRUE) {
								$_SESSION["login_text"] = "New account created! Log in below.\n";
								header("Location: login.php");
								die();
							
							} else {
								$_SESSION["registration_text"] = "E-mail already exists, choose another.\n";
								header("Location: registration.php");
								die();
								
								
							}	
						?>
						
