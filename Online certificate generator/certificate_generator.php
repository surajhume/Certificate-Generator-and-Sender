<?php
header('content-type:image/jpeg');
if(isset($_POST['image'])){
	$font="AGENCYR.TTF";
	$image=imagecreatefromjpeg($_POST['image']);
	$color=imagecolorallocate($image,19,21,22);
		$name=$_POST['name'];
        $x= $_POST['x'];
        $y=$_POST['y'];
		imagettftext($image,$_POST['size'],$_POST['orientation'],$x,$y,$color,$font,$name);
		$file=time();
		imagejpeg($image);
		imagedestroy($image);
		

}
?>