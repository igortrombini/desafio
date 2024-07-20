<h1>Reset Password</h1>
<!-- Formulário para redefinir a senha -->
<?= $this->Form->create() ?>
<?= $this->Form->control('password', ['type' => 'password']) ?>
<?= $this->Form->control('password_confirm', ['type' => 'password']) ?>
<?= $this->Form->button(__('Reset Password')) ?>
<?= $this->Form->end() ?>
