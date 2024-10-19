<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Password reset<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Password reset</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?> 
            <li><?= esc($error) ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>

<?= form_open("/password/processreset/$token") ?>

<div>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" value="<?= old('password') ?>">
</div>

<div>
    <label for="password_confirmation">Repeat password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" value="<?= old('password_confirmation') ?>">
</div>

<button>Reset password</button>

</form>

<?= $this->endSection() ?>
