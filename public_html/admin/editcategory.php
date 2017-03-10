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


	if (isset($_POST['submit'])) {

		$stmt = $pdo->prepare('UPDATE category SET name = :name WHERE id = :id ');

		$criteria = [
			'name' => $_POST['name'],
			'id' => $_POST['id']
		];

		$stmt->execute($criteria);
		echo 'Category added';
	}
	else {
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

			$currentCat = $pdo->query('SELECT * FROM category WHERE id = ' . $_GET['id'])->fetch();
		?>


			<h2>Add Category</h2>

			<form action="addcategory.php" method="POST">

				<input type="hidden" name="id" value="<?php echo $currentCat['id']; ?>" />
				<label>Name</label>
				<input type="text" name="name" value="<?php echo $currentCat['name']; ?>" />


				<input type="submit" name="submit" value="Save Category" />

			</form>
			

		<?php
		}

		else {
			?>
			<h2>Log in</h2>

			<form action="index.php" method="post">
				<label>Username</label>
				<input type="text" name="username" />

				<label>Password</label>
				<input type="password" name="password" />

				<input type="submit" name="submit" value="Log In" />
			</form>
		<?php
		}

	}
	?>


</section>
	</main>
	<footer>
		&copy; Annie's Antiques 2011
	</footer>

</body>
</html>
