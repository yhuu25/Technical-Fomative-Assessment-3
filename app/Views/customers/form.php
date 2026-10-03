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

<?php $editing = ! empty($customer); ?>

<form method="post"
      action="<?= $editing
          ? site_url('customers/' . $customer['id'])
          : site_url('customers') ?>">

    <?= csrf_field() ?>

    <p>
        <label>Full Name</label><br>
        <input
            type="text"
            name="full_name"
            required
            value="<?= esc(old('full_name', $customer['full_name'] ?? '')) ?>">
    </p>

    <p>
        <label>Email</label><br>
        <input
            type="email"
            name="email"
            required
            value="<?= esc(old('email', $customer['email'] ?? '')) ?>">
    </p>

    <p>
        <label>Phone</label><br>
        <input
            type="text"
            name="phone"
            value="<?= esc(old('phone', $customer['phone'] ?? '')) ?>">
    </p>

    <button type="submit">
        <?= $editing ? 'Update Customer' : 'Add Customer' ?>
    </button>

    <a href="<?= site_url('customers') ?>">Cancel</a>
</form>

</body>
</html>