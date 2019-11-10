<!-- php login script -->
<!-- ============================================================== -->
<?php
include_once "connection.php";

    $username = $_POST['username'];
    $username = mysqli_real_escape_string($con, $username);

    $password = $_POST['password'];
    $password = mysqli_real_escape_string($con, $password);

    $result = mysqli_query($con, "SELECT
  admin.admin_id,
  admin.admin_username,
  admin.admin_nickname,
  admin.admin_password,
  admin.created_at,
  admin.modified_at
FROM
  admin
Where admin.admin_username = '$username' And admin.admin_password = '$password'")or die(mysqli_error($con));
    if (mysqli_num_rows($result) != 0) {

        $row = mysqli_fetch_assoc($result);


        $_SESSION['dina']['timestamp'] = time();
        $_SESSION['dina']['authenticate'] = "true";
        $_SESSION['dina']['id'] = $row['admin_id'];
        $_SESSION['dina']['nickname'] = $row['admin_nickname'];
        header('Location: ../index.php');
        exit;
    } else {
        header('Location: ../login.php?backresult=0');
        $_SESSION['dina']['username'] = $username;
        exit;
    }
?>
<!-- ============================================================== -->
<!-- end php login script -->