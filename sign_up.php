<?php $currentPage = "Sign UP"; ?>
<?php require_once("includes/header.php"); ?>

    <div class="container">
        <div class="content">
            <h2 class="heading">Sign Up</h2>

            <?php
                //google recaptcha
                $public_key = "6LfD244UAAAAAI6ot-UBtAxvy9bzBwuX8-ZyX0fl";
                $private_key = "6LfD244UAAAAAIPYM-neiOvPsRNTKxXoKJOqZOUd";
                $url = "https://www.google.com/recaptcha/api/siteverify";

                if(isset($_POST['sign-up'])) {

                    //Google recaptcha
                    $response_key = $_POST['g-recaptcha-response'];

                    //https://www.google.com/recaptcha/api/siteverify?secret=$private_key&response=$response_key&remoteip=currentScriptIpAddress
                    $response = file_get_contents($url . "?secret=" . $private_key . "&response=" . $response_key . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
                    $response = json_decode($response);
                    
                    if(!($response->success == 1)) {
                        $errCaptcha = "Wrong captcha";
                    }
                    
                    $first_name     = escape($_POST['first_name']);
                    $last_name      = escape($_POST['last_name']);
                    $user_name      = escape($_POST['user_name']);
                    $user_email     = escape($_POST['user_email']);
                    $user_pass      = escape($_POST['user_password']);
                    $user_con_pass  = escape($_POST['user_confirm_password']);

                    //first name validation
                    $pattern_fn = "/^[a-zA-Z ]{3,12}$/";
                    if(!preg_match($pattern_fn, $first_name)) {
                        $errFn = "Must be at lest 3 character long, letter and space allowed";
                    }

                    //last name validation
                    $pattern_ln = "/^[a-zA-Z ]{3,12}$/";
                    if(!preg_match($pattern_ln, $last_name)) {
                        $errLn = "Must be at lest 3 character long, letter and space allowed";
                    }

                    //user name validation
                    //at lest 3 character, letter, numeber and underscore allowed
                    $pattern_un = "/^[a-zA-Z0-9_]{3,16}$/";
                    if(!preg_match($pattern_un, $user_name)) {
                        $errUn = "Must be at lest 3 character long, letter, number and underscore allowed";
                    }

                    //email validation
                    //filter_var($user_email, FILTER_VALIDATE_EMAIL);
                    $pattern_ue = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i";
                    if(!preg_match($pattern_ue, $user_email)) {
                        $errUe = "Invalid format of email";

                    }

                    if($user_pass == $user_con_pass) {
                        //password validation
                        $pattern_up = "/^.*(?=.{4,56})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/";
                        if(!preg_match($pattern_up, $user_pass)) {
                            $errPass = "Must be at lest 4 character long, 1 upper case, 1 lower case letter and 1 number exist";
                        }
                    } else {
                        $errPass = "Password dosen't matched";
                    }
                    
                    if(!isset($errFn) && !isset($errLn) && !isset($errUn) && !isset($errUe) && !isset($errPass) && !isset($errCaptcha)) {
                        $hash = password_hash($user_pass, PASSWORD_BCRYPT, ['cost'=>10]);
                        date_default_timezone_set("asia/dhaka");
                        $date = date("Y-m-d H:i:s");
                        
                        $query = "INSERT INTO users (first_name, last_name, user_name, user_email, user_password, validation_key, registration_date) VALUES ('$first_name', '$last_name', '$user_name', '$user_email', '$hash', 0, '$date')";
                        $query_conn = mysqli_query($connection, $query);
                        if(!$query_conn) {
                            die("Query failed" . mysqli_error($connection));
                        } else {
                            echo "<div class='notification'>Sign up successful</div>";
                        }

                    }
                    
                }

            ?>

            <!-- <div class='notification'>Sign up successful. Check your email for activation link</div> -->
            <form action="sign_up.php" method="POST">
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="First name" name="first_name" autocomplete="off">
                    <?php echo isset($errFn)?"<span class='error'>{$errFn}</span>":""; ?>
                </div>
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="Last name" name="last_name" autocomplete="off">
                    <?php echo isset($errLn)?"<span class='error'>{$errLn}</span>":""; ?>
                </div>
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="Username" name="user_name" autocomplete="off">
                    <?php echo isset($errUn)?"<span class='error'>{$errUn}</span>":""; ?>
                </div>
                <div class="input-box">
                    <input type="email" class="input-control" placeholder="Email address" name="user_email" autocomplete="off">
                    <?php echo isset($errUe)?"<span class='error'>{$errUe}</span>":""; ?>
                </div>
                <div class="input-box">
                    <input type="password" class="input-control" placeholder="Enter password" name="user_password" autocomplete="off">
                    <?php echo isset($errPass)?"<span class='error'>{$errPass}</span>":""; ?>
                </div>
                <div class="input-box">
                    <input type="password" class="input-control" placeholder="Confirm password" name="user_confirm_password" autocomplete="off">
                    <?php echo isset($errPass)?"<span class='error'>{$errPass}</span>":""; ?>
                </div>
                <div class="g-recaptcha" data-sitekey="<?php echo $public_key; ?>"></div>
                <?php echo isset($errCaptcha)?"<span class='error'>{$errCaptcha}</span>":""; ?>
                <div class="input-box">
                    <input type="submit" class="input-submit" value="SIGN UP" name="sign-up">
                </div>
                <div class="sign-up-cta"><span>Already have an account?</span> <a href="login.php">Login here</a></div>
            </form>

        </div>
    </div>

<?php require_once("includes/footer.php"); ?>