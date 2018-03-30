<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\www\TwoThink\public/../application/home/view/default/index\activity.html";i:1522222341;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/static/home/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/home/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .main{margin-bottom: 60px;}
        .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
    </style>
</head>
<body>
<div class="main">
    <!--导航部分-->
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid text-center">
            <div class="col-xs-3">
                <p class="navbar-text"><a href="index.html" class="navbar-link">首页</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">服务</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">发现</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">我的</a></p>
            </div>
        </div>
    </nav>
    <div id="content" >
    <!--导航结束-->
    <?php foreach ($activitys as $activity):?>
    <div class="container-fluid">
        <div class="row noticeList">
            <a href="">
                <div class="col-xs-2">
                    <img class="noticeImg" src="<?=$activity['pic']?>" />
                </div>
                <div class="col-xs-10" date-id="<?=$activity['id']?>">
                    <p class="title"><?=$activity['title']?></p>
                    <p class="intro"><?=$activity['content']?></p>
                    <p class="info"><span class="pull-right"><?=$activity['start_time']?></span> </p><br>
                    <p class="info"><span class="pull-right"><?=$activity['end_time']?></span> </p><br><br><br>
                    <a href="javascript:baoming(this);" class=""><span class="btns btn-warning pull-right btn">报名</span></a>
                </div>

            </a>
        </div>
    </div>
    <?php endforeach;?>
    </div>
    <a href="javascript:;" class="page pull-right btn btn-warning" page="1">查看更多</a>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/static/home/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/static/home/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">

    function baoming(obj) {
        var div = $(obj).closest("div");
        var id = div.attr("date-id");
        var data={
            'id':id
        };
        $.get("/home/index/sign",data,function (v) {
            console.log(v)
            if(v == 2){
                alert('未登录,清先登录');
                window.location.href="/user/login/index"
            }else if(v == 0){
                alert('已经报名了')
            }else if(v == 1){
                alert('报名成功')
            }

        });
    }
</script>
<script type="text/javascript">
    $(".page").click(function () {
            var page=$('.page').attr('page');
                page=page-0+1;
        $.get('/home/index/activity',{page:page},function (data) {

            var obj = jQuery.parseJSON(data);

            $(obj).each(function (i,v) {
                var html='';
                html= '<div class="row noticeList"><a href=""><div class="col-xs-2"><img class="noticeImg" src="'+v.pic+'" /></div><div class="col-xs-10" date-id="'+v.id+'"><p class="title">'+v.title+'</p><p class="intro">'+v.content+'</p> <p class="info"><span class="pull-right">'+v.start_time+'</span></p><br><p class="info"><span class="pull-right">'+v.end_time+'</span></p><br><br><br><a href="javascript:baoming(this);" class=""><span class="btns btn-warning pull-right btn" >报名</span></a></div></a></div>';
                $('#content').append(html);
                $('.page').attr('page',page);
            });

        },'json');
        return false;

    })
</script>
</body>
</html>