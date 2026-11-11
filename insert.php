<?php
include 'formconnection.php';
$pic = mysqli_query($conn, "SELECT * FROM `media`");
while ($row = mysqli_fetch_array($pic)) {
    echo "
        <tr>
            <td>$row[Id]</td>
            <td>$row[Name]</td>
            <td>$row[Designation]</td>
            <td>$row[company]</td>
            <td>$row[address]</td>
            <td>$row[mobile]</td>
            <td>$row[email]</td>
            <td>$row[city]</td>
            <td>$row[state]</td>
            <td>$row[pincode]</td>
            <td>$row[date]</td>
            <td>$row[visitor]</td>

            <td><img src='$row[Image]'  width = '30px'  height = '20px'></td>

            <td>$row[feedback]</td> 
            <td><a href='update.php? Id= $row[Id]' class = 'btn btn-danger'>Edit</a></td>
            <td><a href='delete.php? Id= $row[Id]' class = 'btn btn-danger'>Delete</a></td>  
        </tr>
        ";
    }
?>