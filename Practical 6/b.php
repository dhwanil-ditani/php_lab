<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'practical6b');
    function validateFields($mode, $value) {
        $res;
        switch ($mode) {
            case "rollNo": if (preg_match("/[1-9][0-9][A-Z]{3}[0-9]{3}$/i", $value))
                                $res = "";
                            else
                                $res = "Please enter a valid Roll No.";
                            break;
            case "name":    if (!preg_match("/^[a-zA-Z-' ]*$/", $value))
                                $res = "Please enter a valid name.";
                            else
                                $res = "";
                            break;
            case "emailID": if (!filter_var($value, FILTER_VALIDATE_EMAIL))
                                $res = "Please enter a valid email ID.";
                            else
                                $res = "";
                            break;
            case "phoneNo": if (preg_match("/[1-9][0-9]{9}$/", $value))
                                $res = "";
                            else
                                $res = "Please enter a valid Phone number.";
                            break;
            case "marks":   if (preg_match("/[0-9]{1,3}$/", $value))
                                $res = "";
                            else
                                $res = "Please enter numbers only.";
                            break;
        }
        return $res;
    }

    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['insert'])) {
            $active = 1;
        }
        if (isset($_POST['delete'])) {
            $active = 2;
        }
        if (isset($_POST['display']) || isset($_POST['filter'])) {
            $active = 3;
        }
    }
    else {
        $active = 1;
    }
?>
<html>
    <head>
        <title>Practical 6a</title>
        <style>
            .tab {
                overflow: hidden;
                border: 1px solid #ccc;
                background-color: #f1f1f1;
            }
            .tab button {
                background-color: inherit;
                float: left;
                border: none;
                outline: none;
                cursor: pointer;
                padding: 14px 16px;
                transition: 0.3s;
            }
            .tab button:hover {
                background-color: #ddd;
            }
            .tab button.active {
                background-color: #ccc;
            }
            .tabcontent {
                display: none;
                padding: 6px 12px;
                border: 1px solid #ccc;
                border-top: none;
            }
        </style>
        <script>
            function opentab(element) {
                var i, tabcontent, tablink;
                tabcontent = document.getElementsByClassName("tabcontent");
                tablink = document.getElementsByClassName("tablink");
                for (i=0; i<tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                for (i=0; i<tablink.length; i++) {
                    tablink[i].classList.remove("active");
                }
                document.getElementById(element.name).style.display = "block";
                element.classList.add("active");
            }
            function add() {
                var subject1 = document.getElementById('subject1').value;
                var subject2 = document.getElementById('subject2').value;
                var subject3 = document.getElementById('subject3').value;
                var total = Number(subject1) + Number(subject2) + Number(subject3);
                document.getElementById('total').value = total;
            }
        </script>
    </head>
    <body onload="document.getElementById('<?php echo $active ?>').click()">
        <div class="tab">
            <button class="tablink" onclick="opentab(this)" name="insert" id="1">Insert Data</button>
            <button class="tablink" onclick="opentab(this)" name="delete" id="2">Delete Data</button>
            <button class="tablink" onclick="opentab(this)" name="display" id="3">Display Data</button>
        </div>
        <div class="tabcontent" id="insert">
            <form method="POST" action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
                <label for="rollNo">StudentID: </label><input type="text" name="rollNo" id="rollNo" value="<?php if (isset($_POST['rollNo'])) { echo($_POST['rollNo']); } ?>"><br><br>
                <label for="name">Name: </label><input type="text" name="name" id="name" value="<?php if (isset($_POST['name'])) { echo($_POST['name']); } ?>"><br><br>
                <label for="emailId">Email-ID: </label><input type="text" name="emailId" id="emailId" value="<?php if (isset($_POST['emailId'])) { echo($_POST['emailId']); } ?>"><br><br>
                <label for="phoneNo">Phone No: </label><input type="tel" name="phoneNo" id="phoneNo" maxlength="13" minlength="10" value="<?php if (isset($_POST['phoneNo'])) { echo($_POST['phoneNo']); } ?>"><br><br>
                <label for="subject1">Marks of Subject 1:</label><input type="text" name="subject1" id="subject1" onchange="add()" value="<?php if (isset($_POST['subject1'])) { echo($_POST['subject1']); } ?>"><br><br>
                <label for="subject2">Marks of Subject 2:</label><input type="text" name="subject2" id="subject2" onchange="add()" value="<?php if (isset($_POST['subject2'])) { echo($_POST['subject2']); } ?>"><br><br>
                <label for="subject3">Marks of Subject 3:</label><input type="text" name="subject3" id="subject3" onchange="add()" value="<?php if (isset($_POST['subject3'])) { echo($_POST['subject3']); } ?>"><br><br>
                <label for="total">Total Marks: </label><input type="text" name="total" id="total" value="<?php if (isset($_POST['total'])) { echo($_POST['total']); } ?>"><br><br>
                <input type="submit" name="insert" value="submit">
            </form>
            <?php
                if (isset($_POST['insert'])) {
                    if (empty($_POST['rollNo']))
                        $rollNoErr = "Roll No is required";
                    else
                        $rollNoErr = validateFields("rollNo", $_POST['rollNo']);
                    if (empty($_POST['name']))
                        $nameErr = "Name is required";
                    else
                        $nameErr = validateFields("name", $_POST['name']);
                    if (empty($_POST['emailId']))
                        $emailIDErr = "E-Mail ID is required";
                    else
                        $emailIDErr = validateFields("emailID", $_POST['emailId']);
                    if (empty($_POST['phoneNo']))
                        $phoneNoErr = "Mobile number is required";
                    else
                        $phoneNoErr = validateFields("phoneNo", $_POST['phoneNo']);
                    if (empty($_POST['subject1']))
                        $sub1MarksErr = "Marks are required";
                    else
                        $sub1MarksErr = validateFields("marks", $_POST['subject1']);
                    if (empty($_POST['subject2']))
                        $sub2MarksErr = "Marks are required";
                    else
                        $sub2MarksErr = validateFields("marks", $_POST['subject2']);
                    if (empty($_POST['subject3']))
                        $sub3MarksErr = "Marks are required";
                    else
                        $sub3MarksErr = validateFields("marks", $_POST['subject3']);
                    $totalMarksErr = validateFields("marks", $_POST['total']);
                    $Err = $rollNoErr . $nameErr . $emailIDErr . $phoneNoErr . $sub1MarksErr . $sub2MarksErr . $sub3MarksErr . $totalMarksErr;
                    if (strlen($Err) == 0) {
                        $sql = "INSERT INTO student VALUES ('" . $_POST['rollNo'] . "', '" . $_POST['name'] . "', '" . $_POST['emailId'] . "', '" . $_POST['phoneNo'] . "', '" . $_POST['subject1'] . "', '" . $_POST['subject2'] . "', '" . $_POST['subject3'] . "', '" . $_POST['total'] . "');";
                        if (mysqli_query($conn, $sql)) {
                            print("Record Entry Success");
                        }
                        else {
                            print("Record Entry Failed: " . mysqli_error($conn));
                        }
                    }
                    else {
                        print($Err);
                    }
                }
            ?>
        </div>
        <div class="tabcontent" id="delete">
            <form method="POST" action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
                <label for="rollNo">StudentID: </label><input type="text" name="rollNo" id="rollNo"><br><br>
                <label for="emailId">Email-ID: </label><input type="text" name="emailId" id="emailId"><br><br>
                <input type="submit" name="delete" value="submit">
            </form>
            <?php
                if (isset($_POST['delete'])) {
                    if (empty($_POST['rollNo']))
                        $rollNoErr = "Roll No is required";
                    else
                        $rollNoErr = validateFields("rollNo", $_POST['rollNo']);
                    if (empty($_POST['emailId']))
                        $emailIDErr = "E-Mail ID is required";
                    else
                        $emailIDErr = validateFields("emailID", $_POST['emailId']);
                    $Err = $rollNoErr . $emailIDErr;
                    if (strlen($Err) == 0) {
                        $sql = "DELETE FROM student WHERE rollNo = '" . $_POST['rollNo'] . "' AND emailID = '" . $_POST['emailId'] . "';";
                        if (mysqli_query($conn, $sql)) {
                            print("Record Deletion Success");
                        }
                        else {
                            print("Record Deletion Failed");
                        }
                    }
                    else {
                        print($Err);
                    }
                }
            ?>
        </div>
        <div class="tabcontent" id="display">
            <form method="POST" action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
                <input type="submit" name="display" value="click to display student data">
                <input type="submit" name="filter" value="click to filter student data">
            </form>
            <?php
                if (isset($_POST['display'])) {
                    $sql = "SELECT * FROM student;";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<br><table border='2'>
                                <tr>
                                <th>Roll No</th>
                                <th>Name</th>
                                <th>Email ID</th>
                                <th>Mobile Number</th>
                                <th>Subject 1</th>
                                <th>Subject 2</th>
                                <th>Subject 3</th>
                                <th>Total Marks</th>
                            </tr>";
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row["rollNo"]}</td>
                                    <td>{$row["Name"]}</td>
                                    <td>{$row["emailID"]}</td>
                                    <td>{$row["phoneNo"]}</td>
                                    <td>{$row["subject1"]}</td>
                                    <td>{$row["subject2"]}</td>
                                    <td>{$row["subject3"]}</td>
                                    <td>{$row["total"]}</td>
                                </tr>";
                        }
                        print("</table><br><br>");
                    }
                    else {
                        print("No Records Found");
                    }
                }
                if (isset($_POST['filter'])) {
                    $sql = "SELECT * FROM student;";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        echo "<br><table border='2'>
                                <tr>
                                <th>Roll No</th>
                                <th>Name</th>
                                <th>Email ID</th>
                                <th>Mobile Number</th>
                                <th>Subject 1</th>
                                <th>Subject 2</th>
                                <th>Subject 3</th>
                                <th>Total Marks</th>
                            </tr>";
                        while($row = mysqli_fetch_assoc($result)) {
                            if ($row["subject1"] < 40 || $row["subject2"] < 40 || $row["subject3"] < 40) {
                                echo "<tr style='background-color:red;'>";
                            }
                            else {
                                echo "<tr>";
                            }
                            echo   "<td>{$row["rollNo"]}</td>
                                    <td>{$row["Name"]}</td>
                                    <td>{$row["emailID"]}</td>
                                    <td>{$row["phoneNo"]}</td>
                                    <td>{$row["subject1"]}</td>
                                    <td>{$row["subject2"]}</td>
                                    <td>{$row["subject3"]}</td>
                                    <td>{$row["total"]}</td>
                                </tr>";
                        }
                        print("</table><br><br>");
                    }
                    else {
                        print("No Records Found");
                    }
                }
            ?>
        </div>
    </body>
</html>
