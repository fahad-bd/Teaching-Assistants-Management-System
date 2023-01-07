<?php
include 'partials/header.php';

// fetch 
$featired_query = "SELECT * FROM posts WHERE is_featured=1";
$featired_result = mysqli_query($connection, $featired_query);
$featired = mysqli_fetch_assoc($featired_result);
?>


    <!--------------------------------------- Start Featured ----------------------------------->
<?php if(mysqli_num_rows($featired_result) == 1) : ?>
    <section class="featured">
        <div class="container featured__container">
            <div class="post__thumbnail">
                <img src="./images/<?= $featired['thumbnail'] ?>" alt="">
            </div>
            <div class="post__info">
                <?php
                //feacth category from categories table
                $category_id = $featired['category_id'];
                $category_query = "SELECT * FROM categories WHERE id = $category_id";
                $category_result = mysqli_query($connection, $category_query);
                $category = mysqli_fetch_assoc($category_result);
                $category_title = $category['title'];
                ?>
                <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category__button"><?= $category_title ?></a>
                <h2 class="post__title"><a href="<?= ROOT_URL ?>post.html?id=<?= $featired['id'] ?>"><?= $featired['title'] ?></a></h2>
                <p class="post__body">
                    <?= substr($featired['body'], 0, 300) ?>...
                </p>
                <div class="post__author">
                    <?php
                    //fetch author
                    $author_id = $featired['author_id'];
                    $author_query = "SELECT * FROM users WHERE id = $author_id";
                    $author_result = mysqli_query($connection, $author_query);
                    $author = mysqli_fetch_assoc($author_result);

                    ?>
                    <div class="post__author-avatar">
                        <img src="./images/<?= $author['avatar'] ?>" alt="">
                    </div>
                    <div class="post__author-info">
                        <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                        <small>
                            <?= date("M d, Y - H:i", strtotime($featired['date_time'])) ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
    <!--------------------------------------- End Featured ----------------------------------->

    <!--------------------------------------- Start Post ----------------------------------->
    <section class="posts">
        <div class="container posts__container">
            <article class="post">
                <div class="post__thumbnail">
                    <img src="images/pic/blog2.jpg" alt="">
                </div>
                <div class="post__info">
                    <a href="category-posts.html" class="category__button">Wild Life</a>
                    <h3 class="post__title">
                        <a href="post.html">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consectetur, repudiandae!</a>
                    </h3>
                    <p class="post__body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero tempore quasi, numquam voluptatem unde facere? Impedit unde dolores nulla mollitia! Inventore, ipsa distinctio?
                    </p>
                    <div class="post__author">
                        <div class="post__author-avatar">
                            <img src="images/pic/avatar3.jpg" alt="">
                        </div>
                    </div>
                    <div class="post__author-info">
                        <h5>By: F. Ahmad</h5>
                        <small>January 10, 2022 - 10:11</small>
                    </div>
                </div>
            </article>
        </div>
    </section>
    <!--------------------------------------- End Post ----------------------------------->

    <!--------------------------------------- Start Category ----------------------------------->
    <section class="category__buttons">
        <div class="container category__buttons-container">
            <a href="" class="category__button">Art</a>
            <a href="" class="category__button">Wild Life</a>
            <a href="" class="category__button">Travel</a>
            <a href="" class="category__button">Category</a>
            <a href="" class="category__button">Category</a>
            <a href="" class="category__button">Category</a>
        </div>
    </section>
    <!--------------------------------------- End Category ----------------------------------->

   <!-- footer -->
<?php
include 'partials/footer.php';
?>