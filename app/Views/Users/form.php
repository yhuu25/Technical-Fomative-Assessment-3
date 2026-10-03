<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
</head>
<body>

<h1><?= esc($title) ?></h1>

<?php $errors = session()->getFlashdata('errors') ?? []; ?>

<?php if ($errors): ?>
    <ul style="color:red;">
        <?php foreach ($errors as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php $editing = ! empty($user); ?>

<form method="post"
      enctype="multipart/form-data"
      action="<?= $editing
          ? site_url('users/' . $user['id'])
          : site_url('users') ?>">

    <?= csrf_field() ?>

    <p>
        <label>Username</label><br>
        <input
            type="text"
            name="username"
            required
            value="<?= esc(old('username', $user['username'] ?? '')) ?>">
    </p>

    <p>
        <label>Full Name</label><br>
        <input
            type="text"
            name="full_name"
            required
            value="<?= esc(old('full_name', $user['full_name'] ?? '')) ?>">
    </p>

    <?php if ($editing): ?>
        <p>
            <label>Profile Picture</label><br>
            <input
                type="file"
                name="avatar"
                accept=".jpg,.jpeg,.png,image/jpeg,image/png">
        </p>

        <small>JPG or PNG only. Maximum size: 2MB.</small>
    <?php endif; ?>

    <p>
        <button type="submit">
            <?= $editing ? 'Update User' : 'Add User' ?>
        </button>

        <a href="<?= site_url('users') ?>">Cancel</a>
    </p>
</form>

</body>
</html>