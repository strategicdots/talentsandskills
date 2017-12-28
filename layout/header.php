<!DOCTYPE html>
<html lang="en">

<head>
    <title>Talent and Skills </title>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="description" content="">
    <link rel="stylesheet" href="<?php echo $seperator; ?>css/bootstrap.min.css">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $seperator; ?>css/main.css">
    <?php if($thisPage == "pricingTable"): ?>
    <link rel="stylesheet" href="<?php echo $seperator; ?>css/pricing-table.css">
    <?php elseif ($thisPage == "jobsPage") : ?>
    <link rel="stylesheet" href="<?php echo $seperator; ?>css/jobs.css">
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
                            
                            <!-- interns -->
                            <li class="dropdown<?php if($thisPage == "interns"){echo "current"; } ?>">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown"> interns <i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $seperator; ?>register/intern.php">register</a></li>
                                    <li><a href="<?php echo $seperator; ?>login.php">login</a></li>
                                </ul>
                            </li>

                            <!-- candidates -->
                            <li class="dropdown <?php if($thisPage == "candidates"){echo "current"; } ?>">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown"> candidates <i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $seperator; ?>register/candidate.php">register</a></li>
                                    <li><a href="<?php echo $seperator; ?>view-jobs/">View Vacancies</a></li>
                                    <li><a href="<?php echo $seperator; ?>employability-training.php">Employability Training</a></li>
                                    <li><a href="<?php echo $seperator; ?>resume-services.php">CV &#038; Resume Writing Services</a></li>
                                    <!-- <li><a href="<?php echo $seperator; ?>">Upgrade To Super Candidate</a></li> -->
                                    <li><a href="http://localhost/talents/career-resources/career-tips">Career Tips</a></li>
                                    <!-- <li><a href="<?php echo $seperator; ?>employers-list.php">Employers' List</a></li> -->
                                </ul>
                            </li>

                            <!-- employers -->
                            <li class="dropdown <?php if($thisPage == "employers"){echo "current"; } ?>">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown"> employers <i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $seperator; ?>register/employer.php">register</a></li>
                                    <li><a href="<?php echo $seperator; ?>resume-packages">CV access packages</a></li>
                                    <li><a href="<?php echo $seperator; ?>recruitment-solutions.php">request for recruitment service</a></li>
                                    <li><a href="<?php echo $seperator; ?>employer/request-interns.php">request for interns</a></li>
                                    <li><a href="http://localhost/talents/career-resources/recruitment-advice">recruitment advice</a></li>
                                </ul>
                            </li>

                            <!-- services -->
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

                            <!-- career resources -->
                            <li class="dropdown <?php if($thisPage == "career-resources"){echo "current"; } ?>">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown"> career resources <i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="http://talents/career-resources/career-tips/">career tips</a></li>
                                    <li><a href="http://talents/career-resources/recruitment-advice/">recruitment advice</a></li>
                                </ul>
                            </li>

                            <!-- login -->
                            <li>
                                <a href="<?php echo $seperator; ?>login.php"> log in </a>
                            </li>

                            <!-- signup -->
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