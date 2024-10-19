<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Editar usuario<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Editar usuario</h1>

<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>


<?php if (session()->has('warning')): ?>
    <div class="alert alert-warning">
        <?= esc(session('warning')) ?>
    </div>
<?php endif; ?>


<form action="<?= site_url('/admin/users/update/' . $user->id) ?>" method="post">
    <?= csrf_field() ?>

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" value="<?= old('name', esc($user->name)) ?>">
    </div>

    <div>
        <label for="email">email</label>
        <input type="email" name="email" value="<?= old('email', esc($user->email)) ?>">
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password">
        <?php if ($user->id): ?>
        <p>Leave blank to keep existing password</p>
        <?php endif; ?>
    </div>


    <div>
        <label for="password_confirmation">Repeat password</label>
        <input type="password" name="password_confirmation">
    </div>

    <div>
        <label for="is_active">Active</label>
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" id="is_active" value="1" <?= old('is_active', $user->is_active) ? 'checked' : '' ?>>
    </div>

    <div>
    <label for="is_admin">Admin</label>
    <input type="checkbox" name="is_admin" id="is_admin" value="1" <?= old('is_admin', $user->is_admin) ? 'checked' : '' ?>>
</div>


    <div>
        <button type="submit">Save</button>
        <a href="<?= site_url('/admin/users/show/' . $user->id) ?>">Cancel</a>
    </div>
</form>

<?= $this->endSection() ?>

