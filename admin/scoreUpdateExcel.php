<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] = 'Admin') {
        include_once "../DB_connection.php";
        include_once "DAL/data/score.php";
        include_once "BL/data/score.php";
        $id = $_GET['idscore'];
     $score = getScoreBL($conn,$id);

     ?>


     <!DOCTYPE html>
     <html lang="en">

     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Home - Su Pham Thuc Hanh High School</title>
    
         <link rel="icon" href="..logo.png">



        </head>
    <body>
    <form method="post" action="BL/uploadScoreExcel.php?= $id ?>">
    <!-- <input type="hidden" name="idscore" value="<?= $score['id_score'] ?>">
    <div class="form-group">
        <label for="diem15">Điểm 15 phút:</label>
        <input type="input" class="form-control" id="diem15" name="diem15" value="<?= $score['diem15'] ?>">
    </div>
    <div class="form-group">
        <label for="diem45">Điểm 45 phút:</label>
        <input type="input" class="form-control" id="diem45" name="diem45" value="<?= $score['diem45'] ?>">
    </div>
    <div class="form-group">
        <label for="thi">Điểm Thi:</label>
        <input type="input" class="form-control" id="thi" name="thi" value="<?= $score['thi'] ?>">
    </div> -->
    <div class="form-group">


    <label for="ExcelDiem"> Import Diem Thi</label>
    <input type="input" class="form-control" id="thi" name="thi" value="<?= $score['thi'] ?>">
    </div>
    <button style="margin-top: 10px;  margin-right: 2%;" type="submit" class="btn btn-primary position-absolute bottom-2 end-0" data-bs-dismiss="modal" id="Sucsessbtn" onclick="Save()">Post</button>
</form>


      </body>

      </html>
  
    <?php } else { ?>
  
    <?php  } ?>
  
  <?php } else { ?>
  
  <?php } ?>
