<?php
/**
 *   ___   ____ _____ _____ ____ _   _
 * / _ \ / ___|_   _| ____/ ___| | | |
 *| | | | |     | | |  _|| |   | |_| |
 *| |_| | |___  | | | |__| |___|  _  |
 * \__\_\\____| |_| |_____\____|_| |_|
 * wallpaper - wallpaper.class.php
 * Copyright (c) 2015 - 2018.,QCTech ,All rights reserved.
 * Created by: QCTech
 * Created Time: 2018-11-04 - 20:58
 */
define("TEMPFILE", "./data/".date('Y')."-".date('m')."-".date('d').".tmp");
class Wallpaper
{
    public $tempFile = TEMPFILE;

    /**
     * 获取bing每日图片
     * @param int $number 图片编号(1-7)
     * @return string
     */
    private function getBingPictureURL($number = 1)
    {
        $str = file_get_contents('https://cn.bing.com/HPImageArchive.aspx?idx=' . $number . '&n=1');
        if (preg_match("/<urlBase>(.+?)<\/urlBase>/ies", $str, $matches)) {

            return 'http://cn.bing.com' . $matches[1] . '_1920x1080.jpg';
        } else {
            return false;
        }
    }

    /**
     * 从URL下载图片
     * @param string $url 图片地址
     * @param string $local_address 本地保存地址
     * @return string
     */
    protected function getImageFromURL($url, $local_address = './image/')
    {
        if ($url == '' & $url === false) {
            return false;
        }
        $ext_name = strrchr($url, '.'); //获取图片的扩展名
        if ($ext_name != '.jpg' && $ext_name != '.bmp' && $ext_name != '.png') {
            return false; //格式不在允许的范围
        }
        $filename = $local_address . md5($url) . '.jpg';
        if (file_exists($filename)) {
            return 1;
        }
        $file_output = fopen($filename, 'w');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FILE, $file_output);
        curl_exec($ch);
        curl_close($ch);
        return $filename;
    }

    /**
     * 下载bing每日图片
     * @param $download_dir
     * @return bool
     */
    public function bingWallpaper($download_dir = 'image/bing/')
    {
        if (!file_exists('./data/')) mkdir('./data', 0777, true);
        $temp_file = $this->tempFile;
        if (file_exists($temp_file)) {
            return false;
        } else {
            $result = true;
            if (!file_exists($download_dir)) {
                mkdir($download_dir, '0777', true);
            }
            for ($i = 1; $i <= 7; $i++) {
                if (!$this->getImageFromURL($this->getBingPictureURL($i), $download_dir)) $result = false;
            }
            $temp_file = fopen($temp_file, 'w');
            fwrite($temp_file, $this->getImagesFromLocal('bing')[array_rand($this->getImagesFromLocal('bing'),1)]);
            fclose($temp_file);
            return $result;
        }
    }

    /**
     * 获取本地壁纸
     * @param string $type
     * @return array
     */
    private function getImagesFromLocal($type = 'bing')
    {
        if ($type == '') return ['error'];

        switch ($type) {
            case 'bing':
                $image_path = './image/bing/';
                break;
            default:
                $image_path = './image/' . $type . '/';
                break;
        }

        if ($handle = opendir($image_path)) {
            $file_array = scandir($image_path);
            array_splice($file_array, 0, 1);
            for ($i = 0; $i < count($file_array); $i++) {
                if (strrchr($file_array[$i], '.') != '.jpg' && strrchr($file_array[$i], '.') != '.png') array_splice($file_array, $i, 1);
            }
            return $file_array;
        } else {
            return ['error'];
        }
    }

    /**
     * 读取临时文件中的数据
     * @return bool|string
     */
    public function bingImageResult(){
        $temp_file = $this->tempFile;
        if(!file_exists($temp_file)){
            $this->getImagesFromLocal('bing');
        }
        $temp_file = fopen($temp_file, "r");
        $result = fgets($temp_file);
        if($result=='' && $result = ' '){
            return $this->getImagesFromLocal('bing')[array_rand($this->getImagesFromLocal('bing'),1)];
        }
        fclose($temp_file);
        return $result;
    }
}
