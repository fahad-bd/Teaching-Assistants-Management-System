<?php
include 'partials/header.php';

// get back form data if any error occure
$name = $_SESSION['add-profile-data']['name'] ?? null;
$description = $_SESSION['add-profile-data']['description'] ?? null;

//delete session data
unset($_SESSION['add-posfile-data']);

//fetch ta from db
$all_ta = "SELECT * FROM profile WHERE is_ta = 1";
$all_ta_result = mysqli_query($connection, $all_ta);

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
                <input type="text" name="name" value="<?= $name ?>" placeholder="Full Name">
                <textarea rows="8" value="<?= $description ?>" name="description" placeholder="Description"></textarea>
                <select name="userrole" id="">
                    <option value="0">Faculty</option>
                    <option value="1">Teaching Assistant</option>
                </select>
                <p>Select TA</p>
                <select name="ta_id">
                        <option value="-1">TA Not Selected</option>
                    <?php while($ta = mysqli_fetch_assoc($all_ta_result)) : ?>
                        <option value="<?= $ta['id']?>"><?= $ta['name'] ?></option>
                    <?php endwhile ?>
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