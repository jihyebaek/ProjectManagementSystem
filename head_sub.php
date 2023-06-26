<?php
    include_once('./common.php'); 
    if (!checkId($_SESSION['memId'])) { //쿠키 log_id가 db에 없다면 log_in.php로 이동
        header('Location: ./login.php');
    } else {
        $_SESSION['memId'] = $_COOKIE['memId']; //브라우저 종료후 다시 홈페이지 접속시 session값 세팅
    }
    
    $sessionId = $_SESSION['memId'];
    $rslt = checkId($sessionId);
?>

<!-- Popup Include -->
<link rel='stylesheet prefetch' href='./css/magnific-popup.css'>
<link rel='stylesheet prefetch' href='./css/popup_style.css'>

<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js'></script>
<!-- Popup Include -->

<body>
	<span class="wrap">
		<span class="header">
            <style>
                .my_profile_head_box { display:inline-block; float:left;}
                .my_profile_head_box span.mp_img { display:inline-block; width:35px; height:35px; float:left;}
                .my_profile_head_box span.mp_img img.my_profile_img {width:100%; float:left; border-radius:100px; box-shadow:0 0 10px rgba(0, 0, 0, 0.1);}
                .my_profile_head_box span.mp_name { display:inline-block; float:left; margin-left:15px; font-size:19px; line-height:35px;}
            </style>
            <span class="logo">
            	<span class="my_profile_head_box">
                	<span class="mp_img"><img src="./img/no_user.svg" class="my_profile_img"></span>
                    <span class="mp_name"><?=$memName?> (<?=$memTitle?>)</span>
                </span>
            	<a href="./index.php" class="logo_text"><span class="left_line"></span>프로젝트 관리시스템</a>
            </span>
			
            <span class="counselor">
                <!-- <span class="admin"><span id="inline-popups6" onClick="" title="수정" class="btn_text"><a href="#test-popup6" data-effect="mfp-zoom-in">서버정보</a></span></span> -->
                <!-- <span class="admin"><span class="btn_text"><a href="./member_list.php">관리자</a></span></span> -->
                <span id="inline-popups" class="logout" onClick="" title="휴가/행사">
                	<a href="#event-popup" data-effect="mfp-zoom-in"><span class="btn_text">휴가/행사</span></a>
                </span>
                <span class="logout" onClick="logout_proc();" title="로그아웃">
                	<span class="btn_text">로그아웃</span>
                </span>
			</span>
		</span>
        
<script>
    function logout_proc() {
        if (confirm("로그아웃 하시겠습니까?")) {
            location.href="./logout.php";
        }
    }
</script>