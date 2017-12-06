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
                            <li> <a href="my-profile.php" <?php if($thisPage=="my-profile" ) { echo currentPage(); } ?>> my profile </a></li>
                            <li> <a href="job-search.php" <?php if($thisPage=="search-jobs" || $thisPage=="apply-job") { echo currentPage(); } ?>> search jobs </a> </li>
                            <li> <a href="my-jobs.php" <?php if($thisPage=="my-jobs" ) { echo currentPage(); } ?>> my jobs </a>                                </li>
                            <li> <a href="settings.php" <?php if($thisPage=="settings" ) { echo currentPage(); } ?>> settings </a>                                </li>
                            <li> <a href="logout.php" class="last"> logout </a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end .navbar -->