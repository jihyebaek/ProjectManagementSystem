<?php 
    include_once('../common.php');

    $type = $_POST['type']; //저장타입 (추가 || 수정 || 삭제)

    switch($type) {
        case "get" : 
            $pNo = $_POST['pNo']; //프로젝트 pk값
            $psNo = $_POST['psNo']; // 작업그룹 PK값
            $pdNo = $_POST['pdNo']; // 작업항목 PK값

            $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
            $query = "SELECT * FROM project_detail WHERE pjt_no = '$pNo' AND pjts_no = '$psNo' AND pjtd_no ='$pdNo'";
            $rslt = mysqli_query($conn, $query);
            $row = array();
            $row = mysqli_fetch_assoc($rslt);
            $sql = "SELECT a.mem_no, a.mem_name FROM Member a INNER JOIN project_worker b ON a.mem_no = b.mem_no 
                    WHERE b.pw_type = 'Detail' AND b.pw_pno = '$pdNo'";
            $rslt = mysqli_query($conn, $sql);
            $i=0;
            while($pjtdWkr = mysqli_fetch_assoc($rslt)) {$row['pjtd_worker'][$i] = $pjtdWkr;$i++;}
            mysqli_close($conn);
            $data = json_encode($row);
            echo $data;
            break;

        case "add" : 
            $pNo = $_POST['pNo']; //프로젝트 pk값
            $psNo = $_POST['psNo']; // 작업그룹 PK값
            $pdName = $_POST['pdName']; //작업명
            $pdStartdate = $_POST['pdStartdate']; //시작일
            $pdDuedate = $_POST['pdDuedate']; //마감일
            $pdWorkers = $_POST['pdWorkers']; //작업자들
            
            $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
            $query = "INSERT INTO project_detail VALUES(0, '$pNo', '$psNo', '$pdName', '$pdStartdate', '$pdDuedate', now(),'N')";
            if(mysqli_query($conn, $query)) {
                $pdNo = mysqli_insert_id($conn);
                    for($i=0;$i<count($pdWorkers);$i++) {
                        $pdWorker = $pdWorkers[$i];
                        $query = "INSERT INTO project_worker VALUES(0, '$pdWorker','Detail','$pdNo')";
                        $rslt = mysqli_query($conn, $query);
                    }
                $result = "addOk";
            } else {
                $result =mysqli_error($conn);
            }
            mysqli_close($conn);
            echo $result;
            break;

        case "modify" : 
            $pNo = $_POST['pNo']; //프로젝트 pk값
            $psNo = $_POST['psNo']; // 작업그룹 PK값
            $pdNo = $_POST['pdNo']; // 작업항목 PK값
            $pdName = $_POST['pdName']; //작업명
            $pdStartdate = $_POST['pdStartdate']; //시작일
            $pdDuedate = $_POST['pdDuedate']; //마감일
            $pdWorkers = $_POST['pdWorkers']; //작업자들
            $pdComment = $_POST['pdComment']; //수정사유
            $pdWriter = $_POST['pdWriter']; //수정한 회원

            $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
            $query = "UPDATE project_detail 
                        SET pjtd_name = '$pdName', pjtd_startdate = '$pdStartdate', pjtd_duedate = '$pdDuedate'
                        WHERE pjt_no = '$pNo' AND pjts_no = '$psNo' AND pjtd_no = '$pdNo'";
                    if(mysqli_query($conn, $query)) {
                        // 기존 참여인력 비교
                        $sql = "SELECT mem_no FROM project_worker WHERE pw_type = 'Detail' AND pw_pno = '$pdNo'";
                        $rslt = mysqli_query($conn, $sql);
                        $i=0;
                        while($row = mysqli_fetch_assoc($rslt)) {
                            $orgWorker[$i] = $row['mem_no'];
                            $i++;
                        }
                        $deleteVal = array_values(array_diff($orgWorker, $pdWorkers)); // 빠지는 인력 
                        $insertVal = array_values(array_diff($pdWorkers, $orgWorker)); // 추가되는 인력
                            for($i=0;$i<count($insertVal);$i++) { // 추가되는 인력 추가
                                $mem_no = $insertVal[$i];
                                $query = "INSERT INTO project_worker VALUES(0,'$mem_no','Detail','$pdNo')";
                                $rslt = mysqli_query($conn, $query);
                            }
                            for($i=0;$i<count($deleteVal);$i++) { // 빠지는 인력 삭제
                                $mem_no = $deleteVal[$i];
                                $query = "DELETE FROM Project_Worker WHERE mem_no = '$mem_no' AND pw_type = 'Detail' AND pw_pno = '$pdNo'";
                                $rslt = mysqli_query($conn, $query);
                            }
                        $result = "modifyOk";
                        $query = "UPDATE project SET pjt_modifydate = CURRENT_TIMESTAMP()  WHERE pjt_no = '$pNo'";
                        $rslt = mysqli_query($conn, $query);
                    } else {
                        $result = mysqli_error($conn);
                    }
                
                    if(!empty($pdComment)) {
                        $sql = "INSERT INTO project_detail_comment VALUES(0,'$pdNo','$psNo','$pNo','$pdComment','$pdWriter',now())";
                        if(mysqli_query($conn, $sql)) { $mm_no = mysqli_insert_id($conn); } 
                        else { $result =mysqli_error($conn); }
                    }
            mysqli_close($conn);
            echo $result;
            break;

        case  "delete" :
            // $psNo = $_POST['psNo']; // 작업그룹 PK값
            $pdNo = $_POST['pdNo']; // 작업항목 PK값

            $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
            $query = "DELETE FROM project_detail WHERE pjtd_no = '$pdNo'";
                if(mysqli_query($conn, $query)) {
                    $sql = "DELETE FROM project_worker WHERE pw_type = 'Detail' AND pw_pno = '$pdNo'";
                    $rslt = mysqli_query($conn, $sql);

                    $qry = "DELETE FROM project_detail_comment WHERE pjtd_no = '$pdNo'";
                    $rslt = mysqli_query($conn, $qry);

                    $result = "deleteOk";
                } else {
                    $result =mysqli_error($conn);
                }
            mysqli_close($conn);
            echo $result;
            break;

        default : 
            print_r("기본값"); 
            break;
    }
?>