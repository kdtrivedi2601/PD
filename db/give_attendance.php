<script>
   function give_attendance(){
      var block = document.getElementById('upload_attendance');
      if(block.style.display==="none"){
         block.style.display="block";
      }  
      }    
</script>
<form action="" method="POST" enctype="multipart/form-data">
                            
    <input type="file" name="import_file" class="form-control" />
    <button type="submit" name="save_excel_data" class="btn btn-primary mt-3">UPLOAD</button>

</form>
<?php

// session_start();
require('../db/dbconn.php');

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// $sn = $_POST['subject'];
// $esn = $_POST['subject'];


if(isset($_POST['save_excel_data']))
{
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = "0";
        foreach($data as $column)
        {
            if($count > 0)
            {
               
                // $id = $column['0'];
                $enroll = $column['0'];
                $total = $column['1'];
                $present = $column['2'];
                $percentage = $column['3'];
                    // $studentQuery1 = "INSERT INTO 1tet VALUES ('$id','$enroll','$total','$present','$percentage')";
                    $studentQuery1 = "UPDATE 1tet SET percentage = '$percentage' WHERE EnrollNO = '$enroll'";
                    // echo $studentQuery1;
                    $result = mysqli_query($conn, $studentQuery1);
                    $msg = true;
                 
        }
            else
            {
                $count = "1";
            }
        }

        if(isset($msg))
        {
            $_SESSION['message'] = 1;
            header('Location: ../VIEW/attendance.php');
            // echo "Uploaded";
     
        }
        else
        {
            $_SESSION['message'] = "Not Imported";
            // header('Location: index.php');
         
        }
    }
    else
    {
        $_SESSION['message'] = "Invalid File";
        // header('Location: index.php');
     
    }
}


?>