<?php $thisPage = "home";
$seperator = "";

include_once("includes/initialize.php"); 

// find some selected keywords
$keywords = Jobs::selectedKeywords(); 
$newJobs = Jobs::newJobs(); ?>

<!-- header -->
<?php include_once("layout/header.php"); ?>

<!-- .top -->
<div class="top">
      <div class="sm-container text-center">
            <div class="text-center">
                  <form class="p-light-top-breather p-light-bottom-breather" action="view-jobs/job-search.php" method="get">
                        <h1 class="sectxt-color">
                              <span>Find your dream job.</span> Right now.</h1>
                        <div class="">
                              <input type="text" name="keyword" placeholder="Job Title, Skills or Company">
                              <select name="location">
                                    <option selected disabled>Location</option>
                                    <?php foreach ($states as $state) : ?>
                                    <option value="<?php echo $state->name; ?>">
                                          <?php echo $state->name; ?>
                                    </option>
                                    <?php endforeach; ?>
                              </select>
                        </div>
                        <div class="m-light-top-breather">
                              <input type="submit" class="btn main-btn" name="submit" value="Find Jobs">
                        </div>
                  </form>
            </div>
      </div>

      <!-- .jumbo-stripe -->
      <div class="jumbo-stripe p-vlight-breather">
            <div class="container">
                  <a href="#" class="sectxt-color">
                        <p>Looking for candidates? We can help you find better ones, too. Find the most qualified people faster
                              with our help. Start now.</p>
                  </a>
            </div>
      </div>
      <!-- end .jumbo-stripe -->

</div>
<!-- end .top -->

<!-- .content-topbar -->
<div class="m-mid-top-breather content-topbar m-mid-bottom-breather">
      <div class="container">
            <div class="row">
                  <div class="col-sm-3 widget hidden-xs">
                        <div class="light-bx-shadow text-center">
                              <div class="tp">
                                    <p class="headfont capitalize brandtxt-color">Let employers find you</p>
                              </div>
                              <div class="btm mid-font-size p-heavy-left-breather p-light-right-breather">
                                    <p class=""> Talents and Skills make it possible for employers to view your profile and contact you
                                          directly.
                                    </p>
                                    <a href="register/" class="btn capitalize inline-block m-light-bottom-breather m-light-top-breather main-btn">upload your CV</a>
                              </div>
                        </div>
                  </div>
                  <div class="col-sm-9 search-kw">
                        <div class="margin-auto light-bx-shadow">
                              <div class="p-vlight-breather sec-bg p-mid-side-breather">
                                    <p class="headfont capitalize no-margin">Employers are searching for candidates with the following qualities:</p>
                              </div>
                              <div class="tp capitalize">

                                    <?php foreach ($keywords as $keyword) : $keyword = trim($keyword->keywords); ?>
                                    <?php if (!empty($keyword)) : ?>

                                    <a href="view-jobs/job-search.php?keyword=<?php echo urlencode($keyword); ?>" class="inline-block">
                                          <?php echo $keyword; ?>
                                    </a>

                                    <?php endif;
                        endforeach; ?>

                              </div>
                        </div>
                  </div>
            </div>
      </div>
</div>
<!-- end .content-topbar -->

<!-- .mainbar -->
<div class="m-mid-top-breather m-mid-bottom-breather mainbar">
      <div class="container">
            <div class="row">

                  <!-- .featured-jobs -->
                  <div class="col-sm-8 featured-jobs">
                        <div class="light-bx-shadow">
                              <div class="p-vlight-breather sec-bg p-mid-side-breather">
                                    <p class="headfont uppercase no-margin">Featured jobs</p>
                              </div>

                              <?php foreach ($newJobs as $job) :
                                    $employer = Employer::findDetails($job->employer_id);
                              ?>
                              <div class="item">
                                    <div class="btm m-mid-top-breather">
                                          <div class="row">
                                                <div class="col-sm-2">
                                                      <div class="emplyr-img-bx">
                                                            <?php if ($employer->avatar_url) : ?>
                                                            <img src="<?php echo $employer->avatar_url; ?>" class="img-responsive">
                                                            <?php else : ?>
                                                            <img src="<?php echo $seperator; ?>img/company.png" class="img-responsive">
                                                            <?php endif; ?>
                                                      </div>
                                                </div>
                                                <div class="col-sm-9">
                                                      <h2 class="mid-font-size capitalize no-margin">
                                                      <a href="candidate/job.php?id=<?php echo $job->id; ?>"><?php echo $job->title; ?></a>
                                                      </h2>
                                                      
                                                      <p class="small-font-size secheadfont"><?php echo $employer->company_name; ?></p>
                                                      <p class="mid-font-size"><?php echo trimContent(htmlspecialchars_decode($job->description, 40)); ?></p>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                              <?php endforeach; ?>
                        </div>

                  </div>
                  <!-- end .featured-jobs -->

                  <!-- .career-content-section-->
                  <div class="col-sm-4 career-cnt-sectn">
                        <div class="light-bx-shadow p-light-bottom-breather">
                              <div class="p-vlight-breather sec-bg p-mid-side-breather">
                                    <p class="headfont no-margin uppercase">career tips:</p>
                              </div>
                              <div class="btm m-mid-top-breather">
                                    <div class="item m-mid-bottom-breather">
                                          <img src="img/top10.png" class="img-responsive img-rounded">
                                          <h2 class="mid-font-size capitalize">top ten recruitment trends in africa part 1.</h2>
                                          <p class="mid-font-size">Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet
                                                orci.
                                          </p>
                                    </div>
                                    <div class="item m-mid-bottom-breather">
                                          <img src="img/top10.png" class="img-responsive img-rounded">
                                          <h2 class="mid-font-size capitalize">top ten recruitment trends in africa part 1.</h2>
                                          <p class="mid-font-size">Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet
                                                orci.
                                          </p>
                                    </div>

                              </div>
                        </div>
                  </div>
                  <!-- end .career-content-section -->

            </div>
      </div>
</div>
<!-- end .mainbar -->

<!-- footer -->
<?php include_once("layout/footer.php"); ?>