<?php

include 'config.php';
include 'header.php';

session_start();

if (isset($_SESSION['id'])) {
    header('location:display.php');
}
if (isset($_COOKIE['id'])) {
    header('location:display.php');
}

$emailarr = $passarr = '';

if (isset($_POST['login'])) {


    if (empty($_POST['email'])) {
        $emailarr = "required";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailarr = "invalid email formet";
    } elseif (empty($_POST['pass'])) {
        $passarr = "required";
    } elseif (!preg_match("/[A-Z]/", $_POST['pass'])) {
        $passarr = "one uppper charachter must be required";
    } elseif (!preg_match("/[a-z]+/", $_POST['pass'])) {
        $passarr = "one lower charachter must be required";
    } elseif (!preg_match("/[0-9]/", $_POST['pass'])) {
        $passarr = "one degit must be required";
    } elseif (!preg_match("/['@,$,!,%,*,#,?,&']/", $_POST['pass'])) {
        $passarr = "one special must be required";
    } elseif (strlen($_POST['pass']) < 8) {
        $passarr = "maximum 8 length required";
    } else {

        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $sql = "SELECT * FROM user where email = '$email'";
        $data = mysqli_query($conn, $sql);
        $arr = mysqli_fetch_assoc($data);

        if ($arr['email'] == $email || base64_decode($arr['password']) == $pass) {

            $_SESSION['id'] = $arr['id'];
            setcookie('id', $arr['id'], time() + 60 * 10);

            header('location:display.php');
        }

        $emailarr =  "email dose not exist";
    }
}

?>

<div class="pic">
    <div class="container h-100">
        <section>
            <div class="design">

                <form action="" method="post" id="loginForm">
                    <h2 class="text-center p-3">Login</h2>

                    <div class="row">
                        <div class="col-12 mb-1">
                            <div class="form-outline p-2">
                                <label class="form-label" for="emailAddress">Email</label>
                                <span class="error">*<?php echo $emailarr; ?></span>
                                <input type="text" name="email" id="emailAddress" class="form-control" value="<?php if (isset($_POST['email'])) {
                                                                                                                    echo $_POST['email'];
                                                                                                                } ?>" />
                                <label id="emailAddress-error" class="error" for="emailAddress"></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-1">
                            <div class="form-outline p-2">
                                <label class="form-label" for="passAddress">Password</label>
                                <span class="error">*<?php echo $passarr; ?></span>
                                <input type="password" name="pass" id="passAddress" class="form-control" value="<?php if (isset($_POST['pass'])) {
                                                                                                                    echo $_POST['pass'];
                                                                                                                } ?>" />
                                <label id="passAddress-error" class="error" for="passAddress"></label>
                            </div>
                        </div>
                    </div>

                    <div class="pt-3 d-flex justify-content-center">
                        <button class="btn btn-lg btn-dark" name="login" type="submit">Login</button>
                    </div>

                    <p class="text-center text-muted mt-3 mb-0">Have already an account? <a href="register.php" class="fw-bold text-body"><u>Register here</u></a></p>
                </form>
            </div>

        </section>
    </div>
</div>

<script>
    $(document).ready(function() {

        //   login
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email:true
                },
                pass: {
                    required: true,
                    maxlength: 8,
                },
            },
            messages: {
                email: {
                    required: "please enter  email ",
                },
                pass: {
                    required: "enter password",
                },
            },
        });
    });
</script>