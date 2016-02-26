<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Future Value</title>
</head>
<body>
<?php # futureValue.php


define ('interest' , .08);	//static percentage
$amount = 1000; 			//1000 dollars from grandmothers will
$years = 20; 				//amount of time


// Calculate the interest
$total = $amount * (pow(1 + interest, 20));
				// multiply interest by amount of money
// Format the total:
$total = number_format($total, 2);

// Print the results:
echo '<p>Ben Otte says: The future value of your $' . $amount . ' after ' . $years . ' years is <b>' . $total . '</b>.</p>';

?>
</body>
</html>