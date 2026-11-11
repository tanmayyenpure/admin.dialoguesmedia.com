<?php
require '../formconnection.php';

// header('Content-Type: application/json');

try {
    $sql = "SELECT * FROM dateofjoining";
    $result = $conn->query($sql);  
    
    $dojs = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dojs[] = $row;
        }
    }

    $response = [
        'status' => 'success',
        'data' => $dojs
    ];
} catch (Exception $e) {
    $response = [
        'status' => 'error',
        'message' => 'Caught exception: ' . $e->getMessage()
    ];
}

// echo json_encode($response);
$conn->close();
?>

    

<!-- // require '../formconnection.php';

// try {
//     // Define the SQL query
//     $sql = "SELECT * FROM dateofjoining";
    
//     // Execute the query
//     $result = $conn->query($sql);
    
//     // Check if the query execution was successful
//     if ($result === false) {
//         throw new Exception("Database query failed: " . $conn->error);
//     }

//     // Initialize the array to hold the results
//     $dojs = array();

//     // Check if any rows are returned
//     if ($result->num_rows > 0) {
//         // Fetch and store each row in the array
//         while ($row = $result->fetch_assoc()) {
//             $dojs[] = $row;
//         }
//     } else {
//         echo "No records found.";
//     }
    
//     // You can now use the $dojs array for further processing
//    // print_r($dojs);
// } catch (Exception $e) {
//     // Handle any exceptions
//     echo "Error: " . $e->getMessage();
// } finally {
//     // Close the database connection
//     $conn->close();
// }


//     $response = array('status' => 'success', 'data' => $dojs);
// } catch (Exception $e) {
//     echo json_encode(array('status' => 'error', 'message' => 'Caught exception: ' . $e->getMessage()));
// }

$conn->close();
?> -->


