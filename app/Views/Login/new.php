<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Login<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Login</h1>

<?php if (session()->has('warning')): ?>
    <div class="alert alert-warning">
        <?= session('warning') ?>
    </div>
<?php endif; ?>

<?= form_open('/login/create') ?>

<div> 
    <label for="email">Email</label>
    <input type="text" name="email" id="email" value="<?= old('email') ?>" required>
</div>

<div> 
    <label for="password">Password</label>
    <input type="password" name="password" required>
</div>

<button type="submit">Log in</button>

<a href="<?= site_url("/password/forgot") ?>">Forgot password</a>

<?= form_close() ?>

<?= $this->endSection() ?>