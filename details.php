<?php 

include('config/db_connect.php');

if (isset($_POST['delete'])) {
	
	$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

	$sql = "DELETE FROM sauces WHERE id = $id_to_delete";

	if (mysqli_query($conn, $sql)) {
		// success
		header('Location: index.php');
	} {
         // failure
		echo 'query error: ' . mysqli_error($conn);
	}
}




//  check GET request id parameter
if (isset($_GET['id'])) {
	
	$id = mysqli_real_escape_string($conn, $_GET['id']);

	// make sql
	$sql = "SELECT * FROM sauces WHERE id = $id";

	// get the query result
	$result = mysqli_query($conn, $sql);

	// fetch result in array format
	$sauce = mysqli_fetch_assoc($result);

	mysqli_free_result($result);
	mysqli_close($conn);

}


 ?>

 <!DOCTYPE html>
 <html>
 
<?php include('temp/header.php');  ?>

<div class="container center">
	<?php if($sauce): ?>
		
		<h4><?php echo htmlspecialchars($sauce['title']); ?></h4>
		<p>Created by: <?php  echo htmlspecialchars($sauce['email']); ?></p>
		<p><?php echo date($sauce['created_at']); ?></p>
		<h5>Ingredients:</h5>
		<p><?php echo htmlspecialchars($sauce['ingredients']); ?></p>

		<!-- delete form -->
		<form action="details.php" method="POST">
         <form>
         	<input type="hidden" name="id_to_delete" value="<?php echo $sauce['id'] ?>">
         	<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
         </form>


		<?php else: ?>

			<h5>No such sauce exist!</h5>

		<?php endif; ?>
</div>


<?php include('temp/footer.php');   ?>

 </html>