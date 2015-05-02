<?php 
function makeimage($filename, $newfilename, $path, $newwidth, $newheight) {
    //SEARCHES IMAGE NAME STRING TO SELECT EXTENSION (EVERYTHING AFTER . )
    $imgSrc = $path.$filename;
        $newpath = $path.$newfilename.$filename;
        //getting the image dimensions
        list($width, $height) = getimagesize($imgSrc);
        $end_chars1 = substr($filename, -4);
        $end_chars2 = substr($filename, -5);
               
                if( $end_chars1 == '.jpg'|| $end_chars1 == '.JPG'|| $end_chars2 == '.jpeg')
                {
                        $myImage = imagecreatefromjpeg($imgSrc);
                }
                else
                {
                        if($end_chars1 == '.png')
                        {
                                $myImage = imagecreatefrompng($imgSrc);
                        }
                        else
                        {
                                if($end_chars1 == '.gif')
                                {
                                        $myImage = imagecreatefromgif($imgSrc);
                                }
                                else
                                {
                                       
                                       header("Location: ../gallery.php?msg=4");
                                }
                        }
                }

        //saving the image into memory (for manipulation with GD Library)
       
       
        ///--------------------------------------------------------
        //setting the crop size
        //--------------------------------------------------------
        if($height>120)
        {
        $w = 120*$width/$height;
        $h = 120;
        }
        else
        {
       
        $w = $width;
        $h = $height;
        }

        
        //getting the top left coordinate
        $c1 = array("x"=>($w-$cropWidth)/2, "y"=>($h-$cropHeight)/2);
        $thumbSize = $w;
        $thumbSize2 = $h;
        $thumb = imagecreatetruecolor($thumbSize, $thumbSize2);
        imagecopyresampled($thumb, $myImage, 0, 0,0, 0, $thumbSize, $thumbSize2, $width, $height);
       
        //--------------------------------------------------------
        //--------------------------------------------------------
        $lineWidth = 1;
        $margin    = 0;
        $green    = imagecolorallocate($thumb, 193, 252, 182);
        
       
        //header('Content-type: image/jpeg');
        imagejpeg($thumb,$newpath,  90);
        imagedestroy($thumb);
}

function makeimage2($filename, $newfilename, $path, $newwidth, $newheight) {
    //SEARCHES IMAGE NAME STRING TO SELECT EXTENSION (EVERYTHING AFTER . )
    $imgSrc = $path.$filename;
        $newpath = $path.$newfilename.$filename;
        //getting the image dimensions
        list($width, $height) = getimagesize($imgSrc);
        $end_chars1 = substr($filename, -4);
        $end_chars2 = substr($filename, -5);
               
                if( $end_chars1 == '.jpg' || $end_chars1 == '.JPG' || $end_chars2 == '.jpeg')
                {
                        $myImage = imagecreatefromjpeg($imgSrc);
                }
                else
                {
                        if($end_chars1 == '.png')
                        {
                                $myImage = imagecreatefrompng($imgSrc);
                        }
                        else
                        {
                                if($end_chars1 == '.gif')
                                {
                                        $myImage = imagecreatefromgif($imgSrc);
                                }
                                else
                                {
                                       
                                        header("Location: ../gallery.php?msg=4");
                                }
                        }
                }

        //saving the image into memory (for manipulation with GD Library)
       
       
        ///--------------------------------------------------------
        //setting the crop size
        //--------------------------------------------------------
        if($width>800)
        {
        $w = 800;
        $h = 800*$height/$width;
        }
        else
        {
       
        $w = $width;
        $h = $height;
        }

        
        //getting the top left coordinate
        $c1 = array("x"=>($w-$cropWidth)/2, "y"=>($h-$cropHeight)/2);
        $thumbSize = $w;
        $thumbSize2 = $h;
        $thumb = imagecreatetruecolor($thumbSize, $thumbSize2);
        imagecopyresampled($thumb, $myImage, 0, 0,0, 0, $thumbSize, $thumbSize2, $width, $height);
       
        //--------------------------------------------------------
        //--------------------------------------------------------
        $lineWidth = 1;
        $margin    = 0;
        $green    = imagecolorallocate($thumb, 193, 252, 182);
        
       
        //header('Content-type: image/jpeg');
        imagejpeg($thumb,$newpath,  90);
        imagedestroy($thumb);
}


require_once('../config.php');
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
        if(!$link) {
                die('Failed to connect to server: ' . mysql_error());
        }
       
        //Select database
        $db = mysql_select_db(DB_DATABASE);
        if(!$db) {
                die("Unable to select database");
        }

if($_GET["type"] == 1)
{
move_uploaded_file($_FILES["file"]["tmp_name"],
      "../../gallery/". $_FILES["file"]["name"]);
$picname = $_FILES["file"]["name"];
if($picname)
{
$new1 = makeimage($picname, 'tn_', "../../gallery/", 80, 70);
$new2 = makeimage2($picname, 'tn2_', "../../gallery/", 70, 70);
$feed_date =strtotime("now");
list($width1, $height1) = getimagesize("../../gallery/tn2_".$picname);

mysql_query("INSERT INTO gallery ( image, caption ,picx, picy,place,timestamp)
                        VALUES ('$picname','$_POST[caption]' ,'$width1', '$height1','$_POST[place]','$feed_date' )");
unlink('../../gallery/'.$picname);
 header("Location: ../gallery.php?msg=1");
}
else
{
 header("Location: ../gallery.php?msg=2");
}
 }
 if($_GET["type"] == 2)
{

$sql_case_img="SELECT image from gallery WHERE id='$_GET[pic_id]'";
$result_case_img=mysql_query($sql_case_img);
$row_img = mysql_fetch_array($result_case_img);

unlink('../../gallery/tn_'.$row_img["image"]);
unlink('../../gallery/tn2_'.$row_img["image"]);

mysql_query("DELETE from gallery  WHERE id='$_GET[pic_id]'");

 header("Location: ../gallery.php?msg=3");
}
if($_GET["type"] == 3)
{


mysql_query("UPDATE gallery SET caption = '$_POST[caption]'  WHERE id='$_GET[pic_id]'");

 header("Location: ../gallery.php");
}



