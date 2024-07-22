<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <?= $this->Html->css(['dashboard']) ?>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <img src="https://www.centroimobiliario.com.br/images/icons/logo.svg" alt="centro imobiliario">
            </div>
            <nav class="menu">
                <ul>
                    <li><a href="<?= $this->Url->build(['action' => 'editProfile']) ?>">Editar Perfil</a></li>
                    <li><a href="<?= $this->Url->build(['action' => 'editPassword']) ?>">Editar Senha</a></li>
                </ul>
            </nav>
            <div class="profile">
                <?php 
                // Verifica se a foto do usuário está disponível, caso contrário, usa uma imagem padrão
                $photoPath = !empty($user->photo) ? $user->photo : 'path/to/default/avatar.png';
                ?>
                <img src="<?= $this->Url->build('/' . $photoPath) ?>" alt="<?= h($user->name) ?>">
                <p><?= h($user->name) ?></p>
                <p><a href="<?= $this->Url->build(['action' => 'logout']) ?>">Sair</a></p>
            </div>
        </div>
    </div>
    <?= $this->Html->script(['dashboard']) ?>
</body>
</html>
