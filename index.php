<?php 
    include_once('./common.php');
    include_once('./head.php');
    include_once('./head_sub.php');
    include_once('./popup.php');

    /* 파라미터 없을 시 프로젝트 가장 최근 값 뿌려줌 */
    if($_GET == NULL) {
        $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
        if($memLevel >= 5) {
            $query = "SELECT * FROM Project ORDER BY pjt_regdate DESC LIMIT 1";
        } else {
            $query = "SELECT a.*,b.mem_no FROM Project a INNER JOIN Project_Code b ON a.pjt_code = b.pjtcd_name WHERE b.mem_no = '$memNo' ORDER BY pjt_modifydate DESC LIMIT 1";
        }
        $result = mysqli_query($conn, $query);
        $data =[];
        if(!empty($result) || $result == true) {
            $data = mysqli_fetch_assoc($result);
            $_GET['pNo'] = $data['pjt_no'];
            $pjtNo = $data['pjt_no'];
            $_GET['pName'] = $data['pjt_name'];
        }  
        mysqli_close($conn);
    }

    /* 프로젝트 - 업체 정보 가져오기 */
    function getProjectCoInfo($pNo) {
        $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
        $query = "SELECT * FROM project WHERE pjt_no = '$pNo'";
        $result = mysqli_query($conn, $query);
        if(!empty($result) || $result == true) {$row = mysqli_fetch_assoc($result);}
        mysqli_close($conn);
        return $row;
    }
    $pNo = $_GET['pNo'];
    $comInfo = getProjectCoInfo($pNo);

        /* 프로젝트 - 메모 가져오기 */
        function getProjectMemo($pNo) {
            $conn = mysqli_connect(MY_HOST, MY_USER, MY_PASS, MY_DB) or die($conn."DB open error");
            $query = "SELECT * FROM memo WHERE pjt_no = '$pNo' ORDER BY mm_no DESC LIMIT 1";
            $result = mysqli_query($conn, $query);
            if(!empty($result) || $result == true) {$row = mysqli_fetch_assoc($result);}
            mysqli_close($conn);
            return $row;
        }
        $pNo = $_GET['pNo'];
        $memo = getProjectMemo($pNo);

?>

<style>
    .wrap_box { display:inline-block; width:100%; min-height:calc(100vh - 65px); float:left;}
    .wrap_box ul.menu_box { display:inline-block; width:250px; height:100%; min-height:calc(100vh - 65px); float:left; padding: 15px 20px;}
    .wrap_box ul.menu_box li.menu_title { display:inline-block; width:100%; font-size:19px; font-weight:bold; text-align:left; padding-bottom:15px;}
    .wrap_box ul.menu_box li.menu_box_in { display:inline-block; width:100%;}
    .wrap_box ul.menu_box li.menu_box_in button.btn_project_list { position:relative; display:inline-block; width:100%; text-align:left; font-size:15px; padding:10px 15px; background:#fff; border:1px solid #333; border-radius:5px; margin-bottom:5px;}
    .wrap_box ul.menu_box li.menu_box_in button.btn_project_list:hover { color:#1e94ec; border:1px solid #1e94ec;}
    .wrap_box ul.menu_box li.menu_box_in button.btn_project_list span.bar_color { position:absolute; top:0%; left:0%; display:inline-block; width:7px; height:calc(100% - 2px); margin:1px 0 0 1px; border-radius:4px 0 0 4px;}
        
    span.list_title	span.list_content_add{ float: right; font-size: 13px; font-weight: normal; padding-top: 1px;}
    span.list_title	span.list_content_add a{ color: #454545;}
        
    span.section_title	span.list_content_add{ float: right; font-size: 13px; font-weight: normal; line-height: 28px;}
    span.section_title	span.list_content_add a{ color: #454545;}

    .wrap_box ul.menu_box li.menu_title span.btn_project_add { display:inline-block; width:24px; height:24px; line-height:22px; text-align:center; font-size:15px; background:#fff; border:1px solid #333; border-radius:0px; float:right; margin-top:2px; color: #000;}
    .wrap_box ul.menu_box li.menu_title span.btn_project_add a { color: #000;}
    .wrap_box ul.menu_box li.menu_title span.btn_project_add:hover { color:#1e94ec; border:1px solid #1e94ec;}
    .wrap_box ul.menu_box li.menu_title span.btn_project_add:hover a{ color:#1e94ec;}

    .wrap_box ul.content_box { display:inline-block; width:calc(100% - 630px); float:left; text-align:left;}
    .wrap_box ul.content_box li.section_box { display:inline-block; width:100%; padding:15px;}
    .wrap_box ul.content_box li.section_box span.section_title { display:inline-block; width:100%; font-size:19px; font-weight:bold; padding-bottom:15px;}

    .wrap_box ul.schedule_box { display:inline-block; width:380px; height:100%; min-height: calc(100vh - 65px); float:right; background:#f5f6f7; text-align:left; position: relative;}
    .wrap_box ul.schedule_box li.sb_project { display:inline-block; width:100%; padding:15px;}
    .wrap_box ul.schedule_box li.sb_project span.section_title { display:inline-block; width:100%; font-size:19px; font-weight:bold;}
    .wrap_box ul.schedule_box li.sb_project span.section_schedule { display:inline-block; width:100%;}
    .wrap_box ul.schedule_box li.sb_project span.section_schedule textarea{ width: 100%; height: 100%; float: left; min-height: calc(100vh - 320px); border-radius: 0; border-color: #ccc; padding: 0px 10px 10px; border-top: 0; font-size: 1.2em; line-height: 1.6;}
    .wrap_box ul.schedule_box li.sb_project span.project_info_box{ display: inline-block; width: 100%; height: auto; float: left; background: #fff; padding: 10px 10px 0; border: 1px solid #ccc; border-bottom: 0; margin-top: 20px;}
    .wrap_box ul.schedule_box li.sb_project span.project_info_box span.project_info{ display: inline-block; width: 100%; height: auto; float: left; font-size: 1.2em; line-height: 1.6;}
    .wrap_box ul.schedule_box li.sb_project span.project_info_box span.project_info2{ display: inline-block; width: 100%; height: auto; float: left; font-size: 1.2em; line-height: 1.6; padding-bottom: 10px;}
        
    .wrap_box ul.content_box li.section_box span.section_title span.memo_show { display: inline-block; float: right; font-size: 13px; color: #454545; cursor: pointer; font-weight: normal; line-height: 28px;}
    .wrap_box ul.schedule_box li.sb_project span.section_title span.memo_hide { display: inline-block; float: right; font-size: 13px; color: #454545; cursor: pointer; font-weight: normal; line-height: 28px; margin-left: 10px;}
    .wrap_box ul.content_box li.section_box span.section_title span.memo_show:hover{ color: #1e94ec;}
        
    .wrap_box ul.view_none { display:none;}
    
    #calendar1 {
        max-width: 100%;
        margin: 0 auto;
    }
</style>

<div class="wrap_box">
	<?php include_once('./left_menu.php');?>
	
	<style>
        .project_pm_box { display:inline-block; width:100%;}

        .pm_list_box { display:inline-block; width:100%; border:1px solid #ddd;}
        .pm_list_box span.list_title { display:inline-block; width:100%; padding:10px 15px; font-size:17px; font-weight:bold; background:#f5f6f7;}
        .pm_list_box span.list_content { display:inline-block; width:100%; padding:15px; border-bottom:1px solid #ddd;}
        .pm_list_box span.list_content:last-child {border-bottom:0px;}
        .pm_list_box span.list_content span.lc_title { display:inline-block; float:left; font-size:17px; font-weight:bold;}
        .pm_list_box span.list_content span.lc_period { display:inline-block; float:left; font-size:15px; padding-top:3px; padding-left:10px;}
        .pm_list_box span.list_content span.lc_period span.period_status { display:inline-block; padding-left:5px; color:#666;}
        span.period_status.period_status_color_r { color: #ff0000;} /*비상*/
        span.period_status.period_status_color_g { color: #19ce60;} /*여유*/
        span.period_status.period_status_color_o { color: #FFA600;} /*긴급*/
        span.period_status.period_status_color_b { color: #1200FF;} /*일반*/
        
        .pm_list_box span.list_content span.lc_team { display:inline-block; width:100%; padding:10px 0;}
        .pm_list_box span.list_content span.lc_team span.lct_person { display:inline-block; padding:3px; border:1px solid #ddd; border-radius:50px;}
        .pm_list_box span.list_content span.lc_team span.lct_person img.lct_img {width:20px; float:left; margin-right:5px;}
        .pm_list_box span.list_content span.lc_team span.lct_person span.lct_name { display:inline-block; float:left; line-height:20px; font-size:13px; padding:0 7px 0 0;}

        .pm_list_box span.list_content span.lc_work_list { display:inline-block; width:100%; padding-bottom: 15px;}
        .pm_list_box span.list_content span.lc_work_list:last-child { border-bottom:0px; padding-bottom:0px; margin-bottom:0px;}
        .pm_list_box span.list_content span.lc_work_list span.lcw_check { display:inline-block; width:20px; height:20px; line-height:20px; float:left;}
        .pm_list_box span.list_content span.lc_work_list span.lcw_check input.check_frm {width:15px; height:15px;}
        .pm_list_box span.list_content span.lc_work_list span.lcw_work_list { display:inline-block; float:left; font-size:15px;}
        .pm_list_box span.list_content span.lc_work_list span.lcw_work_list span.wl_date { display:inline-block; color:#999; padding-left:5px;}

        .pm_list_box span.list_content span.lc_work_list span.lcw_work_person { display:inline-block; float:left; padding-left:10px;}
        .pm_list_box span.list_content span.lc_work_list span.lcw_work_person span.w_person { display:inline-block; border:1px solid #ddd; line-height:15px; border-radius:50px; padding:3px;}
        .pm_list_box span.list_content span.lc_work_list span.lcw_work_person span.w_person img.lct_img {width:15px; margin-right:5px; float:left;}
        .pm_list_box span.list_content span.lc_work_list span.lcw_work_person span.w_person span.lct_name { display:inline-block; padding-right:5px; float:left;}
            
        .pm_list_box span.list_content span.lc_work_list span.work_list_button { display:inline-block; float:right;}
        .pm_list_box span.list_content span.lc_work_list span.work_list_button a{ display:inline-block; float: left; padding:0 7px; border-left: 1px solid #eee; color: #888;}
        .pm_list_box span.list_content span.lc_work_list span.work_list_button a:first-child{ padding-left: 0; border-left: 0;}
        .pm_list_box span.list_content span.lc_work_list span.work_list_button a:last-child{ padding-right: 0;}

        .pm_list_box span.list_content span.list_content_button { display:inline-block; float:right; padding-top: 3px;}
        .pm_list_box span.list_content span.list_content_button a{ display:inline-block; float: left; padding:0 7px; border-left: 1px solid #eee; color: #888;}
        .pm_list_box span.list_content span.list_content_button a:first-child{ padding-left: 0; border-left: 0;}
        .pm_list_box span.list_content span.list_content_button a:nth-child(3){ padding-right: 0;}

        .pm_list_box span.list_content span.lc_work_list span.lcw_memo { display:inline-block; width:100%; padding:3px 0 0px 20px; float: left;}
        .pm_list_box span.list_content span.lc_work_list span.lcw_memo input.lcw_frm1 { display:inline-block; width:calc(100% - 55px); height:30px; line-height:30px; float:left; padding:0 10px; border:1px solid #ccc;}
        .pm_list_box span.list_content span.lc_work_list span.lcw_memo button.btn_lcw_save {width:55px; height:30px; line-height:30px; float:left; font-size:13px; background:#fff; color:#000; border:1px solid #ccc; border-left:0px;}
        .pm_list_box span.list_content span.lc_work_list span.lcw_memo button.btn_lcw_save:hover { background:#f5f6f7;}
            
        .pm_list_box span.list_content span.lc_work_list span.lcw_work_check { display: inline-block; width: 100%; height: auto; float: left; padding-top: 5px; padding-left: 30px; font-size: 13px; position: relative;}
        .pm_list_box span.list_content span.lc_work_list span.lcw_work_check::before{ display: inline-block; position: absolute; top: 12px; left: 20px; width: 5px; height: 5px; border-left: 1px solid #000; border-bottom: 1px solid #000; content: "";}

	</style>

    <ul class="content_box">
        <li class="section_box">
        	<span class="section_title">프로젝트 현황<span class="memo_show">메모장</span></span>
            <span class="project_pm_box">
            	
                <!-- Project List -->
                <span class="pm_list_box">
                    <!-- 프로젝트 이름 -->
                	<span class="list_title"><?=$_GET['pName']?>
						<span id="inline-popups2" onclick="modifyP(this)" data-pno="<?=$_GET['pNo']?>" class="project_modified"><a href="#pjt_popup" data-effect="mfp-zoom-in"><img src="./img/setting.svg" alt="수정 icon"></a></span>
						<span id="inline-popups3" onclick="addPs(this)" title="작업 추가" class="list_content_add"><a href="#pjt_sub_popup" data-effect="mfp-zoom-in">작업 추가</a></span>
					</span>
                    <!-- //프로젝트 이름 -->
                    
                    <!-- 프로젝트 작업그룹 -->
                    <?php if(!empty($psInfos)) { for($i=0;$i<count($psInfos);$i++) { ?>
                    <span class="list_content">
                    	<span class="lc_title"><?=$psInfos[$i]['pjts_name']?></span>
                        <span class="lc_period"><?=$psInfos[$i]['pjts_startdate']?> ~ <?=$psInfos[$i]['pjts_duedate']?><span class="period_status pjt_sd_status" value="<?=$psInfos[$i]['auto_status']?>">(<?=$psInfos[$i]['residual_day']?> / <?=$psInfos[$i]['auto_status']?>)</span></span>
						<span class="list_content_button">
                            <span id="inline-popups3" onclick="modifyPs(this)" data-psno="<?=$psInfos[$i]['pjts_no']?>">
                                <a href="#pjt_sub_popup" data-effect="mfp-zoom-in">수정</a>
                            </span>
                            <a href="javascript:void(0);" onclick="deletePs(this)" data-psno="<?=$psInfos[$i]['pjts_no']?>">삭제</a>
                            <a href="javascript:void(0);" onclick="addPd(this)" data-psno="<?=$psInfos[$i]['pjts_no']?>">추가</a>
                        </span>
                        <span class="lc_team">
                            <?php foreach($psInfos[$i]['pjts_worker'] as $key=>$val) { ?>
                        	<span class="lct_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name"><?=$val['mem_name']?></span></span>
                            <?php } ?>
                        </span>

                        <?php
                            $pdInfos = getProjectDetailInfos($pNo,$psInfos[$i]['pjts_no']);
                            $pdMems = getPjtDetailMembers($pNo,$psInfos[$i]['pjts_no']);
                            // print_r($pdInfos);
                        ?>

                        <!-- 프로젝트 작업항목 -->
                        <?php if(!empty($pdInfos)) { for($x=0;$x<count($pdInfos);$x++) { ?>
                        <span class="lc_work_list">
                        	<span class="lcw_check"><input type="checkbox" class="check_frm" /></span>
                            <span class="lcw_work_list"><?=$pdInfos[$x]['pjtd_name']?><span class="wl_date"><?=$pdInfos[$x]['pjtd_startdate']?> ~ <?=$pdInfos[$x]['pjtd_duedate']?><span class="period_status pjt_sd_status" value="<?=$pdInfos[$i]['auto_status']?>">(<?=$pdInfos[$x]['residual_day']?> / <?=$pdInfos[$x]['auto_status']?>)</span></span></span>
                            <span class="lcw_work_person">
                                <?php foreach($pdInfos[$x]['pjtd_worker'] as $key=>$val) {  ?>
                            	<span class="w_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name"><?=$val['mem_name']?></span></span>
                                <?php } ?>
                            </span>
							<span class="work_list_button"><a href="#">확인</a>
                            <a href="javascript:void(0);" onclick="modifyPd(this)" data-pno="<?=$pdInfos[$x]['pjt_no']?>" data-psno="<?=$pdInfos[$x]['pjts_no']?>" data-pdno="<?=$pdInfos[$x]['pjtd_no']?>">수정</a>
                            <a href="javascript:void(0);" onclick="deletePd(this)" data-pdno="<?=$pdInfos[$x]['pjtd_no']?>">삭제</a></span>
                            <!-- <span class="lcw_memo"><input type="text" class="lcw_frm1" /><button class="btn_lcw_save">저장</button></span> -->
                            <!-- <span class="lcw_work_check">2023.05.03에 홍길동님이 확인했습니다.</span> -->
                            <?php if(!empty($pdInfos[$x]['pjtd_comment'])) { foreach($pdInfos[$x]['pjtd_comment'] as $key=>$val) { ?>
                            <span class="lcw_work_check"><?=$val['mem_name']?>  : <?=$val['pdc_contents']?> &nbsp;&nbsp;<?=$val['pdc_regdate']?></span>
                            <?php } }?>
                        </span>
                        <?php } }  ?>
                        <!--// 프로젝트 작업항목 -->
						
						<!--프로젝트 작업항목 추가-->
                        <span class="lc_work_list_add" id="pdAdd_<?=$psInfos[$i]['pjts_no']?>" style="display:none">
                            <form id="projectDetailAddForm_<?=$psInfos[$i]['pjts_no']?>" name="projectDetailAddForm_<?=$psInfos[$i]['pjts_no']?>" method="POST">
                                <b>작업 항목 추가</b>
                                <span class="lc_work_list_add_text"><input type="text" id="pdName" name="pdName"></span>
                                <span class="lc_work_list_add_date">
                                    <input type="date" id="pdStartdate" name="pdStartdate">
                                    <input type="date" id="pdDuedate" name="pdDuedate">
                                </span>
                                <span class="lc_work_list_add_button">
                                <?php foreach($psInfos[$i]['pjts_worker'] as $key=>$val) { ?>
                                    <button type="button" onclick="selectWorkers(this)" data-memno="<?=$val['mem_no']?>">
                                    <input type="checkbox" id="pWorkers_<?=$val['mem_no']?>" name="pdWorkers[]" value="<?=$val['mem_no']?>"><?=$val['mem_name']?>
                                    </button>
                                <?php } ?>
                                    <a href="javascript:void(0);" onclick="saveAddPd(this)" data-type="add" data-pno="<?=$psInfos[$i]['pjt_no']?>" data-psno="<?=$psInfos[$i]['pjts_no']?>">저장</a>
                                </span>
                            </form>
                        </span>
						<!-- 프로젝트 작업항목 추가-->
						
						<!-- 프로젝트 작업항목 수정-->
                        <?php for($x=0;$x<count($pdInfos);$x++) {?>
						<span class="lc_work_list_add" id="pdModify_<?=$pdInfos[$x]['pjtd_no']?>" style="display:none">
                            <form id="projectDetailModifyForm_<?=$pdInfos[$x]['pjtd_no']?>" name="projectDetailModifyForm_<?=$pdInfos[$x]['pjtd_no']?>" method="POST">
                                <b>작업 항목 수정</b>
                                <span class="lc_work_list_add_text"><input type="text" id="pdName_<?=$pdInfos[$x]['pjtd_no']?>" name="pdName"></span>
                                <span class="lc_work_list_add_text"><input type="text" id="pdComment_<?=$pdInfos[$x]['pjtd_no']?>" name="pdComment" placeholder="수정 사유를 입력하세요."></span>
                                <span class="lc_work_list_add_date">
                                    <input type="date" id="pdStartdate_<?=$pdInfos[$x]['pjtd_no']?>" name="pdStartdate">
                                    <input type="date" id="pdDuedate_<?=$pdInfos[$x]['pjtd_no']?>" name="pdDuedate">
                                </span>
                                <span class="lc_work_list_add_button">
                                <?php foreach($psInfos[$i]['pjts_worker'] as $key=>$val) { ?>
                                    <button type="button" onclick="selectWorkers(this)" data-memno="<?=$val['mem_no']?>">
                                    <input type="checkbox" id="pWorkers_<?=$val['mem_no']?>" name="pdWorkers[]" value="<?=$val['mem_no']?>"><?=$val['mem_name']?>
                                    </button>
                                <?php } ?>
                                    <a href="javascript:void(0);" onclick="saveModifyPd(this)" data-type="modify" data-pno="<?=$pdInfos[$x]['pjt_no']?>" data-psno="<?=$pdInfos[$x]['pjts_no']?>" data-pdno="<?=$pdInfos[$x]['pjtd_no']?>" data-writer="<?=$memNo?>">저장</a>
                                </span>
                            </form>
						</span>
                        <?php } ?>
						<!-- 프로젝트 작업항목 수정-->
                    </span>
                    <?php } } ?>
                    <!--// 프로젝트 작업그룹 -->
                    
                </span>
                <!--// Project List -->
                
            </span>
        </li>
    </ul>
	
    <ul class="schedule_box memo_hide_button view_none">
		<!--메모-->
    	<li class="sb_project">
        	<span class="section_title">메모<span class="list_content_add">
                <a href="javascript:void(0);" onclick="saveMemo(this)" data-memno="<?=$memNo?>" data-pno="<?=$_GET['pNo']?>">저장</a>
                <span class="memo_hide">닫기</span>
            </span></span>
            <span class="section_schedule">
				<span class="project_info_box">
					<span class="project_info"><b>담당자 : </b><?=$comInfo['pjt_emp_name']?></span>
					<span class="project_info"><b>연락처 : </b><?=$comInfo['pjt_emp_tel']?></span>
					<span class="project_info2"><b>이메일주소 : </b><?=$comInfo['pjt_emp_email']?></span>
					<span class="project_info"><b>대표자 : </b><?=$comInfo['pjt_ceo_name']?></span>
					<span class="project_info"><b>연락처 : </b><?=$comInfo['pjt_ceo_tel']?></span>
					<span class="project_info2"><b>이메일주소 : </b><?=$comInfo['pjt_ceo_email']?></span>
				</span>
				<textarea id="pMemo" placeholder="프로젝트와 관련된 메모를 입력해주세요."><?=$memo['mm_contents']?></textarea>
            </span>
        </li>
		<!--메모-->
		
    </ul>
	
    <ul class="schedule_box memo_show_button">
    	
        <!-- Project Work List -->
    	<li class="sb_project">
        	<span class="section_title">프로젝트 일정</span>
            <span class="section_schedule">
                <!-- Calendar Area -->
                <link rel="stylesheet" href="./css/calendar.css">
                <div class="calendar"></div>
                <script src="./js/calendar.js" type="text/javascript"></script>
                <!--// Calendar Area -->
            </span>
        </li>
        <!--// Project Work List -->
    </ul>
	
	<ul class="schedule_box2">
    	
        <!-- Project Work List -->
    	<li class="sb_project">
        	<span class="section_title">프로젝트 일정</span>
			<!-- <span class="calendar_wrap"></span>
			<span class="calender_info_list_bar"></span> -->
			<span class="calender_info_list_box">
                <?php for($i=0;$i<count($schedule);$i++) { ?>
				<span class="calender_info_list">
                    <span><?=$schedule[$i]['pjts_startdate']?> ~ <?=$schedule[$i]['pjts_duedate']?>
                    <b class="pjt_sd_status" value="<?=$schedule[$i]['auto_status']?>">(<?=$schedule[$i]['residual_day']?> / <?=$schedule[$i]['auto_status']?>)</b>
                    </span><span>/</span><span><?=$schedule[$i]['pjt_name']?></span><span>/</span><span><?=$schedule[$i]['pjts_name']?></span></span>
                <?php } ?>
            </span>
        </li>
        <!--// Project Work List -->
        
        <!-- Event List -->
    	<li class="sb_project">
        	<span class="section_title">휴가/행사 일정</span>
			<!-- <span class="calendar_wrap"></span>
			<span class="calender_info_list_bar"></span> -->
			<span class="calender_info_list_box">
                <?php for($i=0;$i<count($event);$i++) { ?>
				<span class="calender_info_list"><span><?=$event[$i]['he_startdate']?> ~ <?=$event[$i]['he_duedate']?></span><span>/</span><span><?=$event[$i]['he_type']?></span><span>/</span><span><?=$event[$i]['mem_name']?> / <?=$event[$i]['he_content']?></span></span>
			    <?php } ?>
            </span>
        </li>
        <!--// Event List -->
		
    </ul>
</div>


<script>

    /* 상태에 따른 css 효과주기 */
    var pjtStatus = document.getElementsByClassName("pjt_sd_status");
    for (var i = 0; i < pjtStatus.length; i++) {
        var statusVal = pjtStatus[i].getAttribute("value");
        if (statusVal === '여유') {
            pjtStatus[i].classList.add("period_status_color_g");
        } else if (statusVal === '일반') {
            pjtStatus[i].classList.add("period_status_color_b");
        } else if (statusVal === '긴급') {
            pjtStatus[i].classList.add("period_status_color_o");
        } else if (statusVal == '비상') {
            pjtStatus[i].classList.add("period_status_color_r");
        }
    }
	
	$(".wrap_box ul.content_box li.section_box span.section_title span.memo_show").click(function(){
		$(".memo_show_button").addClass("view_none");
		$(".memo_hide_button").removeClass("view_none");
	});
	
	$("li.sb_project span.section_title .list_content_add .memo_hide").click(function(){
		$(".memo_hide_button").addClass("view_none");
		$(".memo_show_button").removeClass("view_none");
	});
	
</script>


<?php include_once('./tail.php'); ?>


<script>

    function addP() { // 프로젝트 추가
        $(".popup_title_modify").hide();
        $(".popup_del_button").hide();
        $(".popup_title_add").show();
        $("#clickType").val("add");

        // 수정 버튼 클릭으로 남은 value 초기화
        $("input[name=pName]").val("");
        $("input[name=pEmpName]").val("");
        $("input[name=pEmpTel]").val("");
        $("input[name=pEmpMail]").val("");
        $("input[name=pCeoName]").val("");
        $("input[name=pCeoTel]").val("");
        $("input[name=pCeoMail]").val("");
        $("input[name=pColour]").val("");
        $("input[name=pCode]").val("");
        $("input[name='pWorkers[]']").prop("checked", false);
    }

    function modifyP(ths) { // 프로젝트 수정
        $(".popup_title_add").hide();
        $(".popup_title_modify").show();
        $("#clickType").val("modify");

        var pNo = ths.dataset.pno;
        $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: "ajax/project_serv.php",
            data: {'type' : 'get','pNo': pNo},
            dataType: "json",
            processData: true,
            cache: false,
            async: true,
            success: function(rslt) {
                $("input[name=pName]").val(rslt.pjt_name);
                $("input[name=pEmpName]").val(rslt.pjt_emp_name);
                $("input[name=pEmpTel]").val(rslt.pjt_emp_tel);
                $("input[name=pEmpMail]").val(rslt.pjt_emp_email);
                $("input[name=pCeoName]").val(rslt.pjt_ceo_name);
                $("input[name=pCeoTel]").val(rslt.pjt_ceo_tel);
                $("input[name=pCeoMail]").val(rslt.pjt_ceo_email);
                $("input[name=pColour]").val(rslt.pjt_colour);
                $("input[name=pCode]").val(rslt.pjt_code);
                for (var i=0;i<rslt.pjt_worker.length;i++) {
                    var memno = rslt.pjt_worker[i].mem_no;
                    $("input[id=pWorkers_"+memno+"][value="+memno+"]").prop("checked", true);
                }
            }, error: function(jqXHR, textStatus, errorThrown) {
                console.log("arjax error : " + jqXHR + "\n" + textStatus + "\n" + errorThrown);
            }
        });
    }

    function addPs(ths) { //작업그룹 추가
        $(".popup_title_modify").hide();
        $(".popup_title_add").show();
        $("#clickTypePs").val("add");

        // 수정 버튼 클릭으로 남은 value 초기화
        $("input[name=psName]").val("");
        $("input[name=psStartdate]").val("");
        $("input[name=psDuedate]").val("");
        $("input[name=psStatus]").val("");
        $("input[name='psWorkers[]']").prop("checked", false);
    }

    function modifyPs(ths) { //작업그룹 수정
        $(".popup_title_add").hide();
        $(".popup_title_modify").show();
        $("#clickTypePs").val("modify");

        var psNo = ths.dataset.psno;
        $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: "ajax/project_sub_serv.php",
            data: {'type' : 'get','psNo': psNo},
            dataType: "json",
            processData: true,
            cache: false,
            async: true,
            success: function(rslt) {
                $('input[id=psNo]').val(rslt.pjts_no);
                $('input[id=psName]').val(rslt.pjts_name);
                $('input[id=psStartdate]').val(rslt.pjts_startdate);
                $('input[id=psDuedate]').val(rslt.pjts_duedate);
                var status = document.getElementsByName("psStatus");
                for (var i=0; i<status.length;i++) {
                    if (status[i].value === rslt.pjts_status) {status[i].checked = true;}
                }
                for (var i=0;i<rslt.pjts_worker.length;i++) {
                    var memno = rslt.pjts_worker[i].mem_no;
                    $('input[id=pWorkers_'+memno+']').val(memno).prop("checked",true);
                }
            }, error: function(jqXHR, textStatus, errorThrown) {
                console.log("arjax error : " + jqXHR + "\n" + textStatus + "\n" + errorThrown);
            }
        });
    }

    function deletePs(ths) { //작업그룹 삭제
        var psNo = ths.dataset.psno;
        var type = "delete";

        var confirmResult = confirm("해당 프로젝트를 삭제하시겠습니까?");
        if (confirmResult == true) {
            $.ajax({
                type: "POST",
                enctype: "multipart/form-data",
                url: "ajax/project_sub_serv.php",
                data: {'type' : type, 'psNo' : psNo},
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

    function addPd(ths) { //작업항목 추가
        var psNo = ths.dataset.psno;
        var addArea = document.getElementById("pdAdd_" + psNo);
        if (addArea.style.display == 'none') { addArea.style.display = "block";} 
        else { addArea.style.display = "none"; }

        // value 초기화
        $("input[name='pdWorkers[]']").prop("checked", false);
    }
    function modifyPd(ths) { //작업항목 수정
        var pNo = ths.dataset.pno;
        var psNo = ths.dataset.psno;
        var pdNo = ths.dataset.pdno;
        var modifyArea = document.getElementById("pdModify_" + pdNo);
        if (modifyArea.style.display == 'none') { modifyArea.style.display = "block";} 
        else { modifyArea.style.display = "none"; }

        var data = {'type' : 'get',
                    'pNo' : pNo,
                    'psNo' : psNo,
                    'pdNo': pdNo}

        $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: "ajax/project_detail_serv.php",
            data: data,
            dataType: "json",
            processData: true,
            cache: false,
            async: true,
            success: function(rslt) {
                $('input[id=pdName_'+pdNo+']').val(rslt.pjtd_name);
                $('input[id=pdStartdate_'+pdNo+']').val(rslt.pjtd_startdate);
                $('input[id=pdDuedate_'+pdNo+']').val(rslt.pjtd_duedate);
                for (var i=0;i<rslt.pjtd_worker.length;i++) {
                    var memno = rslt.pjtd_worker[i].mem_no;
                    $('input[id=pWorkers_'+memno+']').val(memno).prop("checked",true);
                }
            }, error: function(jqXHR, textStatus, errorThrown) {
                console.log("arjax error : " + jqXHR + "\n" + textStatus + "\n" + errorThrown);
            }
        });
    }

    function deletePd(ths) { //작업항목 삭제
        var pdNo = ths.dataset.pdno;
        var type = "delete";

        var confirmResult = confirm("해당 프로젝트를 삭제하시겠습니까?");
        if (confirmResult == true) {
            $.ajax({
                type: "POST",
                enctype: "multipart/form-data",
                url: "ajax/project_detail_serv.php",
                data: {'type' : type, 'pdNo' : pdNo},
                processData: true,
                cache: false,
                async: true,
                success : function(rslt) { 
                    if($.trim(rslt) == "deleteOk") {
                        alert("작업항목을 삭제하였습니다.");
                        location.reload();                   
                    } else {alert(rslt);}
                }, error: function(jqXHR, textStatus, errorThrown) {
                                console.log("arjax error : " + jqXHR + "\n" + textStatus + "\n" + errorThrown);
                }
            });
        } else {
            return false;
        }
    }

    function saveAddPd(ths) { //작업항목 추가 저장
        var type = ths.dataset.type;
        var pNo = ths.dataset.pno;
        var psNo = ths.dataset.psno;

        var form = document.getElementById("projectDetailAddForm_" + psNo);
        var fdata = new FormData(form);
        fdata.append('type',type);
        fdata.append('pNo',pNo);
        fdata.append('psNo',psNo);

        $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: "ajax/project_detail_serv.php",
            data: fdata,
            processData: false,
            contentType: false,
            cache: false,
            async: true,
            success : function(rslt) { 
                if($.trim(rslt) == "addOk") {
                    alert("작업항목을 추가하였습니다.");
                    location.reload();
                } else {alert(rslt);}
            }, error: function(jqXHR, textStatus, errorThrown) {
				console.log("arjax error : " + jqXHR + "\n" + textStatus + "\n" + errorThrown);
            }
        });
    }

    function saveModifyPd(ths) { //작업항목 수정 저장
        var type = ths.dataset.type;
        var pNo = ths.dataset.pno;
        var psNo = ths.dataset.psno;
        var pdNo = ths.dataset.pdno;
        var writer = ths.dataset.writer;

        var form = document.getElementById("projectDetailModifyForm_" + pdNo);
        var fdata = new FormData(form);
        fdata.append('type',type);
        fdata.append('pNo',pNo);
        fdata.append('psNo',psNo);
        fdata.append('pdNo',pdNo);
        fdata.append('pdWriter',writer);

        $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: "ajax/project_detail_serv.php",
            data: fdata,
            processData: false,
            contentType: false,
            cache: false,
            async: true,
            success : function(rslt) { 
                if($.trim(rslt) == "modifyOk") { 
                    alert("작업항목을 수정하였습니다.");
                    location.reload();
                }  else {alert(rslt);}
            }, error: function(jqXHR, textStatus, errorThrown) {
				console.log("arjax error : " + jqXHR + "\n" + textStatus + "\n" + errorThrown);
            }
        });
    }

    function saveMemo(ths) { //프로젝트 메모 저장
        var memNo = ths.dataset.memno;
        var pNo = ths.dataset.pno
        var pMemo = document.getElementById("pMemo").value;
        var data = {'type': "memo", 'pMemo': pMemo, 'memNo': memNo, 'pNo': pNo};

        $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: "ajax/project_serv.php",
            data: data,
            cache: false,
            async: true,
            success : function(rslt) { 
                if($.trim(rslt) == "memoOk") { 
                    alert("메모가 저장되었습니다.");
                    location.reload();
                }  else {alert(rslt);}
            }, error: function(jqXHR, textStatus, errorThrown) {
				console.log("arjax error : " + jqXHR + "\n" + textStatus + "\n" + errorThrown);
            }
        });
    }
    
</script>