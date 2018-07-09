<?php
//---------------------------------------------Top Modul wird includiert-------------------------------------------------------------
include '../module/top.php';

?>

<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">New Account / Sign In</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item">
                        <a href="index.php">Home</a>
                    </li>
                    <li class="breadcrumb-item active">New Account / Sign In</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="box">
                    <h2 class="text-uppercase">New account</h2>
                    <p class="lead">Not our registered customer yet?</p>
                    <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The whole process will not take you more than a minute!</p>
                    <p class="text-muted">
                        If you have any questions, please feel free to
                        <a href="contact.php">contact us</a>, our customer service center is working for you 24/7.
                    </p>
                    <hr />
                    <form action="registrierung_antwort.php" method="POST">
                        <div class="form-group">
                            <label for="anwender_name">Anwendername</label>
                            <input name="anwender_name" type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="passwort">Passwort</label>
                            <input name="passwort" type="password" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="Vorname">Vorname</label>
                            <input name="Vorname" type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="Nachname">Nachname</label>
                            <input name="Nachname" type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input name="Email" type="email" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse:</label>
                            <input name="adresse" type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="hausnummer">Hausnummer</label>
                            <input name="hausnummer" type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="plz">PLZ</label>
                            <input name="plz" type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="ort">Ort</label>
                            <input name="ort" type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="land">Land</label>
                            <input name="land" type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="frage1">Frage1: Wer ist ihr Lieblings Superheld?</label>
                            <input name="frage1" type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="frage2">Frage2: Was ist ihr Lieblings Essen?</label>
                            <input name="frage2" type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="frage3">Frage3: Wer ist ihr Lieblings Promi?</label>
                            <input name="frage3" type="text" class="form-control" />
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-template-outlined">
                                <i class="fa fa-user-md"></i> Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="box">
                    <h2 class="text-uppercase">Login</h2>
                    <p class="lead">Already our customer?</p>
                    <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                    <hr />
                    <form action="login_antwort.php" method="POST">
                        <div class="form-group">
                            <label for="anwender_name">Anwendername</label>
                            <input name="anwender_name" type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="passwort">Passwort</label>
                            <input name="passwort" type="password" class="form-control" />
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-template-outlined">
                                <i class="fa fa-sign-in"></i> Log in
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// --------------------------------------------Bottom------------------------------------------------------------->
include '../module/bottom.php';
?>