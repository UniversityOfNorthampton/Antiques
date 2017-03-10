<!DOCTYPE html>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Oxygen:400,300" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Condiment" rel="stylesheet">
		<link rel="stylesheet" href="styles.css"/>
		<title>Annie's Antiques - Contact Us</title>
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
		<h1>Contact us</h1>
		<p>Please enter your details below and we'll get in touch. We try to respond to all enquires within two working days.</p>

		<form action="contact2.php">
		<label>Your name</label> <input type="text" name="name" />
		<label>Your email address</label> <input type="text" name="email" />
		<label>Your telephone number</label> <input type="text" name="phone" />
		<label>Your enquiry</label> <textarea name="enquiry"></textarea>

		<input type="submit" name="submit" value="Send enquiry" />

		</form>
	</main>


	<footer>
		&copy; Annie's Antiques 2011
	</footer>

</body>
</html>
