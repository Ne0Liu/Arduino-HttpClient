<?php

/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// check for post data
if (isset($_GET["id"])) {
    $id = $_GET['id'];

    // get a product from products table
    $result = mysql_query("SELECT *FROM members WHERE id = $id");

    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {

            $result = mysql_fetch_array($result);
            // success
            $response["success"] = 1;
            $product=$result['lu']." ".$result['ld']." ".$result['cu']." ".$result['cd']." ".$result['ru']." ".$result['rd']." ".$result['ll']." ".$result['cc']." ".$result['rr'];
            // user node
            $response["product"] = array();

            array_push($response["product"], $product);

            // echoing JSON response

           echo json_encode($product);
           //$product=$result['lu']." ".result['ld']." ".result['cu']." ".result['cd']." ".result['ru']." ".result['rd']." ".result['ll']." ".result['cc']." ".result['rr'];
          //echo result['lu'];
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No product found";

            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";

        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>