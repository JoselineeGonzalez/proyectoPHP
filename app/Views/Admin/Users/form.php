<div>
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="<?= old('name', esc($user->name)) ?>">
</div>

<div>
    <label for="email">Email</label>
    <input type="text" name="email" id="email" value="<?= old('email', esc($user->email)) ?>">
</div>

<div>
    <label for="password">Password</label>
    <input type="password" name="password">
    <?php if ($user->id): ?>
        <p>Leave blank to keep existing password</p>
    <?php endif; ?>
</div>

<div>
    <label for="password_confirmation">Repeat Password</label>
    <input type="password" name="password_confirmation">
</div>

<div>
    <label for="is_active">
        <input type="hidden" name="is_active" value="0">
        
        <input type="checkbox" id="is_active" name="is_active" value="1"
            <?= old('is_active', $user->is_active) ? 'checked' : ''; ?>> Active
    </label>
</div>


<div>
    <label for="is_admin">
        <?php if ($user->id == current_user()->id): ?>
            <input type="checkbox" checked disabled> Administrator
        <?php else: ?>
            <input type="hidden" name="is_admin" value="0">
            <input type="checkbox" id="is_admin" name="is_admin" value="1" 
                <?= (old('is_admin', $user->is_admin) == 1) ? 'checked' : ''; ?>> Administrator
        <?php endif; ?>
    </label>
</div>

<button type="submit">Save</button>