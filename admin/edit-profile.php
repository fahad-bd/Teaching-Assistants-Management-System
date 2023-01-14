<?php
require 'partials/header.php';


//fetch post content from db
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM profile WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $profile = mysqli_fetch_assoc($result);
}
else {
    header('location: ' . ROOT_URL . 'admin/manage-profile.php');
    die();
}

//fetch ta from db
$all_ta = "SELECT * FROM profile WHERE is_ta = 1";
$all_ta_result = mysqli_query($connection, $all_ta);

?>
    <!-- profile edit  -->
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Edit Profile</h2>
            <form action="<?= ROOT_URL ?>admin/edit-profile-logic.php" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="id" value="<?= $profile['id'] ?>">
                <input type="hidden" name="previous_thumbnail_name" value="<?= $profile['profilePic'] ?>">
                <input type="text" name="name" value="<?= $profile['name'] ?>" placeholder="Full Name">
                <textarea rows="10" name="description" placeholder="Description"><?= $profile['description'] ?></textarea>
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
                <button type="submit" name="submit" class="btn" >Update Post</button>
            </form>
        </div>
    </section>

  <?php
  require '../partials/footer.php';
  ?>