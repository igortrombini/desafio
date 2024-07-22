<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueceu a Senha</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <?= $this->Html->css(['register']) ?>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Esqueceu a Senha</h1>
        </div>
        <div class="box">
            <?= $this->Flash->render() ?>
            <?= $this->Form->create(null, ['class' => 'forgot-password-form']) ?>
            <div class="input-group">
                <?= $this->Form->control('email', ['label' => 'Email', 'type' => 'email', 'class' => 'form-input', 'placeholder' => 'Email']) ?>
            </div>
            <?= $this->Form->button(__('Enviar Link de Redefinição'), ['class' => 'button']) ?>
            <?= $this->Form->end() ?>
        </div>
        <div class="footer">
            <p><?= $this->Html->link(__('Voltar ao Login'), ['action' => 'login']) ?></p>
        </div>
    </div>
</body>
</html>
