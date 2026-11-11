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
            echo '<td id="attendance_date">' . date('m-d-Y') . '</td>';
            // Third column: Attendance with radio buttons Present and Absent
            echo '<td>';
            echo '<input type="radio" id="attendance_present" name="attendance_status" value="Present" disable style="transform: scale(0.7); margin-right: 5px;"> Present ';
            echo '<input type="radio" id="attendance_absent" name="attendance_status" value="Absent" disable data-toggle="tooltip" data-title="Click to add reason of absense" style="transform: scale(0.7); margin-right: 5px;"> Absent';
            echo '<div style="display: flex; align-items: center;">';
            echo '<input type="text" id="absentReason" name="absent_reason" style="display:none; width: 250px;" class="form-control" placeholder="Enter reason">';
            echo '<input type="button" onClick="validateForm()" value="Save" id="absent" name="absent_reason" class="btn font-weight-normal" style="display: none; background-color: #8e0c0c; color: white; padding: 10px 20px; margin-left: 10px; border: none; border-radius: 5px; font-size: 14px; cursor: pointer; transition: background-color 0.3s ease;">';
            
            // reason change

            echo '<script>
            function validateForm() {
                var reason = document.getElementById("absentReason").value;
                if (reason.trim() === "") {
                    alert("Please enter a reason.");
                    return false;
                } else {
                    fun1(); // Call fun1() if validation passes
                }
            }
            
            </script>';
            
            // end

            echo '</div>';
            echo '</td>';
            echo '<td>     </td>';
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
                echo '<td id="attendance_date">' . date('d-m-Y') . '</td>';
                // Third column: Attendance with radio buttons Present and Absent
                echo '<td>';
                echo '<input type="radio" id="attendance_present" name="attendance_status" value="Present" disable style="transform: scale(0.7); margin-right: 5px;"> Present';
                echo '<input type="radio" id="attendance_absent" name="attendance_status" value="Absent" disable data-toggle="tooltip" data-title="Click to add reason of absense" style="transform: scale(0.7); margin-right: 5px;"> Absent';
             
                echo '<div style="display: flex; align-items: center;">';
                echo '<input type="text" id="absentReason" name="absent_reason" style="display:none;" class="form-control" placeholder="Enter reason" action="savereason.php" method="post">';
                echo '<input type="submit" onClick="fun1()" value="Save" id="absent" name="absent_reason" style="display:none; background-color:#8e0c0c; color:white; padding:2px; margin-left:10px;">';
                echo '</div>';


                echo '</td>';
                echo '<td>     </td>';
                echo '<td>
                                                            Add
                                                    </td>';
                echo '<td>
                                                            Add
                                                    </td>';
                echo '<td>   </td>';
                echo '<td>
                           Add
                     </td>';
                echo '<td>
                     Add
                          </td>';
                echo '</tr>';
            }
            // It's an array, loop through each row
            foreach ($data as $row) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['emp_id']) . '</td>';
                echo '<td>' . $_SESSION['employee'] . '</td>';
                echo '<td>' . htmlspecialchars($row['attendance_date']) . '</td>';
                echo '<td>';
              
                echo '<input type="radio" value="Present" ' . ($row['attendance'] == 1 ? 'checked' : 'disabled') . ' style="transform: scale(0.7); margin-right: 5px;" readonly> Present ';
                echo '<input type="radio" value="Absent" ' . ($row['attendance'] == 0 ? 'checked' : 'disabled') . ' style="transform: scale(0.7); margin-right: 5px;" readonly> Absent';
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
                echo '<td>
                        <a href="#" class="text-primary" onclick="showReportingModal(' . htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') . ')">
                            View Report
                        </a>
                      </td>';

                      echo '<td>
                            <a href="#" class="text-primary" 
                            onclick="fetchMessages(' . htmlspecialchars($row['task_id']) . '); 
                                        selectTaskID(' . htmlspecialchars($row['task_id']) . '); 
                                        showHRModal(' . htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') . ')">
                                View Msg
                            </a>
                        </td>';

                  
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($data['emp_id']) . '</td>';
            echo '<td>' . $_SESSION['employee'] . '</td>';
            echo '<td>' . htmlspecialchars($data['attendance_date']) . '</td>';
            echo '<td>';
            echo '<input type="radio" value="Present" ' . ($row['attendance'] == 1 ? 'checked' : 'disabled') . ' style="transform: scale(0.7); margin-right: 5px;" readonly> Present ';
            echo '<input type="radio" value="Absent" ' . ($row['attendance'] == 0 ? 'checked' : 'disabled') . ' style="transform: scale(0.7); margin-right: 5px;" readonly> Absent';
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



