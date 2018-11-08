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
include_once('wallpaper.class.php');
$wallpaper = new Wallpaper();

$wallpaper->bingWallpaper();
$result = $wallpaper->getImagesFromLocal($TYPE);
if($result != ['error']){
    $rand = array_rand($result,1);
    header('Location:./image/'.$TYPE.'/'.$result[array_rand($result,1)]);
    print_r($result);
}
