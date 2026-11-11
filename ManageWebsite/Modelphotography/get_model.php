<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include '../../formconnection.php'; // Adjust path if needed

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]);
    exit;
}

if (isset($_GET['id'])) {
    // Fetch single model by ID
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT id, image, name, gender, info, created_at FROM models WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => true, "data" => $result->fetch_assoc()]);
    } else {
        echo json_encode(["success" => false, "message" => "Model not found"]);
    }

    $stmt->close();

} elseif (isset($_GET['gender'])) {
    // Fetch models filtered by gender
    $gender = $_GET['gender'];

    if (strtolower($gender) === "all") {
        $sql = "SELECT id, image, name, gender, info, created_at FROM models ORDER BY created_at DESC";
        $stmt = $conn->prepare($sql);
    } else {
        $sql = "SELECT id, image, name, gender, info, created_at FROM models WHERE gender = ? ORDER BY created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $gender);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $models = [];
    while ($row = $result->fetch_assoc()) {
        $models[] = $row;
    }

    echo json_encode(["success" => true, "data" => $models]);

    $stmt->close();

} else {
    // Fetch all models by default
    $sql = "SELECT id, image, name, gender, info, created_at FROM models ORDER BY created_at DESC";
    $result = $conn->query($sql);

    $models = [];
    while ($row = $result->fetch_assoc()) {
        $models[] = $row;
    }

    echo json_encode(["success" => true, "data" => $models]);
}

$conn->close();
?>
