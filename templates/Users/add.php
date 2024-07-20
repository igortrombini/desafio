<h1>Register</h1>
<!-- Formulário de registro -->
<?= $this->Form->create($user) ?>
<?= $this->Form->control('name') ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('login') ?>
<?= $this->Form->control('password', ['type' => 'password']) ?>
<?= $this->Form->control('photo', ['type' => 'file']) ?>
<?= $this->Form->button(__('Register')) ?>
<?= $this->Form->end() ?>
