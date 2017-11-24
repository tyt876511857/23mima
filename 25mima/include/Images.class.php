<?php
Class Images{
	
	// 生成缩略图
	public static function resizeimage($dst,$width=200,$height=200){
		// 首先判断待处理的图片存不存在
		$dst = ltrim($dst,'/');
		$dst = ROOT .$dst;
        $dinfo = self::imageInfo($dst);
        if($dinfo == false) {
            return false;
        }
        $calc = min($width/$dinfo['width'], $height/$dinfo['height']);// 计算缩放比例
        // 创建原始图的画布
        $dfunc = 'imagecreatefrom' . $dinfo['ext'];
        $dim = $dfunc($dst);

        // 创建缩略画布
        $tim = imagecreatetruecolor($width,$height);

        // 创建白色填充缩略画布
        $white = imagecolorallocate($tim,255,255,255);

        // 填充缩略画布
        imagefill($tim,0,0,$white);

        // 复制并缩略
        $dwidth = (int)$dinfo['width']*$calc;
        $dheight = (int)$dinfo['height']*$calc;
        $paddingx = (int)($width - $dwidth) / 2;
        $paddingy = (int)($height - $dheight) / 2;
        imagecopyresampled($tim,$dim,$paddingx,$paddingy,0,0,$dwidth,$dheight,$dinfo['width'],$dinfo['height']);

        $createfunc = 'image' . $dinfo['ext'];
        $dst = strrev($dst);
        $img_dir = explode('.',$dst,2);
        $img_dir = $img_dir[0].'.i_'.$img_dir[1];
        $img_dir = strrev($img_dir);
        $createfunc($tim,$img_dir);
        imagedestroy($dim);
        imagedestroy($tim);
        $imagesfile = '/'.substr($img_dir,strlen(ROOT));

		return $imagesfile;
	}
	// imageInfo 分析图片的信息
    // return array()
    public static function imageInfo($image) {
        // 判断图片是否存在
        if(!file_exists($image)) {
            return false;
        }
        $info = getimagesize($image);
        if($info == false) {
            return false;
        }

        // 此时info分析出来,是一个数组
        $img['width'] = $info[0];
        $img['height'] = $info[1];
        $img['ext'] = substr($info['mime'],strpos($info['mime'],'/')+1);

        return $img;
    }
    //验证码
    public static function captcha($width=50,$height=25) {
            //造画布
            $image = imagecreatetruecolor($width,$height) ;
           
            //造背影色
            $gray = imagecolorallocate($image, 200, 200, 200);
           
            //填充背景
            imagefill($image, 0, 0, $gray);
           
            //造随机字体颜色
            $color = imagecolorallocate($image, mt_rand(0, 125), mt_rand(0, 125), mt_rand(0, 125)) ;
            //造随机线条颜色
            $color1 =imagecolorallocate($image, mt_rand(100, 125), mt_rand(100, 125), mt_rand(100, 125));
            $color2 =imagecolorallocate($image, mt_rand(100, 125), mt_rand(100, 125), mt_rand(100, 125));
            $color3 =imagecolorallocate($image, mt_rand(100, 125), mt_rand(100, 125), mt_rand(100, 125));
           
            //在画布上画线
            imageline($image, mt_rand(0, 50), mt_rand(0, 25), mt_rand(0, 50), mt_rand(0, 25), $color1) ;
            imageline($image, mt_rand(0, 50), mt_rand(0, 20), mt_rand(0, 50), mt_rand(0, 20), $color2) ;
            imageline($image, mt_rand(0, 50), mt_rand(0, 20), mt_rand(0, 50), mt_rand(0, 20), $color3) ;
           
            //在画布上写字
            $text = substr(str_shuffle('ABCDEFGHIJKMNPRSTUVWXYZabcdefghijkmnprstuvwxyz23456789'), 0,4) ;

            imagestring($image, 5, 7, 5, $text, $color);
            $_SESSION['verify']=md5(strtolower($text));
            //显示、销毁
            header('content-type: image/jpeg');
            imagejpeg($image);
            imagedestroy($image);
    }
}
?>