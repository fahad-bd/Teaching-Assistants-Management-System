<?php
include 'partials/header.php';
?>


    <!----------------------------------------- Start Manage User --------------------------------------->
    <section class="dashboard">
        <div class="container dashboard__container">
            <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
            <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
            <aside>
                <ul>
                    <li><a href="add-post.php"><i class="uil uil-pen"></i>
                        <h5>Add Post</h5>
                    </a></li>
                </ul>
                <ul>
                    <li><a href="index.php"><i class="uil uil-fast-mail"></i>
                        <h5>Manage Posts</h5>
                    </a></li>
                </ul>
                <ul>
                    <li><a href="add-user.php"><i class="uil uil-user-plus"></i>
                        <h5>Add User</h5>
                    </a></li>
                </ul>
                <ul>
                    <li><a class="active" href="manage-users.php"><i class="uil uil-user-times"></i>
                        <h5>Manage User</h5>
                    </a></li>
                </ul>
                <ul>
                    <li><a href="add-category.php"><i class="uil uil-edit"></i>
                        <h5>Add Categori</h5>
                    </a></li>
                </ul>
                <ul>
                    <li><a href="manage-categories.php"><i class="uil uil-list-ul"></i>
                        <h5>Manage Categories</h5>
                    </a></li>
                </ul>
            </aside>
            <main>
                <h2>Manage Users</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <body>
                        <tr>
                            <td>Fahad Ahammed</td>
                            <td>fahad</td>
                            <td><a href="edit-user.php" class="btn sm">Edit</a></td>
                            <td><a href="delete-user.php" class="btn sm danger">Delete</a></td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Fahad Ahammed</td>
                            <td>fahad</td>
                            <td><a href="edit-user.php" class="btn sm">Edit</a></td>
                            <td><a href="delete-user.php" class="btn sm danger">Delete</a></td>
                            <td>No</td>
                        </tr>
                        <tr>
                            <td>Fahad Ahammed</td>
                            <td>fahad</td>
                            <td><a href="edit-user.php" class="btn sm">Edit</a></td>
                            <td><a href="delete-user.php" class="btn sm danger">Delete</a></td>
                            <td>No</td>
                        </tr>
                    </body>
                </table>
            </main>
        </div>
    </section>
    <!----------------------------------------- End Manage User --------------------------------------->




<?php
include '../partials/footer.php';
?>