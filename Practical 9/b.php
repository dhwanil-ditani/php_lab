<!DOCTYPE html>
<html lang="en">
<head>
    <title>Practical 9b</title>
</head>
<body>
    <form action="" method="post">
        Phone:- <input type="text" name="phone" id=""><br>
        Password:- <input type="Password" name="password" id=""><br>
        <input type="submit" value="Submit" name="sub-btn">
    </form>

    <?php
    if(isset($_POST['sub-btn'])){
        $phone=trim(htmlspecialchars($_POST['phone']));
        $password=trim(htmlspecialchars($_POST['password']));

        if(preg_match("/\b^[1-9]{1}[0-9]{9}\b/",$phone)){
            echo "Valid:-$phone";
        }
        else
        echo "Not Valid phone:- $phone";
        echo "<br>";
        
        if(preg_match("/^((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$\.%^&*])(?=.{8,}))/",$password)){
            echo "Your Password is a Strong one:- $password";
        }
        else
        echo "Your Password is not a Strong one:- $password";
    }
    ?>
</body>
</html>
