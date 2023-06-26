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
    <form id="projectSubForm" name="projectSubForm" method="POST">
        <input type="hidden" id="clickTypePs" name="clickTypePs">
        <input type="hidden" id="psNo" name="psNo">
        <span class="event_text_input">
            <input type="text" id="psName" name="psName" placeholder="작업명">
        </span>
        <span class="event_date_input event_date_input2">
            <input type="date" id="psStartdate" name="psStartdate">
            <input type="date" id="psDuedate" name="psDuedate">
        </span>
        <span class="event_text_input event_date_input5">
            <b>작업상태</b>
            <button type="button" onclick="selectStatus('havetime')"><input type="radio" id="havetime" name="psStatus" value="여유"/>여유</button>
            <button type="button" onclick="selectStatus('nomal')"><input type="radio" id="nomal" name="psStatus" value="일반"/>일반</button>
            <button type="button" onclick="selectStatus('notime')"><input type="radio" id="notime" name="psStatus" value="긴급"/>긴급</button>
            <button type="button" onclick="selectStatus('urgent')"><input type="radio" id="urgent" name="psStatus" value="비상"/>비상</button>
        </span>
        <span class="event_text_input event_date_input4">
            <b>참여인력</b>
            <?php for($i=0;$i<count($psMems);$i++) { ?>
                <button type="button" onclick="selectWorkers(this)" data-memno="<?=$psMems[$i]['mem_no']?>"><?=$psMems[$i]['mem_name']?>
                <input type="checkbox" id="pWorkers_<?=$psMems[$i]['mem_no']?>" name="psWorkers[]" value="<?=$psMems[$i]['mem_no']?>"/>
                </button>
            <?php } ?>
        </span>
    </form>
	<button class="popup_save_button" onclick="savePs(this)" data-pno="<?=$_GET['pNo']?>">저장</button>
</div>
<!--// 작업 그룹 -->

<!-- 휴가/행사 -->
<div id="event-popup" class="white-popup mfp-with-anim mfp-hide">
	<span class="popup_title">휴가/행사</span>
    <form id="eventForm" name="eventForm" method="POST">
        <span class="event_date_input">
            <input type="date" id="eStartdate" name="eStartdate">
            <input type="date" id="eDuedate" name="eDuedate">
        </span>
        <span class="event_click_input">
            <input type="radio" id="holiday" name="eType" value="휴가">휴가
            <input type="radio" id="event" name="eType" value="행사">행사
        </span>
        <span class="event_text_input">
            <input type="text" id="eContent" name="eContent" placeholder="내용">
        </span>
    </form>
	<button type="button" class="popup_save_button" onclick="saveE(this)" data-memno="<?=$memNo?>">저장</button>
</div>
<!--// 휴가/행사 -->


<script>
    function saveP(ths) { // 프로젝트 추가/수정
        var type = $("#clickType").val();
        var pNo = ths.dataset.pno;

        var fdata = new FormData(projectForm);
        fdata.append('type',type);
        fdata.append('pNo',pNo);

        if($("input[name=pName]").val() == "") {alert("업체명을 입력해주세요.");return false;}
        else if($("input[name=pEmpName]").val() == "") {alert("담당자를 입력해주세요.");return false;}
        else if($("input[name=pEmpTel]").val() == "") {alert("담당자 연락처를 입력해주세요.");return false;}
        else if($("input[name=pCeoName]").val() == "") {alert("대표자를 입력해주세요.");return false;}
        else if($("input[name=pCeoTel]").val() == "") {alert("대표자 연락처를 입력해주세요.");return false;}
        else if($("input[name=pCode]").val() == "") {alert("프로젝트 코드를 입력해주세요.");return false;}
        var cb = document.getElementsByName('pWorkers[]');
        for(var i=0;i<cb.length;i++) {
            var cbVal = cb[i].checked;
            if(cbVal == false) {alert("참여인력을 선택해주세요.");return false;}
        }

        $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: "ajax/project_serv.php",
            data: fdata,
            // dataType : "json",
            processData: false,
            contentType: false,
            cache: false,
            async: true,
            success : function(rslt) { 
                if($.trim(rslt) == "addOk") {
                    alert("프로젝트를 추가하였습니다.");
                    location.reload();
                } else if($.trim(rslt) == "modifyOk") { 
                    alert("프로젝트를 수정하였습니다.");
                    location.reload();
                }  else {alert(rslt);}
            }, error: function(jqXHR, textStatus, errorThrown) {
				console.log("arjax error : " + jqXHR + "\n" + textStatus + "\n" + errorThrown);
            }
        });
    }

    function selectWorkers(ths) { //프로젝트 참여인력 선택
        var memNo = ths.dataset.memno;
        var cb = document.getElementById("pWorkers_"+memNo);
        var cbVal = cb.checked;
        if(cbVal == true) {
            $("input[id=pWorkers_"+memNo+"]").prop("checked",false);
        } else {
            $("input[id=pWorkers_"+memNo+"]").prop("checked",true);
        }
    }

    function deleteP(ths) { //프로젝트 삭제
        var pNo = ths.dataset.pno;
        var type = "delete";

        var confirmResult = confirm("해당 프로젝트를 삭제하시겠습니까?");
        if (confirmResult == true) {
            $.ajax({
                type: "POST",
                enctype: "multipart/form-data",
                url: "ajax/project_serv.php",
                data: {'type' : type, 'pNo' : pNo},
                processData: true,
                cache: false,
                async: true,
                success : function(rslt) { 
                    if($.trim(rslt) == "deleteOk") {
                        alert("프로젝트를 삭제하였습니다.");
                        location.reload();                   
                    } else if($.trim(rslt) == "deletFail") {
                        alert("해당 프로젝트에 작업그룹과 작업항목이 존재하여 삭제할 수 없습니다.");
                    } else {alert(rslt);}
                }, error: function(jqXHR, textStatus, errorThrown) {
                                console.log("arjax error : " + jqXHR + "\n" + textStatus + "\n" + errorThrown);
                }
            });
        } else {
            return false;
        }
    }

    function selectStatus(id) { //작업그룹 작업상태 선택
        $("input[id="+id+"]").prop("checked",true);
        console.log($("intput[id="+id+"]:checked").val());
        // $(".ps_status").addclass("pop_button_event"); //css를 위해 addclass해야함
    }

    function savePs(ths) { // 작업그룹 추가/수정
        var type = $("#clickTypePs").val();
        var pNo = ths.dataset.pno;
        var psNo = $('input[id=psNo]').val();

        var fdata = new FormData(projectSubForm);
        fdata.append('type',type);
        fdata.append('pNo',pNo);
        fdata.append('psNo',psNo);

        if($("input[name=psName]").val() == "") {alert("작업명을 입력해주세요.");return false;}
        else if($("input[name=psStartdate]").val() == "") {alert("시작일을 선택해주세요.");return false;}
        else if($("input[name=psDuedate]").val() == "") {alert("마감일을 선택해주세요.");return false;}

        var status = document.getElementsByName('psStatus');
        var statusChk = false;
        for (var i=0;i<status.length;i++) { if(status[i].checked == true){statusChk = true}; }
        if(statusChk == false) {alert("작업상태를 선택해주세요.");return false;}
        
        var worker = document.getElementsByName('psWorkers[]');
        var workerChk = false;
        for (var i=0;i<worker.length;i++) { if(worker[i].checked == true ){workerChk = true}; }
        if(!workerChk) {alert("작업에 참여할 인력을 선택해주세요.");return false;}

        $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: "ajax/project_sub_serv.php",
            data: fdata,
            // dataType : "json",
            processData: false,
            contentType: false,
            cache: false,
            async: true,
            success : function(rslt) { 
                if($.trim(rslt) == "addOk") {
                    alert("프로젝트를 추가하였습니다.");
                    location.reload();
                } else if($.trim(rslt) == "modifyOk") { 
                    alert("프로젝트를 수정하였습니다.");
                    location.reload();
                }  else {alert(rslt);}
            }, error: function(jqXHR, textStatus, errorThrown) {
				console.log("arjax error : " + jqXHR + "\n" + textStatus + "\n" + errorThrown);
            }
        });
    }

    function saveE(ths) { //휴가/행사 저장
        var memNo = ths.dataset.memno;
        var eType = document.getElementsByName('eType');
        var eTypeChk = false;
        for (var i=0;i<eType.length;i++) { if(eType[i].checked == true){eTypeChk = true}; }

        if($("input[name=eStartdate]").val() == "") {alert("휴가/행사 시작일을 선택해주세요.");return false;}
        else if($("input[name=eDuedate]").val() == "") {alert("휴가/행사 종료일을 선택해주세요.");return false;}
        else if(eTypeChk == false) {alert("휴가 또는 행사를 선택해주세요.");return false;}
        else if($("input[name=eContent]").val() == "") {alert("휴가/행사 내용을 입력해주세요.");return false;}
        
        var fdata = new FormData(eventForm);
        fdata.append('memNo',memNo);

        $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: "ajax/event_serv.php",
            data: fdata,
            // dataType : "json",
            processData: false,
            contentType: false,
            cache: false,
            async: true,
            success : function(rslt) { 
                if($.trim(rslt) == "saveOk") {
                    alert("신청완료하였습니다.");
                    location.reload();
                } else {alert(rslt);}
            }, error: function(jqXHR, textStatus, errorThrown) {
				console.log("arjax error : " + jqXHR + "\n" + textStatus + "\n" + errorThrown);
            }
        });
    }

</script>