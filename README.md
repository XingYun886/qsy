# 聚合短视频去水印

项目预览

WordPress：https://www.pxxox.com/qsy

Web URL  ：http://qsy.pxxox.cn

一、项目简介

本项目是一个基于 WordPress 的短视频去水印工具，旨在帮助用户轻松去除常见短视频平台（如某音、某手、某书、某瓜等 100 多个平台）上视频的水印，方便用户获取无水印的视频资源用于个人学习、研究等合法用途。

二、功能特性

1. 多平台支持：能够处理来自众多热门短视频平台的视频链接，覆盖范围广泛，满足不同用户的需求。

2. 便捷操作：用户只需将短视频链接复制到文本框中，点击相应按钮（“免费去水印”或“下载视频”）即可执行去水印和下载操作，操作简单直观。

3. 实时反馈：去水印操作完成后，会在页面的特定区域（#result 元素）显示处理结果，告知用户去水印是否成功以及相关信息。

三、代码结构

1. PHP 部分

• 模板文件（聚合短视频去水印.php）：定义了页面的整体结构和样式引入，包括页头（get_header()）和页脚（get_footer()）的加载，以及页面主体内容的 HTML 布局，如文本框、按钮等元素的设置，同时还包含了与 JavaScript 交互的部分，通过按钮的点击事件触发相应的 JavaScript 函数来执行去水印和下载操作。

• 处理脚本（dump.php）：负责实际的去水印和下载功能的实现。根据传入的 action 参数（download 或 remove_watermark）以及视频链接（url），调用后端的接口或执行相应的算法来完成视频的处理，并返回结果给前端页面。

2. JavaScript 部分

• 定义了两个主要函数 downloadVideo() 和 removeWatermark()，分别用于处理视频下载和去水印的请求。在函数内部，通过 XMLHttpRequest 对象与后端的 qsy1.php 脚本进行通信，发送视频链接并接收处理结果，然后根据结果进行相应的页面操作，如创建下载链接或显示去水印结

# 在web网页中实现短视频去水印网页

代码修改：

	<!DOCTYPE html><!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>聚合短视频去水印</title>
    <style>
    /* 原始css样式 */
    </style>
    </head>
<body>
    <div class="container">
        <div class="header">
            <h1>聚合短视频去水印</h1>
            <button class="detail-button" onclick="window.open('http://qsy.pxxox.cn/user.html', '_blank')">查看详细教程</button>
        </div>
        <div class="notification">
            <span>🔊 本工具通过调用接口实现去水印功能，请确保输入合法链接哦。</span>
        </div>
        <div class="support">
            支持平台：某音、某手、某书、某瓜等100多个平台
            <a href="#" class="qa-link">常见问题</a>
        </div>
        <div class="textarea-container">
            <textarea placeholder="请复制平台上的短视频链接到此文本框" id="videoLink"></textarea>
        </div>
        <div class="buttons">
            <button class="paste-btn" onclick="downloadVideo()">下载视频</button>
            <button class="remove-watermark-btn" onclick="removeWatermark()">免费去水印</button>
        </div>
        <div id="result"></div>
    </div>
    <script>
        function downloadVideo() {
            var link = document.getElementById('videoLink').value;
            
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'dump.php?action=download&url=' + link, true);
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
            xhr.open('GET', 'dump.php?action=remove_watermark&url=' + link, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('result').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>
</body>

</html>

 将get_header(); // 加载 WordPress 的页头 <?php get_footer(); // 加载 WordPress 的页脚 ?> 代码删除

按照教程顺序即可在web网页中实现而不是在 WordPress 中实现短视频去水印页面

# 在 WordPress 中实现短视频去水印页面

WordPress 新建页面并使用短视频去水印模板教程

前期准备

确保已在服务器上安装好 WordPress，且拥有管理员权限登录 WordPress 后台。同时，已将包含短视频去水印模板（假设模板文件名为 index.php 且已放置在当前使用主题的目录下）及相关功能文件（如处理去水印逻辑的 index.php 等）的主题上传至 WordPress 主题目录，并在后台启用该主题。


新建页面步骤

1. 登录后台：打开浏览器，输入 WordPress 网站的后台管理地址（通常为 www.pxxox.com/wp-admin），使用管理员账号和密码登录。

2. 创建新页面：在 WordPress 后台管理界面，找到“页面”菜单选项，点击“新建页面”。

3. 编辑页面内容（可选）：在页面编辑区域，可以输入一些关于短视频去水印工具的介绍性文字，如使用说明、注意事项等，让用户更好地了解该工具的用途和操作方法。不过，此步骤并非必需，如果希望页面简洁，仅显示去水印功能区域，可跳过此步骤。

4. 选择模板：在页面编辑界面的右侧栏中，找到“页面属性”模块。在“模板”下拉菜单中，选择“短视频去水印”（即之前准备好的 index.php 模板）。

5. 发布页面：完成上述设置后，点击“发布”按钮，将新建的页面发布到网站上。此时，用户可以通过前端访问该页面，使用短视频去水印功能。

后续操作

• 测试功能：在前端访问新创建的短视频去水印页面，尝试输入不同平台的短视频链接，点击“免费去水印”和“下载视频”等按钮，检查去水印和下载功能是否正常工作，确保页面的交互性和功能性完好。

• 优化页面：根据测试结果和用户反馈，对页面进行优化。例如，如果发现页面加载速度较慢，可以考虑优化相关代码和文件（如压缩 CSS 和 JavaScript 文件、优化图片等）；如果存在兼容性问题，可针对不同浏览器和设备进行样式和功能的调整，以提升用户体验。

# API支持解析平台
支持平台：抖音、快手、小红书、微博、微视、今日头条、西瓜视频、哔哩哔哩、秒拍、美拍、皮皮虾、皮皮搞笑、全民小视频、火山小视频、好看视频、看点视频、全民K歌、看点视频、看点快报、度小视、QQ看点、陌陌、唱吧、YY、小咖秀、糖豆、最左、配音秀、酷狗音乐、酷我音乐、看看视频、梨视频、网易云音乐、大众点评、虎牙视频、懂车帝、剪映、趣头条、美图秀秀、刷宝、迅雷、京东、淘宝、天猫、拼多多、微信公众号、火锅视频、轻视频、 百度视频、QQ浏览器、uc浏览器、oppo浏览器、油果浏览器、新片场、万能钥匙WiFi、知乎、腾讯新闻、人民日报、开眼、微叭、微云、快看点、TikTok、youtube、twitter、VUE、vigo、ACfun、now、等等100多个短视频去水印和常用图集解析。
