<?php 
/* DB 접속 정보 */
define('MY_HOST', 'localhost:3308');
define('MY_USER', 'root');
define('MY_PASS', '1234');
define('MY_DB', 'project');

session_start();

$pNo = isset($_GET['pNo']);

/* 회원가입 - 아이디 중복검사 */
/* 로그인 - 로그인 회원의 정보 가져오기 */
function checkId($memId) {
    $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
    $query = "SELECT * FROM member WHERE mem_id = '$memId'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $data;
}

/* 세션등록 */
function set_session($ssname, $value) {
    $session_id = $_SESSION[$ssname];
    if (!$session_id || $session_id != $value) $_SESSION[$ssname] = $value;
    $expire_time = isset($_COOKIE['memId']) ? 0 : time() + (6 * 60 * 60); // 현재 시간 + 6시간
    setcookie('memId', $value, $expire_time, '/');
    return true;
}

if(!session_id()) { session_start(); }
$memLogin = $_SESSION['memId'];
$memId = $memLogin;

if (!empty($memId)) { 
    $memInfo = checkId($memId);
    if ($memInfo) {
        if ($memInfo['mem_level'] == 10) $is_admin = true; 
        else if ($memInfo['mem_level'] == 3) $is_member = true;
        $memNo = $memInfo['mem_no']; //로그인 회원의 회원번호
        $memName = $memInfo['mem_name']; //로그인 회원의 이름
        $memLevel = $memInfo['mem_level']; //로그인 회원의 회원레벨
        $memTitle = $memInfo['mem_title']; //로그인 회원의 회원직책
    }
} 

/* 프로젝트 - 정보 가져오기 */
function getProjectInfos($memNo,$memLevel) {
    $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
    if($memLevel >= 5) {$query = "SELECT * FROM project ORDER BY pjt_regdate";}
    else {$query = "SELECT a.*, c.mem_no, c.mem_name FROM project a 
                    INNER JOIN project_code b ON a.pjt_code = b.pjtcd_name 
                    INNER JOIN member c ON b.mem_no = c.mem_no
                    WHERE b.mem_no = '$memNo'";}
    $result = mysqli_query($conn, $query);
    $i=0;
    $data=[];
    while($row = mysqli_fetch_assoc($result)) {$data[$i] = $row; $i++;}
    mysqli_close($conn);
    return $data;
}
$pInfos = getProjectInfos($memNo,$memLevel);

/* 프로젝트 - 참여인력 가져오기 */
function getPjtMembers() {
    $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
    $query = "SELECT * FROM member WHERE mem_level >= '5'";
    $result = mysqli_query($conn, $query);
    // 다중배열 루프 돌려 담기
    $i=0;
    $data=[];
    while($row = mysqli_fetch_assoc($result)) {$data[$i] = $row; $i++;}
    mysqli_close($conn);
    return $data;
}
$pMems = getPjtMembers();

/* 프로젝트 작업그룹 - 정보 가져오기 */
function getProjectSubInfos($pNo) {
    $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
    $query = "SELECT * FROM project_sub WHERE pjt_no = '$pNo'";
    $result = mysqli_query($conn, $query);
    $i=0;
    $data=[];
    while($row = mysqli_fetch_assoc($result)) {
        $data[$i] = $row;
        $query = "SELECT a.mem_no, b.mem_name FROM project_worker a 
                INNER JOIN member b ON a.mem_no = b.mem_no 
                WHERE a.pw_pno = '".$data[$i]['pjts_no']."' AND a.pw_type = 'Sub'";
        $psWorkers = mysqli_query($conn, $query);
        $x=0;
        while($psWorker = mysqli_fetch_assoc($psWorkers)) {
            $data[$i]['pjts_worker'][$x] = $psWorker;
            $x++;
        }

        // 잔여 작업기간 구하기
        $now = date("Y-m-d");
        $subEnd = $data[$i]['pjts_duedate'];
        $remain = intval((strtotime($now)-strtotime($subEnd)) / 86400);
        $residual_day = str_replace("-","",$remain);
        if($remain < 0) { $data[$i]['residual_day'] = $residual_day."일 남음"; } 
        else if($remain == 0) { $data[$i]['residual_day'] = "D_DAY"; }
        else { $data[$i]['residual_day'] = $residual_day."일 지남"; }

        if($remain >= -3) {$data[$i]['auto_status'] = "비상";
        } else if($remain >= -10) {$data[$i]['auto_status'] = "긴급";
        } else if($remain >= -15) {$data[$i]['auto_status'] = "일반";
        } else if($remain > -20) {$data[$i]['auto_status'] = "여유";
        } else {$data[$i]['auto_status'] = "여유";}

    $i++;}
    mysqli_close($conn);
    return $data;
};
$psInfos = getProjectSubInfos($pNo);

/* 프로젝트 작업그룹 - 참여인력 가져오기 */
function getPjtSubMembers($pNo) {
    $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
    $query = "SELECT b.mem_no, b.mem_name, a.pw_pno FROM project_worker a 
            INNER JOIN member b ON a.mem_no = b.mem_no 
            WHERE pw_pno = '$pNo' AND pw_type = 'Project'";
    $result = mysqli_query($conn, $query);
    // 다중배열 루프 돌려 담기
    $i=0;
    $data=[];
    while($row = mysqli_fetch_assoc($result)) {$data[$i] = $row; $i++;}
    mysqli_close($conn);
    return $data;
}
$psMems = getPjtSubMembers($pNo);

/* 프로젝트 작업항목 - 정보 가져오기 */
function getProjectDetailInfos($pNo,$psNo) {
    $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
    $query = "SELECT * FROM project_detail WHERE pjt_no = '$pNo' AND pjts_no = '$psNo'";
    $result = mysqli_query($conn, $query);
    $i=0;
    $data=[];
    while($row = mysqli_fetch_assoc($result)) {
        $data[$i] = $row;
        $query = "SELECT a.mem_no, b.mem_name FROM project_worker a 
                    INNER JOIN member b ON a.mem_no = b.mem_no 
                    WHERE a.pw_pno = '".$data[$i]['pjtd_no']."' AND a.pw_type = 'Detail'";
        $pdWorkers = mysqli_query($conn, $query);
        $x=0;
        while($pdWorker = mysqli_fetch_assoc($pdWorkers)) {
            $data[$i]['pjtd_worker'][$x] = $pdWorker;
            $x++;
        }

        // 잔여 작업기간 구하기
        $now = date("Y-m-d");
        $subEnd = $data[$i]['pjtd_duedate'];
        $remain = intval((strtotime($now)-strtotime($subEnd)) / 86400);
        $residual_day = str_replace("-","",$remain);
        if($remain < 0) { $data[$i]['residual_day'] = $residual_day."일 남음"; } 
        else if($remain == 0) { $data[$i]['residual_day'] = "마감일!"; }
        else { $data[$i]['residual_day'] = $residual_day."일 지남"; }

        if($remain >= -3) {$data[$i]['auto_status'] = "비상";
        } else if($remain >= -10) {$data[$i]['auto_status'] = "긴급";
        } else if($remain >= -15) {$data[$i]['auto_status'] = "일반";
        } else if($remain > -20) {$data[$i]['auto_status'] = "여유";
        } else {$data[$i]['auto_status'] = "여유";}

        // 작업항목 댓글 구하기
        $sql = "SELECT a.pdc_contents, b.mem_no, b.mem_name, a.pdc_regdate FROM project_detail_comment a 
                INNER JOIN member b ON a.pdc_writer = b.mem_no WHERE a.pjtd_no = '".$data[$i]['pjtd_no']."'";
        $pdComments = mysqli_query($conn, $sql);
        $y=0;
        while($pdComment = mysqli_fetch_assoc($pdComments)) {
            $data[$i]['pjtd_comment'][$y] = $pdComment;
            $y++;
        }
        $i++;}
    mysqli_close($conn);
    return $data;
}

/* 프로젝트 작업항목 - 참여인력 가져오기 */
function getPjtDetailMembers($pNo,$psNo) {
    $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
    $query = "SELECT b.mem_no, b.mem_name, a.pw_pno FROM project_worker a 
            INNER JOIN member b ON a.mem_no = b.mem_no 
            WHERE pw_pno = '$pNo' AND pw_type = 'Detail'";
    $result = mysqli_query($conn, $query);
    // 다중배열 루프 돌려 담기
    $i=0;
    $data=[];
    while($row = mysqli_fetch_assoc($result)) {$data[$i] = $row; $i++;}
    mysqli_close($conn);
    return $data;
}

/* 프로젝트 일정 가져오기 */
function getProjectSchedule() {
    $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
    $query = "SELECT * FROM project a INNER JOIN project_sub b ON a.pjt_no = b.pjt_no ORDER BY a.pjt_no";
    $rslt = mysqli_query($conn, $query);
    $i=0;
    while($row = mysqli_fetch_assoc($rslt)) {
        $data[$i] = $row;

        // 잔여 작업기간 구하기
        $now = date("Y-m-d");
        $subEnd = $data[$i]['pjts_duedate'];
        $remain = intval((strtotime($now)-strtotime($subEnd)) / 86400);
        $residual_day = str_replace("-","",$remain);
        if($remain < 0) {
            $data[$i]['residual_day'] = $residual_day."일 남음";
        } else {
            $data[$i]['residual_day'] = $residual_day."일 지남";
        }
        if($residual_day >= -3) { $data[$i]['auto_status'] = "비상";
        } else if($residual_day >= -10) {$data[$i]['auto_status'] = "긴급";
        } else if($residual_day >= -15) {$data[$i]['auto_status'] = "일반";
        } else if($residual_day > -20) {$data[$i]['auto_status'] = "여유";
        } else {$data[$i]['auto_status'] = "여유";}
        // echo '<span class="calender_info_list"><span>'.$data[$i]['pjts_startdate'].' ~ '.$data[$i]['pjts_duedate'].'<b class="period_status_color_g">('.$data[$i]['residual_day'].'/'.$data[$i]['auto_status'].')</b></span><span>/</span><span>'.$data[$i]['pjt_name'].'</span><span>/</span><span>'.$data[$i]['pjts_name'].'</span></span>';
        $i++;
    }
    mysqli_close($conn);
    return $data;
}
$schedule = getProjectSchedule();

?>