<?php 

    // include_once('./common.php');
    // include_once('./head.php');
    // include_once('./head_sub.php');
    // include_once('./popup.php');

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
	
.wrap_box ul.schedule_box li.memo_button{ display:inline-block; position: absolute; top: 0; left: -35px; width: 35px; height: 35px; background: #f5f6f7;}
.wrap_box ul.schedule_box li.memo_button span{ display:inline-block; width: 100%; height: auto; float: left; text-align: center; line-height: 35px; cursor: pointer;}
.wrap_box ul.schedule_box li.memo_button img{ width: 21px;}
.wrap_box ul.schedule_box li.memo_button span.memo_hide img{ width: 17px;}
	
.wrap_box ul.view_none { display:none;}
</style>

<div class="wrap_box">
	<ul class="menu_box">
    	<li class="menu_title">
        	프로젝트<span id="inline-popups2" onClick="" title="+" class="btn_project_add"><a href="#test-popup2" data-effect="mfp-zoom-in">+</a></span>
        </li>
    	<li class="menu_box_in">
			<button class="btn_project_list"><span class="bar_color" style="background:#1e94ec;"></span>울릉에어</button>
            <button class="btn_project_list"><span class="bar_color" style="background:#015eac;"></span>용인시기흥노인복지관</button>
            <button class="btn_project_list"><span class="bar_color" style="background:#000;"></span>담필름</button>
            <button class="btn_project_list"><span class="bar_color" style="background:#00256c;"></span>엔클라우딩</button>
        </li>
    </ul>
	<style>
	.project_pm_box { display:inline-block; width:100%;}

	.pm_list_box { display:inline-block; width:100%; border:1px solid #ddd;}
	.pm_list_box span.list_title { display:inline-block; width:100%; padding:10px 15px; font-size:17px; font-weight:bold; background:#f5f6f7;}
	.pm_list_box span.list_content { display:inline-block; width:100%; padding:15px; border-bottom:1px solid #ddd;}
	.pm_list_box span.list_content:last-child {border-bottom:0px;}
	.pm_list_box span.list_content span.lc_title { display:inline-block; float:left; font-size:17px; font-weight:bold;}
	.pm_list_box span.list_content span.lc_period { display:inline-block; float:left; font-size:15px; padding-top:3px; padding-left:10px;}
	.pm_list_box span.list_content span.lc_period span.period_status { display:inline-block; padding-left:5px; color:#ff0000;}
	.pm_list_box span.list_content span.lc_team { display:inline-block; width:100%; padding:10px 0;}
	.pm_list_box span.list_content span.lc_team span.lct_person { display:inline-block; padding:3px; border:1px solid #ddd; border-radius:50px;}
	.pm_list_box span.list_content span.lc_team span.lct_person img.lct_img {width:20px; float:left; margin-right:5px;}
	.pm_list_box span.list_content span.lc_team span.lct_person span.lct_name { display:inline-block; float:left; line-height:20px; font-size:13px; padding:0 7px 0 0;}

	.pm_list_box span.list_content span.lc_work_list { display:inline-block; width:100%; }
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
	.pm_list_box span.list_content span.list_content_button a:last-child{ padding-right: 0;}

	.pm_list_box span.list_content span.lc_work_list span.lcw_memo { display:inline-block; width:100%; padding:3px 0 15px 20px;}
	.pm_list_box span.list_content span.lc_work_list span.lcw_memo input.lcw_frm1 { display:inline-block; width:calc(100% - 55px); height:30px; line-height:30px; float:left; padding:0 10px; border:1px solid #ccc;}
	.pm_list_box span.list_content span.lc_work_list span.lcw_memo button.btn_lcw_save {width:55px; height:30px; line-height:30px; float:left; font-size:13px; background:#fff; color:#000; border:1px solid #ccc; border-left:0px;}
	.pm_list_box span.list_content span.lc_work_list span.lcw_memo button.btn_lcw_save:hover { background:#f5f6f7;}

	</style>
	
    <ul class="content_box view_none">
        <li class="section_box">
        	<span class="section_title">프로젝트 현황</span>
        	
            <span class="project_pm_box">
            	
                <!-- Project List -->
                <span class="pm_list_box">
                	<span class="list_title">울릉에어</span>
                    
                    <!-- Main Work List Repeat -->
                    <span class="list_content">
                    	<span class="lc_title">고객관리 시스템 통합작업</span>
                        <span class="lc_period">2023.03.10~2023.05.30<span class="period_status">(30일남음)</span></span>
                        <!-- In Team -->
                        <span class="lc_team">
                        	<span class="lct_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            <span class="lct_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            <span class="lct_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                        </span>
                        <!--// In Team -->
                        <!-- Sub work list Repeat -->
                        <span class="lc_work_list">
                        	<span class="lcw_check"><input type="checkbox" class="check_frm" /></span>
                            <span class="lcw_work_list">디자인, 퍼블리싱<span class="wl_date">2023.03.10~2023.03.30</span></span>
                            <span class="lcw_work_person">
                            	<span class="w_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            	<span class="w_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            </span>
                            <span class="lcw_memo"><input type="text" class="lcw_frm1" /><button class="btn_lcw_save">저장</button></span>
                        </span>
                        <span class="lc_work_list">
                        	<span class="lcw_check"><input type="checkbox" class="check_frm" /></span>
                            <span class="lcw_work_list">디자인, 퍼블리싱<span class="wl_date">2023.03.10~2023.03.30</span></span>
                            <span class="lcw_work_person">
                            	<span class="w_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            </span>
                            <span class="lcw_memo"><input type="text" class="lcw_frm1" /><button class="btn_lcw_save">저장</button></span>
                        </span>
                        <span class="lc_work_list">
                        	<span class="lcw_check"><input type="checkbox" class="check_frm" /></span>
                            <span class="lcw_work_list">디자인, 퍼블리싱<span class="wl_date">2023.03.10~2023.03.30</span></span>
                            <span class="lcw_work_person">
                            	<span class="w_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            </span>
                            <span class="lcw_memo"><input type="text" class="lcw_frm1" /><button class="btn_lcw_save">저장</button></span>
                        </span>
                        <!--// Sub work list Repeat -->
                    </span>
                    <!--// Main Work List Repeat -->
                    
                    
                    <!-- Main Work List Repeat -->
                    <span class="list_content">
                    	<span class="lc_title">고객관리 시스템 통합작업</span>
                        <span class="lc_period">2023.03.10~2023.05.30<span class="period_status">(30일남음)</span></span>
                        <!-- In Team -->
                        <span class="lc_team">
                        	<span class="lct_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            <span class="lct_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            <span class="lct_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                        </span>
                        <!--// In Team -->
                        <!-- Sub work list Repeat -->
                        <span class="lc_work_list">
                        	<span class="lcw_check"><input type="checkbox" class="check_frm" /></span>
                            <span class="lcw_work_list">디자인, 퍼블리싱<span class="wl_date">2023.03.10~2023.03.30</span></span>
                            <span class="lcw_work_person">
                            	<span class="w_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            	<span class="w_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            </span>
                            <span class="lcw_memo"><input type="text" class="lcw_frm1" /><button class="btn_lcw_save">저장</button></span>
                        </span>
                        <span class="lc_work_list">
                        	<span class="lcw_check"><input type="checkbox" class="check_frm" /></span>
                            <span class="lcw_work_list">디자인, 퍼블리싱<span class="wl_date">2023.03.10~2023.03.30</span></span>
                            <span class="lcw_work_person">
                            	<span class="w_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            </span>
                            <span class="lcw_memo"><input type="text" class="lcw_frm1" /><button class="btn_lcw_save">저장</button></span>
                        </span>
                        <span class="lc_work_list">
                        	<span class="lcw_check"><input type="checkbox" class="check_frm" /></span>
                            <span class="lcw_work_list">디자인, 퍼블리싱<span class="wl_date">2023.03.10~2023.03.30</span></span>
                            <span class="lcw_work_person">
                            	<span class="w_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            </span>
                            <span class="lcw_memo"><input type="text" class="lcw_frm1" /><button class="btn_lcw_save">저장</button></span>
                        </span>
                        <!--// Sub work list Repeat -->
                    </span>
                    <!--// Main Work List Repeat -->
                    
                    
                </span>
                <!--// Project List -->
                
            </span>
        </li>
    </ul>

    <ul class="content_box">
        <li class="section_box">
        	<span class="section_title">프로젝트 현황</span>
            <span class="project_pm_box">
            	
                <!-- Project List -->
                <span class="pm_list_box">
                	<span class="list_title">울릉에어
						<span id="inline-popups2" onClick="" class="project_modified"><a href="#test-popup2" data-effect="mfp-zoom-in"><img src="./img/setting.svg" alt="수정 icon"></a></span>
						<span id="inline-popups3" onClick="" title="작업 추가" class="list_content_add"><a href="#test-popup3" data-effect="mfp-zoom-in">작업 추가</a></span>
					</span>
                    
                    <!-- Main Work List Repeat -->
                    <span class="list_content">
                    	<span class="lc_title">고객관리 시스템 통합작업</span>
                        <span class="lc_period">2023.03.10~2023.05.30<span class="period_status">(30일남음)</span></span>
						<span class="list_content_button"><span id="inline-popups3" onClick=""><a href="#test-popup3" data-effect="mfp-zoom-in">수정</a></span><a href="#">삭제</a><a href="#">추가</a></span>
                        <!-- In Team -->
                        <span class="lc_team">
                        	<span class="lct_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            <span class="lct_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            <span class="lct_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                        </span>
                        <!--// In Team -->
                        <!-- Sub work list Repeat -->
                        <span class="lc_work_list">
                        	<span class="lcw_check"><input type="checkbox" class="check_frm" /></span>
                            <span class="lcw_work_list">디자인, 퍼블리싱<span class="wl_date">2023.03.10~2023.03.30</span></span>
                            <span class="lcw_work_person">
                            	<span class="w_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            	<span class="w_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            </span>
							<span class="work_list_button"><a href="#">수정</a><a href="#">삭제</a></span>
                            <span class="lcw_memo"><input type="text" class="lcw_frm1" /><button class="btn_lcw_save">저장</button></span>
                        </span>
                        <span class="lc_work_list">
                        	<span class="lcw_check"><input type="checkbox" class="check_frm" /></span>
                            <span class="lcw_work_list">디자인, 퍼블리싱<span class="wl_date">2023.03.10~2023.03.30</span></span>
                            <span class="lcw_work_person">
                            	<span class="w_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            </span>
							<span class="work_list_button"><a href="#">수정</a><a href="#">삭제</a></span>
                            <span class="lcw_memo"><input type="text" class="lcw_frm1" /><button class="btn_lcw_save">저장</button></span>
                        </span>
                        <span class="lc_work_list">
                        	<span class="lcw_check"><input type="checkbox" class="check_frm" /></span>
                            <span class="lcw_work_list">디자인, 퍼블리싱<span class="wl_date">2023.03.10~2023.03.30</span></span>
                            <span class="lcw_work_person">
                            	<span class="w_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            </span>
							<span class="work_list_button"><a href="#">수정</a><a href="#">삭제</a></span>
                            <span class="lcw_memo"><input type="text" class="lcw_frm1" /><button class="btn_lcw_save">저장</button></span>
                        </span>
                        <!--// Sub work list Repeat -->
						
						<!--Sub work list Repeat 추가-->
						<span class="lc_work_list_add">
							<b>작업 항목 추가</b>
							<span class="lc_work_list_add_text"><input type="text"></span>
							<span class="lc_work_list_add_date">
								<input type="date">
								<input type="date">
							</span>
							<span class="lc_work_list_add_button">
								<button>홍길동</button>
								<button>홍길동</button>
								<button>홍길동</button>
								<a href="#">저장</a>
							</span>
						</span>
						<!--Sub work list Repeat 추가-->
						
                    </span>
                    <!--// Main Work List Repeat -->
                    
                    <!-- Main Work List Repeat -->
                    <span class="list_content">
                    	<span class="lc_title">고객관리 시스템 통합작업</span>
                        <span class="lc_period">2023.03.10~2023.05.30<span class="period_status">(30일남음)</span></span>
						<span class="list_content_button"><span id="inline-popups3" onClick=""><a href="#test-popup3" data-effect="mfp-zoom-in">수정</a></span><a href="#">삭제</a><a href="#">추가</a></span>
                        <!-- In Team -->
                        <span class="lc_team">
                        	<span class="lct_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            <span class="lct_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            <span class="lct_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                        </span>
                        <!--// In Team -->
                        <!-- Sub work list Repeat -->
                        <span class="lc_work_list">
                        	<span class="lcw_check"><input type="checkbox" class="check_frm" /></span>
                            <span class="lcw_work_list">디자인, 퍼블리싱<span class="wl_date">2023.03.10~2023.03.30</span></span>
                            <span class="lcw_work_person">
                            	<span class="w_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            	<span class="w_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            </span>
							<span class="work_list_button"><a href="#">수정</a><a href="#">삭제</a></span>
                            <span class="lcw_memo"><input type="text" class="lcw_frm1" /><button class="btn_lcw_save">저장</button></span>
                        </span>
                        <span class="lc_work_list">
                        	<span class="lcw_check"><input type="checkbox" class="check_frm" /></span>
                            <span class="lcw_work_list">디자인, 퍼블리싱<span class="wl_date">2023.03.10~2023.03.30</span></span>
                            <span class="lcw_work_person">
                            	<span class="w_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            </span>
							<span class="work_list_button"><a href="#">수정</a><a href="#">삭제</a></span>
                            <span class="lcw_memo"><input type="text" class="lcw_frm1" /><button class="btn_lcw_save">저장</button></span>
                        </span>
                        <span class="lc_work_list">
                        	<span class="lcw_check"><input type="checkbox" class="check_frm" /></span>
                            <span class="lcw_work_list">디자인, 퍼블리싱<span class="wl_date">2023.03.10~2023.03.30</span></span>
                            <span class="lcw_work_person">
                            	<span class="w_person"><img src="./img/no_user.svg" class="lct_img" /><span class="lct_name">홍길동</span></span>
                            </span>
							<span class="work_list_button"><a href="#">수정</a><a href="#">삭제</a></span>
                            <span class="lcw_memo"><input type="text" class="lcw_frm1" /><button class="btn_lcw_save">저장</button></span>
                        </span>
                        <!--// Sub work list Repeat -->
						
                    </span>
                    <!--// Main Work List Repeat -->
                    
                </span>
                <!--// Project List -->
                
            </span>
        </li>
    </ul>
	
    <ul class="schedule_box view_none memo_hide_button">
		<!--메모-->
    	<li class="sb_project">
        	<span class="section_title">메모<span class="list_content_add"><a href="#">저장</a></span></span>
            <span class="section_schedule">
				<span class="project_info_box">
					<span class="project_info"><b>담당자 : </b>홍길동</span>
					<span class="project_info"><b>연락처 : </b>010-1234-1234</span>
					<span class="project_info2"><b>이메일주소 : </b>sample@sample.com</span>
					<span class="project_info"><b>대표자 : </b>홍길동</span>
					<span class="project_info"><b>연락처 : </b>010-1234-1234</span>
					<span class="project_info2"><b>이메일주소 : </b>sample@sample.com</span>
				</span>
				<textarea></textarea>
            </span>
        </li>
		<!--메모-->
		
		<!--memo button-->
		<li class="memo_button">
			<span class="memo_hide"><img src="./img/memo_close.svg" alt="메모 close"></span>
		</li>
		<!--memo button-->
		
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
        
        <!-- Event List -->
    	<li class="sb_project">
        	<span class="section_title">휴가/행사 일정</span>
            <span class="section_schedule">
                <!-- Calendar Area -->
                <link rel="stylesheet" href="./css/calendar.css">
                <div class="calendar"></div>
                <script src="./js/calendar.js" type="text/javascript"></script>
                <!--// Calendar Area -->
            </span>
        </li>
        <!--// Event List -->
		
		<!--memo button-->
		<li class="memo_button">
			<span class="memo_show"><img src="./img/memo_icon.svg" alt="메모 icon"></span>
		</li>
		<!--memo button-->
		
    </ul>
</span>


<script>
	
	$(".memo_show_button .memo_button .memo_show").click(function(){
		$(".memo_show_button").addClass("view_none");
		$(".memo_hide_button").removeClass("view_none");
	});
	
	$(".memo_hide_button .memo_button .memo_hide").click(function(){
		$(".memo_hide_button").addClass("view_none");
		$(".memo_show_button").removeClass("view_none");
	});
	
</script>

<?php 
include_once('./tail.php');
?>