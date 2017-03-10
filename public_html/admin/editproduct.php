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

		$stmt = $pdo->prepare('UPDATE stock
								SET title = :title, 
								    description = :description, 
								    price = :price,
								    categoryId = :categoryid
								   WHERE id = :id 
						');

		$criteria = [
			'title' => $_POST['title'],
			'description' => $_POST['description'],
			'price' => $_POST['price'],
			'categoryid' => $_POST['categoryid'],
			'id' => $_POST['id']
		];

		$stmt->execute($criteria);

		if ($_FILES['image']['error'] == 0) {
			$fileName = $pdo->lastInsertId() . '.jpg';
			move_uploaded_file($_FILES['image']['tmp_name'], '../productimages/' . $fileName);
		}

		echo 'Product saved';
	}
	else {
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

			$currentProduct = $pdo->query('SELECT * FROM stock WHERE id = ' . $_GET['id'])->fetch();


		?>

			


			<h2>Edit Product</h2>

			<form action="editproduct.php" method="POST" enctype="multipart/form-data">

				<input type="hidden" name="id" value="<?php echo $currentProduct['id']; ?>" />
				<label>Product Name</label>
				<input type="text" name="title" value="<?php echo $currentProduct['title']; ?>" />

				<label>Description</label>
				<textarea name="description"><?php echo $currentProduct['description']; ?></textarea>

				<label>Price</label>
				<input type="text" name="price" value="<?php echo $currentProduct['price']; ?>" />

				<label>Category</label>

				<select name="categoryid">
				<?php
					$stmt = $pdo->prepare('SELECT * FROM category');
					$stmt->execute();

					foreach ($stmt as $row) {
						if ($currentProduct['categoryId'] == $row['id']) {
							echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
						}
						else {
							echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';	
						}
						
					}

				?>

				</select>


				<?php

					if (file_exists('../productimages/' . $currentProduct['id'] . '.jpg')) {
						echo '<img src="../productimages/' . $currentProduct['id'] . '.jpg" />';
					}
				?>
				<label>Product image</label>

				<input type="file" name="image" />

				<input type="submit" name="submit" value="Save Product" />

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
