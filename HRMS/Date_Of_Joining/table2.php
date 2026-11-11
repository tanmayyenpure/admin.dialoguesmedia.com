<?php
require "read_doj.php"; // Ensure this file correctly returns JSON data

if (isset($response) && is_array($response) && $response['status'] === 'success') {
    $data = $response['data'];

    if (empty($data)) {
        echo "<script>console.log('No Data');</script>";
    } else {
        echo "<script>console.log('Considering Array');</script>";
        $c = 1;

        foreach ($data as $row) {
            echo '<tr>';
            echo '<td class="tg-4az1">' . htmlspecialchars($c) . '</td>';
            echo '<td class="tg-4az1" contenteditable="true" data-name="name" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['name']) . '</td>';
            echo '<td class="tg-4az1" contenteditable="true" data-name="college" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['college']) . '</td>';
            echo '<td class="tg-4az1" contenteditable="true" data-name="location" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['location']) . '</td>';
            echo '<td class="tg-4az1" contenteditable="true" data-name="email" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['email']) . '</td>';
            echo '<td class="tg-4az1" contenteditable="true" data-name="mobile" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['mobile']) . '</td>';
            echo '<td class="tg-4az1" contenteditable="true" data-name="department" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['department']) . '</td>';
            echo '<td class="tg-4az1" contenteditable="true" data-name="doj" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['doj']) . '</td>';
            echo '<td class="tg-4az1" contenteditable="true" data-name="duration" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['duration']) . '</td>';

            // Boolean fields with switches
            $boolValues = [
                'ejm', 'ol', 'is_employee', 'sod', 'video', 'review',
                'feedback_form', 'certificate', 'recommendation_letter', 'app_letter'
            ];

            foreach ($boolValues as $boolKey) {
                $value = isset($row[$boolKey]) ? (int)$row[$boolKey] : 0;
                $checked = ($value === 1) ? 'checked' : '';

                echo '<td class="tg-4az1">';
                echo '<div class="custom-control custom-switch">';
                echo '<input type="checkbox" class="custom-control-input" id="' . $boolKey . $c . '" name="' . $boolKey . $c . '" data-dojid="' . $c . '" data-boolkey="' . $boolKey . '" ' . $checked . ' data-initial-value="' . $value . '" onchange="handleCheckboxChange(this)">';
                echo '<label class="custom-control-label" for="' . $boolKey . $c . '"></label>';
                echo '</div>';
                echo '</td>';
            }

            // Additional fields
            echo '<td class="tg-4az1" contenteditable="true" data-name="batch" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['batch']) . '</td>';
            echo '<td class="tg-4az1" contenteditable="true" data-name="tpo" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['tpo']) . '</td>';
            echo '<td class="tg-4az1" contenteditable="true" data-name="tpo_contact" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['tpo_contact']) . '</td>';
            echo '<td class="tg-4az1" contenteditable="true" data-name="tpo_email" onfocus="handleFocus(this)" onblur="handleBlur(this)">' . htmlspecialchars($row['tpo_email']) . '</td>';

            echo '</tr>';
            $c++;
        }

        echo '<script>document.getElementById("SrNo").textContent = ' . $c . ';</script>';
    }
} else {
    echo "<script>console.log('Some error');</script>";
}
?>
