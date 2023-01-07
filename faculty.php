<?php
include 'partials/header.php';

// fetch post 
$query = "SELECT * FROM profile WHERE is_ta = 0";
$faculty_result = mysqli_query($connection, $query);
?>


    <!--------------------------------------- Start Chairman ----------------------------------->
    <section class="featured">
        <div class="container featured__container">
            <div class="post__thumbnail">
                <img src="./images/tj.jpeg" alt="">
            </div>
            <div class="post__info">
                <br>
                <br>
                <!-- <a href="category-posts.html" class="category__button">Wild Life</a> -->
                <h2 class="post__title"><a href="<?= ROOT_URL ?>tj.php">Dr. Taskeed Jabid</a></h2>
                <p class="post__body" style="text-align: justify;">
                    <b>Chairperson & Associate Professor</b> <br> Department of Computer Science & Engineering <br> <br> <br>
                    We welcome you on behalf of the faculty, staff, and students of the Department of Computer Science and Engineering (CSE) at the East West University (EWU). It is one of the few private universities in Bangladesh that has got a Permanent Certificate from the Ministry of Education by fulfilling all the criteria set for the status. CSE Department at EWU was founded in 1996 at the very beginning of the establishment of the university. CSE Department is now the second largest department of East West University. It has about 1200 students and 28 qualified full-time faculty members. Nevertheless, the present civilization cannot be thought without the use of Information Technology. 
                </p>
                <!-- <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="images/pic/avatar2.jpg" alt="">
                    </div>
                    <div class="post__author-info">
                        <h5>By: Taskid Javid</h5>
                        <small>December 10, 2022 - 09:21</small>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <!--------------------------------------- End Chairman ----------------------------------->

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