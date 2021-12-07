
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sandbox</title>
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

    for ($i = 1; $i < count($myarray)/2; $i++) 
    {
            // check if [i][4] appears in other sub-arrays
            // and if yes, add pointer to that project at the end of the array item


            // check if [i][5] appears in other sub-arrays
            // and if yes, add pointer to that project at the end of the array item


            // check if [i][6] appears in other sub-arrays
            // and if yes, add pointer to that project at the end of the array item


            // check if [i][7] appears in other sub-arrays
            // and if yes, add pointer to that project at the end of the array item


            // check if [i][8] appears in other sub-arrays
            // and if yes, add strong pointer to that project at the end of the array item


            // check if [i][10] appears in other sub-arrays
            // and if yes, add strong pointer to that project at the end of the array item


            // check if [i][12] appears in other sub-arrays
            // and if yes, add strong pointer to that project at the end of the array item


            // check if [i][9] appears in other sub-arrays
            // and if yes, add pointer to that project at the end of the array item


            // check if [i][11] appears in other sub-arrays
            // and if yes, add pointer to that project at the end of the array item


            // check if [i][13] appears in other sub-arrays
            // and if yes, add pointer to that project at the end of the array item



    }

    // Close the file
    fclose($filepointer);
    }

    // Display the code in a readable format
    echo "<pre>";
    var_dump($myarray);
    echo "</pre>";

    echo "<p>";
    echo "array length: " . count($myarray) . "<br>";
    echo $myarray[7][8];
    echo "</p>";

    ?>
    
</body>
</html>
