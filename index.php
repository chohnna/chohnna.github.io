<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <meta name="discription" content="A very first website of portfolia by hanna cho">
 <title>Hanna cho - Curriculum Vitae</title>
</head>
 
<body>
 <br/>
 <a href="https://www.mendeley.com/profiles/hanna-cho6/" target="_blank">[Mendeley]</a>
 <a href="https://github.com/hanncho" target="_blank">[GitHub]</a>
 <!-- Hi, hope you have a good day -->
 <h4>Hanna Cho</h4>
 <!-- need to work more on it -->
 <hr/>
 <br/>
 <p>B.S. in Chemistry</p>
 <p>Hi, <b>Thank you</b> for visiting my website</p>
 <p>This is my very <b><i>first</i></b> website</p> 
</body>
 
<footer>
<div id="respond">
 <h3>Feel free to leave a comment!</h3>
 <form action="post_comment.php" method="post" id="commentform">
  <label for="comment_author" class="required">Your name </label>
  <input type="text" name="comment_author" id="comment_author" value="" tabindex="1" required="required">
  <br/>
  <label for="email" class="required">Your email</label>
  <input type="email" name="email" id="email" value="" tabindex="2" required="required">
  <br/>
  <label for="comment" class="required">Your message</label>
  <br/>
  <br/>
  <textarea name="comment" id="comment" rows="10" tabindex="4"  required="required"></textarea>
  <!-- comment_post_ID value hard-coded as 1 -->
  <input type="hidden" name="comment_post_ID" value="1" id="comment_post_ID" />
  <br/>
  <input name="submit" type="submit" value="Submit comment" />
 </form>
</div>
<?php
require('Persistence.php');
$db = new Persistence();
if( $db->add_comment($_POST) ) {
  header( 'Location: index.php' );
}
else {
  header( 'Location: index.php?error=Your comment was not posted due to errors in your form submission' );
}
?>
 
<?php
require('Persistence.php');
$comment_post_ID = 1;
$db = new Persistence();
$comments = $db->get_comments($comment_post_ID);
$has_comments = (count($comments) > 0);
?>

 <input type="hidden" name="comment_post_ID" value="<?php echo($comment_post_ID); ?>" id="comment_post_ID" />
</footer>
<ol id="posts-list" class="hfeed<?php echo($has_comments?' has-comments':’); ?>">
  <li class="no-comments">Be the first to add a comment.</li>
  <?php
    foreach ($comments as $comment) {
      ?>
      <li><article id="comment_<?php echo($comment['id']); ?>" class="hentry">  
        <footer class="post-info">
          <abbr class="published" title="<?php echo($comment['date']); ?>">
            <?php echo( date('d F Y', strtotime($comment['date']) ) ); ?>
          </abbr>

          <address class="vcard author">
            By <a class="url fn" href="#"><?php echo($comment['comment_author']); ?></a>
          </address>
        </footer>

        <div class="entry-content">
          <p><?php echo($comment['comment']); ?></p>
        </div>
      </article></li>
      <?php
    }
  ?>
</ol>
#posts-list.has-comments li.no-comments {
  display: none;
}
</html>
