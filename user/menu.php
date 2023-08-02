<?php
include 'dbconfig.php';

$conn = new mysqli($hostname, $username, $pwd, 'ordermanagement') or die("Could not connect to mysql" . mysqli_error($con));
?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav" id="menu">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link active" href="/">
                    <li class='nav-item'>
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                </a>
                <!--The Begining of submenu-->
                <!--<div class="sb-sidenav-menu-heading">Master</div>-->
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Joining
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <!--<div class="sb-sidenav-menu-heading">Company Master</div>-->
                        <a class="nav-link" href="downline.php">Downline</a>

                    </nav>
                </div>
                <!--<div class="sb-sidenav-menu-heading">T</div>-->
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts_p" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Payout
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts_p" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="#">Payout List</a>
                    </nav>
                </div>
                <!--<div class="sb-sidenav-menu-heading">Account</div>-->
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts_v" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Accounting
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts_v" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="ledger.php">Statement</a>
                    </nav>
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="withdraw.php">Withdraw Request</a>
                    </nav>
                </div>            
                <a class="nav-link" href="#">
                    <li class='nav-item'>
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Profile
                </a>
                <a class="nav-link" href="#">
                    <li class='nav-item' @click='logout'>
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Logout
                </a>
            </div>
            </li>
        </div>
        <div class="sb-sidenav-footer">
            <?php
            /*$recs = $conn->query("select * from companymaster");
            if ($recs->num_rows > 0) {
                if ($rec = $recs->fetch_assoc()) $tempCName = $rec['CompanyName'];
            } else {
                $tempCName = '';
            }*/
            ?>
            <!--<div class="small text-success"><i class="fa fa-globe"></i> <?php echo $tempCName; ?></div>-->
            <div class="small text-success"><i class="fa fa-globe"></i> Dream Care Solution</div>
        </div>
    </nav>
</div>