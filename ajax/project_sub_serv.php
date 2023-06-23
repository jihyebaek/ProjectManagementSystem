<?php 
    include_once('../common.php');

    $type = $_POST['type']; //저장타입 (추가 || 수정 || 삭제)
    $pNo = isset($_POST['pNo']); // 프로젝트 pk값
    $psNo = isset($_POST['psNo']); // 작업그룹 PK값

    switch($type) {
        case "get" :
            $psNo = $_POST['psNo']; // 작업그룹 PK값

            $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
            $query = "SELECT * FROM project_sub WHERE pjts_no = '$psNo'";
            $rslt = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($rslt);
            $query2 = "SELECT a.mem_no, a.mem_name FROM member a INNER JOIN project_worker b ON a.mem_no = b.mem_no WHERE b.pw_type = 'Sub' AND b.pw_pno = '$psNo'";
            $rslt2 = mysqli_query($conn, $query2);
            $i=0;
            while($pjtWkr = mysqli_fetch_assoc($rslt2)) {$row['pjts_worker'][$i] = $pjtWkr;$i++;}
            mysqli_close($conn);
            $data = json_encode($row);
            echo $data; 
            break;

        case "add" : 
            $pNo = $_POST['pNo']; // 프로젝트 pk값
            $psNo = $_POST['psNo']; // 작업그룹 PK값
            $psName = $_POST['psName']; //작업명
            $psStartdate = $_POST['psStartdate']; //시작일
            $psDuedate = $_POST['psDuedate']; //마감일
            $psStatus = $_POST['psStatus']; //작업상태
            $psWorkers = $_POST['psWorkers']; //작업자들

            $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
            $query = "INSERT INTO project_sub VALUES(0, '$pNo', '$psName', '$psStatus', '$psStartdate', '$psDuedate', now()) ";
            if(mysqli_query($conn, $query)) {
                $psNo = mysqli_insert_id($conn);
                    for($i=0;$i<count($psWorkers);$i++) {
                        $psworker = $psWorkers[$i];
                        $query = "INSERT INTO project_worker VALUES(0, '$psworker','Sub','$psNo')";
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
            $pNo = $_POST['pNo']; // 프로젝트 pk값
            $psNo = $_POST['psNo']; // 작업그룹 PK값
            $psName = $_POST['psName']; //작업명
            $psStartdate = $_POST['psStartdate']; //시작일
            $psDuedate = $_POST['psDuedate']; //마감일
            $psStatus = $_POST['psStatus']; //담당자 이메일
            $psWorkers = $_POST['psWorkers']; //대표자

            $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
            $query = "UPDATE Project_Sub 
                        SET pjts_name = '$psName', pjts_startdate = '$psStartdate', pjts_duedate = '$psDuedate', pjts_status = '$psStatus'
                        WHERE pjt_no = '$pNo' AND pjts_no = '$psNo'";

            if(mysqli_query($conn, $query)) {

                // 기존 참여인력 비교
                $sql = "SELECT mem_no FROM project_worker WHERE pw_type = 'Sub' AND pw_pno = '$psNo'";
                $rslt = mysqli_query($conn, $sql);
                $i=0;
                $orgWorker=[];
                while($row = mysqli_fetch_assoc($rslt)) {
                    $orgWorker[$i] = $row['mem_no'];
                    $i++;
                }
                
                $deleteVal = array_values(array_diff($orgWorker, $psWorkers)); // 빠지는 인력 
                $insertVal = array_values(array_diff($psWorkers, $orgWorker)); // 추가되는 인력
                
                for($i=0;$i<count($insertVal);$i++) { // 추가되는 인력 추가
                    $mem_no = $insertVal[$i];
                    $query = "INSERT INTO project_worker VALUES(0,'$mem_no','Sub','$psNo')";
                    $rslt = mysqli_query($conn, $query);
                }
                
                for($i=0;$i<count($deleteVal);$i++) { // 빠지는 인력 삭제
                    $mem_no = $deleteVal[$i];
                    // 그룹과 항목에 있는 인원이 빠질 경우 결과 false
                    $qry = "SELECT DISTINCT a.mem_no, b.mem_name FROM project_worker a 
                                INNER JOIN Member b ON a.mem_no = b.mem_no 
                                INNER JOIN project_detail c ON a.pw_pno = c.pjtd_no 
                                WHERE a.mem_no = '$mem_no' AND a.pw_type = 'Detail' AND c.pjts_no = '$psNo'";
                        $rslt = mysqli_query($conn, $qry);
                        $row = mysqli_fetch_assoc($rslt);
                        if(isset($row)) {
                            echo ''.$row['mem_name'].'님은 참여한 작업항목이 있으므로 작업그룹에서 제외할 수없습니다.'; return false;
                        } else {
                            $query = "DELETE FROM project_worker WHERE mem_no = '$mem_no' AND pw_type = 'Sub' AND pw_pno = '$psNo'";
                            $rslt = mysqli_query($conn, $query);
                        }
                    }
                    $result = "modifyOk";
                    $query = "UPDATE project SET pjt_modifydate = CURRENT_TIMESTAMP()  WHERE pjt_no = '$pNo'";
                    $rslt = mysqli_query($conn, $query);
            } else {
                $result =mysqli_error($conn);
            }
            mysqli_close($conn);
            echo $result;
            break;

        case  "delete" :
            $psNo = $_POST['psNo']; // 작업그룹 PK값

            $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
            // 작업항목 있을 시 결과 false
            $query = "SELECT a.pjtd_no, a.pjtd_name, a.pjt_no, a.pjts_no, b.pw_no, b.mem_no 
                        FROM project_detail a 
                        INNER JOIN project_worker b ON a.pjtd_no = b.pw_pno 
                        WHERE a.pjts_no = '$psNo'";
            $rslt = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($rslt);
                if(isset($row)) {
                    $result = "deletFail";
                } else {
                    $query = "DELETE FROM project_sub WHERE pjts_no = '$psNo'";
                    if(mysqli_query($conn, $query)) {
                        $sql = "DELETE FROM project_worker WHERE pw_type = 'Sub' AND pw_pno = '$psNo'";
                        $rslt = mysqli_query($conn, $sql);
                        $result = "deleteOk";
                    } else {
                        $result =mysqli_error($conn);
                    }
                }
            mysqli_close($conn);
            echo $result;
            break;

        default : 
            print_r("기본값"); 
            break;
    }
?>