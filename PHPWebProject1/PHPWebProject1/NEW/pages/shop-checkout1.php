<?php
//---------------------------------------------Top Modul wird inkludiert-------------------------------------------------------------
include '../module/top.php';
include '../class/kunde_DBC.php';
?>
<div class="top-space"></div>
<div id="maincontent-area align-container">
    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <h1 class="h2">Checkout - Address</h1>
                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb d-flex justify-content-end">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Checkout - Address</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container">
            <div class="row">
                <div id="checkout" class="col-lg-9">
                    <div class="box border-bottom-0">
                        <form method="get" action="shop-checkout2.php">
                            <ul class="nav nav-pills nav-fill">
                                <li class="nav-item"><a href="shop-checkout1.php" class="nav-link active"> <i class="fa fa-map-marker"></i><br>Address</a></li>
                                <li class="nav-item"><a href="#" class="nav-link disabled"><i class="fa fa-truck"></i><br>Delivery Method</a></li>
                                <li class="nav-item"><a href="#" class="nav-link disabled"><i class="fa fa-money"></i><br>Payment Method</a></li>
                                <li class="nav-item"><a href="#" class="nav-link disabled"><i class="fa fa-eye"></i><br>Order Review</a></li>
                            </ul>
                            <div class="content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">

                                            <label for="firstname">Firstname</label>
                                            <?php
                                            if(isset($_SESSION['anwender']))
                                            {
                                                $anwender = $_SESSION['anwender'];
                                                echo '<input id="firstname" type="text" class="form-control" value="'.$anwender->vorname.'">';
                                            }else{
                                                echo '<input id="firstname" type="text" class="form-control">';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="lastname">Lastname</label>
                                            <?php
                                            if(isset($_SESSION['anwender']))
                                            {
                                                $anwender = $_SESSION['anwender'];
                                                echo '<input id="lastname" type="text" class="form-control" value="'.$anwender->nachname.'">';
                                            }else{
                                                echo '<input id="lastname" type="text" class="form-control">';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="company">Company</label>
                                            <?php
                                            if(isset($_SESSION['anwender']))
                                            {
                                                $anwender = $_SESSION['anwender'];
                                                echo '<input id="company" type="text" class="form-control" value="'.$anwender->firmenname.'">';
                                            }else{
                                                echo '<input id="company" type="text" class="form-control">';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="street">Street</label>
                                            <?php
                                            if(isset($_SESSION['anwender']))
                                            {
                                                $anwender = $_SESSION['anwender'];
                                                echo '<input id="street" type="text" class="form-control" value="'.$anwender->rechnungsanschriftliste[0]->strasse.'">';
                                            }else{
                                                echo '<input id="street" type="text" class="form-control">';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <?php
                                            if(isset($_SESSION['anwender']))
                                            {
                                                $anwender = $_SESSION['anwender'];
                                                echo '<input id="city" type="text" class="form-control" value="'.$anwender->rechnungsanschriftliste[0]->ort.'">';
                                            }else{
                                                echo '<input id="city" type="text" class="form-control">';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="zip">ZIP</label>
                                            <?php
                                            if(isset($_SESSION['anwender']))
                                            {
                                                $anwender = $_SESSION['anwender'];
                                                echo '<input id="zip" type="text" class="form-control" value="'.$anwender->rechnungsanschriftliste[0]->plz.'">';
                                            }else{
                                                echo '<input id="zip" type="text" class="form-control">';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <select id="state" class="form-control">

                                                <option>NRW</option>
                                                <option>Michael Jackson</option>
                                                <option>Tom Waits</option>
                                                <option>Nina Hagen</option>
                                                <option>Marianne Rosenberg</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <select id="country" class="form-control">
                                                <option>Deutschland</option>
                                                <option>Michael Jackson</option>
                                                <option>Tom Waits</option>
                                                <option>Nina Hagen</option>
                                                <option>Marianne Rosenberg</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">Telephone</label>
                                            <?php
                                            if(isset($_SESSION['anwender']))
                                            {
                                                $anwender = $_SESSION['anwender'];
                                                echo '<input id="phone" type="text" class="form-control" value="'.$anwender->telefon.'">';
                                            }else{
                                                echo '<input id="phone" type="text" class="form-control">';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <?php
                                            if(isset($_SESSION['anwender']))
                                            {
                                                $anwender = $_SESSION['anwender'];
                                                echo '<input id="email" type="text" class="form-control" value="'.$anwender->email.'">';
                                            }else{
                                                echo '<input id="email" type="text" class="form-control">';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer d-flex flex-wrap align-items-center justify-content-between">
                                <div class="left-col"><a href="shop-basket.php" class="btn btn-secondary mt-0"><i class="fa fa-chevron-left"></i>Back to basket</a></div>
                                <div class="right-col">
                                    <button type="submit" class="btn btn-template-main">Continue to Delivery Method<i class="fa fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </form>
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
include '../module/bottom.php';
?>