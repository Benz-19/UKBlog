<section class="display-posts">
    <article class="post-card">
        <?php if (empty($posts)): ?>
            <div class="post-content">
                <img src="/ukBlog/public/assets/images/book.jpg" alt="">
                <div class="author-name"><span>Author: </span><br>UK BLOG</div>
                <div class="post-title"><span>Title: </span><br>Potential Blog Template</div>
                <div class="post-body"><span>Book Content: </span><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, assumenda? Aperiam, voluptas? Fugit quisquam fuga obcaecati recusandae reiciendis sed,
                    illum voluptate...</div>
                <button class="view-post-btn">Read More</button>
            </div>

        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <div class="post-content">
                    <img src="/ukBlog/public/assets/images/book.jpg" alt="">
                    <div class="post-title"><span>Author: </span><br><?php echo htmlspecialchars(ucfirst($post['author_name'])); ?></div>
                    <div class="post-title"><span>Title: </span><br><?php echo htmlspecialchars($post['post_title']); ?></div>
                    <div class="post-body"><span>Book Content: </span><br><?php echo htmlspecialchars(mb_strimwidth($post['post_body'], 0, 10, '...')) ?></div>
                    <button class="view-post-btn">Read More</button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </article>
</section>
