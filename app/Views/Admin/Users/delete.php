<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Confirm user<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Delete user</h1>

<p>Are you sure?</p>


<?= form_open("/admin/users/delete/" . $user->id, ['method' => 'post']) ?>
    <button type="submit">Yes</button>
    <a href="<?= site_url('/admin/users/show/' . $user->id) ?>">Cancel</a>
<?= form_close() ?> 

<?= $this->endSection() ?>