<?php $thisPage = "home"; $seperator=""; 
include_once("includes/initialize.php");

// header
include_once("layout/header.php"); ?>

<!-- .top -->
<div class="inner-top other-pages abt">
    <div class="sm-container text-center">
        <h1 class="sectxt-color uppercase"><span class="capitalize">about</span> talent and skills</h1>

    </div>

</div>
<!-- end .top -->

<!--  main content  -->
<div class="container m-mid-breather">

    <!--  main bar  -->
    <div class="col-sm-8">
        <div class="light-bx-shadow">
            <div class="p-vlight-breather sec-bg p-heavy-side-breather m-vlight-bottom-breather">
                <p class="headfont uppercase no-margin text-center">about us </p>
            </div>
            <div class="p-light-bottom-breather p-heavy-side-breather">
            <img src="img/abt-us-2.jpg" class="img-responsive m-mid-breather">

                <p>
                    Talents and Skills is the creative and unrelenting vision of our founding CEO, Mr. Tayo Oluwole. He is always of the opinion
                    and passionate that Africa MUST achieve GREATNESS, the vision and mission he is committed to since the
                    birth of McTimothy Associates, a leading Management Consulting, Recruitment, and Business Training Firm.
                </p>
                <p>
                    He is always happy to help young people get job, develop/empower them to be self-reliant. Due to the growing population of
                    Nigerian graduates who are jobless, and whom are also not employable due to lack of adequate skills required
                    by employers.
                </p>
                <p>
                    TALENTS &amp; SKILLS is an online recruitment platform to enable our clients source and recruit top and skillful professionals.
                    As an online recruitment platform, it accessible to job seekers and employers. </p> 
                    <p>The platform is powered and operated by McTimothy Associates, a management consulting, recruitment/HRservices and training firm
                    dully registered with Corporate Affairs Commission in Nigeria.</p>
                <p>
                    TALENTS &amp; SKILLS as the brainchild of McTimothy Associates was born out of an increased demand for our service to provide
                    a dependable and quick platform for recruitment of talented and skillful professionals/workforce. </p> <p> We
                    have always said we are not a technology company; we are simply recruitment consultants enabling greatness
                    of Africa. Our services are designed to take the stress of recruitment and talents search off our clients’
                    shoulder. </p> <p>We always take the time to clearly understand our client’s specific requirements and talents
                    needs so that only the right candidates with the right profiles are recruited. </p>
                <p>Complete customer satisfaction is our priority, we are happy we serve diverse and happy customers who trust
                    us for professionalism, integrity, service, and resilience. </p> 
                    <p>At McTimothy Associates and Talents &amp; Skills, we are passionate about what we do, how we do it and believe that there is always room for improvement,
                    this is why we listen to you our “Esteemed Customers”. </p> 
                    <p> Finding the right candidates and working with
                    you to develop them, retain them so they continually add value to your organization is the beginning
                    of our partnership with you. </p> 
                    <p>Talents and Skills was born, to serve as a talent pool where Employers and
                    Candidates could connect based on skill matches and opportunities, this is a recruitment platform offering
                    where: </p>
                <ul>
                    <li>Any candidate can join our platform, create a free online CV and be considered by Talents &amp; Skills.net
                        and the Out Sourcing team at McTimothy Associates for ongoing client vacancies</li>
                    <li>Candidates can upgrade to a paid membership, joining a talent pool where they can be found by a large
                        network of employers with job opportunities.</li>
                    <li>Any registered company can access our database of professionals and get to recruit talented and skillful
                        professionals.</li>
                </ul>
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