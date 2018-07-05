<?php
//---------------------------------------------Top Modul wird inkludiert-------------------------------------------------------------
include '../_module/top.php';
include '../_class/kunde_DBC.php';
?>
<div class="top-space"></div>
<div id="maincontent-area align-container">

    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <h1 class="h2">Checkout - Order Review</h1>
                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb d-flex justify-content-end">
                        <li class="breadcrumb-item">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Checkout - Order Review</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container">
            <div class="row">
                <div id="checkout" class="col-lg-9">
                    <div class="box">
                        <form method="get" action="shop-checkout4.php">
                            <ul class="nav nav-pills nav-fill">
                                <li class="nav-item">
                                    <a href="shop-checkout1.php" class="nav-link">
                                        <i class="fa fa-map-marker"></i>
                                        <br />Address
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="shop-checkout2.php" class="nav-link">
                                        <i class="fa fa-truck"></i>
                                        <br />Delivery Method
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="shop-checkout3.php" class="nav-link">
                                        <i class="fa fa-money"></i>
                                        <br />Payment Method
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="shop-checkout4.php" class="nav-link active">
                                        <i class="fa fa-eye"></i>
                                        <br />Order Review
                                    </a>
                                </li>
                            </ul>
                        </form>
                        <div class="content">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Quantity</th>
                                            <th>Unit price</th>
                                            <th>Discount</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $warenkorb = $_SESSION['warenkorb'];

                                        $i = 0;
                                        foreach ($warenkorb as $value)
                                        {
                                            $summe = ($warenkorb[$i]->menge * $warenkorb[$i]->preis);
                                            echo ' <tr>
                                            <td>
                                                <a href="#">
                                                    <img src="../_img/produkte/'.$warenkorb[$i]->artikel_bild.'" alt="'.$warenkorb[$i]->bezeichnung.'" />
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#">'.$warenkorb[$i]->bezeichnung.'</a>
                                            </td>
                                            <td>'.$warenkorb[$i]->menge.'</td>
                                            <td>'.$warenkorb[$i]->preis.'EUR</td>
                                            <td>0.00EUR</td>
                                            <td>'.$summe.'EUR</td>
                                        </tr>';
                                            var_dump($warenkorb[$i]);
                                            $i++;
                                        }

                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">Total</th>
                                            <th>446.00EUR</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer d-flex flex-wrap align-items-center justify-content-between">
                            <div class="left-col">
                                <a href="shop-checkout3.php" class="btn btn-secondary mt-0">
                                    <i class="fa fa-chevron-left"></i>Back to payment method
                                </a>
                            </div>
                            <div class="right-col">
                                <button type="submit" class="btn btn-template-main">
                                    Place the order
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="col-lg-3">
                    <div id="order-summary" class="box mb-4 p-0">
                        <div class="box-header mt-0">
                            <h3>Order summary</h3>
                        </div>
                        <p class="text-muted text-small">Shipping and additional costs are calculated based on the values you have entered.</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Order subtotal</td>
                                        <th>$446.00</th>
                                    </tr>
                                    <tr>
                                        <td>Shipping and handling</td>
                                        <th>$10.00</th>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <th>$0.00</th>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <th>$456.00</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>
<br />
<?php
include '../_module/loadscripts.php';
include '../_module/bottom.php';
?>