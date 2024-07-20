<h1>Forgot Password</h1>
<!-- Formulário para solicitar redefinição de senha -->
<?= $this->Form->create() ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->button(__('Send reset link')) ?>
<?= $this->Form->end() ?>
