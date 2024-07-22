<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <?= $this->Html->css(['register']) ?>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Editar Perfil</h1>
        </div>
        <div class="box">
            <?= $this->Flash->render() ?>
            <?= $this->Form->create($user, ['type' => 'file', 'class' => 'edit-profile-form']) ?>
            <div class="input-group">
                <?= $this->Form->control('name', ['label' => 'Name', 'class' => 'form-input', 'placeholder' => 'Name']) ?>
            </div>
            <div class="input-group">
                <?= $this->Form->control('email', ['label' => 'Email', 'class' => 'form-input', 'placeholder' => 'Email']) ?>
            </div>
            <div class="input-group">
                <?= $this->Form->control('photo', ['type' => 'file', 'label' => 'Upload new photo', 'class' => 'form-input']) ?>
            </div>
            <?= $this->Form->button(__('Save Changes'), ['class' => 'button']) ?>
            <?= $this->Form->end() ?>
        </div>
        <div class="footer">
            <p><?= $this->Html->link(__('Voltar ao Dashboard'), ['action' => 'dashboard']) ?></p>
        </div>
    </div>
</body>
</html>
