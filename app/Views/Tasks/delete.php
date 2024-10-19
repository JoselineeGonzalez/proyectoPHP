<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Confirm Delete<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Delete Task</h1>

<p>Are you sure?</p>


<?= form_open("/tasks/delete/" . $task->id, ['method' => 'post']) ?>
    <button type="submit">Yes</button>
    <a href="<?= site_url('/tasks/show/' . $task->id) ?>">Cancel</a>
<?= form_close() ?> 

<?= $this->endSection() ?>

