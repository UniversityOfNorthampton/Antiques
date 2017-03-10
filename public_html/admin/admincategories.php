<?php
$pdo = new PDO('mysql:dbname=traveljobs;host=127.0.0.1', 'student', 'student');
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<link href='https://fonts.googleapis.com/css?family=Oxygen:400,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="assignment.css"/>
		<title>View Categories</title>
	</head>
	<body>

	<header>
		<section>
			<h1>Travel Jobs</h1>
		</section>
	</header>
	<nav>
		<ul>
			<li><a href="/">Home</a></li>
			<li><a href="jobs.php">Browse Jobs</a></li>
			<li><a href="admin.php">Admin</a></li>
		</ul>
	</nav>
	<main>
		
	<?php
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	?>

	<section class="left">
		<ul>
			<li><a href="admincategories.php">View categories</a></li>
			<li><a href="adminjobs.php">View Jobs</a></li>

		</ul>
	</section>

	<section class="right">
		<h2>Categories</h2>

		<a href="addcategory.php">Add new category</a>


		<?php

		$stmt = $pdo->prepare('SELECT * FROM category');

		$stmt->execute();

		echo '<table>';

		while ($row = $stmt->fetch()) {
			echo '<tr>';

			echo '<td>' . $row['name'] . '</td>';
			echo '<td><a href="editcategory.php?id=' . $row['id'] . '">Edit</a></td>';
			echo '<td><a href="deletecategory.php?id=' . $row['id'] . '">Delete</a></td>';
			echo '</tr>';
		}

		echo '</table>';

		?>

	</section>
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
	?>


	</main>

	<footer>

	&copy; Travel Jobs 2016
	</footer>

</body>
</html>
