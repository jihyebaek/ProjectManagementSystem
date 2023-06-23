<?php
    include_once('../common.php');
    
    $eStartdate =$_POST['eStartdate']; //시작일
    $eDuedate =$_POST['eDuedate']; //시작일
    $eType =$_POST['eType']; //휴가 or 행사
    $eContent =$_POST['eContent']; //상세내용
    $memNo =$_POST['memNo']; //신청자

    $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
    $query = "INSERT INTO holiday_event VALUES(0, '$memNo', '$eContent', '$eType', '$eStartdate', '$eDuedate')";
    if(mysqli_query($conn, $query)) {
        $heNo = mysqli_insert_id($conn);
        if(isset($heNo)) {$result = "saveOk";}
    } else {
        $result =mysqli_error($conn);
    }
    mysqli_close($conn);
    echo $result;
?>