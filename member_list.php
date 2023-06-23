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

.wrap_box ul.content_box { display:inline-block; width:calc(100% - 250px); float:left; text-align:left;}
.wrap_box ul.content_box li.section_box { display:inline-block; width:100%; padding:15px;}
.wrap_box ul.content_box li.section_box span.section_title { display:inline-block; width:100%; font-size:19px; font-weight:bold; padding-bottom:15px;}
	
.project_pm_box { display:inline-block; width:100%;}
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
	<!--사용자도 볼 수 있는 화면 (단! 휴가/행사 달력은 관리자만)-->
    <ul class="content_box">
        <li class="section_box">
        	<span class="section_title">관리자</span>
			
            <span class="project_pm_box">
				
                <span class="member_list_wrap">
                	<span class="mp_img"><img src="./img/no_user.svg" class="my_profile_img"></span>
					<span class="member_list_info">
						<span><p>[정상] 임직원</p><p>/</p><p>홍길동</p><p>대표(디자이너)</p></span>
						<span><p>010-0000-0000</p><p>/</p><p>sample@sample.com</p><p>/</p><p>witiveid</p></span>
					</span>
					<span id="inline-popups4" onClick="" title="수정" class="member_list_button"><a href="#test-popup4" data-effect="mfp-zoom-in">수정</a></span>
				</span>
				
                <span class="member_list_wrap">
                	<span class="mp_img"><img src="./img/no_user.svg" class="my_profile_img"></span>
					<span class="member_list_info">
						<span><p>[정상] 임직원</p><p>/</p><p>홍길동</p><p>대표(디자이너)</p></span>
						<span><p>010-0000-0000</p><p>/</p><p>sample@sample.com</p><p>/</p><p>witiveid</p></span>
					</span>
					<span id="inline-popups4" onClick="" title="수정" class="member_list_button"><a href="#test-popup4" data-effect="mfp-zoom-in">수정</a></span>
				</span>
				
                <span class="member_list_wrap">
                	<span class="mp_img"><img src="./img/no_user.svg" class="my_profile_img"></span>
					<span class="member_list_info">
						<span><p>[정상] 임직원</p><p>/</p><p>홍길동</p><p>대표(디자이너)</p></span>
						<span><p>010-0000-0000</p><p>/</p><p>sample@sample.com</p><p>/</p><p>witiveid</p></span>
					</span>
					<span id="inline-popups4" onClick="" title="수정" class="member_list_button"><a href="#test-popup4" data-effect="mfp-zoom-in">수정</a></span>
				</span>
				
            </span>
        </li>
    </ul>
</div>


<?php 
include_once('./tail.php');
?>