<div class="post-landing">
    <section class="main-container">
        <article class="slider">
            <div class="list" id="slider-list">
                <div class="item">
                    <img src="/ukBlog/public/assets/images/slide-1.jpg" loading="lazy" alt="Slide 1 Image">
                    <div class="content">
                        <div class="title">UK BLOG</div>
                        <div class="type">UNIVERSAL CONTINENT</div>
                        <div class="description">
                            Welcome to the UK Blog. Explore diverse content and perspectives.
                        </div>
                        <div class="button">
                            <button>SEE MORE</button>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="/ukBlog/public/assets/images/slide-2.jpg" loading="lazy" alt="Slide 2 Image">
                    <div class="content">
                        <div class="title">UK BLOG</div>
                        <div class="type">UNIVERSAL CONTINENT</div>
                        <div class="description">
                            Stay updated with fresh ideas and community stories.
                        </div>
                        <div class="button">
                            <button>SEE MORE</button>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="/ukBlog/public/assets/images/slide-3.jpg" loading="lazy" alt="Slide 3 Image">
                    <div class="content">
                        <div class="title">UK BLOG</div>
                        <div class="type">UNIVERSAL CONTINENT</div>
                        <div class="description">
                            Dive into the culture, creativity, and insight.
                        </div>
                        <div class="button">
                            <button>SEE MORE</button>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="/ukBlog/public/assets/images/slide-4.jpg" loading="lazy" alt="Slide 4 Image">
                    <div class="content">
                        <div class="title">UK BLOG</div>
                        <div class="type">UNIVERSAL CONTINENT</div>
                        <div class="description">
                            Discover stories that matter and voices that inspire.
                        </div>
                        <div class="button">
                            <button>SEE MORE</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nextPrevArrows">
                <button id="prev-arrow">&#10094;</button>
                <button id="next-arrow">&#10095;</button>
            </div>
        </article>

        <article class="view-posts-container">
            <h1 style="text-align: center; margin-top: 30px; text-decoration: underline;">TRENDING POSTS</h1>

            <article class="view-posts">
                <!-- View available posts -->
                <?php require __DIR__ . '/../posts/displayPosts.php'; ?>
            </article>
        </article>
    </section>
</div>
