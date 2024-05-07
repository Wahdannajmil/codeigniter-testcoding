<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
</head>
<body>
    <h1>List of Accounts</h1>
    <!-- Tampilkan daftar akun -->
    <?php foreach ($accounts as $account): ?>
        <div>
            <h2><?php echo $account['username']; ?></h2>
            <p>Name: <?php echo $account['name']; ?></p>
            <p>Role: <?php echo $account['role']; ?></p>
        </div>
    <?php endforeach; ?>

    <h2>Create New Account</h2>
    <?php echo form_open('account/create'); ?>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="role">Role:</label>
        <input type="text" id="role" name="role" required>
        <br>
        <input type="submit" value="Create">
    <?php echo form_close(); ?>
</body>
</html>
