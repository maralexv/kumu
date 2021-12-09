
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sandbox</title>
    <script src="https://d3js.org/d3.v7.min.js"></script>
</head>
<body>

    <?php

    // Pointer to the file
    $filename = 'kumu_input.csv';

    // Initiate main array to hold all the data form scv file 
    // and record inter-project connections
    $arr = []; 

    // Open the file for reading
    if (($filepointer = fopen("{$filename}", "r")) !== FALSE) 
    {
        // Each line in the file is converted into an individual array that we call $data
        // The items of the array are comma separated
        while (($data = fgetcsv($filepointer, 1000, ",")) !== FALSE) 
        {
            // Each individual array is being pushed into the nested array
            $arr[] = $data;	
        }

        // Close the file
        fclose($filepointer);
    }

    // Add an empty array (repository of connections) in the last item 
    // of the main array 
    for ($i = 0; $i < count($arr); $i++)
    {
        $arr[$i][count($arr[$i])-1] = [];
    }

    // Create additjonal array, its dimentios the same as the main array
    // to keep the connections 
    $con_arr = [];
    for ($i = 0; $i < count($arr); $i++)
    {
        for ($j = 0; $j < count($arr[$i]); $j++)
        {
            $con_arr[$i][$j] = [];
        }
    }

    // Loop through the main array to record connections in con_arr
    for ($i = 1; $i < count($arr)-1; $i++) 
    {
        // starting from the next item, check if [i][j] values appear 
        // in other cells of the matrix
        for ($j = 4; $j < count($arr[$i])-1; $j++)
        {
            // If the item in the row is empty OR equal to the prev one 
            // (eg. stakeholder fomr the same division), skip amnd move to 
            // the next item
            if (empty($arr[$i][$j]) || $arr[$i][$j] == $arr[$i][$j-2])
            {
                continue;
            }

            // Loop through all the items in the following rows
            for ($k = $i+1; $k < count($arr); $k++)
            {
                for ($m = 4; $m < count($arr[$k])-1; $m++)
                {
                    // If items match, record pointers 
                    if ($arr[$i][$j] == $arr[$k][$m])
                    {
                        array_push($con_arr[$i][$j], [$k, $m]);
                        array_push($con_arr[$k][$m], [$i, $j]);
                    }
                }    
            }
        }
    }

    // Record conneciotns in the main array, inserting connected Project IDs 
    // as elements of the array in Connections (item 14) for each project
    for ($i = 0; $i < count($con_arr); $i++)
    {
        for ($j = 0; $j < count($con_arr[$i]); $j++)
        {
            if (empty($con_arr[$i][$j]))
            {
                continue;
            }

            for ($el = 0; $el < count($con_arr[$i][$j]); $el++)
            {
                array_push($arr[$i][count($arr[$i])-1], $arr[$con_arr[$i][$j][$el][0]][0]);
            }
        }
    }

    // Display the array in a readable format
    echo "<pre>";
    var_dump($arr);
    echo "</pre>";

    echo "<pre>";
    print_r($con_arr);
    echo "</pre>";

    ?>
    
</body>
</html>
