<?php
/*
 * by     : 星云
 * Github : https://github.com/XingYun886
 */
$action = isset($_GET['action'])? $_GET['action'] : '';
$videoUrl = isset($_GET['url'])? $_GET['url'] : '';

$apiUrl = "http://api.0l0.cn/home/api?type=dsp&uid=2694077&key=dlsyCEHKMNRSTVY024&url=".$videoUrl;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response, true);

if ($action === 'download') {
    if ($data['code'] == 200 && isset($data['data']['downurl'])) {
        header('Content-Type: video/mp4'); 
        header('Content-Disposition: attachment; filename="去水印视频.mp4"');
        readfile($data['data']['downurl']); 
    } else {
        $error = "获取下载链接失败，请检查输入的链接是否正确";
        echo "<p>{$error}</p>";
    }
} elseif ($action ==='remove_watermark') {
    if ($data['code'] == 200 && isset($data['data']['downurl'])) {
        $downUrl = $data['data']['downurl'];
        $title = isset($data['data']['title'])? $data['data']['title'] : '无标题';
        $type = isset($data['data']['type'])? $data['data']['type'] : '未知类型';
        $coverUrl = isset($data['data']['cover_url'])? $data['data']['cover_url'] : '';
        echo "<p>视频标题：{$title}</p>";
        echo "<p>视频类型：{$type}</p>";
        echo "<p>封面链接：<a href='{$coverUrl}' target='_blank'>{$coverUrl}</a></p>";
        echo "<p>视频链接：<a href='{$downUrl}' target='_blank'>{$downUrl}</a></p>";
    } else {
        $error = "去水印操作失败，请检查输入的链接是否正确";
        echo "<p>{$error}</p>";
    }
}
?>
