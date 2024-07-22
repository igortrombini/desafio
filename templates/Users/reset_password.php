<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <?= $this->Html->css(['register']) ?>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Redefinir Senha</h1>
        </div>
        <div class="box">
            <?= $this->Flash->render() ?>
            <?= $this->Form->create(null, ['class' => 'reset-password-form']) ?>
            <?= $this->Form->hidden('token', ['value' => $token]) ?>
            <div class="input-group">
                <?= $this->Form->control('password', ['label' => 'Nova Senha', 'type' => 'password', 'class' => 'form-input']) ?>
            </div>
            <div class="input-group">
                <?= $this->Form->control('confirm_password', ['label' => 'Confirmar Nova Senha', 'type' => 'password', 'class' => 'form-input']) ?>
            </div>
            <?= $this->Form->button(__('Redefinir Senha'), ['class' => 'button']) ?>
            <?= $this->Form->end() ?>
        </div>
        <div class="footer">
            <p><?= $this->Html->link(__('Voltar ao Login'), ['action' => 'login']) ?></p>
        </div>
    </div>
</body>
</html>
