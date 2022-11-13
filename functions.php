<?php
require_once "classes/class_User.php";


function getHeader()
{
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">';
    echo '<link rel="stylesheet" href="style/main.css">';
}

function getFooter()
{
    echo '<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>';
    echo '  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>';
}

function displayNavBar()
{
    $user = new User();
    echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">';

    echo '<div class="collapse navbar-collapse" id="navbarSupportedContent">';

    echo '<ul class="navbar-nav mr-auto">';

    echo '<li class="nav-item active"><a href="index.php" class="nav-link">Home</a>';

    if (checkIfItemInCart()) {
        // cookie is set, get information about items in shopping cart
        $items = getFromFile('shoppingCart.json');
        $cnt = count($items);
        echo "<li class='nav-item'><a href='shoppingCart.php' class='nav-link'>Shopping Cart ($cnt)</a>  ";
    } else {
        echo '<li class="nav-item"><a href="shoppingCart.php" class="nav-link">Shopping Cart</a>';
    }

    if ($user->isAdmin()) {
        echo '<li class="nav-item"><a href="adminPage.php" class="nav-link">Admin Page</a>';
    }

    if ($user->isLoggedIn()) {
        echo '<li class="nav-item"><a href="logout.php" class="nav-link">Logout</a>';
    } else {
        echo '<li class="nav-item"><a href="login.php" class="nav-link">Sign in</a>';
    }
    // You can add more pages here

    echo
        '</ul>';
    echo '</div>';
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
    // $valuesArray;
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
    echo '<table class="table table-striped">';
    $isFirstRow = false;

    foreach ($resArray as $item) {

        if ($isFirstRow == FALSE) {
            // first print headers
            echo  '<thead class="thead-dark">';
            echo "<tr>";
            foreach ($item as $key => $value) {
                echo "<th> $key </th>";
            }
            echo "</thead>";
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


function checkIfItemInCart()
{
    return isset($_COOKIE['cart']);
}


function getFromFile($filename)
{
    $headers = array('http' => array('method' => 'GET', 'header' => 'Content: type=application/json \r\n' . '$agent \r\n' . '$hash'));

    $context = stream_context_create($headers);

    $str = file_get_contents($filename, FILE_USE_INCLUDE_PATH, $context);

    $str = utf8_encode($str);

    $str = json_decode($str, true);


    return $str;
}


function removeFromCookie()
{
    if (isset($_COOKIE['cart'])) {
        unset($_COOKIE['cart']);
        setcookie('cart', null, -1, '/');
    }
}
