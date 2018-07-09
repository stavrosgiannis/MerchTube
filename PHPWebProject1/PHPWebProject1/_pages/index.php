<?php
//---------------------------------------------Top Modul wird includiert-------------------------------------------------------------
include '../_module/top.php';

?>

<div class="top-space"></div>

<div class="maincontent-area align-container">
    <br />

    <?php

    if (isset($_SESSION['anwender']))
    {
        var_dump ($_SESSION["anwender"]);
        print_r ($_SESSION["anwender"]->vorname);
    }
    if(isset($_SESSION['ereignis']))
    {
        if ($_SESSION['ereignis'] == 4)
        {
            echo "<h2>Sie wurden erfolgreich Eingelogt<h2 />";
            unset($_SESSION['ereignis']);
        }
        elseif ($_SESSION['ereignis'] == 5)
        {
            echo "<h2>Sie wurden erfolgreich Registriert</br>Weitere Einstellungen finden sie in ihrem Profil<h2 />";
            unset($_SESSION['ereignis']);
        }
    }
    // exit;
    ?>
    <div id="titel-container">

        <!-- Start Alphabet A area -->
        <div class="brands-area">
            <div class="container">
                <div class="row">
                    <a style="text-decoration:none;">
                        <h2 id="sort_a">#A</h2>
                    </a>
                    <div class="col-md-12">
                        <div class="brand-wrapper">
                            <div class="brand-list">
                                <a href="#">
                                    <img src="../_img/brand1.png" alt="" title="Nokia" />
                                </a>
                                <img src="../_img/brand2.png" alt="" />
                                <img src="../_img/brand3.png" alt="" />
                                <img src="../_img/brand4.png" alt="" />
                                <img src="../_img/brand5.png" alt="" />
                                <img src="../_img/brand6.png" alt="" />
                                <img src="../_img/brand1.png" alt="" />
                                <img src="../_img/brand2.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Alphabet A area -->

        <!-- Start Alphabet B area -->
        <!--<div class="brands-area">-->
        <div class="container">
            <div class="row">
                <a style="text-decoration:none;">
                    <h2 id="sort_b">#B</h2>
                </a>
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <div class="brand-list">
                            <a href="#">
                                <img src="../_img/brand1.png" alt="" title="Nokia" />
                            </a>
                            <img src="../_img/brand2.png" alt="" />
                            <img src="../_img/brand3.png" alt="" />
                            <img src="../_img/brand4.png" alt="" />
                            <img src="../_img/brand5.png" alt="" />
                            <img src="../_img/brand6.png" alt="" />
                            <img src="../_img/brand1.png" alt="" />
                            <img src="../_img/brand2.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--</div>-->
        <!-- End Alphabet B area -->

        <!-- Start Alphabet C area -->
        <div class="brands-area">
            <div class="container">
                <div class="row">
                    <a style="text-decoration:none;">
                        <h2 id="sort_c">#C</h2>
                    </a>
                    <div class="col-md-12">
                        <div class="brand-wrapper">
                            <div class="brand-list">
                                <a href="#">
                                    <img src="../_img/brand1.png" alt="" title="Nokia" />
                                </a>
                                <img src="../_img/brand2.png" alt="" />
                                <img src="../_img/brand3.png" alt="" />
                                <img src="../_img/brand4.png" alt="" />
                                <img src="../_img/brand5.png" alt="" />
                                <img src="../_img/brand6.png" alt="" />
                                <img src="../_img/brand1.png" alt="" />
                                <img src="../_img/brand2.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Alphabet C area -->

        <!-- Start Alphabet D area -->
        <div class="brands-area">
            <div class="container">
                <div class="row">
                    <a style="text-decoration:none;">
                        <h2 id="sort_d">#D</h2>
                    </a>
                    <div class="col-md-12">
                        <div class="brand-wrapper">
                            <div class="brand-list">
                                <a href="#">
                                    <img src="../_img/brand1.png" alt="" title="Nokia" />
                                </a>
                                <img src="../_img/brand2.png" alt="" />
                                <img src="../_img/brand3.png" alt="" />
                                <img src="../_img/brand4.png" alt="" />
                                <img src="../_img/brand5.png" alt="" />
                                <img src="../_img/brand6.png" alt="" />
                                <img src="../_img/brand1.png" alt="" />
                                <img src="../_img/brand2.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Alphabet D area -->

        <!-- Start Alphabet E area -->
        <div class="brands-area">
            <div class="container">
                <div class="row">
                    <a style="text-decoration:none;">
                        <h2 id="sort_e">#E</h2>
                    </a>
                    <div class="col-md-12">
                        <div class="brand-wrapper">
                            <div class="brand-list">
                                <a href="#">
                                    <img src="../_img/brand1.png" alt="" title="Nokia" />
                                </a>
                                <img src="../_img/brand2.png" alt="" />
                                <img src="../_img/brand3.png" alt="" />
                                <img src="../_img/brand4.png" alt="" />
                                <img src="../_img/brand5.png" alt="" />
                                <img src="../_img/brand6.png" alt="" />
                                <img src="../_img/brand1.png" alt="" />
                                <img src="../_img/brand2.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Alphabet E area -->

        <!-- Start Alphabet F area -->
        <div class="brands-area">
            <div class="container">
                <div class="row">
                    <a style="text-decoration:none;">
                        <h2 id="sort_f">#F</h2>
                    </a>
                    <div class="col-md-12">
                        <div class="brand-wrapper">
                            <div class="brand-list">
                                <a href="#">
                                    <img src="../_img/brand1.png" alt="" title="Nokia" />
                                </a>
                                <img src="../_img/brand2.png" alt="" />
                                <img src="../_img/brand3.png" alt="" />
                                <img src="../_img/brand4.png" alt="" />
                                <img src="../_img/brand5.png" alt="" />
                                <img src="../_img/brand6.png" alt="" />
                                <img src="../_img/brand1.png" alt="" />
                                <img src="../_img/brand2.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Alphabet F area -->

        <!-- Start Alphabet G area -->
        <div class="brands-area">
            <div class="container">
                <div class="row">
                    <a style="text-decoration:none;">
                        <h2 id="sort_g">#G</h2>
                    </a>
                    <div class="col-md-12">
                        <div class="brand-wrapper">
                            <div class="brand-list">
                                <a href="#">
                                    <img src="../_img/brand1.png" alt="" title="Nokia" />
                                </a>
                                <img src="../_img/brand2.png" alt="" />
                                <img src="../_img/brand3.png" alt="" />
                                <img src="../_img/brand4.png" alt="" />
                                <img src="../_img/brand5.png" alt="" />
                                <img src="../_img/brand6.png" alt="" />
                                <img src="../_img/brand1.png" alt="" />
                                <img src="../_img/brand2.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Alphabet G area -->

        <!-- Start Alphabet H area -->
        <div class="brands-area">
            <div class="container">
                <div class="row">
                    <a style="text-decoration:none;">
                        <h2 id="sort_h">#H</h2>
                    </a>
                    <div class="col-md-12">
                        <div class="brand-wrapper">
                            <div class="brand-list">
                                <a href="#">
                                    <img src="../_img/brand1.png" alt="" title="Nokia" />
                                </a>
                                <img src="../_img/brand2.png" alt="" />
                                <img src="../_img/brand3.png" alt="" />
                                <img src="../_img/brand4.png" alt="" />
                                <img src="../_img/brand5.png" alt="" />
                                <img src="../_img/brand6.png" alt="" />
                                <img src="../_img/brand1.png" alt="" />
                                <img src="../_img/brand2.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Alphabet H area -->

        <!-- Start Alphabet I area -->
        <div class="brands-area">
            <div class="container">
                <div class="row">
                    <a style="text-decoration:none;">
                        <h2 id="sort_i">#I</h2>
                    </a>
                    <div class="col-md-12">
                        <div class="brand-wrapper">
                            <div class="brand-list">
                                <a href="#">
                                    <img src="../_img/brand1.png" alt="" title="Nokia" />
                                </a>
                                <img src="../_img/brand2.png" alt="" />
                                <img src="../_img/brand3.png" alt="" />
                                <img src="../_img/brand4.png" alt="" />
                                <img src="../_img/brand5.png" alt="" />
                                <img src="../_img/brand6.png" alt="" />
                                <img src="../_img/brand1.png" alt="" />
                                <img src="../_img/brand2.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Alphabet I area -->

        <!-- Start Alphabet J area -->
        <div class="brands-area">
            <div class="container">
                <div class="row">
                    <a style="text-decoration:none;">
                        <h2 id="sort_j">#J</h2>
                    </a>
                    <div class="col-md-12">
                        <div class="brand-wrapper">
                            <div class="brand-list">
                                <a href="#">
                                    <img src="../_img/brand1.png" alt="" title="Nokia" />
                                </a>
                                <img src="../_img/brand2.png" alt="" />
                                <img src="../_img/brand3.png" alt="" />
                                <img src="../_img/brand4.png" alt="" />
                                <img src="../_img/brand5.png" alt="" />
                                <img src="../_img/brand6.png" alt="" />
                                <img src="../_img/brand1.png" alt="" />
                                <img src="../_img/brand2.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Alphabet J area -->
    </div>

    <div class="werbung-banner">
        <h2>Werbung Banner</h2>
        <p>420x800</p>
        <img src="../_img/werbung/werbung.jpg" alt="Werbung" />
    </div>
</div>

<?php
// --------------------------------------------Bottom------------------------------------------------------------->
include '../_module/bottom.php';
?>
<!-- Start Cookie Plugin -->
<script type="text/javascript">
    window.cookieconsent_options = {
        message: 'Diese Website nutzt Cookies, um bestm&ouml;gliche Funktionalit&auml;t bieten zu k&ouml;nnen.',
        dismiss: 'Ok, verstanden',
        learnMore: 'Mehr Infos',
        link: 'https://website-tutor.com/datenschutz',
        theme: 'dark-bottom'
    };
</script>
<script type="text/javascript" src="//s3.amazonaws.com/valao-cloud/cookie-hinweis/script-v2.js"></script>
<!-- Ende Cookie Plugin -->