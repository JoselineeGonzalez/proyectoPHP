<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Forgot password?<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Forgot password</h1>

<?php if (session()->has('warning')): ?>
    <div class="alert alert-warning">
        <?= esc(session('warning')) ?>
    </div>
<?php endif; ?>

<?= form_open('/password/processforgot') ?>

<div>
    <label for="email">Email</label>
    <input type="text" name="email" id="email" value="<?= old('email') ?>"> 
</div>

<button type="submit">Send</button>

<?= form_close() ?>

<?= $this->endSection() ?>
