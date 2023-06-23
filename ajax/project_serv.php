<?php
    include_once('../common.php');

    $type = $_POST['type']; //저장타입 (추가 || 수정 || 삭제)
    $pNo = isset($_POST['pNo']); //프로젝트 PK값

    switch($type) {
        case "get" : 
            $pNo = $_POST['pNo']; //프로젝트 PK값

            $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
            $query = "SELECT * FROM project WHERE pjt_no = '$pNo'";
            $rslt = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($rslt);
            $query2 = "SELECT a.mem_no, a.mem_name FROM member a INNER JOIN project_worker b ON a.mem_no = b.mem_no WHERE b.pw_type = 'Project' AND b.pw_pno = '$pNo'";
            $rslt2 = mysqli_query($conn, $query2);
            $i=0;
            while($pjtWkr = mysqli_fetch_assoc($rslt2)) {$row['pjt_worker'][$i] = $pjtWkr;$i++;}
            mysqli_close($conn);
            $data = json_encode($row);
            echo $data; 
            break;

        case "add" : 
            $pName = $_POST['pName']; //업체명
            $pEmpName = $_POST['pEmpName']; //담당자
            $pEmpTel = $_POST['pEmpTel']; //담당자 연락처
            $pEmpMail = $_POST['pEmpMail']; //담당자 이메일
            $pCeoName = $_POST['pCeoName']; //대표자
            $pCeoTel = $_POST['pCeoTel']; //대표자 연락처
            $pCeoMail = $_POST['pCeoMail']; //대표자 이메일
            $pWorkers = $_POST['pWorkers']; //참여인력
            $pColour = $_POST['pColour']; //메인색상
            $pCode = $_POST['pCode']; //코드

            $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
            $query = "INSERT INTO Project 
                    VALUES(0,'$pName', '$pCeoName', '$pCeoTel', '$pCeoMail', 
                    '$pEmpName', '$pEmpTel', '$pEmpMail','$pColour','$pCode',NOW(),NOW())";
            if(mysqli_query($conn, $query)) {
                if($newPjtNo = mysqli_insert_id($conn)) {
                    for($i=0;$i<count($pWorkers);$i++) {
                        $pWorker = $pWorkers[$i];
                        $query = "INSERT INTO Project_Worker VALUES(0,'$pWorker','Project','$newPjtNo')";
                        $rslt = mysqli_query($conn, $query);
                    }
                }
                $result = "addOk";
            }
            mysqli_close($conn);
            echo $result;
            break;

        case "modify" : 
            $pNo = $_POST['pNo']; //프로젝트 PK값
            $pName = $_POST['pName']; //업체명
            $pEmpName = $_POST['pEmpName']; //담당자
            $pEmpTel = $_POST['pEmpTel']; //담당자 연락처
            $pEmpMail = $_POST['pEmpMail']; //담당자 이메일
            $pCeoName = $_POST['pCeoName']; //대표자
            $pCeoTel = $_POST['pCeoTel']; //대표자 연락처
            $pCeoMail = $_POST['pCeoMail']; //대표자 이메일
            $pWorkers = $_POST['pWorkers']; //참여인력
            $pColour = $_POST['pColour']; //메인색상
            $pCode = $_POST['pCode']; //코드

            $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
            $query = "UPDATE project 
                    SET pjt_name = '$pName', pjt_ceo_name = '$pCeoName', pjt_ceo_tel = '$pCeoTel', pjt_ceo_email = '$pCeoMail',
                        pjt_emp_name = '$pEmpName', pjt_emp_tel = '$pEmpTel', pjt_emp_email = '$pEmpMail', pjt_colour = '$pColour', pjt_code = '$pCode', pjt_modifydate = CURRENT_TIMESTAMP()
                    WHERE pjt_no = '$pNo'";
            if(mysqli_query($conn, $query)) {

                // 기존 참여인력 비교
                $sql = "SELECT mem_no FROM project_Worker WHERE pw_type = 'Project' AND pw_pno = '$pNo'";
                $rslt = mysqli_query($conn, $sql);
                $i=0;
                while($row = mysqli_fetch_assoc($rslt)) {$orgWorker[$i] = $row['mem_no']; $i++;}
                if($orgWorker == NULL) {
                    $insertVal = $pWorkers; // 프로젝트 생성시 인력이 0이었을 경우 추가되는 인력
                } else {
                    $insertVal = array_values(array_diff($pWorkers, $orgWorker)); // 추가되는 인력
                }
                $deleteVal = array_values(array_diff($orgWorker, $pWorkers)); // 빠지는 인력 
                
                    for($i=0;$i<count($insertVal);$i++) { // 추가되는 인력 추가
                        $mem_no = $insertVal[$i];
                        $query = "INSERT INTO project_Worker VALUES(0,'$mem_no','Project','$pNo')";
                        $rslt = mysqli_query($conn, $query);
                    }
                
                    for($i=0;$i<count($deleteVal);$i++) { // 빠지는 인력 삭제
                        $mem_no = $deleteVal[$i];

                        // 그룹과 항목에 있는 인원이 빠질 경우 결과 false
                        $qry = "SELECT DISTINCT a.mem_no, b.mem_name FROM project_Worker a INNER JOIN member b ON a.mem_no = b.mem_no WHERE a.mem_no = '$mem_no' AND a.pw_type = 'Sub' OR a.mem_no = '$mem_no' AND a.pw_type = 'Detail'";
                        $rslt = mysqli_query($conn, $qry);
                        $row = mysqli_fetch_assoc($rslt);
                        if(isset($row)) {
                            echo ''.$row['mem_name'].'님은 참여한 작업이 있으므로 프로젝트에서 제외할 수 없습니다.'; 
                            return false;
                            // 복수를 담으려 했으나 오류발생. 원인파악 중
                            // $i=0;
                            // while($row) {
                            //     $mem_name[$i] = $row['mem_name'];
                            //     $i++;
                            // }
                            // $name = implode('와(과)', $mem_name);
                            // if(isset($name)) {echo ''.$name.'님은 참여한 작업이 있으므로 프로젝트에서 제외할 수 없습니다.'; return false;}
                        } else {
                            for($i=0;$i<count($deleteVal);$i++) { 
                                $mem_no = $deleteVal[$i];
                                $query = "DELETE FROM Project_Worker WHERE mem_no = '$mem_no' AND pw_type = 'Project' AND pw_pno = '$pNo'";
                                $rslt = mysqli_query($conn, $query);
                            }
                        }
                    }
                $result= "modifyOk";
                echo $result;
            } else {
                $result = mysqli_error($conn);
            }
            mysqli_close($conn);
            break;

        case  "delete" :
            $pNo = $_POST['pNo']; //프로젝트 PK값

            $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
            $query = "SELECT a.pjts_no, a.pjts_name, b.pjtd_no, b.pjtd_name FROM Project_Sub a
                    INNER JOIN Project_Detail b ON b.pjts_no = a.pjts_no
                    WHERE a.pjt_no = '$pNo' AND b.pjt_no = '$pNo'";
            $rslt = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($rslt);
                if(isset($row)) {
                    $result = "deletFail";
                } else {
                    $query = "DELETE FROM Project WHERE pjt_no = '$pNo'";
                    if(mysqli_query($conn, $query)) {
                        $sql = "DELETE FROM Project_Worker WHERE pw_type = 'Project' AND pw_pno = '$pNo'";
                        $rslt = mysqli_query($conn, $sql);
                        $result= "deleteOk"; //왜 alert으로 뜨지,,?
                    } else {
                        $result =mysqli_error($conn);
                    }
                }
            mysqli_close($conn);
            echo $result;
            break;

        case "memo" :
            // print_r($_POST); exit();
            $pNo = $_POST['pNo']; //프로젝트 PK값
            $pMemo = $_POST['pMemo']; //프로젝트 메모
            $memNo = $_POST['memNo']; //작성자

            $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
            mysqli_close($conn);
            echo $result;
            break;
            
        default : 
            print_r("기본값"); 
            break;
    }

?>