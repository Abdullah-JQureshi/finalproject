
<!-- Admin Side Bar -->

<div id="navbarSupportedContent" class="flex-shrink-0 p-3 col-sm-2 bg-dark">
    <ul class="list-unstyled ">
        <li class="mb-1">
            <button class="btn d-inline-flex align-items-center text-light">
              <a href="index.php" class="nav-link text-white h2">      
          Dashboard
        </a>
            </button>
        </li>
        
        <li class="mb-1">
            <button class="btn d-inline-flex align-items-center text-light" data-bs-toggle="collapse" data-bs-target="#users-collapse" aria-expanded="false">
                User
            </button>
            
            <div class="collapse" id="users-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="add_user.php" class="link-body-emphasis d-inline-flex text-decoration-none text-light  mb-3">Add Users</a></li>
                    <li><a href="user_request.php" class="link-body-emphasis d-inline-flex text-decoration-none text-light mb-3">Users Request</a></li>
                    <li><a href="user_setting.php" class="link-body-emphasis d-inline-flex text-decoration-none text-light ">Users Setting</a></li>
                </ul>
            </div>
        </li>
        
        <li class="mb-1">
            <button class="btn d-inline-flex align-items-center text-light " data-bs-toggle="collapse" data-bs-target="#blogs-collapse" aria-expanded="false">
                Blog
            </button>
            <div class="collapse" id="blogs-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="add_blog.php" class="link-body-emphasis d-inline-flex text-decoration-none text-light mb-3">Add Blogs</a></li>
                    <li><a href="blog_setting.php" class="link-body-emphasis d-inline-flex text-decoration-none text-light ">Blogs Setting</a></li>
                </ul>
            </div>
        </li>

        <li class="mb-1">
            <button class="btn d-inline-flex align-items-center text-light" data-bs-toggle="collapse" data-bs-target="#posts-collapse" aria-expanded="false">
                Post
            </button>
            <div class="collapse" id="posts-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="add_post.php" class="link-body-emphasis d-inline-flex text-decoration-none text-light mb-3">Add Posts</a></li>
                    <li><a href="post_setting.php" class="link-body-emphasis d-inline-flex text-decoration-none text-light ">Posts Setting</a></li>
                </ul>
            </div>
        </li>
        
        <li class="mb-1">
            <button class="btn d-inline-flex align-items-center text-light collapse" data-bs-toggle="collapse" data-bs-target="#categories-collapse" aria-expanded="false">
                Category
            </button>
            <div class="collapse" id="categories-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="add_category.php" class="link-body-emphasis d-inline-flex text-decoration-none text-light mb-3">Add Categories</a></li>
                    <li><a href="category_setting.php" class="link-body-emphasis d-inline-flex text-decoration-none text-light ">Categories Setting</a></li>
                </ul>
            </div>
        </li>
        
        <li class="mb-1">
            <button class="btn d-inline-flex align-items-center text-light">
              <a href="comment.php" class="text-decoration-none text-light">Comments</a>
            </button>
        </li>
        
        <li class="mb-1">
            <button class="btn d-inline-flex align-items-center text-light">
              <a href="feedback.php" class="text-decoration-none text-light">Feedbacks</a>
            </button>
        </li>

        <li class="mb-1">
            <button class="btn d-inline-flex align-items-center text-light">
              <a href="followers.php" class="text-decoration-none text-light">Followers</a>
            </button>
        </li>
    </ul>
</div> 