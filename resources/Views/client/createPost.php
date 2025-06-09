<div class="container">
    <form id="blogForm">
        <h2>Create a New Blog Post</h2>

        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Enter post title" required />

        <label for="content">Content</label>
        <textarea id="content" name="content" rows="6" placeholder="Write your post..." required></textarea>

        <label for="image">Cover Image (optional)</label>
        <input type="file" id="image" name="image" accept="image/*" />

        <button type="submit">Publish</button>

        <p class="message" id="formMessage"></p>
    </form>
</div>
