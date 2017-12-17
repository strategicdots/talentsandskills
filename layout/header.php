<!DOCTYPE html>
<html lang="en">

<head>
    <title>Talent and Skills </title>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="description" content="">
    <link rel="stylesheet" href="<?php echo $seperator; ?>css/bootstrap.min.css">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $seperator; ?>css/main.css">
    <?php if($thisPage == "pricingTable"): ?>
    <link rel="stylesheet" href="<?php echo $seperator; ?>css/pricing-table.css">
    <?php endif; ?>

</head>

<body class="">

    <!--navbar -->
    <div class="white-bg">
        <div class="container">
            <div class="navbar navbar-default navbar-right navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="<?php if(empty($seperator)) {echo " . "; } else { echo $seperator; } ?>" class="pull-left logo block"></a>
                        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <!-- <li class="<?php if($thisPage == "find-jobs"){echo "current"; } ?>">
                                <a href=""> find jobs </a>
                            </li> -->
                            <li class="<?php if($thisPage == "candidates"){echo "current"; } ?>">
                                <a href="">candidates </a>
                            </li>
                            <li class="<?php if($thisPage == "interns"){echo "current"; } ?>">
                                <a href=""> interns </a>
                            </li>
                            <li class="dropdown <?php if($thisPage == "employers"){echo "current"; } ?>">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown"> employers <i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $seperator; ?>register/employer.php">register</a></li>
                                    <li><a href="<?php echo $seperator; ?>cv-packages.php">CV access packages</a></li>
                                    <li><a href="<?php echo $seperator; ?>recruitment-solutions.php">request for recruitment service</a></li>
                                    <li><a href="<?php echo $seperator; ?>employer/request-interns.php">request for interns</a></li>
                                </ul>
                            </li>
                            <li class="dropdown <?php if($thisPage == "services"){echo "current"; } ?>">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown"> services <i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $seperator; ?>background-checks.php">background checks</a></li>
                                    <li><a href="<?php echo $seperator; ?>corporate-training.php">corporate trainings</a></li>
                                    <li><a href="<?php echo $seperator; ?>hr-outsourcing.php">HR outsourcing</a></li>
                                    <li><a href="<?php echo $seperator; ?>pre-employment-testing.php">pre-employment testing</a></li>
                                    <li><a href="<?php echo $seperator; ?>recruitment-solutions.php">recruitment solutions</a></li>
                                </ul>
                            </li>
                            <li class="dropdown <?php if($thisPage == "career-resources"){echo "current"; } ?>">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown"> career resources <i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="">career tips</a></li>
                                    <li><a href="">recruitment advice</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo $seperator; ?>login.php"> log in </a>
                            </li>
                            <li>
                                <a href="<?php echo $seperator; ?>register" class="last"> sign up </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end .navbar -->