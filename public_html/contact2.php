<!DOCTYPE html>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Oxygen:400,300" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Condiment" rel="stylesheet">
		<link rel="stylesheet" href="styles.css"/>
		<title>Annie's Antiques</title>
	</head>
	<body>
	<header>
		<section>
			<h1>Annie's Antiques</h1>
		</section>
	</header>
	<nav>
		<ul>
			<li><a href="/">Home</a></li>
			<li><a href="stock.php">Catalogue</a></li>
			<li><a href="about.html">About</a></li>
			<li><a href="contact.php">Contact us</a></li>
		</ul>
	</nav>
	<main class="home">
		<?php

			if (isset($_POST['submit'])) {
				$to = 'annie@v.je';

				$subject = 'Website contact form';

				$headers = "From: website@v.je" . "\r\n";
				$headers .= "Reply-To: website@v.je\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				$message = '';

				foreach ($_POST as $key => $value) {
					if ($key == 'submit') continue;

					$message .= '<p><strong>' . $key . ':</strong> ' . nl2br($value);
				}

				@mail($to, $subject, $message, $headers);

			}


		?>

		<p>Thank you for your equiry, we will be in touch as soon as possible</p>
	</main>




	<footer>
		&copy; Annie's Antiques 2011
	</footer>

</body>
</html>
