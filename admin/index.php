<?php
include 'partials/header.php';
?>


    <!----------------------------------------- Start Manage Post --------------------------------------->
    <section class="dashboard">
        <div class="container dashboard__container">
            <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
            <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
            <aside>
                <ul>
                    <li><a href="add-post.php"><i class="uil uil-pen"></i>
                        <h5>Add Post</h5>
                    </a></li>
                
                    <li><a class="active" href="index.php"><i class="uil uil-fast-mail"></i>
                        <h5>Manage Posts</h5>
                    </a></li>

                    <?php if(isset($_SESSION['user_is_admin'])) : ?>

                    <li><a href="add-user.php"><i class="uil uil-user-plus"></i>
                        <h5>Add User</h5>
                    </a></li>
                
                    <li><a href="manage-users.php"><i class="uil uil-user-times"></i>
                        <h5>Manage User</h5>
                    </a></li>
                
                    <li><a href="add-category.php"><i class="uil uil-edit"></i>
                        <h5>Add Categori</h5>
                    </a></li>
                
                    <li><a href="manage-categories.php"><i class="uil uil-list-ul"></i>
                        <h5>Manage Categories</h5>
                    </a></li>

                    <?php endif ?>
                </ul>
            </aside>
            <main>
                <h2>Manage Users</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Categori</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <body>
                        <tr>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing.</td>
                            <td>Art</td>
                            <td><a href="edit-post.php" class="btn sm">Edit</a></td>
                            <td><a href="delete-post.php" class="btn sm danger">Delete</a></td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing.</td>
                            <td>Art</td>
                            <td><a href="edit-post.php" class="btn sm">Edit</a></td>
                            <td><a href="delete-post.php" class="btn sm danger">Delete</a></td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing.</td>
                            <td>Art</td>
                            <td><a href="edit-post.php" class="btn sm">Edit</a></td>
                            <td><a href="delete-post.php" class="btn sm danger">Delete</a></td>
                        </tr>
                    </body>
                </table>
            </main>
        </div>
    </section>
    <!----------------------------------------- End Manage Post --------------------------------------->




<?php
include '../partials/footer.php';
?>