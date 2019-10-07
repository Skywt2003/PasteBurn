<?php
include 'functions.php';
include 'header.php';

?>

<script>

$(document).ready(function(){
    if ("<?php echo $_GET['id'] ?>" != ""){
        $.get("show.php?id=<?php echo $_GET['id'] ?>",function(data,status){
            var ret = JSON.parse(data);
            if (ret.success == false){
                $("#showText").text("404");
            } else {
                $("#showText").text(ret.text);
                if (<?php echo $login_enable ?> == 1 && ret.user != ""){
                    $("#showUser").text("来自 " + ret.user + "的分享");
                }
            }
        });
    }
    
    $("#submit").click(function(){
        $.post("add.php",
        {
            <?php if ($login_enable == false || isset($_COOKIE['user']) == false) { ?>
                text: $("#burntext").val()
            <?php } else {?>
                text: $("#burntext").val(),
                user: '<?php echo $_COOKIE["user"]?>',
                pswd: '<?php echo $_COOKIE["pswd"]?>'
            <?php } ?>
        },
        function(data,status){
            var ret = JSON.parse(data);
            if (ret.success == false){
                $("#hint").addClass("alert alert-danger");
                $("#hint").text("错误：" + ret.info);
            } else {
                $("#hint").addClass("alert alert-info");
                $("#hint").text("请分享此网址：<?php echo $siteurl ?>?id=" + ret.info);
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
            <button id="submit" type="button" class="btn btn-primary">Submit</button>
        </form>
        <br>
        <div id="hint"></div>
    <?php } ?>
</div>

<?php include 'footer.php' ?>
