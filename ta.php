<?php
include 'partials/header.php';

// fetch post 
$query = "SELECT * FROM profile WHERE is_ta = 1";
$faculty_result = mysqli_query($connection, $query);
?>

<br><br>
    <!--------------------------------------- Start Post ----------------------------------->
    <section class="posts">
        <div class="container posts__container">
            <?php while($faculty = mysqli_fetch_assoc($faculty_result)) : ?>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/<?= $faculty['profilePic'] ?>" alt="">
                </div>
                <div class="post__info">
                    <h3 class="post__title">
                        <a href="<?= ROOT_URL ?>profile.php?id=<?= $faculty['id'] ?>"><?= $faculty['name'] ?></a>
                    </h3>
                    <p class="post__body">
                        <?= substr($faculty['description'],0,150) ?>...
                    </p>
                </div>
            </article>
            <?php endwhile ?>
        </div>
    </section>
    <!--------------------------------------- End Post ----------------------------------->

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

   <!-- footer -->
<?php
include 'partials/footer.php';
?>