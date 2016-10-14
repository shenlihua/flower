<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.5">


    <link rel="stylesheet" href="/project/Public/Wechat/jquery.mobile-1.4.5.min.css">
    <script src="/project/Public/js/api/jquery.min.js"></script>
    <script src="/project/Public/Wechat/jquery.mobile-1.4.5.min.js"></script>
    <link rel="stylesheet" href="/project/Public/Swiper/css/swiper.min.css">
</head>
<body>

<div data-role="page">
    <div data-role="header">
        <!--<a href="#" data-role="button" data-icon="arrow-l">返回</a>-->
        <h1>欢迎访问我的主页</h1>
        <!--<a href="#" data-role="button" data-icon="search">搜索</a>-->
    </div>
<style>
    .swiper-container{ text-align: center; height: 180px;}
    .ui-content {padding:0em;}
    .ui-content .ui-listview-inset{margin:0em;}
    .auto-theme{height: 250px;text-align: center; margin-top: 0.15em;}
    .auto-theme .auto-theme-left{height: 250px; padding-top: 125px;background: #ccc;}
    .auto-theme .auto-theme-right{height: 125px;border-top: 1px solid #cecece;padding-top: 62.5px;background: #cfcfcf;}
</style>

<div data-role="content">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="/project/Public/images/p1.jpg"/></div>
            <div class="swiper-slide"><img src="/project/Public/images/p2.jpg"/></div>
            <div class="swiper-slide"><img src="/project/Public/images/p3.jpg"/></div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="ui-grid-a auto-theme">
        <div class="ui-block-a auto-theme-left">最新动态</div>
        <div class="ui-block-b auto-theme-right">发表动态</div>
        <div class="ui-block-b auto-theme-right" style="float:right">图片欣赏</div>
    </div>
    <div data-role="main">
        <ul data-role="listview"  data-inset="true">
            <li><a href="#">最新发表的动态</a></li>
            <li data-icon="plus"><a href="#">data-icon="plus"</a></li>
            <li data-icon="plus"><a href="#">data-icon="plus"</a></li>
        </ul>
    </div>
</div>



<div data-role="footer" data-position="fixed">
    <div data-role="navbar">
        <ul>
            <li><a href="#" data-icon="home">首页</a></li>
            <li><a href="#" data-icon="navigation">动态</a></li>
            <li><a href="#" data-icon="user">个人信息</a></li>
        </ul>
    </div>
</div>
</div>

</body>
</html>
<script src="/project/Public/Swiper/js/swiper.min.js"></script>

<script>
    $(document).ready(function () {
        var mySwiper = new Swiper('.swiper-container', {
//            direction: 'vertical',
//            height: 100,//你的slide高度
            autoplay: 5000,//可选选项，自动滑动
            loop : true,//环路
            //分页器
            pagination : '.swiper-pagination',
            paginationClickable :true,


        });
        mySwiper.container[0].style.align='center';
    });
</script>