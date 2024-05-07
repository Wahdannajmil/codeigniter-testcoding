<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Welcome to the Home Page</h1>

    <!-- Menu -->
    <nav>
        <ul>
            <?php if ($this->session->userdata('logged_in')): ?>
                <li><a href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
            <?php else: ?>
                <li><a href="<?php echo base_url('auth/login'); ?>">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</body>
</html>
