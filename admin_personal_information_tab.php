<!-- Tab Name -->
<legend> <h1>المعلومات الشخصية</h1></legend>
<?php
$query = 'select AdminID, FirstName, MiddleName, LastName, AdminUsername, Email, password from admin, account where account.Username = admin.AdminUsername and account.Username = "' . $_SESSION["username"] . '"';
$result = mysqli_query($con, $query);
$FnameError = $MnameError = $LnameError = $EmailError = "";


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
            $password = md5($password);
        }
    }
}
?>

<br>
<div class="container">
    <div class="row">
        <div class="[ col-sm-8 col-sm-offset-3 col-md-12 ]">
            <form method="post" action="CheckAdminInfo.php" style="  text-align: right;">
                <table>
                    <tr>
                        <td><input style="  text-align: right;" type="text" name="name" value="<?php print ($FirstName . ' ' . $MiddleName . ' ' . $LastName); ?>" required></td>
                        <td><label> الاسم</label></td>
                    </tr>
                    <tr>
                        <td><input style="  text-align: right;" type="text" name="id" value="<?php print ($AdminID); ?>"></td>
                        <td> <label>السجل المدني/الإقامة</label></td>
                    </tr>
                    <tr>
                        <td><input style="  text-align: right;"  type="text" name="username" value="<?php print ($AdminUsername); ?>"></td>
                        <td> <label>اسم المستخدم</label></td>
                    </tr>
                    <tr>
                        <td><input style="  text-align: right;"  type="email" name="email" value="<?php print ($Email); ?>" required></td>
                        <td><label> البريد الإلكتروني </label></td>
                    </tr>
                    <tr>
                        <td><input style="  text-align: right;" type="password" name="password" id="password"  
                                   value="<?php echo $password; ?>" required/></td>
                        <td><label>كلمة المرور</label></td>
                    </tr>

                    <tr>
                      
                        </td>
                        <td><button class="btn btn-success" name="changePassword" type="">تغيير كلمة المرور</button></td>
                    </tr>
                </table>
                <br><br>
                <center>
                    <button class="btn btn-danger" name="cancel" type="submit">إلغاء</button>&nbsp;   <button class="btn btn-success" name="update" type="submit">حفظ التعديلات</button>		
                </center>
            </form>
        </div>
    </div>
</div>
