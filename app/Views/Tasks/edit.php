<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit task<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (session()->has('warning')): ?>
    <div class="alert alert-warning">
        <?= session('warning') ?>
    </div>
<?php endif; ?>

<h1>Edit task</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?= form_open("/tasks/update/" . $task->id) ?>
    
    <?= $this->include('Tasks/form') ?>

    
           <button type="submit">Save</button>
           <a href="<?= site_url("/tasks/show/" . $task->id) ?>">Cancel</a>

<?= form_close() ?>

<?= $this->endSection() ?>



