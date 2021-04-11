
<?php

  include('config/db_connect.php');

$title = $email = $ingredients = '';
$errors = array('email'=>'', 'title'=>'', 'ingredients'=>'');

if(isset($_POST['submit'])){
	# code...

	// check mail
	if (empty($_POST['email'])) {
		$errors['email'] = 'An email is required </br>';
	} else {
		$email = $_POST['email'];
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = 'email must be a valid email address';
		}
	}

	// check title

	if (empty($_POST['title'])) {
		$errors['title'] = 'A title is required </br>';
	} else{
		$title = $_POST['title'];
		if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
			$errors['title'] = 'title must be letters and spaces only';
		}
	}

	       // ingredients

	if (empty($_POST['ingredients'])) {
		$errors['ingredients'] = 'An ingredient is required </br>';
	} else{
		$ingredients = $_POST['ingredients'];
		if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
			$errors['ingredients'] = 'ingredients must be a comma separated list';
	}
}

   if (array_filter($errors)) {
   	 // errors in the form
   } else {

   	$email = mysqli_real_escape_string($conn, $_POST['email']);
   	$title = mysqli_real_escape_string($conn, $_POST['title']);
   	$ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

   	// creat sql
   	$sql = "INSERT INTO sauces(title,email,ingredients) VALUES('$title', '$email', '$ingredients')";

   	// save to db and check
   	if (mysqli_query($conn, $sql)) {
   		// success
   		header('Location: index.php');
   	} else{
   		// error
   		echo 'query error: '. mysqli_error($conn);
   	}
   	    
   
}
}




?>

<!DOCTYPE html>
<html>
<?php include('temp/header.php');   ?>

<section class=" container grey-text">
  <h4 class="center">Add a sauce</h4>
<form class="white" action="add.php" method="POST">
	<label>Your Email:</label>
	<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
	<div class="red-text"><?php echo $errors['email']; ?></div><br><br>
	<label>Sauce Title:</label>
	<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
	<div class="red-text"><?php echo $errors['title']; ?></div><br>
	<label>Ingredients:</label>
	<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
	<div class="red-text"><?php echo $errors['ingredients']; ?></div>
	<div class="center"><br>
		<input type="submit" name="submit" value="submit" class="btn brand z-depth-o">
	</div>

</form>
</section>


<?php include('temp/footer.php');   ?>
</html>