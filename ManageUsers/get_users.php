<?php
// Database connection
include '../formconnection.php'; 

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

// ✅ SQL query to fetch user details with last `current_date_time`
$sql = "
    SELECT 
        u.uid,
        u.name, 
        u.username, 
        u.role, 
        u.access, 
        CONCAT_WS(', ', u.view_access, u.edit_access, u.delete_access) AS page_access,
        IFNULL(MAX(ul.current_date_time), 'Never logged in') AS current_date_time
    FROM users u
    LEFT JOIN user_login ul ON u.uid = ul.uid
    GROUP BY u.uid
    ORDER BY current_date_time DESC;
";

$result = $conn->query($sql);

if ($result) {
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $users]);
} else {
    echo json_encode(['success' => false, 'message' => "Error: " . $conn->error]);
}

$conn->close();
?>
