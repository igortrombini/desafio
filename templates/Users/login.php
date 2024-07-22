<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <?= $this->Html->css(['register']) ?>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Login</h1>
        </div>
        <div class="box">
            <?= $this->Flash->render('auth') ?>
            <?= $this->Form->create(null, ['class' => 'login-form']) ?>
            <div class="input-group">
                <?= $this->Form->control('email', ['label' => 'Email address', 'placeholder' => 'Email address', 'class' => 'form-input']) ?>
            </div>
            <div class="input-group">
                <?= $this->Form->control('password', ['label' => 'Password', 'placeholder' => 'Password', 'class' => 'form-input']) ?>
            </div>
            <div class="input-group">
                <?= $this->Form->control('remember_me', ['type' => 'checkbox', 'label' => 'Remember me']) ?>
                <?= $this->Html->link(__('Forgot password?'), ['action' => 'forgotPassword'], ['class' => 'forgot-password-link']) ?>
            </div>
            <?= $this->Form->button(__('Login'), ['class' => 'button']) ?>
            <?= $this->Form->end() ?>
        </div>
        <div class="footer">
            <p>Don't have an account? <?= $this->Html->link(__('Register here'), ['action' => 'add']) ?></p>
        </div>
    </div>
</body>
</html>
