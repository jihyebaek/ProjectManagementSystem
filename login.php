<?php 
include_once('./head.php');

?>

<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">
<meta name="theme-color" content="#19234b">
<link rel="stylesheet" href="./css/member.css">


<span class="login_wrap">
    <span class="login_box">
        <span class="login_title">프로젝트 관리 시스템</span>
        <span class="login_input">
            <input type="text" id="memId" placeholder="아이디" class="int_frm">
            <input type="password" id="memPw" placeholder="비밀번호" class="int_frm">
        </span>
        <span class="login_btn"><button onclick="login_proc();">로그인</button></span>
        
        <span class="member_reg"><a href="./member_registration.php">사용자등록</a></span>
    </span>
    
    <span class="login_notice">
        <span class="copy_info">
        	<a href="#" target="_blank">프로젝트관리</a>
        </span>
    </span>
</span>
    
<!--=============================================================================-->
<script src="./js/jquery-1.12.4.min.js"></script>
<script>
function login_proc() {
    let memId = $.trim($('#memId').val());
    if (!memId) { alert("아이디를 입력하세요."); return; }
    let memPw = $.trim($('#memPw').val()); 
    if (!memPw) { alert("비밀번호를 입력하세요."); return; } 
    
    $.ajax({
		type: "POST",
		url: "ajax/login_serv.php",
		data: { memId:memId, memPw:memPw },
		cache: false,
		success: function(rslt) {
			if ($.trim(rslt) == 'ok') { alert("로그인 성공"); location.replace('./index.php'); }
            else { alert(rslt); return; }
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log("arjax error : " + jqXHR + "\n" + textStatus + "\n" + errorThrown);
		}
	});	
}
</script>
    