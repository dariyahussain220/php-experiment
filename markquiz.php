<?php

 # Init the MySQL Connection
	$mysql_query = new mysqli('localhost', 'root', 'Admin@123', 'quiz');
  if(mysqli_connect_error())
    die( 'Failed to connect to MySQL Database Server - #'.mysql_errno().': '.mysql_error());
 
 # Prepare the SELECT Query
  $selectSQL = "SELECT * FROM attempts";
  
 # Execute the SELECT Query
 #echo 
 $selectRes = $mysql_query->query($selectSQL);
  if(!$mysql_query->query($selectSQL)){
    echo 'Retrieval of data from Database Failed - #'.mysql_errno().': '.mysql_error();
  }else{
    ?>

<center>
<table border="1">
  <thead>
    <tr>
      <th>attempt Id</th>
      <th>Date of attempt</th>
      <th>First Name</th>
      <th>Last Name</th>
	  <th>Student Number</th>
	  <th>No.Of attempts</th>
	  <th>Score</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if( mysqli_num_rows( $selectRes )==0 ){
        echo '<tr><td colspan="4">No Rows Returned</td></tr>';
      }else{
        while( $row = mysqli_fetch_assoc( $selectRes ) ){
          echo "<tr><td>{$row['attemptId']}</td><td>{$row['attemptingDate']}</td><td>{$row['firstName']}</td><td>{$row['lastName']}</td>
				<td>{$row['studentNumber']}</td><td>{$row['noOfAttempts']}</td><td>{$row['score']}</td></tr>\n";
        }
      }
    ?>
  </tbody>
</table>
</center>
    <?php
  }

?>