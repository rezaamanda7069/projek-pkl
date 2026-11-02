<?php
require_once 'auth.php';

if (!empty($_SESSION['admin_id'])) {
    redirect_to('dasbord.php');
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Admin</title>

    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .box {
            background: white;
            width: 380px;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,.2);
        }

        .box h2 {
            text-align: center;
            margin: 0 0 20px;
        }

        .links {
            text-align: center;
            margin-top: 18px;
        }

        .links a {
            display: block;
            margin: 7px 0;
        }

    </style>

</head>

<body>

<div class="box">

    <h2>Login Admin</h2>

    <?php show_flash(); ?>

    <form action="proses.php" method="POST">

        <input type="hidden"
               name="csrf_token"
               value="<?php echo csrf_token(); ?>">

        <div class="form-group">

            <label>Username</label>

            <input
                class="form-control"
                type="text"
                name="username"
                autocomplete="username"
                required
            >

        </div>

        <div class="form-group">

            <label>Password</label>

            <input
                class="form-control"
                type="password"
                name="password"
                autocomplete="current-password"
                required
            >

        </div>

        <button
            class="btn btn-success btn-block"
            type="submit">

            Login

        </button>

    </form>

    <div class="links">

        <a href="lupa_password.php">
            Lupa Password?
        </a>

        <a href="../user/index.php">

            <span class="glyphicon glyphicon-home"></span>

            Kembali ke Beranda

        </a>

    </div>

</div>

</body>

</html>