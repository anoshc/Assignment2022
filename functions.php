<?php
require_once "classes/class_User.php";


function displayNavBar()
{
    $user = new User();
    echo "<nav>";

    echo "<a href='index.php'>Home</a>  ";
    echo "<a href='shoppingCart.php'>Shopping Cart</a>  ";


    if ($user->isAdmin()) {
        echo "<a href='adminPage.php'>Admin page</a>  ";
    }

    if ($user->isLoggedIn()) {
        echo "<a href='logout.php'>Logout</a>  ";
    } else {
        echo "<a href='login.php'>Sign in</a>  ";
    }
    // You can add more pages here


    echo "</nav>";
    echo "<br><br>";
}

// function to read file and return headers and entries
function readThisFile($filename)
{
    //echo "In readThisFile <br>";

    $file = fopen($filename, "r") or die("Unable to open file");

    //Output one line until end-of-file
    $idx = 0;
    while (!feof($file)) {

        if ($idx == 0) {
            $headersArray = fgetcsv($file);
        } else {
            $line = fgetcsv($file);

            if (!(is_null($line[1]))) {
                $valuesArray[$idx - 1] = $line;
            }
        }

        $idx++;
    }

    fclose($file);

    return array(
        'headersArray' => $headersArray,
        'valuesArray' => $valuesArray
    );
}

// creates a 2 dimensional associative array, given a headers array and a values array. 
function createAssocArray($headersArray, $valuesArray)
{
    // create an associative Array given headers and Values
    foreach ($valuesArray as $item => $value) {
        //print_r($item);print_r($value);echo "<br>";
        $idx = 0;
        foreach ($headersArray as $key) {
            $resArray[$item][$key] = $value[$idx];
            $idx++;
        }
    }

    return $resArray;
}


// take an associative array as input and creates a table from it. 
function createTable($resArray)
{
    echo "<table>";
    $isFirstRow = false;

    foreach ($resArray as $item) {

        if ($isFirstRow == FALSE) {
            // first print headers
            echo "<tr>";
            foreach ($item as $key => $value) {
                echo "<th> $key </th>";
            }
            echo "</tr>";

            //then print first row of values
            echo "<tr>";
            foreach ($item as $key => $value) {
                echo "<td> $value </td>";
            }
            echo "</tr>";

            $isFirstRow = TRUE;
        } else {
            // then print every subsequent row of values
            echo "<tr>";
            foreach ($item as $key => $value) {
                echo "<td> $value </td>";
            }
            echo "</tr>";
        }
    }
    echo "</table>";
}

function uploadProductImage($files)
{
    $target_dir = "data/";
    $file = $files['my_file']['name'];
    $path = pathinfo($file);
    $filename = $path['filename'] . uniqid();
    $ext = $path['extension'];
    $temp_name = $files['my_file']['tmp_name'];
    $filename_ext  = $filename . "." . $ext;
    $path_filename_ext = $target_dir . $filename_ext;

    move_uploaded_file($temp_name, $path_filename_ext);

    return $filename_ext;
}


