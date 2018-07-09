<?php

/**
 * header short summary.
 *
 * header description.
 *
 * @version 1.0
 * @author Stavros
 */
?>
<!-- Top bar-->
<div class="top-bar">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-md-6 d-md-block d-none">
                <p>Wichtige Informationen finden sie hier:</p>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-md-end justify-content-between">
                    <ul class="list-inline contact-info d-block d-md-none">
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa fa-phone"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa fa-envelope"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="login">
                        <?php
                        if (!isset($_SESSION['anwender']))
                        {
                            echo ' <a href="#" data-toggle="modal" data-target="#login-modal" class="login-btn">
                                        <i class="fa fa-sign-in"></i>
                                        <span class="d-none d-md-inline-block">Sign In</span>
                                    </a>
                                    <a href="customer-register.php" class="signup-btn">
                                        <i class="fa fa-user"></i>
                                        <span class="d-none d-md-inline-block">Sign Up</span>
                                    </a>';

                        }else{
                            echo '  <a href="shop-basket.php" class="login-btn">
                                        <i class="fa fa-user"></i>
                                        <span class="d-none d-md-inline-block">My Shopping Cart</span>
                                    </a>
                                    <a href="customer-account.php" class="login-btn">
                                        <i class="fa fa-user"></i>
                                        <span class="d-none d-md-inline-block">My Account</span>
                                    </a>
                                        <a href="logout.php" class="login-btn">
                                        <i class="fa fa-sign-in"></i>
                                        <span class="d-none d-md-inline-block">Sign Out</span>
                                    </a>';
                        }

                        ?>
                    </div>
                    <ul class="social-custom list-inline">
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa fa-envelope"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top bar end-->

<!-- Login Modal-->
<div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true" class="modal fade">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="login-modalLabel" class="modal-title">Customer Login</h4>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="login_antwort.php" method="POST">
                    <div class="form-group">
                        <input name="anwender_name" type="text" placeholder="Anwendername" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input name="passwort" type="password" placeholder="passwort" class="form-control" />
                    </div>
                    <p class="text-center">
                        <button class="btn btn-template-outlined">
                            <i class="fa fa-sign-in"></i> Log in
                        </button>
                    </p>
                </form>
                <p class="text-center text-muted">Not registered yet?</p>
                <p class="text-center text-muted">
                    <a href="customer-register.php">
                        <strong>Register now</strong>
                    </a>! It is easy and done in 1 minute and gives you access to special discounts and much more!
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Login modal end-->