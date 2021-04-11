<?php


    include('config/db_connect.php');

     // write query for all sauce
     $sql = 'SELECT title, ingredients, id FROM sauces ORDER BY created_at';

     //make query and get result
     $result = mysqli_query($conn, $sql);

     // fetch the resulting rows as an array
     $sauces = mysqli_fetch_all($result, MYSQLI_ASSOC);

     // free result from memory
     mysqli_free_result($result);

     // close connection
     mysqli_close($conn);

?>
   





<!DOCTYPE html>
<html>
<?php include('temp/header.php');   ?>

<h4 class="center grey-text">Sauces!</h4>

<div class="container">
	<div class="row">
		
       <?php foreach($sauces as $sauce): ?>

       <div class="col s6 md3">   	
       	<div class="card z-depth-0">
       		<div class="card-content center">
       			<h6><?php echo htmlspecialchars($sauce['title']); ?></h6>
       		<ul>
       			<?php foreach (explode(',', $sauce['ingredients']) as $ing): ?>	
                  <li><?php echo htmlspecialchars($ing); ?></li>
       		<?php endforeach; ?>
       		</ul>
       		</div>
       		<div class="card-action right-align">
       			<a class="brand-text" href="details.php?id=<?php echo $sauce['id'] ?>">more info</a>
       		</div>
       	</div>
       </div>

       <?php endforeach; ?>


	</div>
	
</div>





<?php include('temp/footer.php');   ?>

</html>


