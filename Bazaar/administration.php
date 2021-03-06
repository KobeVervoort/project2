<?php

use Bazaar\Classes\Company;
use Bazaar\Classes\Offer;
use \Bazaar\Classes\User;

include_once 'start.php';

session_start();

$page = "administration";

if(isset($_SESSION['companyID'])) {

    $company = new Company();
    $company->getCompanyData($_SESSION['companyID']);

    $offer = new Offer();
    $activeOffers = $offer->getMyOffers($_SESSION['companyID']);

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
    <link rel="stylesheet" href="css/administration.css">
    <title>beheren</title>
</head>
<body>
<?php include_once 'nav.inc.php';?>

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

    <div class="manageButtons">

        <button id="active" class="active">lopend</button>
        <button id="finished" >afgelopen</button>

    </div>


    <ul class="activeOffers">

        <h3>je hebt nog geen deelnames</h3>

        <?php if ($activeOffers == null):?>

        <?php else:?>

            <?php foreach($activeOffers as $key => $o):?>

                <?php if($o['end_date'] > time()):?>

                <li class="offer">

                    <div class="logo">
                        <div class="overlay"></div>

                        <?php if($company->getLogo() != null):?>

                        <img src="<?php echo BASE_URL.'Bazaar/uploads/'.$company->getLogo()?>"
                             alt="<?php echo $company->getCompanyname();?> logo"
                             class="companyLogo">

                        <?php endif;?>

                    </div>

                    <div class="info">
                        <h1><?php echo $o['title'];?></h1>

                        <div class="dates">
                            <p class="startDate">van <?php echo date('d-m-Y', $o['start_date'])?></p>
                            <p class="endDate">tot <?php echo date('d-m-Y', $o['end_date'])?></p>
                        </div>

                    </div>

                    <button class="extend">verleng</button>

                </li>

                <?php endif; ?>

            <?php endforeach;?>

        <?php endif;?>

    </ul>

    <ul class="finishedOffers">

        <h3>je hebt nog geen deelnames</h3>

        <?php if ($activeOffers == null):?>

        <?php else:?>

            <?php foreach($activeOffers as $key => $o):?>

                <?php if($o['end_date'] < time()):?>

                <li class="offer">

                    <div class="logo">
                        <div class="overlay"></div>

                        <?php if($company->getLogo() != null):?>

                        <img src="<?php echo BASE_URL.'Bazaar/uploads/'.$company->getLogo()?>"
                             alt="<?php echo $company->getCompanyname();?> logo"
                             class="companyLogo">

                        <?endif;?>

                    </div>

                    <div class="info">
                        <h1><?php echo $o['title'];?></h1>

                        <div class="dates">
                            <p class="startDate">van <?php echo date('d-m-Y', $o['start_date'])?></p>
                            <p class="endDate">tot <?php echo date('d-m-Y', $o['end_date'])?></p>
                        </div>

                    </div>

                    <button class="extend">verleng</button>

                </li>

                <?php endif; ?>

            <?php endforeach;?>

        <?php endif;?>

    </ul>

    <ul class="savedOffers">
        <a>
            <li class="offer">

                <div class="logo">
                    <div class="overlayFinished"></div>
                </div>

                <div class="info">
                    <h1>Bicky actie bij Frituur Frutties</h1>

                    <div class="dates">
                        <h2>van 10/06/2017</span></h2>
                        <h2>tot 10/07/2017</span></h2>
                    </div>

                    <button class="more"></button>

                    <button class="extend">Plaats</button>

                </div>
            </li>
        </a>
    </ul>

</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var activeButton = $('#active');
        var finishedButton = $('#finished');
        var savedButton = $('#saved');

        var activeOffers = $('.activeOffers');
        var finishedOffers = $('.finishedOffers');
        var savedOffers = $('.savedOffers');

        activeButton.on('click', function (e) {
            e.preventDefault();

            activeButton.addClass('active');
            finishedButton.removeClass('active');
            savedButton.removeClass('active');

            activeOffers.css({display:'block'});
            finishedOffers.css({display:'none'});
            savedOffers.css({display:'none'});
        });

        finishedButton.on('click', function (e) {
            e.preventDefault();

            finishedButton.addClass('active');
            activeButton.removeClass('active');
            savedButton.removeClass('active');

            finishedOffers.css({display:'block'});
            activeOffers.css({display:'none'});
            savedOffers.css({display:'none'});
        });

        savedButton.on('click', function (e) {
            e.preventDefault();

            finishedButton.removeClass('active');
            activeButton.removeClass('active');
            savedButton.addClass('active');

            finishedOffers.css({display:'none'});
            activeOffers.css({display:'none'});
            savedOffers.css({display:'block'});
        });
    });

</script>

</body>
</html>