<?php
/**
 *   ___   ____ ___
 * / _ \ / ___|_ _|_ __ ___   __ _  __ _  ___
 *| | | | |    | || '_ ` _ \ / _` |/ _` |/ _ \
 *| |_| | |___ | || | | | | | (_| | (_| |  __/
 * \__\_\\____|___|_| |_| |_|\__,_|\__, |\___|
 *                                  |___/
 * qcimg - index.php
 * Copyright (c) 2015 - 2018.,QCTech ,All rights reserved.
 * Created by: QCTech
 * Created Time: 2018-11-04 - 22:11
 */
include_once ('function.php');
//获取BING每日图片
if(bingWallpaper()) getImagesFromLocal();