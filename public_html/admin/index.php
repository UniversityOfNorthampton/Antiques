<?php
$pdo = new PDO('mysql:dbname=antiques;host=127.0.0.1', 'student', 'student');
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Oxygen:400,300" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Condiment" rel="stylesheet">
		<link rel="stylesheet" href="../styles.css"/>
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
	<main class="admin">
		
	<?php
	if (isset($_POST['submit'])) {
		if ($_POST['username'] == 'annie' && $_POST['password'] == 'l3tm31n') {
			$_SESSION['loggedin'] = true;	
		}
	}


	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	?>

	<section class="left">
		<ul>
			<li><a href="categories.php">View categories</a></li>
			<li><a href="products.php">View Products</a></li>

		</ul>
	</section>

	<section class="right">
	<h2>You are now logged in</h2>
	</section>
	<?php
	}

	else {
		?>
		<h2>Log in</h2>

		<form action="index.php" method="post" style="padding: 40px">
			<label>Username</label>
			<input type="text" name="username" />

			<label>Password</label>
			<input type="password" name="password" />

			<input type="submit" name="submit" value="Log In" />
		</form>
	<?php
	}
	?>


	</main>

	<footer>

	&copy; Annie's Antiques 2011
	</footer>

</body>
</html>
