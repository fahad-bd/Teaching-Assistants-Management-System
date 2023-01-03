<?php
include 'partials/header.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch category from db
    $query = "SELECT * FROM categories WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) == 1){
        $category = mysqli_fetch_assoc($result);
    }
}
else {
    header('location: ' . ROOT_URL . 'admin/manage-categories.php');
    die();
}
?>


    <!-- category add  -->
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Edit Category</h2>
            <form action="">
                <input type="text" value="<?= $category['title'] ?>" placeholder="Title">
                <textarea rows="4" placeholder="Description"> <?= $category['description'] ?></textarea>
                <button class="btn" type="submit">Update Category</button>
            </form>
        </div>
    </section>


<?php
include '../partials/footer.php';
?>