<?
require("../../config.php");
require("../../libs/resizeimg.php");
$myrow1_1 = $result_settings;
if(isset($_POST["sendchcomment"]) && $MODULES[12][2]==1 )
{

    $name = $_POST["name"];
    $link = $_POST["link"];
    $text = $_POST["text"];
    $photo = $_POST["photo"];
    $typeserv = $_POST["typeserv"];
    $ip = GetUserIP();
    $date = date('Y-m-d G:i:s');
    $text = str_replace('"','',$text);
    $error = "";
    $msg = "";
    $fileElementName = 'chComments-Photo';
    if(!empty($_FILES[$fileElementName]['error']))
    {
        switch($_FILES[$fileElementName]['error'])
        {

            case '1':
                $error = 'Размер файла слишком велик.';
                break;
            case '2':
                $error = 'Размер файла слишком велик.';
                break;
            case '3':
                $error = 'Ошибка при загрузке файла #3.';
                break;
            case '4':
                $error = 'Файл не выбран.';
                break;

            case '6':
                $error = 'Ошибка при загрузке файла #6.';
                break;
            case '7':
                $error = 'Ошибка при загрузке файла #7.';
                break;
            case '8':
                $error = 'Ошибка при загрузке файла #8.';
                break;
            case '999':
            default:
                $error = 'Ошибка при загрузке файла #0.';
        }
    }elseif(empty($_FILES['chComments-Photo']['tmp_name']) || $_FILES['chComments-Photo']['tmp_name'] == 'none')
    {
        $error = 'Файл не выбран.';

    }else
    {
        $msg .= " File Name: " . $_FILES['chComments-Photo']['name'] . ", ";
        $msg .= " File Size: " . @filesize($_FILES['chComments-Photo']['tmp_name']);
        if($_FILES["chComments-Photo"]['size']!= 0)
        {
            $type = substr($_FILES['chComments-Photo']['name'], strrpos($_FILES['chComments-Photo']['name'], '.')+1);
            $photo_img=md5(date('YmdHis').rand(100,1000)).".".$type;
            $tmp_path = "tmp/";
            $dir_upload = "files/reviews_photos/";

            $image = new CHImage();

            //Маленькая картинка
            $image->load($_FILES['chComments-Photo']['tmp_name']);
            if($Review_Small_Width) $image->resizeToWidth($Review_Small_Width);
            else $image->resizeToHeight($Review_Small_Heigth);
            $image->save("../../files/reviews_photos/".$photo_img);

            //Большая картинка
            $image->load($_FILES['chComments-Photo']['tmp_name']);
            if($Review_Big_Width) $image->resizeToWidth($Review_Big_Width);
            else $image->resizeToHeight($Review_Big_Heigth);
            $image->save("../../files/reviews_photos/full/".$photo_img);



            $nameFile  = $photo_img;
            @unlink($tmp_path.$name1);
        }



    }
    mysql_query("INSERT INTO comments (`name`,`link`,`text`,`photo`,`type`,`ip`,`date`) VALUES ('$name','$link','$text','$nameFile','$typeserv','$ip','$date')");
    echo "{";
    echo				"error: '" . $error . "',\n";
    echo				"msg: '" . $msg . "'\n";
    echo "}";
    $title_mail = "Отзыв от $name на $sitename";
    $text_mail = "Имя: $name<br/>Отзыв: $text<br/>IP: <a href='http://www.seogadget.ru/location?addr=$ip' target='_blank'>$ip</a>";
    mail($EmailTO,$title_mail,$text_mail,"Content-type:text/html; charset=utf-8\r\n");
    if(!empty($EmailTO2)){mail($EmailTO2,$title_mail,$text_mail,"Content-type:text/html; charset=utf-8\r\n");}
}
