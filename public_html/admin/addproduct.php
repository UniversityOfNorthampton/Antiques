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

		$stmt = $pdo->prepare('INSERT INTO stock (title, description, price, categoryId) 
							   VALUES (:title, :description, :price, :categoryid)');

		$criteria = [
			'title' => $_POST['title'],
			'description' => $_POST['description'],
			'price' => $_POST['price'],
			'categoryid' => $_POST['categoryid']
		];

		$stmt->execute($criteria);

		if ($_FILES['image']['error'] == 0) {
			$fileName = $pdo->lastInsertId() . '.jpg';
			move_uploaded_file($_FILES['image']['tmp_name'], '../productimages/' . $fileName);
		}

		echo 'Product added';
	}
	else {
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		?>


			<h2>Add Product</h2>

			<form action="addproduct.php" method="POST" enctype="multipart/form-data">
				<label>Product Name</label>
				<input type="text" name="title" />

				<label>Description</label>
				<textarea name="description"></textarea>

				<label>Price</label>
				<input type="text" name="price" />

				<label>Category</label>

				<select name="categoryid">
				<?php
					$stmt = $pdo->prepare('SELECT * FROM category');
					$stmt->execute();

					foreach ($stmt as $row) {
						echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
					}

				?>

				</select>

				<label>Product image</label>

				<input type="file" name="image" />

				<input type="submit" name="submit" value="Add Product" />

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
