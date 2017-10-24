<?php $thisPage = "home"; $seperator=""; 
include_once("includes/initialize.php");

// header
include_once("layout/header.php"); ?>


<!-- .top -->
<div class="inner-top other-pages cv">
      <div class="sm-container text-center">
            <h1 class="sectxt-color uppercase"><span class="capitalize">CV</span> packages</h1>
      </div>

</div>
<!-- end .top -->

<!--  main content  -->
<div class="container m-mid-breather cv-btm">

      <!--  main bar  -->
      <div class="col-sm-8">
            <div class="light-bx-shadow">
                  <div class="p-vlight-breather sec-bg p-heavy-side-breather m-vlight-bottom-breather">
                        <p class="headfont uppercase no-margin text-center">Plans that grow with your business </p>
                  </div>
                  <div class="p-light-bottom-breather p-heavy-side-breather">
                        <p>
                              Talents&amp; Skills clients have the capacity to look over five appealing, Use based arrangements. Charging is month to month
                              (ahead of time) and clients have the capacity to change arrangementsto fit their changing business
                              and utilization needs.
                        </p>
                        <div class="row m-mid-breather">
                              <div class="col-sm-6 package">
                                    <div class="">
                                          <p class="headfont uppercase no-margin text-center">pay as you go (per CV)</p>
                                          <p class="text-center">This option enables you to pay per CV shortlisting and gain access to the candidates
                                                contact details immediately. </p>
                                          <ul class="no-list-style no-left-padding capitalize small-font-size">
                                                <li><i class="glyphicon glyphicon-check" aria-hidden="true"></i> FREE job posting</li>
                                                <li><i class="glyphicon glyphicon-check" aria-hidden="true"></i>Pay as you go
                                                      PER CV/Resume </li>
                                                <li><i class="glyphicon glyphicon-check" aria-hidden="true"></i>Featured listing
                                                      for all your jobs </li>
                                                <li><i class="glyphicon glyphicon-check" aria-hidden="true"></i>Access all applications</li>
                                                <li><i class="glyphicon glyphicon-check" aria-hidden="true"></i>Access to 10
                                                      Resumes</li>
                                                <li><i class="glyphicon glyphicon-check" aria-hidden="true"></i>10 days duration
                                                      </li>
                                          </ul>

                                    </div>
                              </div>
                              <div class="col-sm-6 package">
                                    <div class="">
                                          <p class="headfont uppercase no-margin text-center">pay as you go (per CV)</p>
                                          <p class="text-center">This option enables you to pay per CV shortlisting and gain access to the candidates
                                                contact details immediately. </p>
                                          <ul class="no-list-style no-left-padding capitalize small-font-size">
                                                <li><i class="glyphicon glyphicon-check" aria-hidden="true"></i> FREE job posting</li>
                                                <li><i class="glyphicon glyphicon-check" aria-hidden="true"></i>Pay as you go
                                                      PER CV/Resume </li>
                                                <li><i class="glyphicon glyphicon-check" aria-hidden="true"></i>Featured listing
                                                      for all your jobs </li>
                                                <li><i class="glyphicon glyphicon-check" aria-hidden="true"></i>Access all applications</li>
                                                <li><i class="glyphicon glyphicon-check" aria-hidden="true"></i>Access to 10
                                                      Resumes</li>
                                                <li><i class="glyphicon glyphicon-check" aria-hidden="true"></i>10 days duration
                                                      </li>
                                          </ul>

                                    </div>
                              </div>

                        </div>
                  </div>
            </div>
      </div>

      <!-- sidebar -->
      <div class="sidebar col-sm-4">


            <div class="light-bx-shadow m-mid-bottom-breather">
                  <div class="p-vlight-breather sec-bg p-mid-side-breather">
                        <p class="headfont uppercase no-margin text-center">featured jobs</p>
                  </div>
                  <div class="p-mid-side-breather p-light-breather">

                  </div>
            </div>

            <!--  career tips -->
            <div class="light-bx-shadow m-mid-bottom-breather">
                  <div class="p-vlight-breather sec-bg p-mid-side-breather">
                        <p class="headfont uppercase no-margin text-center">career tips</p>
                  </div>
                  <div class="p-mid-side-breather p-light-breather">

                  </div>
            </div>


            <?php echo sideSearch($states, $seperator); ?>

      </div>


</div>

<!-- footer -->
<?php include_once("layout/footer.php"); ?>