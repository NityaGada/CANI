<?php
session_start();
include('./includes/db.php');
if(!isset($_SESSION['first'])){
	header('location: ./login.php');
}
include('./template-part/head.php') ;
if(isset($_GET['post-id'])){
		
	$post_id =$_GET['post-id'];
}
$full_name = $_SESSION['first'].' '.$_SESSION['last'];
$login_user_pic = $_SESSION['image'];
?>
    <!---Add post section start--->
<?php //include('./template-part/add_post_form.php') ?>
    <!---single page section start--->


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Blogs</title>
<!-- font icons -->
<link rel="stylesheet" href="assets/vendors/themify-icons/css/thfemify-icons.css">
<!-- Bootstrap + JoeBLog main styles -->
<link rel="stylesheet" href="assets/css/joeblog.css">

<section data-spy="scroll" data-target=".navbar" data-offset="40" id="home" style="background-color: #151515; font-family: 'Montserrat', sans-serif;
  color: #e5e5e2; scroll-behavior: smooth;">

    <section class="container">
    <?php
            $all_post = mysqli_query($conn,"SELECT * FROM user_post WHERE id='$post_id'");
            while ($post = mysqli_fetch_array($all_post)): ?>
        <div class="page-container">
            <div class="page-content">
                <div class="card">
                    <div class="card-header pt-0">
                        <h3 class="card-title mb-4"><?php echo $post['post_title'] ?></h3>
                        <div class="blog-media mb-4">
                        <?php if($post['post_image']): ?>
                            <img src="./img/<?php echo $post['post_image'] ?>" alt="<?php echo $post['post_title'] ?>">
                        <?php else: ?>
                            <img src="./img/code-blog.png" alt="Code Blog">
                        <?php endif; ?>
                        </div>  
                        <small class="small text-muted">
                            <a href="#" class="text-muted">BY Admin</a>
                            <span class="px-2">·</span>
                            <span><?php echo $post['post_date'] ?></span>
                            <span class="px-2">·</span>
                            <a href="#" class="text-muted"> Comments : 
                            <?php $comments_count = mysqli_query($conn,"SELECT COUNT(id) FROM user_comment  WHERE comment_post_id='$post_id'"); 
                             $row = $comments_count->fetch_row();
                                echo '<span>('.$row[0].')</span>'; 
                                ?>
                            </a>
                        </small>
                    </div>
                    <div class="card-body border-top">
                        <p class="my-3"><?php echo $post['post_content']; ?></p>
                        <p><?php echo "<b>Prompt for content :</b>", $post['content_prompt']; ?></p>
                        <p><?php echo "<b>Prompt for content :</b>",$post['image_prompt']; ?></p>
                    </div>
                    
                    <div class="card-footer">
                         <div class="comment-form flex align-items-center">
                    <?php if($login_user_pic): ?>
                        <img class="autor-img" src="./img/<?php echo $login_user_pic ?>" alt="<?php echo $full_name ?>">
                    <?php else: ?>
                        <img class="autor-img" src="./img/avatar.png" alt="<?php echo $full_name ?>">
                    <?php endif; ?>
                    <form class="flex" style="width: 100%" action="includes/comment.php?single-post-id=<?php echo $post_id; ?>" method="POST">
                        <input type="text" name="comment" placeholder="Leave a comment" style="width: 100%" required>
                        <input type="hidden" name="comment-postid" value="<?php echo $post_id; ?>" />
                        <button style="margin-left:5px;" class="primary_btn" type="submit"><i class="fa-solid fa-arrow-right-to-bracket"></i></button>
                    </form>
                </div>
                <h3 class="title" style="margin: 1rem 0;">Comments -
                    <?php $comments_count = mysqli_query($conn,"SELECT COUNT(id) FROM user_comment  WHERE comment_post_id='$post_id'"); 
                        $row = $comments_count->fetch_row();
                        echo '<span>('.$row[0].')</span>'; 
                    ?>
                </h3>
                <?php $all_comments = mysqli_query($conn,"SELECT * FROM user_comment WHERE comment_post_id='$post_id'");
                $comment_num = mysqli_num_rows($all_comments);
                if($comment_num > 0): 
                while($comment = mysqli_fetch_array($all_comments)):
                ?>
                <div class="comments flex align-items-center">
                    <?php if($comment['user_pic']): ?>
                        <img class="autor-img" src="./img/<?php echo $comment['user_pic'] ?>" alt="<?php echo $comment['user_name'] ?>">
                    <?php else: ?>
                        <img class="autor-img" src="./img/avatar.png" alt="<?php echo $comment['user_name'] ?>">
                    <?php endif; ?>
                    <div>
                        <h5 class="title"><span><?php echo $comment['user_name']; ?></span></h5>
                        <p><?php echo $comment['comment']; ?></p>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php else: ?>
                    <div class="comments flex align-items-center justify-content-center">
                        <h5 class="title">No comments have been posted yet</h5>
                    </div>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
                       
                    </div>                  
                </div> 

               
              
            <!-- Sidebar -->
            <div class="page-sidebar">
            <?php 
            $all_post = mysqli_query($conn,"SELECT * FROM user_post WHERE id='$post_id'");
            while ($post = mysqli_fetch_array($all_post)): 
            ?>  
                <h3 class=" ">Ai Used for Blog</h3>
                <a href="#" class="badge badge-primary m-1"><?php echo $post['content_ai']; ?></a><br>
                <br><br>
                <h3 class=" ">Ai Used for Image</h3>
                <a href="javascript:void(0)" class="badge badge-primary m-1"><?php echo $post['image_ai']; ?></a><br>
                <br><br><br>
                <?php endwhile; ?>
            </div>
        </div>
    </section>


	<!-- core  -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- JoeBLog js -->
    <script src="assets/js/joeblog.js"></script>
</section>
    
<?php include('./template-part/footer.php') ?>
