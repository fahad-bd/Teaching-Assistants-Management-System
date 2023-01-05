<?php
include 'partials/header.php';

// get back form data if any error occure
$name = $_SESSION['add-profile-data']['name'] ?? null;
$description = $_SESSION['add-profile-data']['description'] ?? null;
$ta1 = $_SESSION['add-profile-data']['ta1'] ?? null;
$ta2 = $_SESSION['add-profile-data']['ta2'] ?? null;

//delete session data
unset($_SESSION['add-posfile-data']);

?>


    <!-- add profile -->
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Add Profile</h2>
            <?php if(isset($_SESSION['add-profile'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['add-profile'];
                        unset($_SESSION['add-profile']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-profile-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="name" value="<?= $name ?>" placeholder="Name">
                <textarea rows="8" value="<?= $description ?>" name="description" placeholder="Description"></textarea>
                <select name="userrole" id="">
                    <option value="0">Faculty</option>
                    <option value="1">Teaching Assistant</option>
                </select>
                <div class="form__control">
                    <label for="avatar">Profile Picture</label>
                    <input type="file" name="avatar" id="avatar">
                </div>
                <button class="btn" name="submit" type="submit">Add User</button>
            </form>
        </div>
    </section>

<?php
include '../partials/footer.php';
?>