<h3>معلومات شخصية</h3>
        <p>.المعلومات الشخصية للادمن</p>
        <?php
        $query = 'select AdminID, FirstName, MiddleName, LastName, AdminUsername, Email, password from admin, account where account.Username = admin.AdminUsername and account.Username = "' . $_SESSION["username"] . '"';
        $result = mysqli_query($con, $query);


        $numRows = mysqli_num_rows($result);
        if ($numRows <= 0) {
            echo "<br> نعتذر لقد حدث خلل، نرجو الخروج و محاولة الدخول للنظام مرة أخرى";  //0000
        } else {
            while ($row = mysqli_fetch_array($result)) {
                foreach ($row as $id => $val) {
                    $AdminID = $row['AdminID'];
                    $FirstName = $row['FirstName'];
                    $MiddleName = $row['MiddleName'];
                    $LastName = $row['LastName'];
                    $AdminUsername = $row['AdminUsername'];
                    $Email = $row['Email'];
                    $password = $row['password'];
                }
            }
        }
        ?>
        <br>
<div class="container">
    <div class="row">
        <div class="[ col-sm-8 col-sm-offset-3 col-md-12 ]">
        <form method="post" action="CheckAdminInfo.php">
            <table>
                <tr>
                    <td><input type="text" name="name" value="<?php print ($FirstName . ' ' . $MiddleName . ' ' . $LastName); ?>" required></td>
                    <td><label> الاسم</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="id" value="<?php print ($AdminID); ?>"></td>
                    <td> <label>السجل المدني/الإقامة</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="username" value="<?php print ($AdminUsername); ?>"></td>
                    <td> <label>اسم المستخدم</label></td>
                </tr>
                <tr>
                    <td><input type="email" name="email" value="<?php print ($email); ?>" required></td>
                    <td><label> البريد الإلكتروني </label></td>
                </tr>
                <tr>
                    <td><input type="text" name="password" value="<?php print ($password); ?>" required></td>
                    <td><label>كلمة المرور</label></td>
                </tr>
                <tr>
                    <td><button class="btn" name="changePassword" type="">تغيير كلمة المرور</button></td>
                </tr>
            </table>
            <br><br>
            <center>
                <button class="btn" name="cancel" type="submit">إلغاء</button>&nbsp;   <button class="btn" name="update" type="submit">حفظ التعديلات</button>		
            </center>
        </form>
        </div>
    </div>
</div>