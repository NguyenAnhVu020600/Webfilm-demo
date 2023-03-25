<?php
require 'header.php';
?>
<div class="container-login">
        <div class="content">
            <div id="large-header" class="large-header">

                <h1>Login Form</h1>
                <div class="main-agileits">
                    <div class="form-w3-agile">
                        <h2>Login Now</h2>
                        <form action="action_login.php" method="post">
                            <div class="form-sub-w3">
                            <input type="text" name="email" placeholder="Email " required="" />
                                <div class="icon-w3">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="message_error">
                                <!-- @Html.ValidationMessageFor(model => model.email, "", new { @class = "text-danger" }) -->
                            </div>

                            <div class="form-sub-w3">
                            <input type="password" name="password" placeholder="Password" required="" />
                                <div class="icon-w3">
                                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="message_error">
                                <!-- @Html.ValidationMessageFor(model => model.password, "", new { @class = "text-danger" }) -->
                            </div>
                            <div class="message_error">
                                <?php
                                    include 'action_login.php';
                                    if(isset($_SESSION['thongbaologin']))
                                    {
                                        echo $_SESSION['thongbaologin'];
                                        unset($_SESSION['thongbaologin']);
                                    }
                                ?>
                                
                            </div>

                            <p class="p-bottom-w3ls">Forgot Password?<a href="#"> Click here</a></p>
                            <p class="p-bottom-w3ls1">&nbsp; New User?<a href="register.php"> Register here</a></p>
                            <div class="clear"></div>
                            <div class="submit-w3l">
                                <input type="submit" value="Login" name="login" class="btn btn-default">
                            </div>
                            <div class="social w3layouts">
                                <div class="heading">
                                    <h6>Or Login with</h6>
                                    <div class="clear"></div>
                                </div>
                                <div class="icons">
                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-google" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>

                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>

                            </div>
                        </form>
                    </div>

                </div>
                <div class="copyright w3-agile">
                    <p class="p-bottom-w3ls2"><a href="index.php">Trang chủ</a></p>
                </div>
            </div>
        </div>
    </div>