<?php $thisPage = "register"; $seperator="../"; 
include_once("{$seperator}includes/initialize.php"); ?>

<!-- header -->
<?php include_once("{$seperator}layout/header.php"); ?>

<div class="container inner-top p-heavy-top-breather">
    <div class="row">
        <div class="col-sm-6">
            <div class="heavy-container"> 
                <h2 class="text-center">I'm a Candidate</h2>
                <p class="text-center">Get headhunted by leading employers</p>
                <form action="/candidate/register" method="post">

                    <div class="form-group">
                        <input type="email" name="username" id="username" placeholder="Email Address" value="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <select required placeholder="Please Select specialism" class="form-control" name="">
                            <option value="" selected>Please, Select Specialism</option>
                            <option value="accountancy">Accounting / Audit / Tax</option>
                            <option value="administration-management">Administration / Management</option>
                            <option value="agriculturefarming">Agriculture/Farming</option>
                            <option value="banking">Banking / Finance / Insurance</option>
                            <option value="building-designarchitecture">Building Design/Architecture</option>
                            <option value="business-development">Business Development</option>
                            <option value="business-strategyplanning">Business Strategy/Planning</option>
                            <option value="charity-voluntary">Charity &amp; Voluntary</option>
                            <option value="constructioncontract-management">Construction/Contract Management</option>
                            <option value="consultingbusiness-strategy-planning">Consulting/Business Strategy &amp; Planning</option>
                            <option value="creatives-arts-design-fashion">Creatives (Arts, Design, Fashion)</option>
                            <option value="customer-service">Customer Service</option>
                            <option value="digital-creative">Digital &amp; Creative</option>
                            <option value="educationteachingtraining">Education/Teaching/Training</option>
                            <option value="engineering">Engineering</option>
                            <option value="estate-agency">Estate Agency</option>
                            <option value="executive-top-management">Executive / Top Management</option>
                            <option value="graduate">Graduate</option>
                            <option value="healthcare-pharmaceutical">Healthcare / Pharmaceutical</option>
                            <option value="hospitality-leisure-travels">Hospitality / Leisure / Travels</option>
                            <option value="human-resources">Human Resources</option>
                            <option value="information-technology">Information Technology</option>
                            <option value="it-contractor">IT Contractor</option>
                            <option value="lawlegal">Law/Legal</option>
                            <option value="legal-jobs">Legal jobs</option>
                            <option value="leisure-tourism">Leisure &amp; Tourism</option>
                            <option value="leisure-tourism-jobs">Leisure &amp; Tourism jobs</option>
                            <option value="manaufacturing">Manaufacturing</option>
                            <option value="manufacturing-production">Manufacturing / Production</option>
                            <option value="manufacturing-jobs">Manufacturing jobs</option>
                            <option value="marketing-advertising-communications">Marketing / Advertising / Communications</option>
                            <option value="marketing-pr">Marketing &amp; PR</option>
                            <option value="marketing-pr-jobs">Marketing &amp; PR jobs</option>
                            <option value="media">Media</option><option value="media-digital-creative-jobs">Media, Digital &amp; Creative jobs</option>
                            <option value="motoring-automotive">Motoring &amp; Automotive</option>
                            <option value="ngocommunity-services-development">NGO/Community Services &amp; Development</option>
                            <option value="oilgas-mining-energy">Oil&amp;Gas / Mining / Energy</option>
                            <option value="project-programme-management">Project / Programme Management</option>
                            <option value="public-sector">Public Sector</option>
                            <option value="purchase-ledger-clerk">Purchase Ledger Clerk</option>
                            <option value="purchasing">Purchasing</option>
                            <option value="qaqc-hse">QA&amp;QC / HSE</option>
                            <option value="real-estate-property">Real Estate / Property</option>
                            <option value="retail">Retail</option>
                            <option value="sales-marketing">Sales &amp; Marketing</option>
                            <option value="salesbusiness-development">Sales/Business Development</option>
                            <option value="supply-chain-procurement">Supply Chain / Procurement</option>
                            <option value="telecommunications">Telecommunications</option>
                            <option value="transportation">Transportation</option>
                            <option value="vocational-trade-and-services">Vocational Trade and Services</option>
                            <option value="web-designinggraphic-design">Web designing/Graphic design</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="tel" id="password" name="phone" placeholder="Phone Number" value="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Password" value="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <input  class="btn main-btn form-control" type="submit" value="Register as a Candidate">
                    </div>
                    <input type="hidden" value="CUWnNWtjhMcE6bzx+UWOgSk9IFBsTdB3vNjk4=" name="_csrf">
                </form>

            </div>
        </div>
        <div class="td md-dsp-none">
            <div class="or pos-static mrg-auto"></div>
        </div>

        <div class="col-sm-6">
            <div class="heavy-container">
                <h2 class="text-center">I'm an Employer</h2>
                <p class="text-center">Get instant access to great candidates</p>
                <form action="/employer/register" method="post">

                    <div class="form-group">
                        <input type="email" name="email" value="" placeholder="Company Email Address" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <input type="text" name="company_name" value="" placeholder="Company Name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <select required placeholder="Please Select specialism" class="form-control" name="">
                            <option value="" selected>Please, Select Specialism</option>
                            <option value="accountancy">Accounting / Audit / Tax</option>
                            <option value="administration-management">Administration / Management</option>
                            <option value="agriculturefarming">Agriculture/Farming</option>
                            <option value="banking">Banking / Finance / Insurance</option>
                            <option value="building-designarchitecture">Building Design/Architecture</option>
                            <option value="business-development">Business Development</option>
                            <option value="business-strategyplanning">Business Strategy/Planning</option>
                            <option value="charity-voluntary">Charity &amp; Voluntary</option>
                            <option value="constructioncontract-management">Construction/Contract Management</option>
                            <option value="consultingbusiness-strategy-planning">Consulting/Business Strategy &amp; Planning</option>
                            <option value="creatives-arts-design-fashion">Creatives (Arts, Design, Fashion)</option>
                            <option value="customer-service">Customer Service</option>
                            <option value="digital-creative">Digital &amp; Creative</option>
                            <option value="educationteachingtraining">Education/Teaching/Training</option>
                            <option value="engineering">Engineering</option>
                            <option value="estate-agency">Estate Agency</option>
                            <option value="executive-top-management">Executive / Top Management</option>
                            <option value="graduate">Graduate</option>
                            <option value="healthcare-pharmaceutical">Healthcare / Pharmaceutical</option>
                            <option value="hospitality-leisure-travels">Hospitality / Leisure / Travels</option>
                            <option value="human-resources">Human Resources</option>
                            <option value="information-technology">Information Technology</option>
                            <option value="it-contractor">IT Contractor</option>
                            <option value="lawlegal">Law/Legal</option>
                            <option value="legal-jobs">Legal jobs</option>
                            <option value="leisure-tourism">Leisure &amp; Tourism</option>
                            <option value="leisure-tourism-jobs">Leisure &amp; Tourism jobs</option>
                            <option value="manaufacturing">Manaufacturing</option>
                            <option value="manufacturing-production">Manufacturing / Production</option>
                            <option value="manufacturing-jobs">Manufacturing jobs</option>
                            <option value="marketing-advertising-communications">Marketing / Advertising / Communications</option>
                            <option value="marketing-pr">Marketing &amp; PR</option>
                            <option value="marketing-pr-jobs">Marketing &amp; PR jobs</option>
                            <option value="media">Media</option><option value="media-digital-creative-jobs">Media, Digital &amp; Creative jobs</option>
                            <option value="motoring-automotive">Motoring &amp; Automotive</option>
                            <option value="ngocommunity-services-development">NGO/Community Services &amp; Development</option>
                            <option value="oilgas-mining-energy">Oil&amp;Gas / Mining / Energy</option>
                            <option value="project-programme-management">Project / Programme Management</option>
                            <option value="public-sector">Public Sector</option>
                            <option value="purchase-ledger-clerk">Purchase Ledger Clerk</option>
                            <option value="purchasing">Purchasing</option>
                            <option value="qaqc-hse">QA&amp;QC / HSE</option>
                            <option value="real-estate-property">Real Estate / Property</option>
                            <option value="retail">Retail</option>
                            <option value="sales-marketing">Sales &amp; Marketing</option>
                            <option value="salesbusiness-development">Sales/Business Development</option>
                            <option value="supply-chain-procurement">Supply Chain / Procurement</option>
                            <option value="telecommunications">Telecommunications</option>
                            <option value="transportation">Transportation</option>
                            <option value="vocational-trade-and-services">Vocational Trade and Services</option>
                            <option value="web-designinggraphic-design">Web designing/Graphic design</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="tel" name="phone" value="" placeholder="Phone Number" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" value="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <input  class="btn sec-btn form-control" type="submit" value="Register as an Employer">
                    </div>
                    <input type="hidden" value="CUWnNWtjhMcE6bzx+UWOgSk9IFBsTdB3vNjk4=" name="_csrf">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- footer -->
<?php include_once("{$seperator}layout/footer.php"); ?>