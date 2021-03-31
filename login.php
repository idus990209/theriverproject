<?php

include('config/session.php');
include('config/db_connect.php');

if (!empty($_SESSION['name'])) {
    header('Location: index.php');
}

$login_username = $login_password = '';
$username = $fullname = $email = $password = '';

$errors = array('login_username' => '', 'login_password' => '', 'username' => '', 'fullname' => '', 'email' => '', 'password' => '');
$login = $register = '';

if (isset($_POST['login'])) {
    unset($_POST['register']);

    // write query for all pizzas
    $sql = 'SELECT username, fullname, userpassword, id FROM  user';

    // make query & get result
    $result = mysqli_query($conn, $sql);

    // fetch the resulting rows as an array
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result from memory
    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);

    foreach ($users as $user) {
        // validate user
        if ($_POST['login_username'] == $user['username'] && $_POST['login_password'] == $user['userpassword']) {
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            header('Location: index.php');
        } else {
            $login_username = $_POST['login_username'];
            $login_password = $_POST['login_password'];
        }
    }
    $login = 'Login failed!';
}

if (isset($_POST['register'])) {
    unset($_POST['login']);

    // check username
    if (empty($_POST['username'])) {
        $errors['username'] = 'A username is required <br/>';
    } else {
        $username = $_POST['username'];
        if (strlen($username) < 4) {
            $errors['username'] = 'Username must be at least 4 characters <br/>';
        }
    }

    // check name
    if (empty($_POST['fullname'])) {
        $errors['fullname'] = 'A name is required <br/>';
    } else {
        $fullname = $_POST['fullname'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $fullname)) {
            $errors['fullname'] = 'Name must be letters and spaces only <br/>';
        }
    }

    // check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required <br/>';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be a valid email address <br/>';
        }
    }

    // check password
    if (empty($_POST['password'])) {
        $errors['password'] = 'A password is required <br/>';
    } else {
        $password = $_POST['password'];
        if (strlen($password) < 8) {
            $errors['password'] = 'Password must be at least 8 characters <br/>';
        }
    }

    if (!array_filter($errors)) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // create sql
        $sql = "INSERT INTO user(username, fullname, email, userpassword) VALUES('$username', '$fullname', '$email', '$password')";

        // save to db and check
        if (mysqli_query($conn, $sql)) {
            // success
            $username = $fullname = $email = $password = '';
            $login = 'Registration succesful!';
        } else {
            // error
            $login = 'Registration failed!';
            echo 'query error: ' . mysqli_error($conn);
        }
    }
}

$name = 'Guest';

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<!--==========================
    Login Section
  ============================-->
<section id="intro">
    <div class="intro-container wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 border-right">
                    <h2 class="text-white">Login</h2>
                    <div class="container" style="padding: 40px 80px;">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <div style="height: 60px;"></div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="login_username" placeholder="Username" value="<?php echo htmlspecialchars($login_username); ?>">
                                <div class="text-warning"><?php echo $errors['login_username']; ?></div>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="login_password" placeholder="Password">
                                <div class="text-warning"><?php echo $errors['login_password']; ?></div>
                            </div>
                            <input type="submit" name="login" value="Login" class="about-btn">
                            <div class="text-warning"><?php echo $login; ?></div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 border-left">
                    <h2 class="text-white">Register new user</h2>
                    <div class="container" style="padding: 40px 80px;">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <div class="form-group">
                                <input class="form-control" type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>">
                                <div class="text-warning"><?php echo $errors['username']; ?></div>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="fullname" placeholder="Name" value="<?php echo htmlspecialchars($fullname); ?>">
                                <div class="text-warning"><?php echo $errors['fullname']; ?></div>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="email" placeholder="E-mail" value="<?php echo htmlspecialchars($email); ?>">
                                <div class="text-warning"><?php echo $errors['email']; ?></div>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" placeholder="Password">
                                <div class="text-warning"><?php echo $errors['password']; ?></div>
                            </div>
                            <input type="submit" name="register" value="Register" class="about-btn">
                            <div class="text-warning"><?php echo $register; ?></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('templates/footer.php'); ?>

</html>