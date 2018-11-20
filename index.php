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
include_once('wallpaper.class.php');
$wallpaper = new Wallpaper();

$wallpaper->bingWallpaper();
$result = $wallpaper->bingImageResult();
if($result != ['error']){
    header('Location:./image/bing/'.$result);
}
