<?php
      
      // connect to database
     $conn = mysqli_connect('localhost', 'steev', 'steev1234', 'nice_sauce');


        // check connection
     if (!$conn) {
     	 echo 'connection error: '  . mysqli_connect_error();
     }

 ?>