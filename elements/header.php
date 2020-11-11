<html>

<head>
    <title>User login logout register create system</title>
    <link rel="stylesheet" href="css/style.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
    </script>
</head>

<body>

    <!-- Logo & Nav toggler -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php?">
            <img src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav items -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?">home</a>
                </li>
                <!-- Non-logged in users -->
                <?php if (!isset($_SESSION['user'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=login">login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=register">register</a>
                </li>
                <?php } ?>
                
                <!-- Logged in users only -->
                <?php if (isset($_SESSION['user'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=userpage">userpage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?&logout=true">logout</a>
                </li>
                <?php } ?>

                <!-- Admin only -->
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin') { ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=admin">admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=create_admin">create admin</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </nav>