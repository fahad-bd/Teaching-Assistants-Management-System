<?php
include 'partials/header.php';


//fetch post from db
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM profile WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $profile = mysqli_fetch_assoc($result);
}
else {
    header('location: ' . ROOT_URL . 'faculty.php');
}
?>

    <!----------------------------------------- Start Single Post Body --------------------------------------->
    <section class="singlepost">
        <div class="container singlepost__container">
            <h2><?= $profile['name'] ?></h2>
            <div class="singlepost__thumbnail">
                <img src="./images/<?= $profile['profilePic'] ?>" alt="">
            </div>
            <p>
                <?php echo $profile['description'] ?>
            </p>
        </div>  
    </section>
    <!--------------------------------------- End Post Body ----------------------------------->

    <!--------------------------------------- Start Category ----------------------------------->
    <section class="category__buttons">
        <div class="container category__buttons-container">
            <?php
                $all_categories_query = "SELECT * FROM categories";
                $all_categories = mysqli_query($connection, $all_categories_query);
            ?>
            <?php while($category = mysqli_fetch_assoc($all_categories)) : ?>
            <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['title'] ?></a>
            <?php endwhile ?>
        </div>
    </section>
    <!--------------------------------------- End Category ----------------------------------->

<?php
include 'partials/footer.php'
?>