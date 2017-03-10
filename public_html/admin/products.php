<?php
$pdo = new PDO('mysql:dbname=antiques;host=127.0.0.1', 'student', 'student', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
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
		<section class="left">
			<ul>
				<li><a href="/admin/categories.php">View Categories</a></li>
				<li><a href="/admin/products.php">View Products</a></li>
			</ul>
		</section>

		<section class="right">

		
	<?php

		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		?>


			<h2>Current Products</h2>

			<a class="new" href="addproduct.php">Add new product</a>

			<?php
			echo '<table>';
			echo '<thead>';
			echo '<tr>';
			echo '<th>Name</th>';
			echo '<th style="width: 10%">Price</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '</tr>';

			$products = $pdo->query('SELECT * FROM stock');

			foreach ($products as $product) {
				echo '<tr>';
				echo '<td>' . $product['title'] . '</td>';
				echo '<td>£' . $product['price'] . '</td>';
				echo '<td><a style="float: right" href="editproduct.php?id=' . $product['id'] . '">Edit</a></td>';
				echo '<td><form method="post" action="deleteproduct.php">
				<input type="hidden" name="productId" value="' . $product['id'] . '" />
				<input type="submit" name="submit" value="Delete" />
				</form></td>';
				echo '</tr>';
			}

			echo '</thead>';
			echo '</table>';

		}

		else {
			?>
			<h2>Log in</h2>

			<form action="admin.php" method="post">
				<label>Username</label>
				<input type="text" name="username" />

				<label>Password</label>
				<input type="password" name="password" />

				<input type="submit" name="submit" value="Log In" />
			</form>
		<?php
		}
	?>

</section>
	</main>
	<footer>
		&copy; Annie's Antiques 2011
	</footer>

</body>
</html>
