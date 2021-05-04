<?php
$rollNo = isset($_POST['rollNo'])?$_POST['rollNo']:'';
$name = isset($_POST['name'])?$_POST['name']:'';
$sem = isset($_POST['sem'])?$_POST['sem']:'';
$m1 = (int)isset($_POST['m1'])?$_POST['m1']:'';
$m2 = isset($_POST['m2'])?$_POST['m2']:'';
$m3 = isset($_POST['m3'])?$_POST['m3']:'';
$m4 = isset($_POST['m4'])?$_POST['m4']:'';
$m5 = isset($_POST['m5'])?$_POST['m5']:'';
$percentage = (((int)$m1+(int)$m2+(int)$m3+(int)$m4+(int)$m5) / 5.0);
$res = "";
$dis = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $FILE = fopen('student.dat', 'a+');
        if(fwrite($FILE, "$rollNo|$name|$sem|$m1|$m2|$m3|$m4|$m5|$percentage\n") === FALSE) {
            $res = "Error, record not saved.";
            $res_type = "error";
        }
        else {
            $res = "Record saved successfully.";
            $res_type = "success";
        }
        fclose($FILE);
    }

    if (isset($_POST['display'])) {
        function disTable() {
            echo "<br><table border='1'>
            <tr>
            <th class='text'>Roll Number</th>
            <th class='text'>Name</th>
            <th class='text'>Semester</th>
            <th class='text'>Marks 1</th>
            <th class='text'>Marks 2</th>
            <th class='text'>Marks 3</th>
            <th class='text'>Marks 4</th>
            <th class='text'>Marks 5</th>
            <th class='text'>Percentage</th>
            </tr>";
            $FILE = fopen('student.dat', 'a+');
            while (!feof($FILE)) {
                $line = explode("|", fgets($FILE));
                if (count($line) > 1) {
                    echo "<tr>";
                    for ($i = 0; $i < count($line); $i++) {
                        echo "<td class='text'>{$line[$i]}</td>";
                    }
                    echo "</tr>";
                }
            }
            echo "</table><br>";
            fclose($FILE);
        }

        $dis = 1;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Practical 10c</title>
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="rollNo">Roll number:<input type="text" name="rollNo" id="rollNo"></label>
        <br><br>
        <label for="name">Name:<input type="text" name="name" id="name"></label>
        <br><br>
        <label for="sem">Semester:<input type="text" name="sem" id="sem"></label>
        <br><br>
        <label for="m1">Marks 1:<input type="number" name="m1" id="m1"></label>
        <br><br>
        <label for="m2">Marks 2:<input type="number" name="m2" id="m2"></label>
        <br><br>
        <label for="m3">Marks 3:<input type="number" name="m3" id="m3"></label>
        <br><br>
        <label for="m3">Marks 4:<input type="number" name="m4" id="m4"></label>
        <br><br>
        <label for="m3">Marks 5:<input type="number" name="m5" id="m5"></label>
        <br><br>
        <input type="submit" name="submit" value="Submit">
        <input type="submit" name="display" value="Display">
    </form>
    <p class="<?php echo $res_type?'success':'error';?>"><?=$res?></p>
    <?php if ($dis==1) disTable(); ?>
</body>
</html>
