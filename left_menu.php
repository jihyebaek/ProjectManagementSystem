<ul class="menu_box">
    <li class="menu_title">
        프로젝트<span id="inline-popups2" onClick="addP()" title="+" class="btn_project_add"><a href="#pjt_popup" data-effect="mfp-zoom-in">+</a></span>
    </li>

    <?php if(!empty($pInfos)) { ?>
    <li class="menu_box_in">
        <?php for($i=0;$i<count($pInfos);$i++) { ?>
        <button class="btn_project_list" onclick="getProjectInfo(this)" data-pjtno="<?=$pInfos[$i]['pjt_no']?>" data-pjtname="<?=$pInfos[$i]['pjt_name']?>"><span class="bar_color" style="background:#1e94ec;"></span><?=$pInfos[$i]['pjt_name']?></button>
        <?php } ?>
    </li>
    <?php } ?>
</ul>

<script>
    function getProjectInfo(ths) {// 프로젝트 클릭시 이름 넘기기
        var pjtNo = ths.dataset.pjtno;
        var pjtName = ths.dataset.pjtname;
        window.location.href="/pm/index.php?pNo="+pjtNo+"&pName="+pjtName;
    }
</script>