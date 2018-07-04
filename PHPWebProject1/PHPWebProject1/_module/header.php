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

<header>
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            <li>
                                <a href="myaccount.php">
                                    <i class="fa fa-user"></i><?php echo $lang["MyAccount"]; ?>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-heart"></i><?php echo $lang["MyWishlist"]; ?>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-user"></i><?php echo $lang["Cart"]; ?>
                                </a>
                            </li>
                            <?php
                            if (isset($_SESSION['anwender']))
                            { ?>
                            <li>
                                <a href="logout.php">
                                    <i class="fa fa-user"></i><?php echo $lang["Logout"]; ?>
                                </a>
                            </li>

                            <?php
                            }
                            else
                            { ?>
                            <li>
                                <a href="login_anfrage.php">
                                    <i class="fa fa-user"></i><?php echo $lang["Login"]; ?>
                                </a>
                            </li>
                            <?php
                            }

                            ?>  
                        </ul>
                    </div>
                </div>
							

                <div class="col-md-4">
                    <div class="header-right">
                        <ul class="list-unstyled list-inline">
                            <!--<li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#">
                                    <span class="key">
                                        <?php echo $lang["Currency"]; ?>:
                                    </span>
                                    <span class="value">EUR </span>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#">USD</a>
                                    </li>
                                    <li>
                                        <a href="#">EUR</a>
                                    </li>
                                    <li>
                                        <a href="#">GBP</a>
                                    </li>
                                </ul>
                            </li>-->

                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#">
                                    <span class="key">
                                        <?php echo $lang["Language"]; ?>
                                    </span>
                                    <span class="value"></span>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="?lang=en">Englisch</a>
                                    </li>
                                    <li>
                                        <a href="?lang=de">Deutsch</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End header area -->
</header>