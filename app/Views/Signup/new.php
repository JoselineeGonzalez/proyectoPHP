<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Signup<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>

<h1>Signup</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?= form_open("/signup/create") ?>

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?= old('name') ?>">
    </div>

    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?= old('email') ?>">
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password">
    </div>

    <div>
        <label for="password_confirmation">Repeat Password</label>
        <input type="password" name="password_confirmation">
    </div>
    
    <button type="submit">Sign up</button>
    <a href="<?= site_url("/home") ?>" class="cancel-button">Cancel</a> 

<?= form_close() ?>

<?= $this->endSection() ?>
