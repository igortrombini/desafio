<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <?= $this->Html->css(['register']) ?>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Alterar Senha</h1>
        </div>
        <div class="box">
            <?= $this->Flash->render() ?>
            <?= $this->Form->create(null, ['class' => 'edit-password-form']) ?>
            <div class="input-group">
                <?= $this->Form->control('current_password', ['label' => 'Senha Atual', 'type' => 'password', 'class' => 'form-input', 'placeholder' => 'Senha Atual']) ?>
            </div>
            <div class="input-group">
                <?= $this->Form->control('new_password', ['label' => 'Nova Senha', 'type' => 'password', 'class' => 'form-input', 'placeholder' => 'Nova Senha']) ?>
            </div>
            <div class="input-group">
                <?= $this->Form->control('confirm_password', ['label' => 'Confirmar Nova Senha', 'type' => 'password', 'class' => 'form-input', 'placeholder' => 'Confirmar Nova Senha']) ?>
            </div>
            <?= $this->Form->button(__('Alterar Senha'), ['class' => 'button']) ?>
            <?= $this->Form->end() ?>
        </div>
        <div class="footer">
            <p><?= $this->Html->link(__('Voltar ao Dashboard'), ['action' => 'dashboard']) ?></p>
        </div>
    </div>
</body>
</html>
