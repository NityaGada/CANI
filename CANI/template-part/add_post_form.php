<?php

 $all_topic = mysqli_query($conn,"SELECT * FROM topic ORDER BY id");
 $topic_num = mysqli_num_rows($all_topic);
 if($topic_num > 0){

 while ($topic = mysqli_fetch_array($all_topic)){
    if($topic["id"] == $_GET["id"]){
        $id  =  $topic["id"] ;
        $_SESSION["id"] = $id;
        $_SESSION["topic"] = $topic["topic"];

    }
 }
 }
?>
<?php if($_SESSION['email'] == "admin@email.com") : ?>
<button class="primary_btn add_post_form_open_btn">&plus;</button>
    <section class="add-post-form-area"  style="overflow-y: scroll;">
        <button class="primary_btn add_post_form_close_btn">&cross;</button>
        <div class="main-content">
            <div class="form-area flex align-items-center justify-content-center" style="height: 100vh;">
                <form action="./includes/add_post.php" method="POST" enctype="multipart/form-data">
                    <p>Create a new post your</p>
                    <div class="input-box">
                        <label for="postTitle">Post title</label> <br>
                        <input type="text" name="title" id="title" placeholder="Enter title" style="width: 100%">
                    </div>
                    <div class="input-box">
                        <label for="post-desc">Post Description</label>
                        <textarea name="postcont" id="post-desc" cols="30" rows="10" style="width: 100%"
                            placeholder="Enter post Description"></textarea>
                    </div>
                    <div class="input-box">
                        <label for="post-img">Post image</label>
                        <input type="file" id="post-img" style="width: 100%" name="post_ima" />
                    </div>
                    <div class="input-box">
                        <label for="postpromptcontent">Prompt for Content</label>
                        <input type="text" name="contentprompt" id="contentprompt" placeholder="Enter prompt for content"
                            style="width: 100%">
                    </div>
                    <div class="input-box">
                        <label for="postpromptimage">Prompt for Image</label>
                        <input type="text" name="imageprompt" id="imageprompt" placeholder="Enter prompt for image"
                            style="width: 100%">
                    </div>
                    <div class="input-box">
                        <label for="aiToolContent">AI Tool for content</label>
                        <input type="text" name="toolcontent" id="toolcontent" placeholder="Enter Tool used to generate content"
                            style="width: 100%">
                    </div>
                    <div class="input-box">
                        <label for="aiToolImage">AI Tool for Image</label>
                        <input type="text" name="toolimage" id="toolimage" placeholder="Enter Tool used to generate image"
                            style="width: 100%">
                    </div>
                    <input type="hidden" value=<?php $id ?> id="topic" name="topic" >
                    <div class=" flex justify-content-space-between">
                        <input class="primary_btn" type="submit" value="Add new post" />
                        <button class="primary_btn" type="reset">&circlearrowright;</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php endif; ?>