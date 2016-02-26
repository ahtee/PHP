<?php
	 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  
  // create short variable names
 // $searchtype=$_POST['searchtype'];
 // $searchterm=trim($_POST['searchterm']);

  require('mysqli_connect.php');
  
if (empty($_POST['searchtype'])){
	$errors[] = 'You forgot to enter a Search Type!';
  } else {
	$searchtype = mysqli_real_escape_string($dbc, trim($_POST['searchtype']));
  }
  
if (empty($_POST['searchterm'])){
	$errors[] = 'You forgot to enter a Search Term!';
  } else {
	$searchterm = mysqli_real_escape_string($dbc, trim($_POST['searchterm']));
  }

	if (empty($errors)){
	$query = "select * from customers where ".$searchtype." like '%".$searchterm."%'";
	$result= mysqli_query($dbc, $query);
	$num_results = mysqli_num_rows($result);

  if ($result){
  echo "<p>Number of customers found: ".$num_results."</p>";
  }

  for ($i=0; $i <$num_results; $i++) {
     $row = mysqli_fetch_assoc($result);
     echo "<p><strong>".($i+1).". Name: ";
     echo (stripslashes($row['name']));
     echo "</strong><br />Address: ";
     echo stripslashes($row['address']);
     echo "<br />City: ";
     echo stripslashes($row['city']);
     echo "</p>";
  }

  mysqli_free_result($result);
  mysqli_close($dbc);
  
  } else {
	echo '<p class="error">'.$errors[0].'</p>';
  } 
  
  
} 

?>
<html>
<head>
  <title>Book-O-Rama Customer Search</title>
</head>

<body>
  <h1>Book-O-Rama Customer Search</h1>

  <form action="results.php" method="post">
    Choose Search Type:<br />
    <select name="searchtype">
	  <option value="">
      <option value="name">Name
      <option value="city">City
    </select>
    <br />
    Enter Search Term:<br />
    <input name="searchterm" type="text" size="40">
    <br />
    <input type="submit" name="submit" value="Search">
  </form>

</body>
</html>

