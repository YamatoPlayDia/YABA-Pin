<!DOCTYPE html>
<html>
<head>
    <title>Profile List</title>
    <!-- CSS only -->
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body>
    <div class="container mt-5">
        <table class="table" id="profileTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Profile</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <a href="/create" class="btn btn-dark">create</a>
    </div>

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>

    <!-- Custom JS -->
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/index.js'); ?>
</body>
</html><?php /**PATH /var/www/html/resources/views/index.blade.php ENDPATH**/ ?>