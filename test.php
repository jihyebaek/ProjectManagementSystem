<?php 
    include_once('./common.php');
    include_once('./popup.php');
?>
<!-- 프로젝트 -->
<div id="pjt_popup" class="white-popup mfp-with-anim mfp-hide">
	<span class="popup_title popup_title_add">프로젝트 그룹 추가</span>
	<span class="popup_title popup_title_modify">프로젝트 그룹 수정</span>
    <form id="projectForm" name="projectForm" method="POST">
        <input type="hidden" id="clickType" name="clickType">
        <span class="event_text_input">
            <input type="text" id="pName" name="pName" placeholder="업체명">
        </span>
        <span class="event_date_input event_date_input2">
            <input type="text" id="pEmpName" name="pEmpName" placeholder="담당자">
            <input type="text" id="pEmpTel" name="pEmpTel" placeholder="연락처">
        </span>
        <span class="event_text_input">
            <input type="text" id="pEmpMail" name="pEmpMail" placeholder="이메일주소">
        </span>
        <span class="event_date_input event_date_input3">
            <input type="text" id="pCeoName" name="pCeoName" placeholder="대표자">
            <input type="text" id="pCeoTel" name="pCeoTel" placeholder="연락처">
        </span>
        <span class="event_text_input">
            <input type="text" id="pCeoMail" name="pCeoMail" placeholder="이메일주소">
        </span>
        <span class="event_text_input event_date_input4">
            <b>참여인력</b>
            <?php for($i=0;$i<count($pMems);$i++) { ?>
                <button type="button" onclick="selectWorkers(this)" data-memno="<?=$pMems[$i]['mem_no']?>"><?=$pMems[$i]['mem_name']?>
                <input type="checkbox" id="pWorkers_<?=$pMems[$i]['mem_no']?>" name="pWorkers[]" value="<?=$pMems[$i]['mem_no']?>"/>
                </button>
            <?php } ?>
        </span>
        <span class="event_text_input event_date_input4">
            <b style="margin-bottom: 5px;">프로젝트 메인 색상</b>
            <input type="text" id="pColour" name="pColour" placeholder="#ff0000">
        </span>
        <span class="event_text_input event_date_input4">
            <b style="margin-bottom: 5px;">프로젝트 코드</b>
            <input type="text" id="pCode" name="pCode">
        </span>
    </form>
	<button class="popup_save_button" onclick="saveP(this)" data-pno="<?=$_GET['pNo']?>">저장</button>
    <button class="popup_save_button popup_del_button" onclick="deleteP(this)" data-pno="<?=$_GET['pNo']?>">삭제</button>
</div>
<!--// 프로젝트 -->

<!-- 작업 그룹 -->
<div id="pjt_sub_popup" class="white-popup mfp-with-anim mfp-hide">
	<span class="popup_title popup_title_add">작업 그룹 추가</span>
	<span class="popup_title popup_title_modify">작업 그룹 수정</span>
    <form  id="projectSubForm" name="projectSubForm" method="POST">
        <input type="hidden" id="clickType" name="clickType">
        <span class="event_text_input">
            <input type="text" placeholder="작업명">
        </span>
        <span class="event_date_input event_date_input2">
            <input type="date">
            <input type="date">
        </span>
        <span class="event_text_input event_date_input5">
            <b>작업상태</b>
            <button class="pop_button_event">여유</button>
            <button>일반</button>
            <button>긴급</button>
            <button>비상</button>
        </span>
        <span class="event_text_input event_date_input4">
            <b>참여인력</b>
            <?php for($i=0;$i<count($psMems);$i++) { ?>
                <button onclick="selectWorkers(this)" data-memno="<?=$psMems[$i]['mem_no']?>"><?=$psMems[$i]['mem_name']?>
                <input type="checkbox" id="pWorkers_<?=$psMems[$i]['mem_no']?>" name="psWorkers[]" value="<?=$psMems[$i]['mem_no']?>"/>
                </button>
            <?php } ?>
        </span>
    </form>
	<button class="popup_save_button">저장</button>
</div>
<!--// 작업 그룹 -->