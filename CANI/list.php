<?php
session_start();
include('./includes/db.php');
if(!isset($_SESSION['first'])){
	header('location: ./login.php');
}
include('./template-part/head.php') ;
$full_name = $_SESSION['first'].' '.$_SESSION['last'];
$login_user_pic = $_SESSION['image'];
?>
    <!---Add post section start--->
    <?php include('./template-part/add_post_form.php') ?>
    <!---Add post section end--->
    
    <!---Home main section start--->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link rel="stylesheet" href="css/home.css">

    <section>
    
        <div class="main-content flex justify-content-center post-area">
            <?php

            $all_topic = mysqli_query($conn,"SELECT * FROM topic ORDER BY id");
            $topic_num = mysqli_num_rows($all_topic);
            if($topic_num > 0){
            
            while ($topic = mysqli_fetch_array($all_topic)){
                if($topic["id"] == $_GET["id"]){
                    $_SESSION["topic"] = $topic["topic"];
                    echo $topic["topic"],"<br><br><br>";
                }
            }
        }
            
            $id = $_GET["id"];
            $all_post = mysqli_query($conn,"SELECT * FROM user_post WHERE topic_id=$id ORDER BY id DESC ");
            $post_num = mysqli_num_rows($all_post);
            if($post_num > 0):
            while ($post = mysqli_fetch_array($all_post)):
                $post_id = $post['id'];
            ?>

            <br><br>
            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                <div class="card bg-dark">
                    <?php if($post['post_image']): ?>
                    <img src="./img/<?php echo $post['post_image'] ?>" alt="<?php echo $post['post_title'] ?>" style="margin:10px 10px 0px 10px"
                    width="90%" height="200">
                    <?php else: ?>
                        <img src="./img/code-blog.png" alt="Code Blog">
                    <?php endif; ?>
                    <div class="card-body">
                        <h6 class="card-title"><?php echo $post['post_title'] ?></h6>
                        <p class="card-text"><?php echo $post['post_content'] ?></p>
                        <a href="single.php?post-id=<?php echo $post_id; ?>" class="btn btn-primary">READ MORE</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            <?php else: ?>
                <?php include('./template-part/no_post_found.php') ?>
            <?php  endif; ?> 
        </div>
    </section>
    <!---Home main section end--->
    <?php include('./template-part/footer.php') ?>