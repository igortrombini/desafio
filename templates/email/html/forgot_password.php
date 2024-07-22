<p>Olá <?= h($user->name) ?>,</p>
<p>Você solicitou a redefinição da sua senha. Clique no link abaixo para redefinir sua senha:</p>
<p><?= $this->Html->link('Redefinir Senha', $url) ?></p>
<p>Se você não solicitou essa mudança, ignore este e-mail.</p>
<p>Obrigado,</p>
<p>Sua equipe</p>
