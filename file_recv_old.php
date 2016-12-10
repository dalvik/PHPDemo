<?php

$s2 = new SaeStorage();
$name =$_FILES['file']['name'];  
$index = strrpos($name, "_");//strpos
if($index > 1){
    $mac = substr($name,0, $index-1);
    $fileName = substr($name,$index+1);
    $nameLength = strlen($fileName);
	if($nameLength>=13){
		$fileDate = substr($fileName,0,6);
		$fileDay = substr($fileName,6,2);
	}
} else {
	$fileName = $name;
}
if($mac !='006b8e1bbdb' && $mac != '40F3082A1E2' && $mac != '000af53ae22' && $mac != '000af53ae22' && $mac != '18dc567c3c5' && $mac != 'F025B756B94' 
&& $mac != '0008222e456' && $mac != 'D022BE490CD' && $mac != '98ffd0e4f8b' && $mac != 'cc07e4b8999' && $mac != '88708cb75b9' && $mac != '38BC1A07312' 
&& $mac != 'e8bba8ad050' && $mac != '10D542D9BF' && $mac != 'e0191d6c9ed' && $mac != '6021C0FFF57' && $mac != '18dc56d0d92' && $mac != '6C2F2CE6CB7' 
&& $mac != '3423BA7EB89' && $mac != '20593d2c000' && $mac != '001a99cc462' && $mac != 'd850e62ec25' && $mac != '7c1dd964b1f' && $mac != 'e42d02a1bc8' 
&& $mac != '0012fec6ad8' && $mac !='E432CB2A21B' && $mac != '00166DC16F7' ){
   echo $s2->upload('soundrecorder',"/".$mac."/".$fileDate."/".$fileDay."/".$fileName,$_FILES['file']['tmp_name']);//
}else{
    echo true;
}

//echo "The file ".( $_FILES['file']['name'])." has been uploaded.";
/*
    $target_path  = "./tmp/";//接收文件目录  
    $target_path = $target_path.($_FILES['file']['name']);
    $target_path = iconv("UTF-8","gb2312", $target_path);
    if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {  
       echo "The file ".( $_FILES['file']['name'])." has been uploaded.";
    }else{  
       echo "There was an error uploading the file, please try again! Error Code: ".$_FILES['file']['error'];
    }*/
    
    
?>