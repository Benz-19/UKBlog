<div class="container">
    <form action="/ukBlog/create-post" method="POST" id="blogForm">
        <h2>Create a New Blog Post</h2>
        <div class="message" style="display: none;">
            <p class="error">
                <?php if (isset($_SESSION['error'])): ?>
                    <?php echo $_SESSION['error']; ?>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
            </p>
            <p class="success">
                <?php if (isset($_SESSION['success'])): ?>
                    <?php echo $_SESSION['success']; ?>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
            </p>
        </div>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Enter post title" required />

        <label for="content">Content</label>
        <textarea id="content" name="body" rows="6" placeholder="Write your post..." required></textarea>

        <label for="image">Cover Image (optional)</label>
        <input type="file" id="image" name="image" accept="image/*" />

        <button type="submit" name="sendPost">Publish</button>

        <p class="message" id="formMessage"></p>
    </form>
</div>

for
