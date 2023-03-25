<?php
session_start();
require 'header_log.php';
?>
<div class="container-login">
        <div class="content">
            <div id="large-header" class="large-header">
                <h1>Register Form</h1>
                <div class="main-agileits1">
                    <!--form-stars-here-->
                    <div class="form-w3-agile">
                        <h2>Register Now</h2>
                        <form action="action_register.php" method="post">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12 col-12">
                                    <div class="form-sub-w3">
                                    <input type="text" name="email" placeholder="Email" required="" />
                                        <div class="icon-w3">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="message_error">
                                        <!-- @Html.ValidationMessageFor(model => model.email, "", new { @class = "text-danger" }) -->
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 col-12">
                                    <div class="form-sub-w3">
                                    <input type="text" name="username" placeholder="Tên tài khoản" required="" />
                                        <div class="icon-w3">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="message_error">
                                        
                                    </div>
                                </div>


                                <div class="col-md-6 col-sm-12 col-xs-12 col-12">
                                    <div class="form-sub-w3">
                                    <input type="password" name="password" placeholder="Password" minlength="7" required="" />
                                        <div class="icon-w3">
                                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="message_error">
                                        
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 col-12">
                                    <div class="form-sub-w3">
                                    <input type="password" name="confirm_password" placeholder="Confirm Password" minlength="7" required="" />
                                        <div class="icon-w3">
                                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="message_error">
                                        <!-- @Html.ValidationMessageFor(model => model.confirm_password, "", new { @class = "text-danger" }) -->

                                    </div>
                                </div>
                            </div>
                            <div class="message_error">
                                <?php
                                    include "action_register.php";
                                    
                                    if(isset($_SESSION['register']))
                                    {
                                        
                                        echo $_SESSION['register'];
                                        unset ($_SESSION['register']);
                                    }
                                ?>
                            </div>
                            <div class="submit-w3l">
                                <input type="submit" value="Register" name="register" class="btn btn-default">
                            </div>

                            <div class="social w3layouts">
                                <p class="p-bottom-w3ls2">User? <a href="login.php"> Login here</a></p>
                                <div class="heading">
                                    <h6>Or Login with</h6>
                                    <div class="clear"></div>
                                </div>
                                <div class="icons" style="padding-left:255px">
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
                    <!--//form-ends-here-->
                </div><!-- copyright -->
                <div class="copyright w3-agile">
                    <p> © 2017 Clean Login Form . All rights reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a></p>
                </div>
            </div>

        </div>
    </div>