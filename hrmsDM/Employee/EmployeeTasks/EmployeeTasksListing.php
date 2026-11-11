<?php
session_start();
if (!isset($_SESSION['emp_id'])) {
  echo "<script>console.log('Emp id not given');</script>";
  header("location: ../login.html");
}
function isTodayAtt($attendanceDate)
{
  // Convert the attendance date to a DateTime object
  $attendanceDateTime = new DateTime($attendanceDate);

  // Get today's date as a DateTime object
  $today = new DateTime();

  // Compare the dates (ignoring the time component)
  return $attendanceDateTime->format('Y-m-d') === $today->format('Y-m-d');
}

function getCurrentDate() {
  return date('Y-m-d'); // Format: YYYY-MM-DD
}

// Usage
$currentDate = getCurrentDate();
echo $currentDate;

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Employee Task Listing</title>
  <link rel="stylesheet" href="../Template/css/bootstrap.min.css">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link href="../Template/bootstrap-toggle/css/bootstrap-toggle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <link href="../Template/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
  <link href="../Template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <style>
    *{
      font-size:14px;
    }
    .table-header {
      background-color: black;
      color: white;
      border: none;
    }

    /* this is opening/closing form css */
    .table-bordered th,
    .table-bordered td {
      border-width: 2px;
      border-color: #19191a;
      border-left: none;
    }

    #employeetable th, 
#employeetable td {
    width: 150px; /* Adjust width as needed */
    white-space: nowrap; /* Prevent text wrapping */
    text-align:center;
}


    .table-bordered td input,
    .table-bordered td textarea {
      border: none;
      height: 40px;
    }

    /* <!-- this is opening/closing form css --> */
    .container {
      width: 750px;
      height: 610px;
      padding: 10px;
      background-color: #fff;
      border-radius: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      overflow-y: auto;
    }

    header {
      background: linear-gradient(45deg, #c40000 50%, #000000 50%);
      padding: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: #fff;
      border-radius: 10px 10px 0 0;
      font-size: 14px;
    }

    header h1 {
      font-size: 18px;
    }

    .date {
      font-size: 14px;
    }

    .content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      /* Two columns */
      grid-template-rows: 1fr 1fr;
      /* Two rows */
      grid-gap: 10px;
      /* Space between the boxes */
      padding: 10px 0;
      flex-grow: 1;
    }

    .box {
      background-color: #f0f0f0;
      padding: 10px;
      border-radius: 10px;
      font-size: 14px;
      display: flex;
      flex-direction: column;
      overflow-y: auto;
      /* Allow vertical scrolling */
      height: 200px;
      /* Set a fixed height for the box */
    }

    .box h2 {
      text-align: center;
      width: 100%;
      margin-bottom: 15px;
    }
    
    .box {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    
    .input-container {
      width: 100%;
    }

    h2 {
      margin-bottom: 10px;
      font-size: 14px;
    }

    .input-container {
      display: flex;
      align-items: center;
      margin-bottom: 8px;
    }

    .icon {
      margin-right: 8px;
      font-size: 14px;
      color: #999;
    }

    input {
      width: 100%;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }

    .submit-button {
      display: flex;
      justify-content: center;
      padding: 10px 0;
      position: sticky;
      bottom: 0;
      top: 20px;
      background-color: #fff;
      z-index: 999;
    }

    #submitbutton {
      padding: 8px 20px;
      background-color: #c40000;
      color: #fff;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-size: 15px;
    }

   

    .submitbutton button:hover {
      background-color: #900000;
    }

    input[type="radio"]:checked {
      visibility: visible !important;
    }

    /* send message modul */
    .container {
      width: 750px;
      padding: 10px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
    }
    .containerreport{
      height: 550px;
    }

    header {
      background: linear-gradient(45deg, #c40000 50%, #000000 50%);
      padding: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: #fff;
      border-radius: 10px 10px 0 0;
      font-size: 14px;
    }

    .content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      grid-gap: 10px;
      padding: 10px 0;
      flex-grow: 1;
    }


    .contentreport input{
      height: 40px;
      margin-top:20px;
    }


    .Repo-button{
      padding-top: 10px;
      margin-left:40%;
      margin-top:10px;
    }

    .Repo-button button {
      padding: 8px 20px;
      background-color: #c40000;
      color: #fff;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-size: 15px;
    }

    .Repo-button button:hover {
      background-color: #900000;
    }

    .hourlytasks,.intractbox{
      background-color: #f0f0f0;
      padding: 10px;
      border-radius: 10px;
      font-size: 14px;
      display: flex;
      flex-direction: column;
      height: 400px;
    }

    .msgbox {
      padding: 5px;
      width: 100%;
      resize: none;
      overflow-y: auto;
      height: 340px;
    }

    #hrmsg{
      height: 290px;
    }

    .employeemsg {
    width: 100%; /* Adjust width as needed */
    height: 200px; /* Set a fixed height */
    overflow-y: auto; /* Enable vertical scrollbar when content overflows */
    border: 1px solid #ccc; /* Optional: Add a border */
    padding: 10px; /* Optional: Add some padding */
    background-color: #f9f9f9; /* Light background for visibility */
    border-radius: 5px; /* Optional: Rounded corners */
}

/* Custom Scrollbar (optional for better styling) */
.employeemsg::-webkit-scrollbar {
    width: 8px; /* Width of scrollbar */
}

.employeemsg::-webkit-scrollbar-thumb {
    background-color: #888; /* Scrollbar color */
    border-radius: 5px;
}

.employeemsg::-webkit-scrollbar-thumb:hover {
    background-color: #555; /* Darker on hover */
}

    .send-button {
      text-align: right;
      padding-top: 10px;
    }

    .send-button button {
      padding: 8px 20px;
      background-color: #c40000;
      color: #fff;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-size: 15px;
    }

    .send-button button:hover {
      background-color: #900000;
    }

    .viewmsgcontainer{
      height: 550px;
    }


    @media (max-width: 768px) {
      #absentReason {
        width: 100% !important;
        margin-bottom: 10px;
      }
      #absent {
        width: 100%;
      }
    }

    .edit-view-cell {
        text-align: center;
        vertical-align: middle;
    }
    .edit-view-link {
        display: inline-block;
        width: 100%;
    }

    /* Custom radio button styles */
    input[type="radio"] {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      width: 20px;
      height: 20px;
      border: 2px solid #ccc;
      border-radius: 50%;
      outline: none;
      margin-right: 5px;
      vertical-align: middle;
      position: relative;
    }

    input[type="radio"]:checked::before {
      content: '';
      display: block;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    input[type="radio"][value="Present"]:checked::before {
      background-color: #4CAF50;
    }

    input[type="radio"][value="Absent"]:checked::before {
      background-color: #FF0000;
    }

    input[type="radio"][value="Present"]:checked + span {
      color: #4CAF50;
      font-weight: bold;
    }

    input[type="radio"][value="Absent"]:checked + span {
      color: #FF0000;
      font-weight: bold;
    }

    label {
      display: inline-flex;
      align-items: center;
      cursor: pointer;
    }

    /* Existing styles... */

    /* Style for all table headers */
    #employeetable th {
      text-align: center;
      vertical-align: middle;
    }

    /* Center align the Date column content */
    #employeetable td:nth-child(3) {
      text-align: center;
    }

    /* Style for the reason textarea */
    #reason {
      height: 130px;
      padding: 5px;
      vertical-align: top;
      width: 100%;
      resize: none;
      overflow-y: auto;
    }

    /* Custom scrollbar styles */
    #reason::-webkit-scrollbar {
      width: 8px;
    }

    #reason::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    #reason::-webkit-scrollbar-thumb {
      background: #888;
      border-radius: 4px;
    }

    #reason::-webkit-scrollbar-thumb:hover {
      background: #555;
    }
    #container1 {
  display: none;
}
  </style>

</head>

<body id="page-top">
  <!-- SIDEBAR -->
  <section id="sidebar">
    <a href="#" class="brand">
      <img src="../img/apple-touch-icon.png" alt="">
      <span class="text">Dialoguesmedia</span>
    </a>
    <ul class="side-menu top">
      <li class="active">
        <a href="#">
          <i class='bx bxs-dashboard'></i>
          <span class="text">Dashboard</span>
        </a>
      </li>


    </ul>
    <ul class="side-menu">
    </ul>
  </section>
  <!-- SIDEBAR -->

  <!-- CONTENT -->
  <section id="content">
    <!-- NAVBAR -->
    <nav>
      <i class='bx bx-menu'></i>
      <!-- <a href="#" class="nav-link">Search here</a> -->
      <form action="#">
        <div class="form-input">
          <input type="search" placeholder="Search...">
          <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
        </div>
      </form>

      <!-- logout btn  -->
      <a href="../login.html" style="background-color:#8e0c0c; padding: 5px 15px; cursor: pointer;font-style: normal;font-size:14px;color: white; border: none;" type="submit" name="logout">Logout</a>

      <a href="#" class="profile">
      </a>
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
      <!-- Page Wrapper -->
      <div id="wrapper">
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="card-body">
            <div class="modal fade" id="OpeningClosingModal" tabindex="-1" role="dialog" aria-labelledby="OpeningClosingModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role=" document">
                <div class="modal-content">
                  <div class="container" id="container">
                    <header>
                      <h1>Daily Report | Opening/Closing mail</h1>
                      <span class="date">Date <span id="currentDate"></span></span>
                      
                    </header>
                    <script>
    // Function to get today's date and format it as YYYY-MM-DD
    function getCurrentDate() {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var year = today.getFullYear();
        
        return year + '-' + month + '-' + day; // Format: YYYY-MM-DD
    }

    // Insert the current date into the span with id 'currentDate'
    document.getElementById('currentDate').textContent = getCurrentDate();
</script>
                    <input type="hidden" id="task_id" name="task_id" disabled>
                    <input type="hidden" id="type" name="type" disabled>

                    <div class="content">
                      <div class="box tasks">
                        <h2><b>Today's Tasks</b></h2>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task1" placeholder="Task 1">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task2" placeholder="Task 2">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task3" placeholder="Task 3">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task4" placeholder="Task 4">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task5" placeholder="Task 5">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task6" placeholder="Task 6">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task7" placeholder="Task 7">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task8" placeholder="Task 8">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task9" placeholder="Task 9">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task10" placeholder="Task 10">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task11" placeholder="Task 11">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task12" placeholder="Task 12">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task13" placeholder="Task 13">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task14" placeholder="Task 14">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task15" placeholder="Task 15">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task16" placeholder="Task 16">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task17" placeholder="Task 17">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task18" placeholder="Task 18">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task19" placeholder="Task 19">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task20" placeholder="Task 20">
                        </div>
                      </div>

                      <div class="box work-done">
                        <h2><b>Actual Work Done</b></h2>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone1" name="workdone1" placeholder="Work 1" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone2" name="workdone2" placeholder="Work 2" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone3" name="workdone3" placeholder="Work 3" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone4" name="workdone4" placeholder="Work 4" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone5" name="workdone5" placeholder="Work 5" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone6" name="workdone6" placeholder="Work 6" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone7" name="workdone7" placeholder="Work 7" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone8" name="workdone8" placeholder="Work 8" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone9" name="workdone9" placeholder="Work 9" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone10" name="workdone10" placeholder="Work 10" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone11" name="workdone11" placeholder="Work 11" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone12" name="workdone12" placeholder="Work 12" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone12" name="workdone13" placeholder="Work 13" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone12" name="workdone14" placeholder="Work 14" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone12" name="workdone15" placeholder="Work 15" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone12" name="workdone16" placeholder="Work 16" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone12" name="workdone17" placeholder="Work 17" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone12" name="workdone18" placeholder="Work 18" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone12" name="workdone19" placeholder="Work 19" disabled>
                        </div>
                        <div class="input-container">
                          <span class="icon vector-icon"><i class="fas fa-clipboard"></i></span>
                          <input type="text" id="workdone12" name="workdone20" placeholder="Work 20" disabled>
                        </div>

                      </div>

                      <div class="box backlog">
                        <h2><b>Any Backlog</b></h2>
                        <div class="input-container">
                          <span class="icon back-line-icon"><i class="fas fa-undo"></i></span>
                          <input type="text" id="backlog" name="backlog1" placeholder="Backlog 1">
                        </div>
                        <div class="input-container">
                          <span class="icon back-line-icon"><i class="fas fa-undo"></i></span>
                          <input type="text" id="backlog" name="backlog" placeholder="Backlog 2">
                        </div>
                        <div class="input-container">
                          <span class="icon back-line-icon"><i class="fas fa-undo"></i></span>
                          <input type="text" id="backlog" name="backlog" placeholder="Backlog 3">
                        </div>
                        <div class="input-container">
                          <span class="icon back-line-icon"><i class="fas fa-undo"></i></span>
                          <input type="text" id="backlog" name="backlog" placeholder="Backlog 4">
                        </div>
                        <div class="input-container">
                          <span class="icon back-line-icon"><i class="fas fa-undo"></i></span>
                          <input type="text" id="backlog" name="backlog" placeholder="Backlog 5">
                        </div>
                        <div class="input-container">
                          <span class="icon back-line-icon"><i class="fas fa-undo"></i></span>
                          <input type="text" id="backlog" name="backlog" placeholder="Backlog 6">
                        </div>
                        <div class="input-container">
                          <span class="icon back-line-icon"><i class="fas fa-undo"></i></span>
                          <input type="text" id="backlog" name="backlog" placeholder="Backlog 7">
                        </div>
                        <div class="input-container">
                          <span class="icon back-line-icon"><i class="fas fa-undo"></i></span>
                          <input type="text" id="backlog" name="backlog" placeholder="Backlog 8">
                        </div>
                        <div class="input-container">
                          <span class="icon back-line-icon"><i class="fas fa-undo"></i></span>
                          <input type="text" id="backlog" name="backlog" placeholder="Backlog 9">
                        </div>
                        <div class="input-container">
                          <span class="icon back-line-icon"><i class="fas fa-undo"></i></span>
                          <input type="text" id="backlog" name="backlog" placeholder="Backlog 10">
                        </div>
                        
                      </div>

                      <div class="box backlog-reason">
                        <h2><b>Reason for Backlog</b></h2>
                        <div class="input-container">
                          <span class="icon ep-back-icon"><i class="fas fa-arrow-right"></i></span>
                          <textarea id="reason" name="reason" placeholder="Type here" 
                                    style="height: 130px; padding: 5px; vertical-align: top; width: 100%; resize: none; overflow-y: auto;"></textarea>
                        </div>                        
                      </div>
                    </div>
                    <!-- <button id="submitbutton"></button> -->

                    <div class="submit-button">
                      <button type="button" id="submitbutton" onclick="submitattendance()"><b>Submit</b></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
          </div>
        

          <div id="ReportingModel" class="modal fade" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="containerreport" >
                  <header>
                    <h1>Every 2 Hours Reporting</h1>
                    <span class="date">Date <span id="currentDate1"></span></span>

                  </header>
                  <script>
                    // Function to get today's date and format it as YYYY-MM-DD
                    function getCurrentDate() {
                      var today = new Date();
                      var day = String(today.getDate()).padStart(2, '0');
                      var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
                      var year = today.getFullYear();

                      return year + '-' + month + '-' + day; // Format: YYYY-MM-DD
                    }

                    // Insert the current date into the span with id 'currentDate'
                    document.getElementById('currentDate').textContent = getCurrentDate();
                  </script>
                    <input type="hidden" id="task_id" name="task_id" disabled>
                    <input type="hidden" id="type" name="type" disabled>

                    <div class="contentreport">
                      <div class="box hourlytasks">
                        <h2><b>Tasks</b></h2>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task12pm" placeholder="12pm Task">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task2pm" placeholder="2pm Task">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task4pm" placeholder="4pm Task">
                        </div>
                        <div class="input-container">
                          <span class="icon ellipse-icon"><i class="fa-solid fa-circle"></i></span>
                          <input type="text" id="task6pm" placeholder="6pm Task">
                        </div>
                      </div>
                      <div class="Repo-button">
                      <button type="button" id="" onclick="submitattendance()"><b>Submit</b></button>
                      </div>
                    </div>
                    
                  </div>
                </div>
                </div>
              </div>
           </div>


          <div id="HRModal" class="modal fade" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="container viewmsgcontainer" >
                  <header>
                    <h1>Interact with Employee</h1>
                    <span class="date">Date <span id="currentDate1"></span></span>

                  </header>
                  <script>
                    // Function to get today's date and format it as YYYY-MM-DD
                    function getCurrentDate() {
                      var today = new Date();
                      var day = String(today.getDate()).padStart(2, '0');
                      var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
                      var year = today.getFullYear();

                      return year + '-' + month + '-' + day; // Format: YYYY-MM-DD
                    }

                    // Insert the current date into the span with id 'currentDate'
                    document.getElementById('currentDate').textContent = getCurrentDate();
                  </script>
                  <input type="hidden" id="selected_task_id" name="task_id" disabled>
                  <input type="hidden" id="type" name="type" disabled>

                  <div class="content">

                    <div class="box intractbox">
                      <h2><b>Recieve Messages</b></h2>
                      <div class="input-container">
                        <span class="icon ep-back-icon"><i class="fas fa-arrow-right"></i></span>
                        <div id="employeemsg" class="msgbox" name="reason" placeholder="Type here"
                          style=" "></div>
                      </div>
                    </div>

                    <div class="box intractbox">
                      <h2><b>Send Messages</b></h2>
                      <div class="input-container">
                        <span class="icon ep-back-icon"><i class="fas fa-arrow-right"></i></span>
                        <textarea id="hrmsg" name="reason" class="msgbox" placeholder="Type here"
                          style=""></textarea>
                      </div>
                      <div class="send-button">
                      <button type="button" id="send" onclick="submitMessage()"><b>send</b></button>
                    </div>
                    </div>
                    
                  </div>
                </div>
                </div>
              </div>
           </div>
                          
                
          <div class="card shadow mb-4">
            <div class="card-header">
              <h6 class="m-0 font-weight-bold text-danger fs-15">Employee Task Listing</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="employeetable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="table-header">
                      <th>Emp ID</th>
                      <th>Employee Name </th>
                      <th>Date</th>
                      <th>Mark Attendance</th>
                      <!-- <th>Ab Reason</th> -->
                      <th>Opening Time</th>
                      <th>Opening Report</th>
                      <th>Closing Report</th>
                      <th>Closeing Time</th>
                      <th>Every 2hr Reporting</th>
                      <th>Interact with Employee</th>
                    </tr>
                    
                  </thead>
                  <tbody>
                  <?php
                            include "table1.php";
                            
                            ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      
      <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      </div>
      <!-- End of Content Wrapper -->
      </div>
      <!-- End of Page Wrapper -->
    </main>
    <!-- MAIN -->
  </section>
  <!-- CONTENT -->
</body>
<!-- Page level plugins -->

<script src="../Template/vendor/jquery/jquery.min.js"></script>
<script src="../Template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../Template/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../Template/js/popper.min.js"></script>
<script src="../Template/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../Template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../Template/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
<!-- Core plugin JavaScript-->

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const today = new Date();
    const formattedDate = today.toLocaleDateString('en-GB'); // Format as DD/MM/YYYY
    document.getElementById('currentDate').textContent = formattedDate;
  });
</script>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    var presentRadio = document.getElementById('attendance_present');
    var absentRadio = document.getElementById('attendance_absent');
    var absentReason = document.getElementById("absentReason");
    var saveReasonBtn = document.getElementById("saveReasonBtn");

    // Add click event listeners to the radio buttons
    presentRadio.addEventListener('click', function() {
      disableRadio(absentRadio);
      markattendance('Present');
    });

    absentRadio.addEventListener('click', function() {
      //disableRadio(presentRadio);
      document.getElementById("attendance_absent").nextSibling.nodeValue = "";
      document.getElementById("absentReason").style.display = "inline-block";

    });

    absentRadio.addEventListener('click', function() {
      //disableRadio(presentRadio);
      document.getElementById("attendance_absent").nextSibling.nodeValue = "";
      document.getElementById("absent").style.display = "inline-block";

    });


    // Function to disable the specified radio button
    function disableRadio(radio) {
      radio.disabled = true;
    }
    // absentReason.addEventListener("blur", function() {
    //   // Show an alert when the user clicks out of the text box
    //   var reason = this.value.trim();
    //   if (reason !== null && reason !== "") {
    //     // Show an alert when the user clicks out of the text box
    //     var saveConfirmation = confirm("Do you want to save?");
    //     if (saveConfirmation) {
    //       // Add logic here to save the data
    //       markattendance('Absent');

    //     }
    //   } else {
    //     alert('Please Provide Reason of Absense');
    //   }
    // });
  });
  

  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    var dataTable = $('#reademployeetasks').DataTable({
      "order": [
        [0, "desc"]
      ]
    });

        var empIdFromUrl = "<?php echo isset($_GET['emp_id']) ? urlencode($_GET['emp_id']) : ''; ?>";
    if (!empIdFromUrl) {
      alert('Invalid URL: emp_id is required');
    } else {
      var url = './reademployeetasks.php?emp_id=' + empIdFromUrl;
    }
        $('#OpeningClosingModal').on('hidden.bs.modal', function() {
          console.log('Modal closed');
          resetvalues();
        });


  });
</script>

<script>
  function showmodal(rowdata, opening, closing) {
    $('#OpeningClosingModal').modal('show');

    // Select all inputs dynamically
    const inputs = document.querySelectorAll('[id^="task"], [id^="workdone"], [id^="backlog"], #reason');
    const typerow = document.getElementById('type');
    const task_id = document.getElementById('task_id');
    const submitbutton = document.getElementById('submitbutton');
    const OpeningClosingLabel = document.querySelector('.modal-content header h1');

    // Show/hide submit button only if it is today's date
    const today = new Date().toISOString().split('T')[0];
    submitbutton.style.display = (rowdata['attendance_date'] === today) ? 'inline-block' : 'none';

    // Set task ID
    task_id.value = rowdata['task_id'];

    // Set the modal title
    typerow.value = opening ? 'opening' : 'closing';
    OpeningClosingLabel.textContent = opening 
        ? 'Daily Report | Opening Mail' 
        : 'Daily Report | Closing Mail';

    // Set all inputs to disabled (read-only)
    inputs.forEach(input => {
        input.setAttribute('disabled', 'disabled');
        input.value = rowdata[input.id] || '';  // Set input values
    });
}







  function showHRModal(rowdata, opening) {
    $('#HRModal').modal('show'); // Show the modal

    var receiveMessageInput = document.getElementById('recieve');
    var sendMessageInput = document.getElementById('send');
    var typerow = document.getElementById('type');
    var sendButton = document.getElementById('sendButton');
    var hrHeader = document.querySelector('#HRModal header h1');

    // Set current date
   

    // Enable/disable fields based on opening
    if (opening) {
        typerow.value = 'open';
        hrHeader.textContent = 'Interact with HR | Open Messages';
        receiveMessageInput.removeAttribute('disabled');
        // sendMessageInput.removeAttribute('disabled');
        sendButton.style.display = 'inline-block';
    } else {
        typerow.value = 'closed';
        hrHeader.textContent = 'Interact with HR | Closed Messages';
        receiveMessageInput.setAttribute('disabled', 'disabled');
        // sendMessageInput.setAttribute('disabled', 'disabled');
        sendButton.style.display = 'none';
    }

    // Set values for input fields if rowdata exists
    receiveMessageInput.value = rowdata['recieve'] || '';
    sendMessageInput.value = rowdata['send'] || '';
}


// Function to get today's date in YYYY-MM-DD format
function getCurrentDate() {
    var today = new Date();
    var day = String(today.getDate()).padStart(2, '0');
    var month = String(today.getMonth() + 1).padStart(2, '0');
    var year = today.getFullYear();
    return day + '-' + month + '-' + year;
}

// Set the current date initially
document.getElementById('currentDate1').textContent = getCurrentDate();


function showReportingModal(rowdata) {
    $('#ReportingModel').modal('show'); // Show the modal

    // Select task input fields correctly
    var taskInputs = {
        task12pm: document.getElementById('task12pm'),
        task2pm: document.getElementById('task2pm'),
        task4pm: document.getElementById('task4pm'),
        task6pm: document.getElementById('task6pm')
    };

    var task_id = document.getElementById('task_id');
    var typerow = document.getElementById('type');

    // Set task_id and type
    task_id.value = rowdata['task_id'];
    typerow.value = 'reporting';

    // Array of task field names in correct order
    var taskKeys = ['task12pm', 'task2pm', 'task4pm', 'task6pm'];
    
    var enableNext = true; // Flag to control enabling

    // Iterate through each task input
    taskKeys.forEach((key) => {
        var input = taskInputs[key];

        if (rowdata[key]) {
            input.value = rowdata[key];
            input.setAttribute('disabled', 'disabled'); // Disable if already submitted
        } else if (enableNext) {
            input.value = ''; // Clear the input
            input.setAttribute('disabled', 'disabled'); // Enable first empty task
            enableNext = false; // Prevent enabling others
        } else {
            input.value = ''; // Clear other fields
            input.setAttribute('disabled', 'disabled'); // Keep them disabled
        }
    });
}


  // function toggleFormFields(checkbox) {
  //   var taskField = document.getElementById('taskField');
  //   var actualWorkField = document.getElementById('actualWorkField');
  //   var backlogField = document.getElementById('backlogField');

  //   if (checkbox.checked) {
  //     // Opening
  //     taskField.style.display = 'block';
  //     actualWorkField.style.display = 'none';
  //     backlogField.style.display = 'none';
  //   } else {
  //     // Closing
  //     taskField.style.display = 'none';
  //     actualWorkField.style.display = 'block';
  //     backlogField.style.display = 'block';
  //   }
  // }

  
 



  function markattendance(attendance) {
    console.log("<?php echo $_GET['emp_id']; ?>")
    var attendance_date = document.getElementById('attendance_date').innerText;
    if (attendance == 'Present') {
      var data = {
        "attendance_date": attendance_date,
        "attendance": 1,
        "emp_id": "<?php echo $_GET['emp_id']; ?>"
      }
      $.ajax({
        type: 'POST',
        url: 'create_employee_task.php',
        data: data,
        success: function(response) {
          console.log(response);
          if (response.status === 'success') {
            alert('Attendance marked successfully!');
            window.location.href = 'EmployeeTasksListing.php?emp_id=<?php echo $_GET['emp_id'] ?>';

          } else {
            alert('Error: ' + response.message);
          }
        },
        error: function(xhr, status, error) {
          alert('AJAX request failed: ' + status + ' - ' + error);
        }
      });
    } else {
      var absentReason = document.getElementById("absentReason").value;
      var data = {
        "attendance_date": attendance_date,
        "attendance": 0,
        "emp_id": "<?php echo $_GET['emp_id'] ?>",
        "reason": absentReason
      }
      $.ajax({
        type: 'POST',
        url: 'create_employee_task.php',
        data: data,
        success: function(response) {
          console.log(response);
          if (response.status === 'success') {
            alert('Attendance marked successfully!');
            window.location.href = 'EmployeeTasksListing.php?emp_id=<?php echo $_GET['emp_id'] ?>';

          } else {
            alert('Error: ' + response.message);
          }
        },
        error: function(xhr, status, error) {
          console.log('AJAX request failed: ' + status + ' - ' + error);
        }
      });
    }

  }

  function submitMessage() {
    let task_id = document.getElementById("selected_task_id").value.trim();
    let employeemsg = document.getElementById("hrmsg").value.trim();

    if (!task_id) {
        alert("Error: Task ID not selected!");
        return;
    }

    console.log("Submitting Task ID:", task_id); // Debugging log

    let formData = new FormData();
    formData.append("task_id", task_id);
    formData.append("hrmsg", employeemsg);

    fetch("submit_message.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.status === "success") {
            document.getElementById("hrmsg").value = ""; // Clear input after success
            window.location.href = 'EmployeeTasksListing.php?emp_id=<?php echo $_GET['emp_id'] ?>';
        }
    })
    .catch(error => console.error("Error:", error));
}



function selectTaskID(taskId) {
    console.log("Selected Task ID:", taskId); // Debugging: Check if taskId is received

    let taskInput = document.getElementById("selected_task_id");
    if (taskInput) {
        taskInput.value = taskId;
    } else {
        console.error("Hidden input field for task ID not found!");
    }
}

function fetchMessages(task_id) {
    fetch(`fetch_messages.php?task_id=${task_id}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                let messages = data.data;
                let msgContainer = document.getElementById("employeemsg"); // Employee messages container

                msgContainer.innerHTML = ""; // Clear previous messages

                messages.forEach(msg => {
                    let messageContent = `
                            <p><strong>${msg.employeemsg }</p>
                            
                       
                    `;

                    msgContainer.innerHTML += messageContent;
                });
                
            } else {
                document.getElementById("employeemsg").innerHTML = "<p>No messages or tasks found.</p>";
            }
        })
        .catch(error => console.error("Error fetching messages:", error));
}





  function fun1() {
    markattendance('Absent');
    // console.log(absentReason.value);


  }

  function submitattendance() {
    var task_id = document.getElementById('task_id');
    var typerow = document.getElementById('type');

    if (!task_id || !typerow) {
        console.error("Type or task_id element is missing.");
        return;
    }

    var formData = {
        "task_id": task_id.value,
        "type": typerow.value
    };

    formData["task12pm"] = getValueOrNull("task12pm");
    formData["task2pm"] = getValueOrNull("task2pm");
    formData["task4pm"] = getValueOrNull("task4pm");
    formData["task6pm"] = getValueOrNull("task6pm");
    // Include the new fields
  
    formData["reason"] = getValueOrNull("reason");

    for (var i = 1; i <= 20; i++) {
        formData["task" + i] = getValueOrNull("task" + i);
        formData["workdone" + i] = getValueOrNull("workdone" + i);
    }

    for (var i = 1; i <= 10; i++) {
        formData["backlog" + i] = getValueOrNull("backlog" + i);
    }

    console.log("Submitting Data: ", formData);

    $.ajax({
        type: 'POST',
        url: 'update_employee_task.php',
        contentType: 'application/json',
        data: JSON.stringify(formData),
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                alert(typerow.value + " updated successfully");
                $('#OpeningClosingModal').modal('hide');
                resetvalues();
                window.location.href = 'EmployeeTasksListing.php?emp_id=<?php echo $_GET['emp_id'] ?>';
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('AJAX request failed: ' + status + ' - ' + error);
        }
    });
}

// Function to return input value or null
function getValueOrNull(id) {
    var element = document.getElementById(id);
    return element && element.value.trim() !== '' ? element.value.trim() : null;
}


  function resetvalues() {
    var elements = ['task1', 'task2', 'task3', 'task4', 'task5', 'workdone1', 'workdone2', 'workdone3', 'workdone4', 'workdone5', 'backlog1', 'backlog2', 'backlog3', 'backlog4', 'backlog5', 'backlog6', 'backlog7', 'backlog8', 'backlog9', 'backlog10', 'reason', 'ab_reason','12pmtask','2pmtask','4pmtask','6pmtask'];

    elements.forEach(function(elementId) {
      var element = document.getElementById(elementId);
      if (element) {
        // Check if it's a form element with a value property
        if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA' || element.tagName === 'SELECT') {
          element.value = '';
        } else {
          element.innerText = '';
        }
      }
    });

  }

  function isToday(dateString) {
    var today = new Date();
    var dateParts = dateString.split("-");
    var attendanceDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
    return (
      today.getDate() === attendanceDate.getDate() &&
      today.getMonth() === attendanceDate.getMonth() &&
      today.getFullYear() === attendanceDate.getFullYear()
    );
  }
</script>



<!-- check_status -->
<script>
  function updateStatus() {
    alert("You are active");
    fetch('update_status.php')
      .then(response => response.text())
      .then(data => {
        document.getElementById('status').innerText = data;
        checkStatus();
      })
      .catch(error => console.error('Error:', error));
  }

  function checkStatus() {
    fetch('check_status.php')
      .then(response => response.text())
      .then(data => {
        document.getElementById('status').innerText = data;
      })
      .catch(error => console.error('Error:', error));
  }

  // Automatically check status every minute
  setInterval(checkStatus, 60000); // 60000 ms = 1 minute

  window.onload = function() {
    checkStatus();
  };


  var btn = getElementByid('absent');
  var reson = getElementByid('absentReason');


  function fun1() {
    markattendance('Absent');
    // console.log(absentReason.value);


  }
  // btn.addEventListener('click', fun1());
</script>
<!-- 
<script>
  var btn=getElementByid('absent');
  var reson=getElementByid('absentReason');


  function fun1(){
    
    alert("ahgfaggsc");
  }
  btn.addEventListener('click', fun1());
</script> -->

</html>