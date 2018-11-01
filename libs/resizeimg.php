<?php

class CHImage
{
    var $image;
    var $image_type;
    var $filename;
    function load($filename)
    {
        $this->filename = $filename;
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if ($this->image_type == IMAGETYPE_JPEG)
        {
            $this->image = imagecreatefromjpeg($filename);
        }
        elseif ($this->image_type == IMAGETYPE_GIF)
        {
            $this->image = imagecreatefromgif($filename);
        }
        elseif ($this->image_type == IMAGETYPE_PNG)
        {
            $this->image = imagecreatefrompng($filename);
        }
    }
    function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 95, $permissions = null)
    {

        if ($image_type == IMAGETYPE_JPEG)
        {
            imagejpeg($this->image, $filename, $compression);
        }
        elseif ($image_type == IMAGETYPE_GIF)
        {
            imagegif($this->image, $filename);
        }
        elseif ($image_type == IMAGETYPE_PNG)
        {
            imagepng($this->image, $filename);
        }
        if ($permissions != null)
        {
            chmod($filename, $permissions);
        }
    }
    function output($image_type = IMAGETYPE_JPEG)
    {
        if ($image_type == IMAGETYPE_JPEG)
        {
            imagejpeg($this->image);
        }
        elseif ($image_type == IMAGETYPE_GIF)
        {
            imagegif($this->image);
        }
        elseif ($image_type == IMAGETYPE_PNG)
        {
            imagepng($this->image);
        }
    }
    function getWidth()
    {
        return imagesx($this->image);
    }
    function getHeight()
    {
        return imagesy($this->image);
    }
    function resizeToHeight($height)
    {
        if($this->getHeight()>$height)
        {
            $ratio = $height / $this->getHeight();
            $width = $this->getWidth() * $ratio;
            $this->resize($width, $height);
        }
        else
        {
            $this->resize($this->getWidth(), $this->getHeight());
        }
    }
    function resizeToWidth($width)
    {
        if($this->getWidth()>$width)
        {
            $ratio = $width / $this->getWidth();
            $height = $this->getheight() * $ratio;
            $this->resize($width, $height);
        }
        else
        {
            $this->resize($this->getWidth(), $this->getHeight());
        }
    }
    function scale($scale)
    {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);
    }
    function resize($width, $height, $crop=0)
    {
       /* $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->
                getWidth(), $this->getHeight());
        $this->image = $new_image;*/







        //Создаем полноцветное изображение
        $destination_resource=imagecreatetruecolor($width, $height);

//Отключаем режим сопряжения цветов
        imagealphablending($destination_resource, false);

//Включаем сохранение альфа канала
        imagesavealpha($destination_resource, true);

//Ресайз
        imagecopyresampled($destination_resource, $this->image, 0, 0, 0, 0, $width, $height, $this->
        getWidth(), $this->getHeight());

//Сохранение
        $this->image = $destination_resource;
    }

    function crop($crop = 'square',$percent = false)
    {
        if($crop)
        {
            $x1 = $crop[0];
            $y1 = $crop[1];
            $x2 = $crop[2];
            $y2 = $crop[3];

            $width = $this->getWidth();
            $height = $this->getHeight();
            $width = ($width-$x2)/2;
            $height = ($height-$y2)/2;

            if($this->getWidth()>=$x2 && $this->getHeight()>=$y2)
            {
                $new = imagecreatetruecolor($x2, $y2);
                imagecopyresampled($new, $this->image, 0, 0, $width, $height, $x2, $y2, $x2, $y2);
                $this->image = $new;
            }
        }
    }


}



function resize($file, $type = 1, $width = 100, $tmp_path="tmp/", $quality = null)
{
    $max_thumb_size = $width;
    $max_size = $width;

    if ($quality == null)
        $quality = 95;

    if ($file['type'] == 'image/jpeg')
        $source = imagecreatefromjpeg($file['tmp_name']);
    elseif ($file['type'] == 'image/png')
        $source = imagecreatefrompng($file['tmp_name']);
    elseif ($file['type'] == 'image/gif')
        $source = imagecreatefromgif($file['tmp_name']);
    else
        return false;


    $src = $source;

    $w_src = imagesx($src);
    $h_src = imagesy($src);

    if ($type == 1)
        $w = $max_thumb_size;
    elseif ($type == 2)
        $w = $max_size;


    if ($w_src > $w)
    {
        $ratio = $w_src/$w;
        $w_dest = round($w_src/$ratio);
        $h_dest = round($h_src/$ratio);
        $dest = imagecreatetruecolor($w_dest, $h_dest);
        imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
        imagejpeg($dest, $tmp_path . $file['name'], $quality);
        imagedestroy($dest);
        imagedestroy($src);

        return $file['name'];
    }
    else
    {
        imagejpeg($src, $tmp_path . $file['name'], $quality);
        imagedestroy($src);

        return $file['name'];
    }
}

function AddWatermark($img_file, $filetype, $watermark = '../img/watermark.png'){
    $offset = 5;//отступ от правого нижнего края
    $image = GetImageSize($img_file);
    $xImg = $image[0];
    $yImg = $image[1];
    switch ($image[2]) {
        case 1:
            $img=imagecreatefromgif($img_file);
            break;
        case 2:
            $img=imagecreatefromjpeg($img_file);
            break;
        case 3:
            $img=imagecreatefrompng($img_file);
            break;
    }

    $r = imagecreatefrompng($watermark);
    $x = imagesx($r);
    $y = imagesy($r);

    $xDest = $xImg - ($x + $offset);
    $yDest = $yImg - ($y + $offset);
    imageAlphaBlending($img,1);
    imageAlphaBlending($r,1);
    imagesavealpha($img,1);
    imagesavealpha($r,1);
    imagecopyresampled($img,$r,$xDest,$yDest,0,0,$x,$y,$x,$y);
    switch ($filetype) {
        case "jpg":
            imagejpeg($img,$img_file,100);
            break;
        case "jpeg":
            imagejpeg($img,$img_file,100);
            break;
        case "gif":
            imagegif($img,$img_file);
            break;
        case "png":
            imagepng($img,$img_file);
            break;
    }
    imagedestroy($r);
    imagedestroy($img);
}
?> 