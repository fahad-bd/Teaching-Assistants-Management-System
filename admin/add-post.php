<?php
include 'partials/header.php';
?>


    <!-- post add  -->
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Create Post</h2>
            <div class="alert__message error">
                <p>This is an error message</p>
            </div>
            <form action="" enctype="multipart/form-data">
                <input type="text" placeholder="Title">
                <select>
                    <option value="1">Travel</option>
                    <option value="1">Art</option>
                    <option value="1">Science</option>
                    <option value="1">Science</option>
                    <option value="1">Science</option>
                    <option value="1">Science</option>
                </select>
                <textarea rows="10" placeholder="Body"></textarea>
                <div class="form__control inline">
                    <input type="checkbox" id="is_featured">
                    <label for="is_featured">Featured</label>
                </div>
                <div class="form__control">
                    <label for="thumbnail">Add Thumbnail</label>
                    <input type="file" name="" id="thumbnail">
                </div>
                <button class="btn" type="submit">Add Post</button>
            </form>
        </div>
    </section>

<?php
include '../partials/footer.php';
?>