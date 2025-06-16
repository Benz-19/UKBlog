<section>
    <article class="post-card">
        <img src="/ukBlog/public/assets/images/book.jpg" alt="">
        <h1>Here</h1>
        <?php foreach ($posts as $post): ?>
            <div class="post-title"><span>Author: </span><?php echo $post['post_author']; ?></div>
            <div class="post-title"><span>Title: </span><?php echo $post['post_title']; ?></div>
            <div class="post-body"><span>Book Content: </span><?php echo $post['post_body']; ?></div>
            <button class="view-post-btn">Read More</button>
        <?php endforeach; ?>
    </article>
</section>
