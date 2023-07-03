<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>secret bottle</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;600&display=swap" rel="stylesheet">
        <!-- Styles -->
        <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
        <style>
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            html, body {
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                line-height: 1.5;
                font-family: font-family: 'Figtree', sans-serif;

                
            }

            a {
                text-decoration: none;
                color:#fffafa /* Default text color */
            }

            a:hover {
                color: #1a202c; /* Hover text color */
            }

            input, button, select, optgroup, textarea {
                font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
                font-size: xx-small
            }

            .main {
                position: relative;
                background-image: url('assets/img/loginimg.png');
                background-size: cover;
                width: 390px;
                height: 844px;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column; /* Adding this line to arrange items vertically */
            }

            .glowAnime {
			/* padding-top: 5%; */
			font-size: 1.5em;
			color: white;
		}

            .auth-links {
                position: absolute;
                bottom: 10%;
                text-align: center;
                width: 70%;
                left: 15%;
            }

            .auth-links a {
                display: inline-block; /* Each link will be displayed in a separate line */
                font-size: 5px
                padding: 15px 15px;
                color: white;
                background-color: #007BFF;
                border: none;
                border-radius: 20px;
                text-decoration: none;
                margin: 10px auto;
                width: 100%;
                text-align: center;
                position: relative;
            }

            #login {
                padding: 11px;
            }

            #register {
                padding: 11px;
            }

            .auth-links a:hover {
                background-color: #0056b3;
            }

        </style>
    </head>

    <body>
        
        <div class="main">
            <p class="glowAnime">secret bottle</p>
            <?php if(Route::has('login')): ?>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(url('/dashboard')); ?>" class="auth-links" id="dashboard">Dashboard</a>
                <?php else: ?>
                    <div class="auth-links">
                        <a href="<?php echo e(route('login')); ?>" id="login">Log in</a>
                        <?php if(Route::has('register')): ?>
                            <a href="<?php echo e(route('register')); ?>" id="register">Register</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
        <script src="http://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/move02/8-17/js/8-17.js"></script>
    </body>
</html><?php /**PATH /var/www/html/resources/views/welcome.blade.php ENDPATH**/ ?>