<?php
/*
 * Template Name: 聚合短视频去水印
 * Description  : 一个用于去除短视频水印的工具页面。
 * Copyright    : 星云
 * URL          : www.pxxox.com/129.html
 * Github       : https://github.com/XingYun886
 */
get_header();
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f7f7f7;
    }

    .container {
        margin: 20px auto;
        padding: 20px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    @media screen and (min-width: 1024px) {
        .container {
            max-width: 400px;
        }
    }

    @media screen and (max-width: 768px) {
        .container {
            max-width: 90%;
        }
    }

    .pxxox_header {
        background-color: #2C68FD;
        color: white;
        text-align: center;
        padding: 30px;
        border-radius: 10px;
        position: relative;
    }

    .pxxox_header .detail-button {
        background-color: #66B2FF;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
        display: inline-block;
    }

    .notification {
        background-color: #FFF2E5;
        color: #ffa500;
        padding: 10px;
        margin-top: 20px;
        border-radius: 5px;
        display: flex;
        align-items: center;
    }

    .support {
        margin-top: 20px;
        font-size: 14px;
        color: #666;
    }

    .qa-link {
        color: #ffa500;
        float: right;
    }

    .textarea-container {
        margin-top: 20px;
    }

    textarea {
        width: 100%;
        height: 80px;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
        margin-top: 10px;
        resize: none;
    }

    .buttons {
        display: flex;
        margin-top: 20px;
    }

    .buttons button {
        flex: 1;
        padding: 10px;
        margin: 5px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }

    .paste-btn {
        background-color: #f0f0f0;
        color: #333;
    }

    .remove-watermark-btn {
        background-color: #FF5722;
        color: white;
    }

    #result {
        margin-top: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #result p {
        word-wrap: break-word;
        white-space: normal;
    }
</style>

<main class="container">
    <div class="pxxox_header">
        <h1>短视频去水印</h1>
        <button class="detail-button" onclick="window.open('http://qsy.pxxox.cn/user.html', '_blank')">查看详细教程</button>
    </div>
    <div class="notification">
        <span>🔊 本工具通过调用接口实现去水印功能，请确保输入合法链接哦。</span>
    </div>
    <div class="support">
        支持平台：某音、某手、某书、某瓜等100多个平台
        <a href="http://qsy.pxxox.cn/user.html" class="qa-link">常见问题</a>
    </div>
    <div class="textarea-container">
        <textarea placeholder="请复制平台上的短视频链接到此文本框" id="videoLink"></textarea>
    </div>
    <div class="buttons">
        <button class="paste-btn" onclick="downloadVideo()">下载视频</button>
        <button class="remove-watermark-btn" onclick="removeWatermark()">免费去水印</button>
    </div>
    <div id="result"></div>
</main>

<script>
    function downloadVideo() {
        var link = document.getElementById('videoLink').value;
        
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/wp-content/themes/zibll/pages/dump.php?action=download&url=' + link, true);
        xhr.responseType = 'blob';
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var blob = new Blob([xhr.response], {type: 'video/mp4'});
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = '去水印视频.mp4';
                a.click();
                window.URL.revokeObjectURL(url);
            }
        };
        xhr.send();
    }

    function removeWatermark() {
        var link = document.getElementById('videoLink').value;
        
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/wp-content/themes/zibll/pages/dump.php?action=remove_watermark&url=' + link, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('result').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
</script>

<?php get_footer();
?>
