<?php

/**
 * menu short summary.
 *
 * menu description.
 *
 * @version 1.0
 * @author Stavros
 */
?>

<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="">
                        <a href="index.php">
                            <?php echo $lang["Home"]; ?>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <?php echo $lang["Shop"]; ?>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <?php echo $lang["Products"]; ?>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <?php echo $lang["Search"]; ?>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <?php echo $lang["Contact"]; ?>
                        </a>
                    </li>
                    <li>
                        <form action="suche_antwort.php" method="post">
                            <input name="sucheingabe" type="text" maxlength="100" placeholder="Suche..." />
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div><!-- End mainmenu area -->