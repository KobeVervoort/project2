<?php

use Bazaar\Classes\Company;
use Bazaar\Classes\Offer;
use Bazaar\Classes\User;

include_once 'start.php';

session_start();
$page = "companyProfile";

if(isset($_SESSION['companyID'])) {

    $company = new Company();
    $company->getCompanyData($_SESSION['companyID']);

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
    <link rel="stylesheet" href="css/company_profile.css">
    <title>profiel</title>
</head>
<body>
<?php include_once 'nav.inc.php'?>

<section class="profileHeader">

    <?php if($company->getLogo() == null):?>

        <div class="defaultProfile">
            <p class="initials"><?php echo substr($company->getCompanyname(), 0, 2);?></p>
        </div>

    <?php else:?>

        <img class="profilePic" src="<?php echo BASE_URL . 'Bazaar/uploads/' . $company->getLogo();?>" alt="<?php echo $company->getCompanyname();?>'s logo">

    <?php endif;?>

    <h1><?php echo $company->getCompanyname();?></h1>

</section>

<section class="main">

    <div class="offerButtons">

        <button id="information" class="active">gegevens</button>
        <button id="payments" >betalingen</button>

    </div>

    <div class="profileInfo">

        <h2>Contact</h2>

        <div class="contact">
            <h3>Naam</h3>
            <p><?php echo $company->getCompanyname()?></p>

            <h3>Email</h3>
            <p><?php echo $company->getEmail()?></p>

            <h3>Tel</h3>
            <p><a href="#">toevoegen</a></p>
        </div>

        <h2>Bedrijfsgegevens</h2>

        <div class="bedrijfsgegevens">

            <h3>Adres</h3>
            <p><?php echo $company->getAddress()?> <br> 2800 <?php echo $company->getCity()?></p>
            <h3>Openingsuren</h3>
            <p><a href="#">toevoegen</a></p>

        </div>

        <a class="logout" href="logout.php">log uit</a>

    </div>

    <ul class="payments">
        <li class="payment">
            <div class="overlay">
                <p id="nr">nr. 56890401</p>
                <p id="date">04/04/2017</p>
            </div>
            <div class="paymentInfo">
            <p><span>Aan </span>Pascal Hendrickx</p>
            <p><span>Bedrag </span>€24,5</p>
            <p id="statusOpen"><span>Status </span>open</p>
            </div>
        </li>

        <li class="payment">
            <div class="overlay">
                <p id="nr">nr. 67100649</p>
                <p id="date">05/03/2017</p>
            </div>
            <div class="paymentInfo">
                <p><span>Aan </span>Pascal Hendrickx</p>
                <p><span>Bedrag </span>€12,2</p>
                <p id="statusPayed"><span>Status </span>betaald</p>
            </div>
        </li>

        <li class="payment">
            <div class="overlay">
                <p id="nr">nr. 02268416</p>
                <p id="date">10/02/2017</p>
            </div>
            <div class="paymentInfo">
                <p><span>Aan </span>Pascal Hendrickx</p>
                <p><span>Bedrag </span>€24,5</p>
                <p id="statusPayed"><span>Status </span>betaald</p>
            </div>
        </li>

    </ul>

</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var informationButton = $('#information');
        var paymentsButton = $('#payments');

        var information = $('.profileInfo');
        var payments = $('.payments');

        informationButton.on('click', function (e) {
            e.preventDefault();

            informationButton.addClass('active');
            paymentsButton.removeClass('active');

            information.css({display: 'block'});
            payments.css({display: 'none'});
        });

        paymentsButton.on('click', function (e) {
            e.preventDefault();

            paymentsButton.addClass('active');
            informationButton.removeClass('active');

            payments.css({display: 'block'});
            information.css({display: 'none'});
        });

        $('body').on('click', function (e) {
            console.log($(event.target).prop('tagName'));
        })
    });

</script>

</body>
</html>