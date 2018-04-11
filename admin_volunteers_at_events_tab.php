 <!-- Tab Name -->
<legend> <h1>المتطوعون بالفعاليات</h1></legend>


        <!-- Volunteers in each event-->
        <?php
        $query = "select EventID, EventName from event";
        $result = mysqli_query($con, $query);

//Events' list
        echo "<form method='post' name='Volunteer_selectEvent' action='admin-profile.php'>";
        echo "<button type='submit' name='show'  value='show'>بحث</button> &nbsp;&nbsp;";
        echo "<select id='event' name='Volunteer_selectEvent'>";
        while ($row = mysqli_fetch_array($result)) {
            foreach ($row as $id => $val) {
                $EventID = $row['EventID'];
                $EventName = $row['EventName'];
            }

            echo "<option value='$EventID' >$EventName</option>";
        }
        echo "</select>";
        echo "</form>";


        if (isset($_POST["Volunteer_selectEvent"])) {

            $Volunteer_selectEvent = $_POST["Volunteer_selectEvent"];
            $query = "select DISTINCT VolunteerID, FirstName, MiddleName, LastName, MobileNumber, email from volunteer, account, volunteerparticipateonevent where account.Username = volunteer.VolunteerUsername and"
                    . " volunteer.VolunteerID = volunteerparticipateonevent.Volunteer_ID and volunteerparticipateonevent.Event_ID = $Volunteer_selectEvent";
            $result = mysqli_query($con, $query);


            $numRows = mysqli_num_rows($result);
            if ($numRows <= 0) {
                echo "<br> لا يوجد متطوعين في الوقت الحالي";
            } else {

                //creating a table for listing the volunteers in the selected event
                // إنشاء جدول لإضافة المتطوعين المشاركين بالفعالية المحددة
                echo "<div>";
                echo "<table id='t01'>";
                echo "<tr>";
                //echo "<th> المهمه </th>";  // 0000 add to the table
                echo "<th>البريد الإلكتروني</th>";
                echo "<th>رقم الجوال </th>";
                echo "<th>الاسم الثلاثي</th>";
                echo "<th>السجل المدني</th>";
                echo "</tr>";
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

                    //printing volunteers' info in the table
                    //طباعة بيانات المتطوعين في الجدول
                    echo "<td> $email </td>";
                    echo "<td> $MobileNumber </td>";
                    echo "<td>" . $FirstName . " " . $MiddleName . " " . $LastName . "</td>";
                    echo "<td> $VolunteerID</td>";

                    echo "</tr>";
                }

                echo "</table>";
                echo "</div>";
            }
        }
        ?>

        <br><br>
        <center>
            <button class="btn">حذف</button>
            <button class="btn">تعديل</button>



            <!--volunteer hours -->

            <center>
                <input type="date" name="date"> &nbsp  أسم الفعالية&nbsp <input type="text" align="right" name="EvnName" > &nbsp التاريخ

                <br>
                &nbsp

                <table id='t01' >
                    <tr>
                        <th align="center">مجموع الساعات</th><th align="center">وقت الخروج</th><th align="center">وقت الدخول</th><th align="center">أسم المتطوع</th>
                    </tr>
                    <tr>
                        <td align="center"></td> <td align="center"><input type="time" name="usr_time"></td> <td align="center"><input type="time" name="usr_time"></td> <td align="center"> </td>
                    </tr>

                </table>
<br><br><center>
                <button class="btn">حفظ</button>
            </center>

            <?php
            echo "<select id='event' name='Admin_selectEvent'>";
            while ($row = mysqli_fetch_array($result)) {
                foreach ($row as $id => $val) {
                    $EventID = $row['EventID'];
                    $EventName = $row['EventName'];
                }

                echo "<option value='$EventID' >$EventName</option>";
            }
            echo "</select>";
            echo "</form>";


            if (isset($_POST["Admin_selectEvent"])) {

                $Admin_selectEvent = $_POST["Admin_selectEvent"];


                $query = "select volunteer.FirstName, volunteer.MiddleName, volunteer.LastName from volunteer where volunteer.Volunteer_ID = volunteerparticipateonevent.Volunteer_ID AND volunteerparticipateonevent.Event_ID = $Volunteer_selectEvent";

                $result = mysqli_query($con, $query);


                $numRows = mysqli_num_rows($result);
                if ($numRows <= 0) {
                    echo "<br> لايوجد متطوعين في الوقت الحالي";
                } else {

//creating a table for listing all the volunteer
                    // إنشاء جدول لتسجيل دخول وخروج كل متطوع بالفعالية
                    echo "<div>";
                    echo "<table id='t01'>";
                    echo "<tr>";
                    echo "<th>اسم المتطوع</th>";
                    echo "<th>وقت الدخول</th>";
                    echo "<th>وقت الخروج</th>";
                    echo "<th>مجموع الساعات</th>";
                    echo "</tr>";
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        foreach ($row as $id => $val) {
                            $FirstName = $row['FirstName'];
                            $MiddleName = $row['MiddleName'];
                            $LastName = $row['LastName'];
                            $StartingHour = $row['in_time'];
                            $EndingHour = $row['out_time'];
                            $total = $row['SUM(in_time-out_time)'];
                        }


                        //printing events' info in the table
                        //طباعة بيانات دخول وخروج المتطوعين في الجدول

                        echo "<td>" . $FirstName . " " . $MiddleName . " " . $LastName . "</td>";
                        echo "<td> $StartingHour </td>";
                        echo "<td> $EndingHour</td>";
                        echo "<td> $total</td>";

                        echo "</tr>";
                    }

                    echo "</table>";
                    echo "</div>";
                }
            }
            ?>


 