<?php
    $email = (isset($_POST["email"])) ? $_POST["email"] : "";
    $response = "";
    $res_type = FALSE;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (empty($_POST["email"])) {
            $response = "E-mail is required.";
            $res_type = FALSE;
        } else {
            if (preg_match("/^[a-z]{1}[a-z0-9]*\.?[a-z0-9]*@{1}[a-z0-9]+[\.]{1}[a-z]+[\.]?[a-z]+$/", $email)) {
                $response = "E-mail accepted.";
                $res_type = TRUE;
            }
            else {
                $response = "E-mail is not valid.";
                $res_type = FALSE;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Practical 9a</title>
    <style>
        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>
<body>
    <form method="POST" action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>">
        <label for="email"><strong>Enter e-mail:</strong>
            <input type="text" name="email" id="email" value="<?=$email?>">
            <br><br>
            <span class="<?php echo $res_type?'success':'error';?>"><?=$response?></span>
            <br><br>
        </label>

        <input type="submit" value="Check">
    </form>
</body>
</html>
