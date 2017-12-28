<!DOCTYPE html>

<html lang="en">

<head>
    <title>Talent and Skills </title>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="description" content="">

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

    <!--navbar -->
    <div class="white-bg">
        <div class="container">
            <div class="navbar navbar-default navbar-right navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="http://localhost/talents" class="pull-left logo block"></a>
                        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">

                            <!-- interns -->
                            <li class="">
                                <a href=""> interns </a>
                            </li>

                            <!-- candidates -->
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown"> candidates
                                    <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="http://localhost/talents/register/candidate.php">register</a>
                                    </li>
                                    <li>
                                        <a href="http://localhost/talents/view-jobs/">View Vacancies</a>
                                    </li>
                                    <li>
                                        <a href="http://localhost/talents/employability-training.php">Employability Training</a>
                                    </li>
                                    <li>
                                        <a href="http://localhost/talents/resume-services.php">CV &#038; Resume Writing Services</a>
                                    </li>
                                    <!-- <li><a href="http://localhost/talents/">Upgrade To Super Candidate</a></li> -->
                                    <li>
                                        <a href="http://localhost/talents/career-resources/career-tips">Career Tips</a>
                                    </li>
                                    <!-- <li>
                                        <a href="http://localhost/talents/employers-list.php">Employers' List</a>
                                    </li> -->
                                </ul>
                            </li>

                            <!-- employers -->
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown"> employers
                                    <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="http://localhost/talents/register/employer.php">register</a>
                                    </li>
                                    <li>
                                        <a href="http://localhost/talents/cv-packages.php">CV access packages</a>
                                    </li>
                                    <li>
                                        <a href="http://localhost/talents/recruitment-solutions.php">request for recruitment service</a>
                                    </li>
                                    <li>
                                        <a href="http://localhost/talents/employer/request-interns.php">request for interns</a>
                                    </li>
                                    <li>
                                        <a href="http://localhost/talents/career-resources/recruitment-advice">recruitment advice</a>
                                    </li>

                                </ul>
                            </li>

                            <!-- services -->
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown"> services
                                    <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="http://localhost/talents/background-checks.php">background checks</a>
                                    </li>
                                    <li>
                                        <a href="http://localhost/talents/corporate-training.php">corporate trainings</a>
                                    </li>
                                    <li>
                                        <a href="http://localhost/talents/hr-outsourcing.php">HR outsourcing</a>
                                    </li>
                                    <li>
                                        <a href="http://localhost/talents/pre-employment-testing.php">pre-employment testing</a>
                                    </li>
                                    <li>
                                        <a href="http://localhost/talents/recruitment-solutions.php">recruitment solutions</a>
                                    </li>
                                </ul>
                            </li>

                            <!-- career resources -->
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle current" data-toggle="dropdown"> career resources
                                    <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="http://localhost/talents/career-resources/career-tips">career tips</a>
                                    </li>
                                    <li>
                                        <a href="http://localhost/talents/career-resources/recruitment-advice">recruitment advice</a>
                                    </li>
                                </ul>
                            </li>

                            <!-- login -->
                            <li>
                                <a href="http://localhost/talents/login.php"> log in </a>
                            </li>

                            <!-- signup -->
                            <li>
                                <a href="http://localhost/talents/register" class="last"> sign up </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end .navbar -->