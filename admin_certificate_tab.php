 <!-- Certificates for volunteers-->
        <?php
        //0000000000000000000000000000000000000000000000000000000
        echo "Certificates:";
        $query = "select EventID, EventName from event";

        $result = mysqli_query($con, $query);

        $error = "";
        //Events' list
        echo "<form method='post' name='selectEvent' action='try_AllVolunteers.php'>";
        echo "<span style='color:red;'>$error</span>"; //0000
        echo "<button type='submit' name='show'  value='show'>بحث</button> &nbsp;&nbsp;";
        echo "<select id='event' name='selectEvent'>";
        while ($row = mysqli_fetch_array($result)) {
            foreach ($row as $id => $val) {
                $EventID = $row['EventID'];
                $EventName = $row['EventName'];
            }

            echo "<option value='$EventID' >$EventName</option>"; //0000 to keep same value when post back try --> " . <?php echo (isset($_POST["selectEvent"] && $_POST["selectEvent"] == "$EventID")?"selected='selected'":"";?->
        }
        echo "</select>";
        echo "</form>";


        if (isset($_POST["selectEvent"])) {

            $selectEvent = $_POST["selectEvent"];
            $query = "select DISTINCT VolunteerID, FirstName, MiddleName, LastName, MobileNumber, email from volunteer, account, volunteerparticipateonevent where account.Username = volunteer.VolunteerUsername and volunteer.VolunteerID = volunteerparticipateonevent.Volunteer_ID and volunteerparticipateonevent.Event_ID = $selectEvent";

            $result = mysqli_query($con, $query);


            $numRows = mysqli_num_rows($result);
            if ($numRows <= 0) {
                echo "<br> لا يوجد متطوعين في الوقت الحالي";
            } else {
                echo "<form name='SendCertificateForm' method='POST'>"; //action='0000.php?AID=<?php echo $AID
                //creating a table for listing the volunteers in the selected event
                // إنشاء جدول لإضافة المتطوعين المشاركين بالفعالية المحددة
                echo "<div>";
                echo "<table id='t01'>";
                echo "<tr>";
                //echo "<th> المهمه </th>";  // 0000 add to the table
                echo "<th> الشهاده</th>";
                echo "<th>البريد الإلكتروني</th>";
                echo "<th>رقم الجوال </th>";
                echo "<th>الاسم الثلاثي</th>";
                echo "<th>السجل المدني</th>";
                echo "<th><input type='checkbox' name='SelectAll' id='SelectAll' onchange='checkboxAll(this)'> </th>";
                echo "</tr>";
                $num = 0;
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    foreach ($row as $id => $val) {
                        $VolunteerID = $row['VolunteerID'];
                        $FirstName = $row['FirstName'];
                        $MiddleName = $row['MiddleName'];
                        $LastName = $row['LastName'];
                        $MobileNumber = $row['MobileNumber'];
                        $email = $row['email'];
                    }
                    $num += 1;
                    //printing volunteers' info in the table
                    //طباعة بيانات المتطوعين في الجدول
                    echo "<td><a href='tcpdf/examples/certificate-English-email.php?volunteer_id=" . $VolunteerID . "&event_id=" . $selectEvent . "'><img src=\"images/certificate.png\" alt=\"Certificate\" height=30 weight=30 ' /></a></td>";
                    echo "<td> $email </td>";
                    echo "<td> $MobileNumber </td>";
                    echo "<td>" . $FirstName . " " . $MiddleName . " " . $LastName . "</td>";
                    echo "<td> $VolunteerID</td>";
                    //echo "<td><input type='checkbox' name='" . $num ."' />&nbsp;</td>";
                    echo "<td> <input type='checkbox' name=CertificateSelection[] value=$VolunteerID> </td>";
                    echo "</tr>";
                }
                echo "$error"; //0000
                echo "</table>";
                echo "</div>";
                echo "<button Onclick='return sendEmailConfirmation();' type='submit' class='button' name='sendEmail' id='sendEmail' value='Send Certificate'> إرسال الشهادة </button>";
                echo "</form>";
            }
        }
        ?>

