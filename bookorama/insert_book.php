<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //MY INPUT
  
  require('mysqli_connect.php');

  $errors = array( );
	
  if (empty($_POST['isbn'])){
	$errors[] = 'You forgot to enter ISBN Number!';
  } else {
	$isbn = mysqli_real_escape_string($dbc, trim($_POST['isbn']));
  }
  if (empty($_POST['author'])){
	$errors[] = 'You forgot to enter Author Name!';
  } else {
	$author = mysqli_real_escape_string($dbc, trim($_POST['author']));
  }
  if (empty($_POST['title'])){
	$errors[] = 'You forgot to enter a Book Title!';
  } else {
	$title = mysqli_real_escape_string($dbc, trim($_POST['title']));
  }
  if (empty($_POST['price'])){
	$errors[] = 'You forgot to enter a Price!';
  } else {
	$price = mysqli_real_escape_string($dbc, trim($_POST['price']));
  }
	
  if (mysqli_connect_error()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }

  if (empty($errors)) { 
  $query  = 'insert into books (isbn, author, title, price) values (?, ?, ?, ?)';
  $result = @mysqli_query($dbc, $query);
  $stmt = mysqli_prepare($dbc, $query);
  mysqli_stmt_bind_param($stmt, 'issi', $isbn, $author, $title, $price);
  mysqli_stmt_execute($stmt);
  if(@mysqli_stmt_affected_rows($stmt) == 1){
		echo '<p>' . mysqli_stmt_error($stmt) . '</p>';
	}
  mysqli_stmt_close($stmt);
  } 

if ($stmt) { 
 echo "<p>The book was inserted.</p>"; 
 } else { 
 echo '<h1>System Error</h1>'; 
 //Debugging message: 
 //echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</p>'; 
} 

  mysqli_close($dbc);
}

?>

<html>
<head>
  <title>Book-O-Rama - New Book Entry</title>
</head>

<body>
  <h1>Book-O-Rama - New Book Entry</h1>

  <form action="insert_book.php" method="post">
    <table border="0">
      <tr>
        <td>ISBN</td>
         <td><input type="text" name="isbn" maxlength="13" size="13"></td>
      </tr>
      <tr>
        <td>Author</td>
        <td> <input type="text" name="author" maxlength="30" size="30"></td>
      </tr>
      <tr>
        <td>Title</td>
        <td> <input type="text" name="title" maxlength="60" size="30"></td>
      </tr>
      <tr>
        <td>Price $</td>
        <td><input type="text" name="price" maxlength="7" size="7"></td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" value="Register"></td>
      </tr>
    </table>
  </form>
</body>
</html>
