
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
        // starting from the next item, check if same divisions, 
        // stakeholders or departments appear in other items
        for ($j = 4; $j < count($myarray[$i]); $j++)
        {
            for ($k = $i+1; $k < count($myarray); $k++)
            {
                for ($m = 4; $m < count($myarray[$k]); $m++)
                {
                    if ($myarray[$i][$j] == $myarray[$k][$m])
                    {
                        // if yes, add pointer to that project at the end of the 
                        // current ith item
                    }

                }    
            }
        }
    }

    // Close the file
    fclose($filepointer);
    }

    // Display the code in a readable format
    echo "<pre>";
    var_dump($myarray);
    echo "</pre>";

    echo "<p>";
    echo "half-length = " . count($myarray)/2 . "<br>";
    echo "item [7][8] = " . $myarray[7][8];
    echo "</p>";

    ?>
    
</body>
</html>
