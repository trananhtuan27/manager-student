<?php

require_once('Model/DBconnect.php');

if (isset($_GET['student_code'])){
    $student_code = $_GET['student_code'];

    $sql = "DELETE  FROM shiken WHERE student_code = '$student_code'";
    $sql1 = "DELETE recruit , naitei  FROM recruit  INNER JOIN naitei  
     WHERE recruit.student_code= naitei.student_code and recruit.student_code = '$student_code'";
    $query = mysqli_query($conn,$sql);
    $query1 = mysqli_query($conn,$sql1);

    if (isset($query)){
        echo "削除を完了しました。";
        header('Location: http://localhost/democode');
    } else {
        echo "削除を完了しませんでした。";
    }
}
?>