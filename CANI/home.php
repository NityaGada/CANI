
<?php
session_start();
include('./includes/db.php');
if(!isset($_SESSION['first'])){
	header('location: ./login.php');
}
include('./template-part/main_header.php') ;
$full_name = $_SESSION['first'].' '.$_SESSION['last'];
$login_user_pic = $_SESSION['image'];
?>
<section style="background-color: #151515;
    font-family: 'Montserrat', sans-serif;
    color: #e5e5e2; height:100%;">
    <div class="main-content flex justify-content-center post-area">
        <ul>
        <?php
            $all_topic = mysqli_query($conn,"SELECT * FROM topic ORDER BY id ");
            $topic_num = mysqli_num_rows($all_topic);
            if($topic_num > 0){
            
            while ($topic = mysqli_fetch_array($all_topic)){
                echo "<li> <a href='list.php?id={$topic['id']}'> {$topic['topic']}  
                </a></li>";
            }
            
            }
            ?>
        </ul>
    </div>
</section>



<!---Home main section end--->
<?php include('./template-part/footer.php') ?>
