<?php
use Bazaar\Classes\Company;
use Bazaar\Classes\Offer;
use \Bazaar\Classes\User;

include_once 'start.php';

session_start();

$page = 'placeOffer';
$stepNumber = 2;

if(isset($_SESSION['companyID'])){

    $company = new Company();
    $company->getCompanyData($_SESSION['companyID']);
    $value = $_SESSION['value'];
    $valuePrice = $value * 1.5;
    $participations = $_SESSION['participations'];
    $placement = $_SESSION['placement'];

    if($placement == 'list'){
        $placement = 'aanbiedingenlijst';
        $placementPrice = 10;
    } else {
        $placement = 'Homepagina + <br>aanbiedingenlijst';
        $placementPrice = 30;
    }

    $totalPrice = $valuePrice + $placementPrice;
    $_SESSION['totalPrice'] = $totalPrice;

    $documentNumber = time();
    $date = date('d/m/Y', $documentNumber);

    $dueDate = strtotime('+3 weeks');
    $dueDate = date('d/m/Y', $dueDate);

} else if (isset($_SESSION['userID'])){
    header('Location: index.php');
} else {
    header('Location: Bazaar/register.php');
}

?><!doctype html>
<html lang="en">
<head>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,600,800" rel="stylesheet">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/steps.css">
    <link rel="stylesheet" href="css/placeOffer.css">
    <title>Plaats uw aanbieding</title>
</head>
<body>

    <?php include_once 'nav.inc.php'?>

    <section class="main">

        <?php include_once 'steps.inc.php'?>

        <div class="secondStep">

            <div class="heading">
                <p>nr. <?php echo $documentNumber?></p>
                <p id="documentDate"><?php echo $date ?></p>
            </div>


            <div class="companyInfo">
                <p><?php echo $company->getCompanyname()?></p>
                <p><?php echo $company->getAddress()?></p>
                <p>2800 Mechelen</p>
            </div>

            <div class="document">
                <h1>Offerte</h1>
                <h2>Aanbieding KVBazaar</h2>
                <div>
                    <p class="product">Actie</p>
                    <p class="price">&euro;<?php echo $valuePrice?></p>
                </div>
                <div>
                    <p class="product"><?php echo $placement?></p>
                    <p class="price">&euro;<?php echo $placementPrice?></p>
                </div>
                <div class="total">
                    <p class="product">Totaal (incl. BTW)</p>
                    <p class="price">&euro;<?php echo $totalPrice?></p>
                </div>

                <p id="dueDate">Te betalen voor <?php echo $dueDate?></p>

            </div>

            <div class="buttons">
                <a href="place_offer_step1.php" id="change">wijzig</a>
                <a href="place_offer_step3.php" id="confirm">bevestig</a>
            </div>

        </div>

    </section>

</body>
</html>