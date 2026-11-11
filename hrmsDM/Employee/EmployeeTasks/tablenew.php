<?php
require "reademployeetasks.php";

if ($response != false) {
    if ($response['status'] == 'success') {
        $data = $response['data'];
        if ($data == null) {
            echo "<script>console.log('No Data');</script>";
            echo '<tr>';
            // First column: Emp_ID
            echo '<td>' . $_GET['emp_id'] . '</td>';
            echo '<td>' . $_SESSION['employee'] . '</td>';
            // Second column: Date
            echo '<td id="attendance_date">' . date('Y-m-d') . '</td>';
            // Third column: Attendance with radio buttons Present and Absent
            echo '<td>';
            echo '<td>'.($row['attendance'] == 1 ? 'present' : 'absent') . '</td>';

            // echo '<input type="radio" id="attendance_present" name="attendance_status" value="Present"> Present ';
            // echo '<input type="radio" id="attendance_absent" name="attendance_status" value="Absent" data-toggle="tooltip" data-title="Click to add reason of absense"> Absent';
            // echo '<input type="text" id="absentReason" name="absent_reason" style="display:none;" class="form-control" placeholder="Enter reason">';
            echo '</td>';
            echo '<td>     </td>';
            echo '<td>Add</td>';
            // Fifth column: Closing with a text saying View
            echo '<td>Add</td>';
            echo '<td>   </td>';
            echo '</tr>';
        } else if (is_array($data)) {
            echo "<script>console.log('Considering Array');</script>";
            $check_set_vals = $data[0];
            if (!isTodayAtt($check_set_vals['attendance_date'])) {
                echo '<tr>';
                // First column: Emp_ID
                echo '<td>' . htmlspecialchars($check_set_vals['emp_id']) . '</td>';
                echo '<td>' . $_SESSION['employee'] . '</td>';
                // Second column: Date
                echo '<td id="attendance_date">' . date('Y-m-d') . '</td>';
                // // Third column: Attendance with radio buttons Present and Absent
                // echo '<td>';
                echo '<td>'.($row['attendance'] == 1 ? 'Present' : 'Absent') . '</td>';
                // echo '<input type="radio" id="attendance_present" name="attendance_status" value="Present"> Present ';
                // echo '<input type="radio" id="attendance_absent" name="attendance_status" value="Absent" data-toggle="tooltip" data-title="Click to add reason of absense"> Absent';
                // echo '<input type="text" id="absentReason" name="absent_reason" style="display:none;" class="form-control" placeholder="Enter reason">';
                // echo '</td>';
                echo '<td>     </td>';
                echo '<td>
                                                            Add
                                                    </td>';
                echo '<td>
                                                            Add
                                                    </td>';
                echo '<td>   </td>';
                echo '</tr>';
            }
            // It's an array, loop through each row
            foreach ($data as $row) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['emp_id']) . '</td>';
                echo '<td>' . $_SESSION['employee'] . '</td>';
                echo '<td>' . htmlspecialchars($row['attendance_date']) . '</td>';
                echo '<td>';
                echo '<input type="radio" value="Present" ' . ($row['attendance'] == 1 ? 'checked' : 'disabled') . ' > Present ';
                echo '<input type="radio" value="Absent" ' . ($row['attendance'] == 0 ? 'checked' : 'disabled') . ' > Absent';
                echo '</td>';
                echo '<td>' . htmlspecialchars(date('H:i:s', strtotime($row['opening_time']))) . '</td>';
                echo '<td>';
                if ($row['attendance'] == 0) {
                    echo 'Edit/View';
                } else {
                    echo '<a href="#" class="text-primary" onclick="showmodal(' . htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') . ', true, false)">
                                                            Edit/View
                                                        </a>';
                }
                echo '</td>';
                echo '<td>';
                if ($row['attendance'] == 0) {
                    echo 'Edit/View';
                } else {
                    echo '<a href="#" class="text-primary" onclick="showmodal(' . htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') . ', false, true)">
                                                            Edit/View
                                                        </a>';
                    echo '</td>';
                }
                echo '<td>' . htmlspecialchars(date('H:i:s', strtotime($row['closing_time']))) . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($data['emp_id']) . '</td>';
            echo '<td>' . $_SESSION['employee'] . '</td>';
            echo '<td>' . htmlspecialchars($data['attendance_date']) . '</td>';
            echo '<td>';
            echo '<td>'.($row['attendance'] == 1 ? 'present' : 'absent') . '</td>';
            // echo '<input type="radio" value="Present" ' . ($row['attendance'] == 1 ? 'checked' : 'disabled') . ' > Present ';
            // echo '<input type="radio" value="Absent" ' . ($row['attendance'] == 0 ? 'checked' : 'disabled') . ' > Absent';
            echo '</td>';
            echo '<td>' . htmlspecialchars($data['opening']) . '</td>';
            echo '<td>' . htmlspecialchars($data['closing']) . '</td>';
            echo '</tr>';
        }
    }
}
else {
    echo "<script>console.log('Some error');</script>";
}


