<?php
    include_once('../common.php');

    $mem_id = $_POST['memId']; //아이디
    $mem_pw = $_POST['memPw']; //비번
    $mem_type =$_POST['memType']; //임직원||게스트
    $mem_title = $_POST['memTitle']; //직책
    $mem_name = $_POST['memName']; //이름
    $mem_tel = $_POST['memTel']; //연락처
    $mem_mail = $_POST['memMail']; //이메일

    if(checkId($mem_id)) {$result = "이미 가입되어 있는 아이디입니다.";} 
    else {
        $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
        $encryptPw = password_hash($mem_pw, PASSWORD_DEFAULT); //비밀번호 암호화
        $query = "INSERT INTO member set mem_id='$mem_id', 
                                        mem_pw='$encryptPw', 
                                        mem_name='$mem_name', 
                                        mem_phone='$mem_tel', 
                                        mem_email='$mem_mail', 
                                        mem_type='$mem_type',
                                        mem_title='$mem_title',
                                        mem_level='1'";
        $r = mysqli_query($conn,$query);
        $result = "ok";
        set_session('memName', $mem_name);
    }

    mysqli_close($conn);
    echo $result;

?>