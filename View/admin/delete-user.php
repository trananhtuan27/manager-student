<?php
require_once('../../Model/DBconnect.php');


if (isset($_POST['id'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM student WHERE id =$id";
    $query = mysqli_query($conn,$sql);
    if (isset($query)){
        echo "削除を完了しました。";
    }
}
?>

