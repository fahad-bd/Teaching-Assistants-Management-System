<?php
include 'partials/header.php';
?>


    <!-- add user -->
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Edit User</h2>
            <form action="" enctype="multipart/form-data">
                <input type="text" placeholder="First Name">
                <input type="text" placeholder="Last Name">
                <select name="" id="">
                    <option value="0">Teacher</option>
                    <option value="0">Teaching Assistant</option>
                    <option value="1">Admin</option>
                </select>
                <button class="btn" type="submit">Update User</button>
            </form>
        </div>
    </section>

<?php
include '../partials/footer.php';
?>