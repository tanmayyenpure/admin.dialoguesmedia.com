<?php 
require_once '../formconnection.php'; // Your database connection
require_once '../phpqrcode/qrlib.php'; // QR code generator
require_once '../dompdf/autoload.inc.php'; // Dompdf

use Dompdf\Dompdf;

if (isset($_GET['media_id'])) {
    $media_id = $_GET['media_id'];

    // Fetch invitation data
    $response = null;
    try {
        $query = "SELECT `name`, `designation`, `mobile`, `email` FROM `media` WHERE id='$media_id'";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $response = $result->fetch_assoc();
        }
    } catch (Exception $e) {
        exit('Database error.');
    }

    if ($response) {
        $fullname = $response['name'];
        $designation = $response['designation'];
        $mobileNumber = $response['mobile'];
        $emailAddress = $response['email'];

        // Paths
        $qr_path = __DIR__ . '/../temp/qr.png';
        
        // Create temp/ folder if not exists
        if (!file_exists(__DIR__ . '/../temp')) {
            mkdir(__DIR__ . '/../temp', 0777, true);
        }

        // Generate QR code
        QRcode::png("Name: $fullname\nDesignation: $designation\nPhone: $mobileNumber\nEmail: $emailAddress\nMedia: $media_id", $qr_path, 'H', 4, 4);

        // Encode QR image to base64
        $imageData = base64_encode(file_get_contents($qr_path));
        $qr_base64 = 'data:image/png;base64,' . $imageData;

        // Build HTML
        $html = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; text-align: center; padding-top: 30px; }
                .qr { margin-top: 20px; }
            </style>
        </head>
        <body>
            <h1>Invitation</h1>
            <p><strong>Name:</strong> $fullname</p>
            <p><strong>Designation:</strong> $designation</p>
            <p><strong>Mobile:</strong> $mobileNumber</p>
            <p><strong>Email:</strong> $emailAddress</p>
            <div class='qr'>
                <img src='$qr_base64' width='150' height='150'>
            </div>
        </body>
        </html>";

        // Load Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output PDF
        $dompdf->stream('Invitation.pdf', ['Attachment' => false]);
        exit; // IMPORTANT: stop script here
    } else {
        exit('No invitation data found.');
    }
} else {
    exit('No media ID provided.');
}
?>
