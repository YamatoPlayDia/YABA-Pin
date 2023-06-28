<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <!-- CSS only -->
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body>
    <div class="container mt-5">
        <form id="profileForm">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="profile">Profile</label>
                <textarea class="form-control" id="profile"></textarea>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <a href="/" class="btn btn-dark">back</a>
    </div>

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>

    <!-- Custom JS -->
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/edit_profile.js'); ?>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/edit_profile.blade.php ENDPATH**/ ?>