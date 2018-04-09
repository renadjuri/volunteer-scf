 <h3>المتطوعون لدى جمعية السرطان السعودي</h3>
        <p>كشف بمعلومات المتطوعين</p>

        <?php
        $query = "select VolunteerID, FirstName, MiddleName, LastName, MobileNumber, VolunteerUsername, BlackList, email from volunteer, account where account.Username = volunteer.VolunteerUsername and BlackList=0";

        $result = mysqli_query($con, $query);


        $numRows = mysqli_num_rows($result);
        if ($numRows <= 0) {
            echo "<br> لا يوجد متطوعين في الوقت الحالي";
        } else {
            //creating a table for listing all the volunteers
            // إنشاء جدول لإضافة جميع المتطوعين المسجلين بالموقع
            echo "<div>";
            echo "<table id='t01'>";
            echo "<tr>";
            echo "<th>اسم المستخدم</th>";
            echo "<th> القائمة السوداء </th>";
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
                    $VolunteerUsername = $row['VolunteerUsername'];
                    $BlackList = $row['BlackList'];
                    $email = $row['email'];
                }

                //printing volunteers' info in the table
                //طباعة بيانات المتطوعين في الجدول
                echo "<td><a Onclick='return ConfirmAddToBlacklist();' href='admin-profile.php?volunteer_id=" . $VolunteerID . "&action=addToBlacklist'><img src=\"images/plus-black-circle.png\" alt=\"Add to blacklist\"' /></a></td>";
                echo "<td> $VolunteerUsername </td>";
                echo "<td> $email </td>";
                echo "<td> $MobileNumber </td>";
                echo "<td>" . $FirstName . " " . $MiddleName . " " . $LastName . "</td>";
                echo "<td> $VolunteerID</td>";

                echo "</tr>";
            }

            echo "</table>";
            echo "</div>";
        }
        ?><!-- end PHP script -->