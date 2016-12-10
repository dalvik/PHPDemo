<?php
	//夏日PHP图形计数器程序v0.2
	//作者:夏日
	//网址:www.04ie.com
 	$path= "img/count";//图片所在的文件夹子, img 是在相应文件夹下
 	$f_name = "img/count/num.txt";//计数器的数据保存在num.txt
	$n_digit = 10;
 	//如果文件不存在，则新建文件，初始值置为100/
	if(!file_exists($f_name)){
 	$fp=fopen($f_name,"w");
 	fputs($fp,"0000000000");
 	fclose($fp);
 }
 	$fp=fopen($f_name,"r"); //打开num.txt文件
 	$hits=fgets($fp,$n_digit); //开始计取数据
 	fclose($fp); //关闭文件
 	$hits=(int)$hits + 1;//计数器增加1
 	$hits=(string)$hits; 
 	$fp=fopen($f_name,"w");
 	fputs($fp,$hits);//写入新的计数
 	fclose($fp); //关闭文件
	//循环读取并显示出图形计数器
	for($i=0;$i<$n_digit;$i++)
	
	//$hits = str_replace("$i","$i $alt","$hits"); 文字计数器，需要开启即可
	$hits = str_replace("$i","<img src='$path/$i.gif' $alt>","$hits");
	echo $hits;   
?>