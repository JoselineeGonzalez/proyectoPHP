<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Nuevo usuario<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (session()->has('warning')): ?>
    <div class="alert alert-warning">
        <?= session('warning') ?>
    </div>
<?php endif; ?>

<h1>Nuevo usuario</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?= form_open("/admin/users/create") ?>

    <?= $this->include('Admin/Users/form') ?>
    
           <button type="submit">Save</button>
           <a href="<?= site_url("/admin/users") ?>">Cancel</a>

<?= form_close() ?>

<?= $this->endSection() ?>