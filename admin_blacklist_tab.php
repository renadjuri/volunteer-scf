 <h3>القائمة السوداء</h3>
        <p>كشف بمعلومات المتطوعين الذين وضعوا في القائمة السوداء</p>

        <center>

            <!-- Blacklist page code-->
            <?php
            $query = "select FirstName, MiddleName, LastName, VolunteerID, BlackList from volunteer where BlackList = 1";
            $result = mysqli_query($con, $query);


            $numRows = mysqli_num_rows($result);
            if ($numRows <= 0) {
                echo "<br> لا يوجد أي متطوع في القائمة السوداء";
            } else {

                //creating a table for listing all the volunteers in the blacklist
                // إنشاء جدول لإضافة جميع المتطوعين الذين وضعوا في القائمة السوداء
                echo "<div>";
                echo "<table id='t01'>";
                echo "<tr>";
                echo "<th> القائمة السوداء </th>"; // حذف من القائمة
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
                    }

                    //printing volunteers' info in the table
                    //طباعة بيانات المتطوعين في الجدول
                    echo "<td><a Onclick='return ConfirmDeleteFromBlacklist();' href='admin-profile.php?volunteer_id=" . $VolunteerID . "&action=removeFromBlacklist'><img src=\"images/cross-red-circle.png\" alt=\"Remove from blacklist\"' /></a></td>";
                    echo "<td>" . $FirstName . " " . $MiddleName . " " . $LastName . "</td>";
                    echo "<td> $VolunteerID</td>";

                    echo "</tr>";
                }


                echo "</table>";
                echo "</div>";
            }
            ?><!-- end PHP script -->

        </center>
