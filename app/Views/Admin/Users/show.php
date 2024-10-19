<?= $this->extend('layouts/default') ?>

<?php if (session()->get('info')): ?>
    <div class="alert alert-success">
        <?= session()->get('info') ?>
    </div>
<?php endif; ?>

<?= $this->section('title') ?>Usuarios<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Usuario</h1>

<a href="<?= site_url("/admin/users") ?>">Back to index</a>

<dl>
    <dt>Nombre</dt>
    <dd><?= isset($user->name) ? esc($user->name) : '' ?></dd>

    <dt>Email</dt>
    <dd><?= isset($user->email) ? esc($user->email) : '' ?></dd>

    <dt>Active</dt>
    <dd><?= isset($user->is_active) ? ($user->is_active ? 'yes' : 'no') : '' ?></dd> <!-- Cambiado a <dd> -->

    <dt>Administrator</dt>
    <dd><?= isset($user->is_admin) ? ($user->is_admin ? 'yes' : 'no') : '' ?></dd>

    <dt>Created at</dt>
    <dd><?= isset($user->created_at) ? date('Y-m-d H:i:s', strtotime($user->created_at)) : '' ?></dd>
    
    <dt>Updated at</dt>
    <dd><?= isset($user->updated_at) ? date('Y-m-d H:i:s', strtotime($user->updated_at)) : '' ?></dd>
</dl>


<?php if (isset($user->id)): ?>
    <a href="<?= site_url('/admin/users/edit/' . $user->id) ?>">Edit</a>

<?php endif; ?>

    <?php if ($user->id != current_user()->id): ?>

    <?= form_open("/admin/users/delete/" . $user->id, ['method' => 'post']) ?>
        <button type="submit">Delete</button>
    <?= form_close() ?>

<?php endif; ?>

<?= $this->endSection() ?>