<?php
include "read_typedata.php";

$contenteditable = "false";
if ($response != false) {
  if ($response['status'] == 'success') {
    $data = $response['data'];
    if ($data == null) {
      echo "<script>console.log('No Data');</script>";
    } else if (is_array($data) && $type == 1) {
      echo "<script>console.log('Considering Array');</script>";

      $c = 1;
      foreach ($data as $row) {
        echo '<tr>';
        echo '<td></td>';
        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
        echo '<td contenteditable="' . $contenteditable . '" data-id="' . $row['id'] . '" data-name="name" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['name']) . '</td>';
        echo '<td contenteditable="' . $contenteditable . '" data-id="' . $row['id'] . '" data-name="designation" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['designation']) . '</td>';
        echo '<td contenteditable="' . $contenteditable . '" data-id="' . $row['id'] . '" data-name="company" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['company']) . '</td>';
        echo '<td contenteditable="' . $contenteditable . '" data-id="' . $row['id'] . '" data-name="address" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['address']) . '</td>';
        echo '<td contenteditable="' . $contenteditable . '" data-id="' . $row['id'] . '" data-name="mobile" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['mobile']) . '</td>';
        echo '<td contenteditable="' . $contenteditable . '" data-id="' . $row['id'] . '" data-name="email" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['email']) . '</td>';
        echo '<td contenteditable="' . $contenteditable . '" data-id="' . $row['id'] . '" data-name="city" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['city']) . '</td>';
        echo '<td contenteditable="' . $contenteditable . '" data-id="' . $row['id'] . '" data-name="state" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['state']) . '</td>';
        echo '<td contenteditable="' . $contenteditable . '" data-id="' . $row['id'] . '" data-name="pincode" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['pincode']) . '</td>';
        echo '<td contenteditable="' . $contenteditable . '" data-id="' . $row['id'] . '" data-name="date" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['date']) . '</td>';
        echo '<td contenteditable="' . $contenteditable . '" data-id="' . $row['id'] . '" data-name="visitor" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['visitor']) . '</td>';
        echo '<td contenteditable="' . $contenteditable . '" data-id="' . $row['id'] . '" data-name="language" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['language']) . '</td>';
        echo '<td contenteditable="' . $contenteditable . '" data-id="' . $row['id'] . '" data-name="languages" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['languages']) . '</td>';
        echo '<td contenteditable="' . $contenteditable . '" data-id="' . $row['id'] . '" data-name="image" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . '<a href="data:image;base64,' . base64_encode($row['image']) . '" download="image.jpg" style="color:black;">Download Image</a></td>';
        echo '<td contenteditable="' . $contenteditable . '" data-id="' . $row['id'] . '" data-name="feedback" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['feedback']) . '</td>';
        echo '<td contenteditable="' . $contenteditable . '" data-id="' . $row['id'] . '" data-name="location" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['location']) . '</td>';
        echo '<td><a href="../dashEID.php?id=' . $row['id'] . '" class="btn btn-sm" title="Edit"><i class="fas fa-edit"></i></a></td>';
        echo '<td><button onclick="submitRow(' . $row['id'] . ')"class="btn btn-danger btn-circle">Submit</button></td>';
        // echo '<td data-name="project_id" onfocus="handleFocus(this)">' . htmlspecialchars($row['project_id']) . '</td>';
        // echo '<td data-name="Type" onfocus="handleFocus(this)">' . htmlspecialchars($row['Type']) . '</td>';
        echo '</tr>';
        $c += 1;
      }
    } else if (is_array($data) && $type == 2) {
      echo "<script>console.log('Considering Array 2');</script>";

      // It's an array, loop through each row
      $c = 1;
      foreach ($data as $row) {
        echo '<tr>';
        echo '<td></td>';
        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['designation']) . '</td>';
        echo '<td>' . htmlspecialchars($row['company']) . '</td>';
        echo '<td>' . htmlspecialchars($row['address']) . '</td>';
        echo '<td>' . htmlspecialchars($row['mobile']) . '</td>';
        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
        echo '<td>' . htmlspecialchars($row['city']) . '</td>';
        echo '<td>' . htmlspecialchars($row['state']) . '</td>';
        echo '<td>' . htmlspecialchars($row['pincode']) . '</td>';
        echo '<td>' . htmlspecialchars($row['date']) . '</td>';
        echo '<td>' . htmlspecialchars($row['visitor']) . '</td>';
        echo '<td>' . htmlspecialchars($row['language']) . '</td>';
        echo '<td>' . htmlspecialchars($row['languages']) . '</td>';
        echo '<td>' . '<a href="data:image;base64,' . base64_encode($row['image']) . '" download="image.jpg" style="color:black;">Download Image</a></td>';
        echo '<td>' . htmlspecialchars($row['feedback']) . '</td>';
        echo '<td>' . htmlspecialchars($row['location']) . '</td>';
        echo '<td>' . '<a href="https://dialoguesmedia.com/OurProject/invitation.php?media_id=' . htmlspecialchars($row['id']) . '" style="color:black;">Download QR</a></td>';
        // echo '<td>' . htmlspecialchars($row['project_id']) . '</td>';
        // echo '<td>' . htmlspecialchars($row['Type']) . '</td>';
        echo '</tr>';
        $c += 1;
      }
    }
  }
} else {
  echo "<script>console.log('Some error');</script>";
}
?>
