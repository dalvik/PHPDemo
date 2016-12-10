<?php 
	session_start();
    header("Content-Type:image/jpeg");
	$width = 60;
	$height = 20;
    $image = imagecreate($width, $height);
    $bg = imagecolorallocate($image, 0, 0, 0);
    $lco = imagecolorallocate($image, 255, 255, 255);
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZqwertyuiopasdfghjklzxcvbnm0123456789";
	$arr = str_split($str);
	$code = $arr[rand(0,61)].$arr[rand(0,61)].$arr[rand(0,61)].$arr[rand(0,61)];
	$_SESSION['yzm'] = $code;
	imagestring($image, 5, rand(5, $height), rand(0, 15), $code, $lco);
    //imagestring($image,4,5,25,$code,$lco);
    //写中文
    // array imagettftext(resource image, int size, int angle, int x, int y int color, string fontfile, string text);
	for($i=1;$i<=3;$i++){
		imageline($image, rand(0,$width), rand(0, $height),rand(0,$width), rand(0, $height), $lco);
	}
	//for($i=1; $i<=50; $i++){
	//	imagepixel($image, rand(0, 300), rand(0,300), $lco);
	//}
    //imagettftext($img, 20,0,100,100,$lco,"./msyh.ttc","中文");
    imagejpeg($image);
    imagedestroy($image);
?>