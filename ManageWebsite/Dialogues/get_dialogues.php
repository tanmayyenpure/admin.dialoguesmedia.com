<?php
// Database connection
include '../../formconnection.php';

// Check connection
if ($conn->connect_error) {
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed'
    ]);
    exit;
}

$sql = "SELECT id, title, category, image, video, created_at FROM dialogues ORDER BY created_at DESC";
$result = $conn->query($sql);

$dialogues = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dialogues[] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'category' => $row['category'],
            'image' => $row['image'],
            'video' => $row['video'],
            'created_at' => $row['created_at']
        ];
    }
    echo json_encode([
        'success' => true,
        'data' => $dialogues
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No dialogues found'
    ]);
}

$conn->close();
?>
