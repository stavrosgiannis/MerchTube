<?php

/**
 * head short summary.
 *
 * head description.
 *
 * @version 1.0
 * @author Stavros
 */
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MerchTube</title>
    <link rel="shortcut icon" type="image/x-icon" href="../_img/fav.ico">

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../_css/bootstrap.min.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../_css/style.css" />
    <link rel="stylesheet" href="../_css/responsive.css" />
    <link rel="stylesheet" href="../_css/owl.carousel.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<?php

if (!isset($_SESSION["lang"]))
{
    $_SESSION["lang"] = "de";
}else if (isset($_GET["lang"]) && $_SESSION["lang"] != $_GET["lang"] && !empty($_GET["lang"]))
{
    if ($_GET["lang"] == "de")
    {
        $_SESSION["lang"] = "de";
    }else if ($_GET["lang"] == "en")
    {
        $_SESSION["lang"] = "en";
    }
}

require_once "../_languages/" . $_SESSION["lang"] . ".php";
?>