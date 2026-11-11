<?php

session_start();


if (isset($_GET['submit'])) {
  
  require '../invitation.php';

}
include '../formconnection.php';
// if (!isset($_SESSION['emp_id'])) {
//   echo "<script>console.log('Emp id not given');</script>";s
//   header("location:/OurProject/login.html");
// } else {
//   $emp_id = isset($_SESSION['emp_id']) ? $_SESSION['emp_id'] : null;
  $project_id = isset($_GET['project_id']) ? $_GET['project_id'] : null;
  $media_id = isset($_GET['media_id']) ? $_GET['media_id'] : null;
   $id = isset($_GET['id']) ? $_GET['id'] : 'create';

  /// trial raj
if($project_id!=null)     {
  $sql = "SELECT * FROM project WHERE pid = '$project_id'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    // Output data of the single row
    $row = $result->fetch_assoc();
} 
}
if($media_id!=null) {
  $sql = "SELECT * FROM media WHERE id = '$media_id'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    // Output data of the single row
    $media = $result->fetch_assoc();
} 
}

   // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - Description: " . $row["description"]. "<br>";
// } else {
//     echo "0 results";
// }






?>

<div class="div">
  <div class="div-2">
    <div class="div-3">
      <div class="column">
        <div class="div-4">
          <img
            loading="lazy"
            src="../<?php echo $row["logo_path"] ?>"
            class="img"
          />
          <!-- <div class="div-5">
            <br />
            MUNCHEN -->
          <!-- </div> --> 
        </div>
      </div>
      <div class="column-2">
        <div class="div-6">
          <div class="div-7">
            <div class="column-3">
              <div class="div-8">
                <div class="div-9">Marketing Partner</div>
                <div class="div-10"></div>
              </div>
            </div>
            <div class="column-4">
              <img
                loading="lazy"
                srcset="
                  https://cdn.builder.io/api/v1/image/assets/TEMP/1e9ac30d9f150b290e6968f23b15fab1a3faddb9c53f3ed332a6c12a9822ebc9?apiKey=93d6739517cb41448f62dbf5c2765c87&width=100   100w,
                  https://cdn.builder.io/api/v1/image/assets/TEMP/1e9ac30d9f150b290e6968f23b15fab1a3faddb9c53f3ed332a6c12a9822ebc9?apiKey=93d6739517cb41448f62dbf5c2765c87&width=200   200w,
                  https://cdn.builder.io/api/v1/image/assets/TEMP/1e9ac30d9f150b290e6968f23b15fab1a3faddb9c53f3ed332a6c12a9822ebc9?apiKey=93d6739517cb41448f62dbf5c2765c87&width=400   400w,
                  https://cdn.builder.io/api/v1/image/assets/TEMP/1e9ac30d9f150b290e6968f23b15fab1a3faddb9c53f3ed332a6c12a9822ebc9?apiKey=93d6739517cb41448f62dbf5c2765c87&width=800   800w,
                  https://cdn.builder.io/api/v1/image/assets/TEMP/1e9ac30d9f150b290e6968f23b15fab1a3faddb9c53f3ed332a6c12a9822ebc9?apiKey=93d6739517cb41448f62dbf5c2765c87&width=1200 1200w,
                  https://cdn.builder.io/api/v1/image/assets/TEMP/1e9ac30d9f150b290e6968f23b15fab1a3faddb9c53f3ed332a6c12a9822ebc9?apiKey=93d6739517cb41448f62dbf5c2765c87&width=1600 1600w,
                  https://cdn.builder.io/api/v1/image/assets/TEMP/1e9ac30d9f150b290e6968f23b15fab1a3faddb9c53f3ed332a6c12a9822ebc9?apiKey=93d6739517cb41448f62dbf5c2765c87&width=2000 2000w,
                  https://cdn.builder.io/api/v1/image/assets/TEMP/1e9ac30d9f150b290e6968f23b15fab1a3faddb9c53f3ed332a6c12a9822ebc9?apiKey=93d6739517cb41448f62dbf5c2765c87&
                "
                class="img-2"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="div-11">
    <img
      loading="lazy"
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/0df1d503f7e4c3bba096a015eed4fac2b374a96339382cfc053fd234ac6662f7?apiKey=93d6739517cb41448f62dbf5c2765c87&"
      class="img-3"
    />
    <div class="div-12">
      <img
        loading="lazy"
        src="https://cdn.builder.io/api/v1/image/assets/TEMP/3835ebf2e6d385658bcdf41b79bab2bf49894a20c52006473df5588359c0f85a?apiKey=93d6739517cb41448f62dbf5c2765c87&"
        class="img-4"
      />
      <div class="div-13">
        <div class="div-14">
          <div class="div-15"><?php echo $row["Description"] . " ‘ " . date("Y", strtotime($row["start_date"])); ?> </div>
          <div class="div-16"></div>
        </div>
        <div class="div-17"><?php echo $row["place"] . " , " . $row["city"] ; ?></div>
        <div class="div-18"><?php $date = new DateTime($media["date"]); echo $date->format("d F, Y");  ?></div>
        <div class="div-19"><?php echo $media["name"] ?></div>
        <div class="div-20"><?php echo $media["designation"] ?></div>
        <div class="div-21"><?php echo $media["mobile"] ?></div>
        <div class="div-22"><?php echo $media["email"] ?></div>
      </div>
    </div>
    <img
      loading="lazy"
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/5c78e681aceaed07b4cc63e1168e1a800969b3338657dcbd02fad819e8a51fc6?apiKey=93d6739517cb41448f62dbf5c2765c87&"
      class="img-5"
    />
  </div>
  <div class="div-23">Batch No : SI<?php 
  $id=$media["id"]; 
  $lid=5-strlen((string)$id); 
  $st="";
  for($i=0;$i<$lid;$i+=1){
    $st .= "0";
  }
  $st.=$id; 
  echo $st;
  ?> </div>
  <div class="div-24">Scan QR Code</div>
  <img
    src="http://localhost/OurProject/temp/qr.jpg"
    class="img-6"
  />
  <img
    loading="lazy"
    srcset="
      https://cdn.builder.io/api/v1/image/assets/TEMP/08793a4a1e0d970d315dc72fd9dd55811fd68ec267c45b84b68e734532c12466?apiKey=93d6739517cb41448f62dbf5c2765c87&width=100   100w,
      https://cdn.builder.io/api/v1/image/assets/TEMP/08793a4a1e0d970d315dc72fd9dd55811fd68ec267c45b84b68e734532c12466?apiKey=93d6739517cb41448f62dbf5c2765c87&width=200   200w,
      https://cdn.builder.io/api/v1/image/assets/TEMP/08793a4a1e0d970d315dc72fd9dd55811fd68ec267c45b84b68e734532c12466?apiKey=93d6739517cb41448f62dbf5c2765c87&width=400   400w,
      https://cdn.builder.io/api/v1/image/assets/TEMP/08793a4a1e0d970d315dc72fd9dd55811fd68ec267c45b84b68e734532c12466?apiKey=93d6739517cb41448f62dbf5c2765c87&width=800   800w,
      https://cdn.builder.io/api/v1/image/assets/TEMP/08793a4a1e0d970d315dc72fd9dd55811fd68ec267c45b84b68e734532c12466?apiKey=93d6739517cb41448f62dbf5c2765c87&width=1200 1200w,
      https://cdn.builder.io/api/v1/image/assets/TEMP/08793a4a1e0d970d315dc72fd9dd55811fd68ec267c45b84b68e734532c12466?apiKey=93d6739517cb41448f62dbf5c2765c87&width=1600 1600w,
      https://cdn.builder.io/api/v1/image/assets/TEMP/08793a4a1e0d970d315dc72fd9dd55811fd68ec267c45b84b68e734532c12466?apiKey=93d6739517cb41448f62dbf5c2765c87&width=2000 2000w,
      https://cdn.builder.io/api/v1/image/assets/TEMP/08793a4a1e0d970d315dc72fd9dd55811fd68ec267c45b84b68e734532c12466?apiKey=93d6739517cb41448f62dbf5c2765c87&
    "
    class="img-7"
  />
</div>
<style>
  .div {
    border-color: rgba(0, 0, 0, 1);
    border-style: solid;
    border-width: 1px;
    background-color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 80px 0 20px;
  }
  .div-2 {
    margin-top: 5px;
    width: 100%;
    max-width: 902px;
  }
  @media (max-width: 991px) {
    .div-2 {
      max-width: 100%;
    }
  }
  .div-3 {
    gap: 20px;
    display: flex;
  }
  @media (max-width: 991px) {
    .div-3 {
      flex-direction: column;
      align-items: stretch;
      gap: 0px;
    }
  }
  .column {
    display: flex;
    flex-direction: column;
    line-height: normal;
    width: 41%;
    margin-left: 0px;
  }
  @media (max-width: 991px) {
    .column {
      width: 100%;
    }
  }
  .div-4 {
    display: flex;
    margin-top: 19px;
    align-items: flex-start;
    gap: 20px;
    font-size: 28px;
    color: #333;
    font-weight: 700;
    white-space: nowrap;
    justify-content: space-between;
  }
  @media (max-width: 991px) {
    .div-4 {
      margin-top: 40px;
      white-space: initial;
    }
  }
  .img {
    aspect-ratio: 1.54;
    object-fit: auto;
    object-position: center;
    width: 189px;
    align-self: start;
    max-width: 100%;
  }
  .div-5 {
    font-family: IBM Plex Sans, sans-serif;
    margin-top: 73px;
  }
  @media (max-width: 991px) {
    .div-5 {
      margin-top: 40px;
    }
  }
  .column-2 {
    display: flex;
    flex-direction: column;
    line-height: normal;
    width: 59%;
    margin-left: 20px;
  }
  @media (max-width: 991px) {
    .column-2 {
      width: 100%;
    }
  }
  .div-6 {
    border-radius: 48px;
    border-color: rgba(0, 0, 0, 1);
    border-style: solid;
    border-width: 3px;
    flex-grow: 1;
    padding: 45px 40px;
  }
  @media (max-width: 991px) {
    .div-6 {
      max-width: 100%;
      margin-top: 40px;
      padding: 0 20px;
    }
  }
  .div-7 {
    gap: 20px;
    display: flex;
  }
  @media (max-width: 991px) {
    .div-7 {
      flex-direction: column;
      align-items: stretch;
      gap: 0px;
    }
  }
  .column-3 {
    display: flex;
    flex-direction: column;
    line-height: normal;
    width: 50%;
    margin-left: 0px;
  }
  @media (max-width: 991px) {
    .column-3 {
      width: 100%;
    }
  }
  .div-8 {
    display: flex;
    flex-direction: column;
    align-self: stretch;
    font-size: 28px;
    color: #000;
    font-weight: 400;
    margin: auto 0;
  }
  @media (max-width: 991px) {
    .div-8 {
      margin-top: 40px;
    }
  }
  .div-9 {
    font-family: IBM Plex Sans, sans-serif;
  }
  .div-10 {
    border-color: rgba(178, 55, 58, 1);
    border-style: solid;
    border-width: 4px;
    background-color: #b2373a;
    align-self: center;
    margin-top: 5px;
    width: 148px;
    height: 4px;
  }
  .column-4 {
    display: flex;
    flex-direction: column;
    line-height: normal;
    width: 50%;
    margin-left: 20px;
  }
  @media (max-width: 991px) {
    .column-4 {
      width: 100%;
    }
  }
  .img-2 {
    aspect-ratio: 1.56;
    object-fit: auto;
    object-position: center;
    width: 194px;
    max-width: 100%;
    flex-grow: 1;
  }
  @media (max-width: 991px) {
    .img-2 {
      margin-top: 40px;
    }
  }
  .div-11 {
    align-self: stretch;
    display: flex;
    margin-top: 64px;
    width: 100%;
    align-items: end;
    gap: 20px;
    font-size: 25px;
    color: #080808;
    font-weight: 400;
    justify-content: space-between;
    padding: 0 20px;
  }
  @media (max-width: 991px) {
    .div-11 {
      max-width: 100%;
      flex-wrap: wrap;
      margin-top: 40px;
    }
  }
  .img-3 {
    aspect-ratio: 0.19;
    object-fit: auto;
    object-position: center;
    width: 56px;
    fill: #c52e33;
    margin-top: 57px;
  }
  @media (max-width: 991px) {
    .img-3 {
      margin-top: 40px;
    }
  }
  .div-12 {
    align-self: stretch;
    display: flex;
    gap: 20px;
  }
  .img-4 {
    aspect-ratio: 0.09;
    object-fit: auto;
    object-position: center;
    width: 24px;
    align-self: end;
    margin-top: 85px;
  }
  @media (max-width: 991px) {
    .img-4 {
      display: none;
      margin-top: 40px;
    }
  }
  .div-13 {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    flex-basis: 0;
    width: fit-content;
  }
  .div-14 {
    display: flex;
    flex-direction: column;
    align-items: start;
    font-size: 28px;
    font-weight: 600;
    padding: 0 14px 0 64px;
  }
  @media (max-width: 991px) {
    .div-14 {
      padding-left: 20px;
    }
  }
  .div-15 {
    font-family: IBM Plex Sans, sans-serif;
  }
  .div-16 {
    border-color: rgba(178, 55, 58, 1);
    border-style: solid;
    border-width: 4px;
    background-color: #b2373a;
    width: 148px;
    height: 4px;
    margin: 7px 0 0 30px;
  }
  @media (max-width: 991px) {
    .div-16 {
      margin-left: 10px;
    }
  }
  .div-17 {
    font-family: IBM Plex Sans, sans-serif;
    margin-top: 56px;
  }
  @media (max-width: 991px) {
    .div-17 {
      margin-top: 40px;
    }
  }
  .div-18 {
    font-family: IBM Plex Sans, sans-serif;
    margin-top: 28px;
  }
  .div-19 {
    font-family: IBM Plex Sans, sans-serif;
    margin-top: 28px;
  }
  .div-20 {
    font-family: IBM Plex Sans, sans-serif;
    margin-top: 32px;
  }
  .div-21 {
    font-family: IBM Plex Sans, sans-serif;
    margin-top: 26px;
  }
  .div-22 {
    font-family: IBM Plex Sans, sans-serif;
    margin-top: 31px;
  }
  .img-5 {
    aspect-ratio: 0.19;
    object-fit: auto;
    object-position: center;
    width: 56px;
    fill: #c52e33;
    margin-top: 57px;
  }
  @media (max-width: 991px) {
    .img-5 {
      margin-top: 40px;
    }
  }
  .div-23 {
    border-color: rgba(197, 46, 51, 1);
    border-style: solid;
    border-width: 4px;
    margin-top: 31px;
    color: #080808;
    justify-content: center;
    padding: 18px 26px;
    font: 400 26px IBM Plex Sans, sans-serif;
  }
  @media (max-width: 991px) {
    .div-23 {
      padding: 0 20px;
    }
  }
  .div-24 {
    color: #080808;
    margin-top: 27px;
    font: 400 22px IBM Plex Sans, sans-serif;
  }
  .img-6 {
    aspect-ratio: 1;
    object-fit: auto;
    object-position: center;
    width: 134px;
    margin-top: 10px;
    max-width: 100%;
  }
  .img-7 {
    aspect-ratio: 25;
    object-fit: auto;
    object-position: center;
    width: 1016px;
    fill: #c52e33;
    margin-top: 17px;
    max-width: 1016px;
  }
  @media (max-width: 991px) {
    .img-7 {
      max-width: 100%;
    }
  }
</style>
