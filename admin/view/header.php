<header id="header">
    <hgroup>
        <h1 class="site_title"><a target="_blink" href="<?php echo WEBSITEADDRESS;?>"><img src="images/logo.png" /></a></h1>
        <h2 class="section_title"><?php echo PROJECT_NAME; ?></h2>
        <div class="btn_view_site"><a href="?obj=logout">LOGOUT</a></div>
    </hgroup>
</header> <!-- end of header bar -->
<section id="secondary_bar">
    <div class="user">
        <p><?php echo next($user_info); ?> (<a href="#">3 Messages</a>)</p>
        <!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
    </div>
    <div class="breadcrumbs_container">
        <article class="breadcrumbs"><a href="http://localhost/forum" target="_black">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current"><?php echo @$_GET["obj"]?$_GET["obj"]:"Dashbaord"; ?></a></article>
    </div>
</section><!-- end of secondary bar -->

