<?php
session_start();
include '../connection.php';
include '../toaster.php';
if($_SESSION['MESSAGECHECK'] == 1){
	echo '<script>showToaster(" Thank you for reporting! We will contact you soon.", "green")</script>';
	$_SESSION['MESSAGECHECK'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

	$name = $_POST['name'];
	$email = $_POST['email'];
	$note = $_POST['note'];


	$qry = "INSERT INTO report (name, email, note) VALUES (?, ?, ?)";
	$stmt = $con->prepare($qry);
	$stmt->bind_param("sss", $name, $email, $note);
	if ($stmt->execute()) {
		$_SESSION['MESSAGECHECK'] = 1;
		//echo '<script>showToaster(" Thank you for reporting! We will contact you soon.", "green")</script>';
		header("Location: contact.php");
        exit();
	} else {
		$_SESSION['MESSAGECHECK'] = 0;
		echo '<script>showToaster("Report submission failed. Please try again later.", "red")</script>';
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Contact Us </title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap');

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: 'Poppins', sans-serif;
		}

		.contact {
			position: relative;
			min-height: 100vh;
			padding: 50px 100px;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			background: url(../img/con-bg.jpg);
			background-size: cover;
		}

		.contact .content {
			max-width: 800px;
			text-align: center;
		}

		.contact .content h2 {
			font-size: 36px;
			font-weight: 500;
			color: #fff;
		}

		.contact .content p {
			font-weight: 300;
			color: #fff;
		}

		.container {
			width: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
			margin-top: 30px;
		}

		.container .contactInfo {
			width: 50%;
			display: flex;
			flex-direction: column;
		}

		.container .contactInfo .box {
			position: relative;
			padding: 20px 0;
			display: flex;
		}

		.container .contactInfo .box .icon {
			min-width: 60px;
			height: 60px;
			background: #fdfc6b;
			display: flex;
			justify-content: center;
			align-items: center;
			border-radius: 50%;
			font-size: 22px;
		}

		.container .contactInfo .box .text {
			display: flex;
			margin-left: 20px;
			font-size: 16px;
			color: #fff;
			flex-direction: column;
			font-weight: 300;
		}

		.container .contactInfo .box .text h3 {
			font-weight: 500;
			color: #fff;
		}

		.contactForm {
			width: 40%;
			padding: 40px;
			background: #fff;
		}

		.contactForm h2 {
			justify-content: center;
			font-size: 30px;
			color: #333;
			display: flex;
			font-weight: 500;
		}

		.contactForm .inputBox {
			position: relative;
			width: 100%;
			margin-top: 10px;
		}

		.contactForm .inputBox input,
		.contactForm .inputBox textarea {
			width: 100%;
			padding: 5px 0;
			font-size: 16px;
			margin: 10px 0;
			border: none;
			border-bottom: 2px solid #333;
			outline: none;
			resize: none;
		}

		.contactForm .inputBox span {
			position: absolute;
			left: 0;
			padding: 5px 0;
			font-size: 16px;
			margin: 10px 0;
			pointer-events: none;
			transition: 0.5s;
			color: #666;
		}

		.contactForm .inputBox input:focus~span,
		.contactForm .inputBox input:valid~span,
		.contactForm .inputBox textarea:focus~span,
		.contactForm .inputBox textarea:valid~span {
			color: black;
			font-size: 12px;
			transform: translateY(-20px);
		}

		.contactForm .inputBox input[type="submit"] {
			background: #fdfc6b;
			color: black;
			border: none;
			cursor: pointer;
			padding: 10px;
			font-size: 18px;
		}

		.home-link {
			color: black;
			top: 0;
			right: 0;
			margin-left: 20rem;
			text-decoration: none;
			font-size: 15px;
		}

		.home-link:hover {
			color: black;
			text-decoration: none;
			font-size: 17px;
		}

		.error {
			color: red;
			font-size: 14px;
			display: block;
			margin-top: 5px;
			transform: translateY(-20px);
		}


		@media (max-width: 991px) {
			.contact {
				padding: 50px;
			}

			.container {
				flex-direction: column;
			}

			.container .contactInfo {
				margin-bottom: 40px;
			}

			.container .contactInfo,
			.contactForm {
				width: 100%;
			}

		}
	</style>
</head>

<body>
	<section class="contact">
		<div class="content">
			<h2 h2>Contact Us</h2>
			<p>"Have something to share or a query about our revolutionary
				Bus Pass Management System? Drop us a message, and our experts will promptly
				provide the report you require. Experience the future of Bus Pass Management System today!"
			</p>
		</div>
		<div class="container">
			<div class="contactInfo">
				<div class="box">
					<div class="icon"><i class="fa-solid fa-envelope"></i></div>
					<div class="text">
						<h3>Email</h3>
						<p>buspassmsofficial@gmail.com</p>
					</div>
				</div>
				<div class="box">
					<div class="icon"><i class="fa-solid fa-phone"></i></div>
					<div class="text">
						<h3>Phone</h3>
						<p>123-456-789</p>
					</div>
				</div>
			</div>
			<div class="contactForm">
				<form action="../main/contact.php" method="POST">
					<h2>Give Feedback</h2>
					<hr>
					<div class="inputBox">
						<input type="text" name="name" id="name" required="required" oninput="validateName(this)">
						<span>Full Name</span>
						<span class="error" id="name-error"></span>
					</div><br>
					<div class="inputBox">
						<input type="text" name="email" id="email" required="required" oninput="validateEmail(this)">
						<span>Email</span>
						<span class="error" id="email-error"></span>
					</div><br>
					<div class="inputBox">
						<textarea required="required" name="note" id="note" oninput="validateNote(this)"></textarea>
						<span>Type Your Message...</span>
						<span class="error" id="note-error"></span>
					</div>
					<br>
					<div class="inputBox">
						<input type="submit" name="submit" value="Send">
					</div>
				</form>
				<a href="../user/user.php" class="home-link">Home</a>
			</div>
		</div>
	</section>
</body>
<script>
	function validateName(input) {
		const nameError = input.nextElementSibling.nextElementSibling;
		const namePattern = /^[a-zA-Z\s]*$/;

		if (input.value.trim() === "") {
			nameError.textContent = "Name is required.";
		} else if (!namePattern.test(input.value)) {
			nameError.textContent = "Name should only contain letters and spaces.";
		} else {
			nameError.textContent = "";
		}
	}

	function validateEmail(input) {
		const emailError = input.nextElementSibling.nextElementSibling;
		const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		if (!emailPattern.test(input.value)) {
			emailError.textContent = "Invalid email address.";
		} else {
			emailError.textContent = "";
		}
	}

	function validateNote(input) {
		const noteError = input.nextElementSibling.nextElementSibling;
		if (input.value.trim() === "") {
			noteError.textContent = "Message is required.";
		} else {
			noteError.textContent = "";
		}
	}

	function validateForm() {
		const nameInput = document.getElementById("name");
		const emailInput = document.getElementById("email");
		const noteInput = document.getElementById("note");
		const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;


		validateName();
		validateEmail();
		validateNote();

		if (nameInput.value.trim() === "" || !emailPattern.test(emailInput.value) || noteInput.value.trim() === "") {
			return false;
		}

		return true;
	}
</script>

</html>