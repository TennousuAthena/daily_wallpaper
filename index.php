<?php
/**
 *   ___   ____ _____ _____ ____ _   _
 * / _ \ / ___|_   _| ____/ ___| | | |
 *| | | | |     | | |  _|| |   | |_| |
 *| |_| | |___  | | | |__| |___|  _  |
 * \__\_\\____| |_| |_____\____|_| |_|
 * wallpaper - index.php
 * Copyright (c) 2015 - 2018.,QCTech ,All rights reserved.
 * Created by: QCTech
 * Created Time: 2018-11-04 - 22:11
 */
$TYPE = 'bing';
include_once ('function.php');
//获取BING每日图片
bingWallpaper();

$result = getImagesFromLocal($TYPE);
if($result != ['error']){
    header('Location:./image/'.$TYPE.'/'.$result[array_rand($result,1)]);
}