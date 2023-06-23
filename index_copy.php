<?php 

include_once('./head.php');
include_once('./head_sub.php');

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



<?php /*
<span class="content_box">

	<span style="float:left; font-size:12px; border:1px solid #333; border-radius:5px; padding:5px 10px; margin-bottom:10px; margin-right:10px;">TOTAL : <span id="rcnt">0</span> 건</span>
    <span style="float:left; font-size:12px; border:1px solid #333; border-radius:5px; padding:5px 10px; margin-bottom:10px; margin-right:10px;">총인원 : <span id="rcnt2">0</span> 명</span>
    <span style="float:left; font-size:12px; border:1px solid #333; border-radius:5px; padding:5px 10px; margin-bottom:10px; margin-right:10px;">견적 : <span id="rcnt3">0</span> 원</span>
    <span style="float:left; font-size:12px; border:1px solid #333; border-radius:5px; padding:5px 10px; margin-bottom:10px;">결제 : <span id="rcnt4">0</span> 원</span>

    <table class="consulting_table2" cellpadding="0" cellspacing="0;">
        <thead>
            <tr>
                <td>NO.</td>
                <td>그룹</td>
                <td>등록일</td>
                <td>현황</td>
                <td>이름</td>
                <td>성별</td>
                <td>연락처</td>
                <td colspan="3">일정</td>
                <td colspan="6">인원</td>
                <td colspan="5">숙소</td>
                <td colspan="3">식사</td>
                <td colspan="5">행사</td>
                <td>셔틀</td>
                <td>금액</td>
                <td></td>
            </tr>
            <tr class="empty"><td colspan="31"></td></tr>
        </thead>
        <tbody id="target_box">
    <!--===========================================================================================================================================================================================-->
    
    <!--===========================================================================================================================================================================================-->
        </tbody>
    </table>
    
    <span class="more_btn_wrap" id="moretag" style="display:none">
        <span class="more_btn" onclick="more_proc();">
            <span>더보기</span>
            <span><img src="./img/down_arrow.svg" alt="아이콘"></span>
        </span>
    </span>
    
    <div style="text-align:center;font-size:14px;margin-top:100px;margin-bottom:100px;display:none" id="nolist">검색된 자료가 없습니다.</div>
    <div style="text-align:center;font-size:14px;margin-top:100px;margin-bottom:100px;display:none" id="nomore">마지막 자료입니다.</div>
    
    <style>
        .more_btn_wrap{width: 100%; display: inline-block; float: left; text-align: center; margin-bottom: 30px;}
        .more_btn{display: inline-block; width: 100px; cursor: pointer;}
        .more_btn span{width: 100%; display: inline-block; float: left; font-size: 1.2em; font-weight: bold; text-align: center;}
        .more_btn span img{height: 15px; display: inline-block; margin-top: 0px;}
        .setcheck{check}
    </style>

</span>

<?php include_once('./tail.php'); ?>

<script>
var start_page = 0; 

function search_proc() {
	$('#moretag').hide();
	$('#nolist').hide();
	$('#nomore').hide();
    $('#start_page').val(start_page); 
    var fdata = new FormData($('#tgform')[0]); 
    for (let key of fdata.keys()) { console.log(key); }
for (let value of fdata.values()) { console.log(value); }
    
    $.ajax(
    {
        type: "POST",
        enctype: 'multipart/form-data',
        url: "./index_serv.php",
        processData: false, // important
        contentType: false, // important
        data: fdata,
        cache: false,
        timeout: 3000,
        success: function(edata) { //console.log(edata);
            let tmp1 = $.trim(edata);
            let dt = tmp1.split('@@');
            $('#target_box').append(dt[1]);
            let dtt = dt[0].split('##');
            let rcnt = dtt[0]; rcnt *= 1;
            let rcnt2 = dtt[1]; rcnt2 *= 1;
            let rcnt3 = dtt[2]; rcnt3 *= 1;
            let rcnt4 = dtt[3]; rcnt4 *= 1;
            $('#rcnt').text(rcnt.toLocaleString());
            $('#rcnt2').text(rcnt2.toLocaleString());
            $('#rcnt3').text(rcnt3.toLocaleString());
            $('#rcnt4').text(rcnt4.toLocaleString());
            start_page++;
            if (document.getElementById('hreturn1')) $('#nolist').show(); 
            else if (document.getElementById('hreturn2')) $('#nomore').show(); 
            else $('#moretag').show();
        },
        beforeSend:function(){ //loading.gif 처리 
            //$('#loader').show();
        },
        complete:function(){
            //$('#loader').hide();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            //console.log("arjax error : " + jqXHR + "\n" + textStatus + "\n" + errorThrown);
        }
    });	
}
setTimeout(function(){$("#sch_btn").trigger("click");},300);
//search_proc();
//===========================================================================
function write_proc() {
    location.href="./info.php?tgno=n";
}

var chk0 = '';
var chk7 = '';
function new_search_proc(st='') {
    if (st === '0') { 
        if (!chk0) { $('.check').removeAttr('checked'); $('#chk0').prop('checked', true); chk0 = '1'; chk7 = '';} 
        else { chk0 = '';}
        chkval = '';
    } else if (st === '7') { 
        if (!chk7) { $('.check').removeAttr('checked'); $('#chk7').prop('checked', true); chk7 = '1'; chk0 = '';} 
        else { chk7 = '';}
        chkval = '';
    } else {
        $('#chk0').prop('checked', false);
        $('#chk7').prop('checked', false);
        chk0 = '';
        chk7 = '';
    }
    var chkval = '';
    if ($('#chk1').is(":checked")) { if (chkval) chkval += ','; chkval += '1'; }
    if ($('#chk2').is(":checked")) { if (chkval) chkval += ','; chkval += '2'; }
    if ($('#chk3').is(":checked")) { if (chkval) chkval += ','; chkval += '3'; }
    if ($('#chk5').is(":checked")) { if (chkval) chkval += ','; chkval += '5'; }
    if ($('#chk4').is(":checked")) { if (chkval) chkval += ','; chkval += '4'; }
    if ($('#chk9').is(":checked")) { if (chkval) chkval += ','; chkval += '9'; }
    if ($('#chk8').is(":checked")) { if (chkval) chkval += ','; chkval += '8'; }
    if ($('#chk7').is(":checked")) { if (chkval) chkval += ','; chkval += '7'; }
    
    $('#tg_status').val(chkval); 
    start_page = 0;
    $('#target_box').html('');
    search_proc();
}

function more_proc() {
    search_proc();
}

function detail_proc(tgno) {
    location.href="./info.php?tgno="+tgno;
}
</script>

*/ ?>


<?php 
include_once('./tail.php');
?>