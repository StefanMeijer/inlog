<?php
//Check if user is trying to escape GET methode
if (!isset($_GET["page"])) {
    echo 'Use website as expected.';
    exit;
}
?>
<div class="content">
    <!-- logged in user information -->
    <div class="profile_info">
        <div>
            <?php  if (isset($_SESSION['user'])) : ?>
            <strong><?php echo $_SESSION['user']['username']; ?></strong>

            <small>
                <i style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
            </small>

            <?php endif ?>
        </div>
    </div>
</div>

<div class="row">
    <form action="" method="post" enctype="multipart/form-data">
    Select csv to upload:
    <input type="file" name="uploadedfile">
    <input type="submit" name="submit">
    </form>
</div>

<div class="row">
    <form action="" method="post" enctype="multipart/form-data">
     csv to export:
    <input type="submit" name="submit">
    </form>
</div>