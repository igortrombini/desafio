<h1>Login</h1>
<!-- Formulário de login -->
<?= $this->Form->create() ?>
<?= $this->Form->control('login') ?>
<?= $this->Form->control('password', ['type' => 'password']) ?>
<?= $this->Form->button(__('Login')) ?>
<?= $this->Form->end() ?>
