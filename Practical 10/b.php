<!DOCTYPE html>
<html lang="en">
<head>
    <title>Practical 10b</title>
</head>
<body>
    <?php
    date_default_timezone_set("Asia/Kolkata");
    $d = dir(getcwd());
    while (($file = $d->read()) !== false){
        $tmp =pathinfo($file);
        echo "filename: " . $file . "<br>";
        echo "File Type:- ".filetype($file)." <br>";
        if(array_key_exists('extension',$tmp)){
            $ext=$tmp['extension'];
            if(empty($ext))
            echo "Your file extension is directory <br>";
            else
            echo "Your file extension is ".$ext." <br>";
        }
        echo "Your file size is ".filesize($file)." <br>";
        $filetime=filemtime($file);
        echo "Your file creation time ".date("F d Y H:i:s.", $filetime)." <br>";
        echo "<br>";
    }
    ?>
</body>
</html>
