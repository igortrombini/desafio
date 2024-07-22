<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <?= $this->Html->css(['register']) ?>
</head>
<body>
    <div class="container">
        <div class="header">            
            <h1>Create an account</h1>
        </div>
        <div class="box">
            <?= $this->Flash->render('auth') ?>
            <?= $this->Form->create(null, ['class' => 'register-form', 'type' => 'file']) ?>
            <div class="input-group">
                <?= $this->Form->control('name', ['label' => 'Name', 'placeholder' => 'Name', 'class' => 'form-input']) ?>
            </div>
            <div class="input-group">
                <?= $this->Form->control('email', ['label' => 'Email address', 'placeholder' => 'Email address', 'class' => 'form-input']) ?>
            </div>
            <div class="input-group">
                <?= $this->Form->control('login', ['label' => 'Login', 'placeholder' => 'Login', 'class' => 'form-input']) ?>
            </div>
            <div class="input-group">
                <?= $this->Form->control('password', ['label' => 'Password', 'placeholder' => 'Password', 'class' => 'form-input']) ?>
            </div>
            <div class="input-group">
                <?= $this->Form->control('photo', ['type' => 'file', 'label' => 'Upload photo', 'class' => 'form-input']) ?>
            </div>
            <?= $this->Form->button(__('Register'), ['class' => 'button']) ?>
            <?= $this->Form->end() ?>
        </div>
        <div class="footer">
            <p>Already have an account? <?= $this->Html->link(__('Login here'), ['action' => 'login']) ?></p>
        </div>
    </div>
</body>
</html>
