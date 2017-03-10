<!DOCTYPE html>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Oxygen:400,300" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Condiment" rel="stylesheet">
		<link rel="stylesheet" href="styles.css"/>
		<title>Annie's Antiques - Jewlry</title>
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
	<main class="stock">
		<ul class="categories">
			<li><a href="paintings.php">Paintings</a></li>
			<li><a href="furniture.php">Furniture</a></li>
			<li><a href="kitchenware.php">Kitchenware</a></li>
			<li class="current"><a  href="jewelry.php">Jewelry</a></li>
		</ul>

		<div class="products">

		<h1>Jewelry</h1>

		<img src="images/jewlry.jpg" alt="Jewlry" />
<?php
$pdo = new PDO('mysql:dbname=antiques;host=127.0.0.1', 'student', 'student');

$products = $pdo->query('SELECT * FROM stock WHERE categoryId = 4');


echo '<ul>';
foreach ($products as $product) {
	
	echo '<li>';
	if (is_file('./productimages/' . $product['id'] . '.jpg')) {
		echo '<img alt="' . $product['title'] . '" src="productimages/' . $product['id'] . '.jpg" />';
	}
	else {
		echo '<div class="noimage"></div>';
	}
	echo '<div class="info"><h2>' . $product['title'] . '</h2>';
	echo '<p>' . nl2br($product['description']) . '</p>';
	echo '<h3>£' . $product['price'] . '</h3></div>';

}
echo '</ul>';
?>
		</div>
	</main>


	<footer>
		&copy; Annie's Antiques 2011
	</footer>

</body>
</html>
