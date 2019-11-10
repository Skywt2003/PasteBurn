<?php

/*
 * 首页
 */

include 'functions.php';
include 'header.php';

?>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<script>
$(document).ready(function(){
    if ("<?php echo $_GET['id'] ?>" != ""){
        $.get("./api/get.php?id=<?php echo $_GET['id'] ?>",function(data,status){
            var ret = JSON.parse(data);
            if (ret.success == false){
                $("#showText").text(ret.info);
            } else {
                $("#showText").text(ret.text);
                $("#showUser").addClass("text-info");
                if (<?php echo $login_enable ?> == 1 && ret.user != ""){
                    if (ret.time != 'NULL') $("#showUser").text("Shared by " + ret.user + " at " + ret.time);
                    else $("#showUser").text("Shared by " + ret.user);
                } else {
                    if (ret.time != null) $("#showUser").text("Shared at " + ret.time);
                }
            }
        });
    }
    
    // 一个坑点：jQuery 中 checkbox 如果用 val() 方法总是返回 on，正确的使用姿势：prop('checked') 返回 true/false
    $("#submit").click(function(){
        $.post("./api/push.php",
        {
            <?php if ($login_enable == false || isset($_COOKIE['pb_token']) == false) { ?>
                text: $("#burntext").val(),
                savetime: $("#rcdTime").prop('checked')
            <?php } else {?>
                text: $("#burntext").val(),
                savetime: $("#rcdTime").prop('checked'),
                token: '<?php echo $_COOKIE["pb_token"]?>'
            <?php } ?>
        },
        function(data,status){
            var ret = JSON.parse(data);
            if (ret.success == false){
                $("#hint").addClass("alert alert-danger");
                $("#hint").text("ERROR: " + ret.info);
            } else {
                $("#hint").addClass("alert alert-info");
                $("#hint").text("Please share this URL: <?php echo $siteurl ?>?id=" + ret.info);
            }
        });
    });
});
</script>

<div class="container maincontent">
    <?php if ($_GET["id"] != ""){ ?>
        <div id="showText"></div> <br><br>
        <div id="showUser"></div><?php
    } else { ?>
        <h3>阅后即焚</h3>
        <p>在下面的文本框中输入文字，将生成的网址分享给朋友，网址在被打开一次后就会被删除！</p>
        <form id="main">
            <textarea id="burntext" rows="10" maxlength="65535" class="form-control" placeholder="Worth a thousand words."></textarea><br>
            <div class="custom-control custom-checkbox" >
                <input type="checkbox" class="custom-control-input" id="rcdTime" name="rcdTime">
                <label class="custom-control-label" for="rcdTime" data-toggle="tooltip" data-placement="right" title="如果不勾选，数据库中不会保留这段文字的分享时间。">记录并显示分享时间</label>
            </div> <br>
            <button id="submit" type="button" class="btn btn-primary">Submit</button>
        </form>
        <br>
        <div id="hint"></div>
    <?php } ?>
</div>

<?php include 'footer.php' ?>
