<?php

include 'config.php';
include 'header.php';



$sql = "SELECT * FROM user";
$data = mysqli_query($conn, $sql);

$farr  = $earr = $parr = $garr = $hobbyarr = $filearr = '';

if (isset($_POST['register'])) {

    $extension = ['jpg', 'jpeg', 'png', 'PNG', 'JPEG', 'JPG'];
    $size = $_FILES['file']['size'];

    $email = $_POST['email'];
    $q = "select * from user where email='$email'";
    $c = mysqli_query($conn, $q);
    $arr = mysqli_num_rows($c);

    if (empty($_POST['fname'])) {         //fname
        $farr = "required first name";
    } elseif (!preg_match('/^[A-Za-z]*$/', $_POST['fname'])) {
        $farr = "only letter allowed";
    } elseif (empty($_POST['email'])) {     //email
        $earr = "required email";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $earr = "invalid email formet";
    } elseif ($arr > 0) {
        $earr = "email already exist";
    } elseif (empty($_POST['pass'])) {      //password
        $parr = "required password";
    } elseif (!preg_match("/[a-z]+/", $_POST['pass'])) {
        $parr = "one lower and special charachter must be required";
    } elseif (!preg_match("/[A-Z]+/", $_POST['pass'])) {
        $parr = "one upper character must be required";
    } elseif (!preg_match("/[0-9]/", $_POST['pass'])) {
        $parr = "one degit must be required";
    } elseif (!preg_match("/['@,$,!,%,*,#,?,&']/", $_POST['pass'])) {
        $parr = "one special must be required";
    } elseif (strlen($_POST['pass']) < 8) {
        $parr = "maximum 8 length required";
    } elseif (empty($_POST['gender'])) {        //gender    
        $garr = "required gender";
    } elseif (empty($_POST['hobby'])) {        //hobby
        $hobbyarr = "required interest";
    } elseif (!file_exists($_FILES['file']['tmp_name'])) {      //file
        $filearr = "file must be selectd";
    } elseif (!in_array(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION), $extension)) {
        $filearr = "file must be .jpg .png .jpeg required";
    } else {

        $fname = $_POST['fname'];
        $email = $_POST['email'];
        $pass = base64_encode($_POST['pass']);
        $gender = $_POST['gender'];
        $hobby = $_POST['hobby'];
        $String = implode(',', $hobby);
        $jsonString = json_encode($String);


        $tar_dir = 'image/';
        $path = $tar_dir . basename($_FILES['file']['name']);
        $file = move_uploaded_file($_FILES['file']['tmp_name'], $path);

        if ($file) {
            echo "Successfully uploaded";
        } else {
            echo "Not uploaded because of error #" . $_FILES["file"]["error"];
        }

        $insert = "INSERT INTO user (`name`,`email`,`password`,`gender`,`interest`,`image`) 
                    VALUES ('$fname','$email','$pass','$gender','$jsonString','$path')";

        $data = mysqli_query($conn, $insert);
        if ($data) {
            header('location:login.php');
        } else {
            echo mysqli_error($conn);
        }
    }
}

?>

<div class="pic">
    <div class="container h-100">
        <section>
            <div class="design">

                <form action="" method="post" enctype="multipart/form-data" id="Register">
                    <h2 class="text-center p-2">Register User</h2>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-outline p-2">
                                <label class="form-label" for="fname">Name</label>
                                <span class="error">*<?php echo $farr; ?></span>
                                <input type="text" name="fname" id="fname" class="form-control" value="<?php if (isset($_POST['fname'])) {
                                                                                                            echo $_POST['fname'];
                                                                                                        } ?>" />
                                <label id="fname-error" class="error" for="fname"></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-outline p-2">
                                <label class="form-label" for="email">Email</label>
                                <span class="error">*<?php echo $earr; ?></span>
                                <input type="text" name="email" id="email" class="form-control" value="<?php if (isset($_POST['email'])) {
                                                                                                            echo $_POST['email'];
                                                                                                        } ?>" />
                                <label id="email-error" class="error" for="email"></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-outline p-2">
                                <label class="form-label" for="pass">Password</label>
                                <span class="error">*<?php echo $parr; ?></span>
                                <input type="password" name="pass" id="pass" class="form-control" value="<?php if (isset($_POST['pass'])) {
                                                                                                                echo $_POST['pass'];
                                                                                                            } ?>" />
                                <label id="pass-error" class="error" for="pass"></label>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="form-outline p-2">Gender: </label>
                            <span class="error">*<?php echo $garr; ?></span><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="male" <?php if ($_POST['gender'] == 'male') {
                                                                                                            echo "checked='checked'";
                                                                                                        } ?> checked />
                                <label class="form-check-label" for="gender">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="female" <?php if ($_POST['gender'] == 'female') {
                                                                                                                echo "checked='checked'";
                                                                                                            } ?> />
                                <label class="form-check-label" for="gender">Female</label>
                            </div>
                            <label id="gender-error" class="error" for="gender"></label><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-outline p-2">Interest : </label>
                            <span class="error">*<?php echo $hobbyarr; ?></span>
                            <div class="form-check">
                                <input type="checkbox" name="hobby[]" id="reading" class="form-check-input ml-0" value="reading">
                                <label class="form-check-label" for="reading">
                                    Reading
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobby[]" id="writing" class="form-check-input" value="writing">
                                <label class="form-check-label" for="writing">
                                    writing
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobby[]" id="coding" class="form-check-input" value="coding">
                                <label class="form-check-label" for="coding">
                                    coding
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="hobby[]" id="playing" class="form-check-input" value="playing">
                                <label class="form-check-label" for="playing">
                                    playing
                                </label>
                            </div>
                            <label id="hobby[]-error" class="error" for="hobby[]"></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-outline p-2">
                                <label class="form-label" for="photo">Attachment:</label>
                                <span class="error">*<?php echo $filearr; ?></span>
                                <input type="file" name="file" class="form-control form-control-md" id="photo" />
                                <label id="photo-error" class="error" for="photo"></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-check d-flex justify-content-start pt-2">
                                <input class="form-check-input me-2 p-2" type="checkbox" value="" id="form2Example3cg" />
                                <label class="form-check-label" for="form2Example3g">
                                    I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="pt-3 d-flex justify-content-center">
                        <button class="btn btn-lg btn-dark" name="register" type="submit">Register</button>
                    </div>
                    <p class="text-center text-muted mt-3 mb-0">Have already an account? <a href="login.php" class="fw-bold text-body"><u>Login here</u></a></p>
                </form>
            </div>

        </section>
    </div>
</div>

<script>
    $(document).ready(function() {
        // register

        jQuery.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || /^[A-Za-z ]+$/.test(value)
        });


        jQuery.validator.addMethod("regex", function(value, element) {
            return this.optional(element) || /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[a-zA-Z0-9!@#$%&*]+$/.test(value)
        });

        // register
        validator = $("#Register").validate({
            rules: {
                fname: {
                    required: true,
                    alpha:true
                },
                email: {
                    required: true,
                    email:true
                },
                pass: {
                    required: true,
                    regex:true,
                    maxlength: 8,
                },
                gender: {
                    required: function(elem) {
                        return $("input.select:checked").length >= 0;
                    },
                },
                "hobby[]": {
                    required: function(elem) {
                        return $("input.select:checked").length >= 0;
                    },
                },
                file: {
                    required: true,
                },
            },
            messages: {
                fname: {
                    required: "please enter your first name",
                },
                email: {
                    required: "enter your email",
                    email:"email format is invalid"
                    // remote: "Email already in use!"
                },
                pass: {
                    required: " enter password",
                    regex:"At least one capital small character and one number and special character must be requird",
                    maxlength: "8 alllowed",
                },
                gender: {
                    required: "select gender",
                },
                "hobby[]": {
                    required: "select interest",
                },
                file: {
                    required: "select photo",
                },
            },
        });

    });
</script>