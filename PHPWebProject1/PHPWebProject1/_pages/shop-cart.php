<?php
//---------------------------------------------Top Modul wird includiert-------------------------------------------------------------
include '../_module/top.php';
include '../_class/kunde_DBC.php';
?>

<div class="top-space"></div>
<div class="maincontent-area align-container">

    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <h1 class="h2">Shopping Cart</h1>
                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb d-flex justify-content-end">
                        <li class="breadcrumb-item">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Shopping Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container">
            <div class="row bar">
                <!--<div class="col-lg-12">
                    <p class="text-muted lead">You currently have 3 item(s) in your cart.</p>
                </div>-->
                <div id="basket" class="col-lg-9">
                    <div class="box mt-0 pb-0 no-horizontal-padding">
                        <form method="get" action="shop-checkout1.php">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Quantity</th>
                                            <th>Unit price</th>
                                            <th>Discount</th>
                                            <th colspan="2">Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                        // --------------------------------------------Bottom------------------------------------------------------------->
                                        //datenbank connect
                                        $mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);
                                        //fall es nicht klappt gibt es ein error aus
                                        if ($mysqli->connect_errno)
                                        {
                                            echo "Anmeldung fehlgeschlagen: ". $mysqli->connect_errno;
                                            exit(0);
                                        }
                                        $anwender = $_SESSION['anwender'];
                                        $mysqli->set_charset("utf8");
                                        //liste ALLES aus denm warenkorb und die atikel aus
                                        $select_anweisung = "SELECT *
								                            FROM tbl_warenkorb AS w, tbl_artikel AS a
								                            WHERE w.artikel_id = a.id_artikel
								                            AND w.anwender_id = $anwender->id_anwender";
                                        if($ergebnismenge = $mysqli->query($select_anweisung)){
                                            while($datensatz = $ergebnismenge->fetch_assoc())
                                            {
                                                //falls 2 mal das gleiche produkt da ist soll auch der preis demendsprechend verhalten und sich erhöhen
                                                $totalpreis = $datensatz['preis']*$datensatz['menge'];

                                                echo '<tr>
                                                    <td>
                                                        <a href="#">';

                                                if(empty($datensatz['arikel_bild_id']))
                                                {
                                                    echo '<img style="height:17%;width:17%;" src="../_img/produkte/unset.jpg" alt="'.$datensatz['bezeichnug'].'" class="img-fluid" />';
                                                }else{
                                                    echo '<img style="height:17%;width:17%;" src="../_img/produkte/"'.$datensatz['artikel_bild'].'" alt="'.$datensatz['bezeichnug'].'" class="img-fluid" />';
                                                }

                                                echo '</a>
                                                    </td>
                                                    <td>
                                                        <a href="#">'.$datensatz['bezeichnug'].'</a>
                                                    </td>
                                                    <td>
                                                        <input type="number" value="'.$datensatz['menge'].'" class="form-control" />
                                                    </td>
                                                    <td>'.$datensatz['preis'].'€</td>
                                                    <td>0.00€</td>
                                                    <td>'.$totalpreis.'€</td>
                                                    <td>
                                                        <a href="#">
                                                            <i class="fa fa-trash-o"></i>
                                                        </a>
                                                    </td>
                                                       <td>
                                                           <a class="btn btn-default" href="../_module/loeschewarenkorbinhalt.php?typ=entfernen&id_artikel='.$datensatz['id_artikel'].'">Delete</a>
                                                        </td>
                                                </tr>';

                                            }
                                        }

                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">Total</th>
                                            <th colspan="2">
                                                4545€
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="box-footer d-flex justify-content-between align-items-center">
                                <div class="right-col">
                                    <button class="btn btn-secondary">
                                        <i class="fa fa-refresh"></i> Update cart
                                    </button>
                                    <button type="submit" class="btn btn-template-outlined">
                                        Proceed to checkout
                                        <i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--<div class="col-lg-3">
                    <div id="order-summary" class="box mt-0 mb-4 p-0">
                        <div class="box-header mt-0">
                            <h3>Order summary</h3>
                        </div>
                        <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>
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
                    <div class="box box mt-0 mb-4 p-0">
                        <div class="box-header mt-0">
                            <h4>Coupon code</h4>
                        </div>
                        <p class="text-muted">If you have a coupon code, please enter it in the box below.</p>
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" />
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-template-main">
                                        <i class="fa fa-gift"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br />
<?php
// --------------------------------------------Bottom------------------------------------------------------------->
include '../_module/loadscripts.php';
include '../_module/bottom.php';
?>