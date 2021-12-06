
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

$filename = 'kumu_input.csv';

// The nested array to hold all the arrays
$myarray = []; 

// Open the file for reading
if (($filepointer = fopen("{$filename}", "r")) !== FALSE) 
{
  // Each line in the file is converted into an individual array that we call $data
  // The items of the array are comma separated
  while (($data = fgetcsv($filepointer, 1000, ",")) !== FALSE) 
  {
    // Each individual array is being pushed into the nested array
    $myarray[] = $data;		
  }

  // Close the file
  fclose($filepointer);
}

// Display the code in a readable format
echo "<pre>";
var_dump($myarray);
echo "</pre>";

?>
    
</body>
</html>
