<section class="display-posts">
    <article class="post-card">
        <img src="/ukBlog/public/assets/images/book.jpg" alt="">
        <?php if (empty($posts)): ?>
            <div class="author-name"><span>Author: </span>UK BLOG</div>
            <div class="post-title"><span>Title: </span>Potential Blog Template</div>
            <div class="post-body"><span>Book Content: </span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, assumenda? Aperiam, voluptas? Fugit quisquam fuga obcaecati recusandae reiciendis sed,
                illum voluptate...</div>
            <button class="view-post-btn">Read More</button>

        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <div class="post-title"><span>Author: </span><?php echo $post['author_name']; ?></div>
                <div class="post-title"><span>Title: </span><?php echo $post['post_title']; ?></div>
                <div class="post-body"><span>Book Content: </span><?php echo htmlspecialchars(mb_strimwidth($post['post_body'], 0, 10, '...')) ?><div>
                        <button class="view-post-btn">Read More</button>
                    <?php endforeach; ?>
                <?php endif; ?>
    </article>
</section>
