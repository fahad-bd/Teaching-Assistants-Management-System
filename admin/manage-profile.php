<?php
include 'partials/header.php';

$profiles_query = "SELECT * FROM profile";
$profiles = mysqli_query($connection, $profiles_query);
?>


    <!----------------------------------------- Start Manage User --------------------------------------->
    <section class="dashboard">

        <!-- success massege for added user  -->
        <?php if(isset($_SESSION['add-user-success'])) : ?>
            <div class="alert__message success container">
                    <p>
                        <?= $_SESSION['add-user-success'];
                        unset($_SESSION['add-user-success']); 
                        ?>
                    </p>
            </div>
            <!-- edit user if succefull give this sms  -->
        <?php elseif(isset($_SESSION['edit-user-success'])) : ?>  
            <div class="alert__message success container">
                    <p>
                        <?= $_SESSION['edit-user-success'];
                        unset($_SESSION['edit-user-success']); 
                        ?>
                    </p>
            </div>
            <!-- edit user if error than show this  -->
        <?php elseif(isset($_SESSION['edit-user'])) : ?> 
            <div class="alert__message error container">
                    <p>
                        <?= $_SESSION['edit-user'];
                        unset($_SESSION['edit-user']); 
                        ?>
                    </p>
            </div>
            <!-- delete user error sms  -->
        <?php elseif(isset($_SESSION['delete-user'])) : ?> 
            <div class="alert__message error container">
                    <p>
                        <?= $_SESSION['delete-user'];
                        unset($_SESSION['delete-user']); 
                        ?>
                    </p>
            </div>
            <!-- delete user success sms  -->
        <?php elseif(isset($_SESSION['delete-user-success'])) : ?> 
            <div class="alert__message success container">
                    <p>
                        <?= $_SESSION['delete-user-success'];
                        unset($_SESSION['delete-user-success']); 
                        ?>
                    </p>
            </div>
        <?php elseif(isset($_SESSION['add-profile'])) : ?> 
            <div class="alert__message error container">
                    <p>
                        <?= $_SESSION['add-profile'];
                        unset($_SESSION['add-profile']); 
                        ?>
                    </p>
            </div>
        <?php elseif(isset($_SESSION['add-profile-success'])) : ?> 
            <div class="alert__message success container">
                    <p>
                        <?= $_SESSION['add-profile-success'];
                        unset($_SESSION['add-profile-success']); 
                        ?>
                    </p>
            </div>
        <?php elseif(isset($_SESSION['edit-profile-success'])) : ?> 
            <div class="alert__message success container">
                    <p>
                        <?= $_SESSION['edit-profile-success'];
                        unset($_SESSION['edit-profile-success']); 
                        ?>
                    </p>
            </div>
        <?php elseif(isset($_SESSION['delete-profile'])) : ?> 
            <div class="alert__message error container">
                    <p>
                        <?= $_SESSION['delete-profile'];
                        unset($_SESSION['delete-profile']); 
                        ?>
                    </p>
            </div>
        <?php elseif(isset($_SESSION['delete-profile-success'])) : ?> 
            <div class="alert__message success container">
                    <p>
                        <?= $_SESSION['delete-profile-success'];
                        unset($_SESSION['delete-profile-success']); 
                        ?>
                    </p>
            </div>
        <?php endif ?>

        <div class="container dashboard__container">
            <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
            <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>

            <aside>
                <ul>
                    <li><a href="add-post.php"><i class="uil uil-pen"></i>
                        <h5>Add Post</h5>
                    </a></li>
                
                    <li><a href="index.php"><i class="uil uil-fast-mail"></i>
                        <h5>Manage Posts</h5>
                    </a></li>

                    <?php if(isset($_SESSION['user_is_admin'])) : ?>

                    <li><a href="add-user.php"><i class="uil uil-user-plus"></i>
                        <h5>Add User</h5>
                    </a></li>
                
                    <li><a href="manage-users.php"><i class="uil uil-book-reader"></i>
                        <h5>Manage User</h5>
                    </a></li>

                    <li><a href="add-profile.php"><i class="uil uil-user-square"></i>
                        <h5>Add Profile</h5>
                    </a></li>
                
                    <li><a href="manage-profile.php"><i class="uil uil-user-circle"></i>
                        <h5>Manage Profile</h5>
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
                <h2>Manage Profile</h2>
                <?php if(mysqli_num_rows($profiles) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <!-- <th>Description</th> -->
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Designation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($profile = mysqli_fetch_assoc($profiles)) : ?>
                            <tr>
                                <td><?= "{$profile['name']}"?></td>
                                <!-- for show the description on the manage profile page uncommand next line -->
                                <!-- <td><?//= $profile['description']?></td> -->
                                <td><a href="<?= ROOT_URL ?>admin/edit-profile.php?id=<?= $profile['id']?>" class="btn sm">Edit</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-profile.php?id=<?= $profile['id']?>" class="btn sm danger">Delete</a></td>
                                <td><?= $profile['is_ta'] ? 'TA' : 'Faculty' ?></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
                <?php else : ?>
                    <div class="alert__message error">
                        <?= "No Profile Found!" ?>
                    </div>
                <?php endif ?>    
            </main>
        </div>
    </section>
    <!----------------------------------------- End Manage User --------------------------------------->




<?php
include '../partials/footer.php';
?>