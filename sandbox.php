<?php include_once("../includes/initialize.php"); 
if (!$session->is_logged_in()) {redirect_to("../login"); } 
if(empty($_GET['location'])) { redirect_to("dashboard"); } 

$user = User::find_details($session->user_id);
$last_fund_row = Wallet::find_last_balance_entry($session->user_id);
$bal = $last_fund_row['balance'];


// 1. the current page number ($current_page)
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

// 2. records per page ($per_page)
$per_page = 5;

// 3. total record count ($total_count)
$total_count = find_all_stations_by_location($_GET['location']);

$pagination = new Pagination($page, $per_page, $total_count);

$clean_location = $database->escape_value($_GET['location']);

// find stations for this page
$sql  = "SELECT * FROM users WHERE merchant=1 ";
$sql .= "AND address LIKE '%{$clean_location}%' "; 
$sql .= "OR firstname LIKE '%{$clean_location}%' ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";

$merchants = Merchant::find_by_sql_query($sql);

// Need to add ?page=$page to all links we want, to 


include_once("../layouts/dashboard_header.php"); ?>

<div class="main_dashboard">
    <div class="container">
        <div class="row">
            <?php echo user_sidebar(); ?>
            <!-- XS SIDEBAR -->
            <div class="col-sm-3 sidebar visible-xs">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <p class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#mainCollapse"> Open Menu
                                </a> 
                            </p>
                        </div>
                        <div id="mainCollapse" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="no-list-style no-left-padding">
                                    <li><a href="dashboard" class="inline-block">Dashboard</a></li>
                                    <li><a href="find_a_fuel_station" class="inline-block">find fuel station</a></li>
                                    <li><a href="buy_fuel" class="inline-block">buy fuel</a></li>
                                    <li><a href="my_wallet" class="inline-block">wallet</a></li>
                                    <li><a href="reports" class="inline-block">reports</a></li>
                                    <li><a href="my_profile" class="inline-block">profile</a></li>
                                    <li><a href="" class="inline-block">airtime purchase</a></li>
                                    <li><a href="transfer_fuel" class="inline-block">transfer fuel</a></li>
                                    <li><a href="logout" class="inline-block">logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OF XS SIDEBAR -->

            <div class="col-sm-9 no-left-padding no-right-padding main">
                <?php if(empty($merchants)) { 
    echo "<p>No result found for your query </p>"; }
                echo "<p class=\"brandtxt-color\">We have {$total_count} stations in {$_GET['location']}</p>";
                foreach($merchants as $merchant) : ?>
                <div class="row">
                    <div class="col-sm-9">
                        <h2 class="mid-font-size"> <?php echo $merchant->firstname; ?></h2>
                        <p class="small-font-size"><span class="txt-bold">Location: </span><?php echo $merchant->address; ?></p>
                        <!--<p class="txt-bold small-font-size">Price of Products</p>-->
                        <?php $products = MerchantProduct::find_products_by_merchant($merchant->id);
                        foreach($products as $product): ?>
                        <div class="row small-font-size">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6"><?php echo $product->name . ":"; ?> </div>
                                    <div class="col-sm-6"><strong><?php echo "&#x20A6;" . format_amount($product->price) ?></strong> </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-sm-3" style="padding-top: 60px;">
                        <?php if(!empty($bal)): ?>
                        <!-- IF USER HAS MONEY IN WALLET -->
                        <a href="buy_fuel?merchant_id=<?php echo $merchant->unique_user_id; ?>" class="btn main-btn-color main-font sectxt-color uppercase">buy here</a>
                        <?php else: ?>
                        <!-- WALLET IS EMPTY -->
                        <a href="fund_types.php" class="btn main-btn-color main-font sectxt-color uppercase">Fund account to buy here </a>
                        <?php endif; ?>
                    </div>
                </div>
                <hr>
                <?php endforeach; ?>

                <div id="pagination" style="clear: both;">
                    <?php
                    if($pagination->total_pages() > 1) {

                        if($pagination->has_previous_page()) { 
                            echo "<a href=\"find_stations?location={$_GET['location']}&page=";
                            echo $pagination->previous_page();
                            echo "\">&laquo; Previous</a> "; 
                        }

                        for($i=1; $i <= $pagination->total_pages(); $i++) {
                            if($i == $page) {
                                echo " <span class=\"selected\">{$i}</span> ";
                            } else {
                                echo " <a href=\"find_stations?location={$_GET['location']}&page={$i}\">{$i}</a> "; 
                            }
                        }

                        if($pagination->has_next_page()) { 
                            echo "<a href=\"find_stations?location={$_GET['location']}&page=";    
                            echo $pagination->next_page();
                            echo "\">Next &raquo;</a> "; 
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include_once("../layouts/footer.php"); ?>