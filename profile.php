<?php
include 'partials/header.php';


//fetch post from db
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM profile WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $profile = mysqli_fetch_assoc($result);
    $ta_id = $profile['ta1'];
    if($ta_id != -1){
        $ta_profile_query = "SELECT * FROM profile WHERE id = $ta_id";
        $ta_profile_result = mysqli_query($connection, $ta_profile_query);
        $ta_profile = mysqli_fetch_assoc($ta_profile_result);
    }
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

    <!-- ta  -->
    <?php if($ta_id != -1) : ?>
    <section class="posts">
        <div class="container posts__container">
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/<?= $ta_profile['profilePic'] ?>" alt="">
                </div>
                <div class="post__info">
                    <h3 class="post__title">
                        <a href="<?= ROOT_URL ?>profile.php?id=<?= $ta_profile['id'] ?>"><?= $ta_profile['name'] ?></a>
                    </h3>
                    <p class="post__body">
                        <?= substr($ta_profile['description'],0,150) ?>...
                    </p>
                </div>
            </article>
        </div>
    </section>
    <?php endif ?>
    <!-- ta end  -->
    <!--------------------------------------- Start Category ----------------------------------->
    
    <!--------------------------------------- End Category ----------------------------------->

<?php
include 'partials/footer.php'
?>