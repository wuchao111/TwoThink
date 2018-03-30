<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\www\TwoThink\public/../application/home/view/default/index\notice.html";i:1521859684;}*/ ?>
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
    <!--导航结束-->
    <?php foreach ($notices as $notice):?>
    <div class="container-fluid">
        <div class="row noticeList">
            <a href="<?php echo url('details'); ?>?id=<?=$notice['id']?>">
                <div class="col-xs-2">
                    <img class="noticeImg" src="<?=$notice['pic']?>" />
                </div>
                <div class="col-xs-10">
                    <p class="title"><?=$notice['intro']?></p>
                    <p class="intro"><?=$notice['title']?></p>
                    <p class="info">点击量:<?=$notice['clicks']?><span class="pull-right"><?=date('Y-m-d H:i:s',$notice['time'])?></span> </p>
                </div>

            </a>
        </div>
    </div>
    <?php endforeach;?>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/static/home/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/static/home/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>