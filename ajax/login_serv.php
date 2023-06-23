<?php
include_once('../common.php');

$memId  = isset($_POST['memId']) ? trim($_POST['memId']) : '';
$memPw = isset($_POST['memPw']) ? trim($_POST['memPw']) : '';

$logedMem = checkId($memId);
$password = password_hash($memPw, PASSWORD_DEFAULT);

if($logedMem) {
    if(password_verify($memPw, $logedMem['mem_pw'])) {
        set_session('memId', $memId);
        $result = "ok";
    } else {
        $result = "아이디 또는 비밀번호가 일치하지 않습니다.1";
    }
} else {
    $result = "아이디 또는 비밀번호가 일치하지 않습니다.2";
}

echo $result;
?>