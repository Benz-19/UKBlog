 <nav>
     <ul>
         <li>
             <a href="/ukBlog">
                 <h3 class="logo">ukBlog </h3>
             </a>
         </li>
         <div class="nav-links">
             <a href="/ukBlog">
                 <li>Home</li>
             </a>
             <a href="/ukBlog/about">
                 <li>About</li>
             </a>
         </div>

         <?php if ($_SESSION['user_status'] !== 'logged-in'): ?>
             <div class="top-btn">
                 <a href="/ukBlog/login">
                     <button class="login">Login</button>
                 </a>
                 <a href="/ukBlog/register">
                     <button class="register">Register</button>
                 </a>
             </div>
         <?php else: ?>
             <div class="user-icon">
                 <i class="fas fa-user"></i>
             </div>

             <div class="user-option hide">
                 <ul>
                     <li><a href="/ukBlog/settings"><i class="fas fa-gear"></i> Settings</a></li>
                     <?php if ($_SESSION['user_type'] === 'client'): ?>
                         <li><a href="/ukBlog/view-posts"><i class="fas fa-book"></i> View Posts</a></li>
                     <?php endif; ?>
                     <li><a href="/ukBlog/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                 </ul>
             </div>

         <?php endif; ?>

     </ul>

     <div class="menu-btn">
         <i class="fas fa-bars open-menu"></i>
         <i class="fas fa-times close-menu hidden"></i>
     </div>

     <div class="menu-btn-content hidden">
         <ul>
             <li>
                 <a href="/ukBlog">
                     Home
                 </a>
             </li>
             <li>
                 <a href="/ukBlog/about">
                     About
                 </a>
             </li>
             <li>
                 <a href="/ukBlog/login">
                     <button class="login">Login</button>
                 </a>
             </li>
             <li>
                 <a href="/ukBlog/register">
                     <button class="register">register</button>
                 </a>
             </li>
         </ul>
     </div>

 </nav>
