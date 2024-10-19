<<?= $this->extend('layouts/default') ?>

<?php if (session()->get('info')): ?>
    <div class="alert alert-success">
        <?= session()->get('info') ?>
    </div>
<?php endif; ?>

<?= $this->section('title') ?>Task Details<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Task Details</h1>

<a href="<?= site_url('tasks') ?>">Back to index</a>

<dl>
    <dt>ID</dt>
    <dd><?= isset($task->id) ? esc($task->id) : '' ?></dd>
    
    <dt>Description</dt>
    <dd><?= isset($task->description) ? esc($task->description) : '' ?></dd>
    
    <dt>Created at</dt>
    <dd><?= isset($task->created_at) ? date('Y-m-d H:i:s', strtotime($task->created_at)) : '' ?></dd>
    
    <dt>Updated at</dt>
    <dd><?= isset($task->updated_at) ? date('Y-m-d H:i:s', strtotime($task->updated_at)) : '' ?></dd>
</dl>

<?php if (isset($task->id)): ?>
    <a href="<?= site_url('/tasks/edit/' . $task->id) ?>">Edit</a>

    <?= form_open("/tasks/delete/" . $task->id, ['method' => 'post']) ?>
        <button type="submit">Delete task</button>
    <?= form_close() ?>
<?php endif; ?>

<?= $this->endSection() ?>






