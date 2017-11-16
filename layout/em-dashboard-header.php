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
    <?php if($thisPage == "create-job"): ?> 
    <link rel="stylesheet" href="<?php echo $seperator; ?>css/datetimepicker.css">
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
                            <li> <a href="dashboard.php" <?php if($thisPage=="dashboard" ) { echo currentPage(); } ?>> dashboard </a></li>
                            <li> <a href="create-job.php" <?php if($thisPage=="create-job" ) { echo currentPage(); } ?>> post a job </a>                                </li>
                            <li> <a href="jobs.php" <?php if($thisPage=="jobs" ) { echo currentPage(); } ?>> job posts </a> </li>
                            <li> <a href="orders.php" <?php if($thisPage=="orders" ) { echo currentPage(); } ?>> my orders </a>                                </li>
                            <li> <a href="settings.php" <?php if($thisPage=="settings" ) { echo currentPage(); } ?>> settings </a>                                </li>
                            <li> <a href="logout.php" class="last"> logout </a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end .navbar -->