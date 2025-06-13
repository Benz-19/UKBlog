<div class="container">
    <form action="/ukBlog/update-post" method="POST" id="blogForm">
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
        <input type="text" id="title" name="title" value="<?php echo $title; ?>" required />

        <label for="body">Content</label>
        <textarea id="content" name="body" rows="6" required><?php echo $body; ?></textarea>

        <label for=" image">Cover Image (optional)</label>
        <input type="file" id="image" name="image" accept="image/*" />

        <button type="submit" name="updatePost">Update Post</button>

        <p class="message" id="formMessage"></p>
    </form>
</div>

for
