<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit task<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (session()->has('warning')): ?>
    <div class="alert alert-warning">
        <?= session('warning') ?>
    </div>
<?php endif; ?>

<h1>New task</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?= form_open("/tasks/create") ?>

    <?= $this->include('Tasks/form') ?>
    
           <button type="submit">Save</button>
           <a href="<?= site_url("/tasks") ?>">Cancel</a>

<?= form_close() ?>

<?= $this->endSection() ?>





