<div class="main-content flex align-items-center justify-content-center" style="min-height:75vh;flex-direction:column;">
    <h1 class="title">No post found</h1>
    <?php if($_SESSION['email'] == "admin@email.com") : ?>
    <a href="home.php" ><button class="primary_btn create_new_post" >Create New Post &plus;</button></a>
    <?php endif;?>
</div>