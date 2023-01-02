<?php
include 'partials/header.php';


//for edit we need id of that row from database
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
}
else {
    header('location: ' . ROOT_URL . 'admin/manage-users.php');
    die();
}
?>


    <!-- add user -->
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Edit User</h2>
            <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="POST">
                <input type="hidden" value="<?= $user['id']?>" name="id">
                <input type="text" value="<?= $user['firstname']?>" name="firstname" placeholder="First Name">
                <input type="text" value="<?= $user['lastname']?>" name="lastname" placeholder="Last Name">
                <select name="userrole" id="">
                    <option value="0">Teacher</option>
                    <option value="0">Teaching Assistant</option>
                    <option value="1">Admin</option>
                </select>
                <button class="btn" name="submit" type="submit">Update User</button>
            </form>
        </div>
    </section>

<?php
include '../partials/footer.php';
?>