<section class="dash-container">
    <h1>Welcome <span><?php echo htmlspecialchars(strtoupper($_SESSION['username'])) ?? 'Admin'; ?></span></h1>
    <article>
        <?php if (!isset($posts)): ?>
            <div>No posts found!</div>
        <?php else: ?>
            <div class="posts-container">
                <p class="num-posts">Number of posts: <?php echo count($posts); ?></p>

                <!-- Error message -->
                <div class="post_handler">
                    <?php if (isset($_SESSION['post_handler'])): ?>
                        <p><?php echo $_SESSION['post_handler']; ?></p>
                        <p><?php unset($_SESSION['post_handler']); ?></p>
                    <?php endif; ?>
                </div>

                <!-- Display Posts -->
                <?php foreach ($posts as $post): ?>
                    <div class="single-post">
                        <div class="single-post-content">
                            <p><span>ID: </span><?php echo htmlspecialchars($post['post_id']); ?></p>
                            <p><span>Post Title: </span><?php echo htmlspecialchars($post['title']); ?></p>
                            <p><span>Author: </span><?php echo htmlspecialchars($post['author_name']); ?></p>
                            <p><span>Created At: </span><?php echo htmlspecialchars($post['created_at']); ?></p>
                            <p><span>Updated At: </span><?php echo htmlspecialchars($post['updated_at']); ?></p>
                        </div>

                        <div class="single-post-btn">
                            <a href="/ukBlog/update-post?id=<?php echo htmlspecialchars($post['post_id']); ?>"><button class="upt-btn">Update</button></a>
                            <a href="/ukBlog/delete-post?id=<?php echo htmlspecialchars($post['post_id']); ?>"><button class="del-btn">Delete</button></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </article>
</section>
