<?php 
include_once('./head.php'); 
?>

<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">
<meta name="theme-color" content="#19234b">
<link rel="stylesheet" href="./css/member.css">

<span class="login_wrap">
    <span class="login_box">
        <span class="login_title">프로젝트 관리시스템 사용자 등록</span>
            <form id="registerMember" name="registerMember" enctype="multipart/form-data" method="POST" >
                <span class="login_input">
                    <input type="text" id="memId" name="memId" placeholder="아이디" class="int_frm">
                    <input type="password" id="memPw" name="memPw" placeholder="패스워드" class="int_frm">
                    <input type="password" id="memPwChck" name="memPwChck" placeholder="패스워드 확인" class="int_frm">
                </span>
                
                <span class="login_input login_section">
                    <span class="frm_radio">
                        <span class="radio_box"><input type="radio" id="cruew" name="memType" value="cruew" class="radio"> 임직원</span>
                        <span class="radio_box"><input type="radio" id="guest" name="memType" value="guest" class="radio"> 게스트</span>
                    </span>
                    <span class="login_input">
                        <input type="text" id="memTitle" name="memTitle" placeholder="직책(ex. 개발자)" class="int_frm">
                    </span>
                </span>
                
                <span class="login_input login_section">
                    <input type="text" id="memName" name="memName" placeholder="이름" class="int_frm">
                    <input type="text" id="memTel" name="memTel" placeholder="연락처" class="int_frm">
                    <input type="text" id="memMail" name="memMail" placeholder="이메일" class="int_frm">
                </span>
                
                <span class="login_input login_profile_box">
                    <style></style>
                    <span class="profile_img"><img src="./img/no_user.svg" class="user_img"></span>
                    <span class="profile_add">
                        <input type="file" class="add_file">
                        <span class="profile_add_tip">사이즈 500*500px</span>
                    </span>
                </span>
            </form>
        
        <span class="login_btn"><button onclick="signUp()">사용자등록</button></span>
    </span>
    
    <span class="login_notice">
        <span class="copy_info">
            <a href="#" target="_blank">프로젝트관리</a>
    </span>
</span>
    
<!--=============================================================================-->
<script src="./js/jquery-1.12.4.min.js"></script>
<script>
    function signUp() {
        // 빈 값 반환
        var memId = $.trim($('#memId').val());
        if(!memId){alert('아이디를 입력하세요.');return false;}

        var memPw = $.trim($('#memPw').val());
        var memPwChck = $.trim($('#memPwChck').val());
        if(memPw != memPwChck){alert('비밀번호가 일치하지 않습니다.');return false;}

        var memName = $.trim($('#memName').val());
        if(!memName){alert('이름을 입력하세요.'); return false;}

        var memTel = $.trim($('#memTel').val());
        if(!memTel){alert('연락처를 입력하세요.'); return false;}

        var memMail = $.trim($('#memMail').val());
        if(!memMail){alert('이메일을 입력하세요.'); return false;}

        // form data ajax 넘기기
        var formdata = new FormData(registerMember);
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "ajax/register_serv.php",
            processData: false, 
            contentType: false, 
            data: formdata,
            cache: false,
            success: function(rslt) { 
                if($.trim(rslt) == 'ok') {alert("회원가입이 완료되었습니다."); 
                    window.location.href="./member_result.php"; }
                else { alert($.trim(rslt)); }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("arjax error : " + jqXHR + "\n" + textStatus + "\n" + errorThrown);
            }
        });
    }
</script>

    