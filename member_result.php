<?php 
include_once('./common.php');
include_once('./head.php'); 
?>

<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">
<meta name="theme-color" content="#19234b">
<link rel="stylesheet" href="./css/member.css">


<span class="login_wrap">
    <span class="login_box">
        <span class="login_title">사용자등록 완료</span>
        

        <span class="member_result">

        	<span class="result_profile_img"><img src="./img/no_user.svg" class="user_img"></span>
            <span class="user_name"><?=$_SESSION['memName']?> 님</span>
            <span class="result_notice">가입을 환영합니다.</span>
            
        </span>
        
        <span class="login_btn"><button onclick="location.href='./login.php'">로그인</button></span>
    </span>
</span>
    
<!--=============================================================================-->
<script src="./js/jquery-1.12.4.min.js"></script>

    