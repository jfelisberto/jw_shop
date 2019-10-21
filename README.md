Olá bem vindo ao sistema Minha Loja

Vamos aos primeiros passos da configuração.

1 - Setando o acesso ao banco de dados
    No array $settings['database']; atribua os dados da conta de acesso ao  MySQL
    $settings['database'] array (
        'username' => 'usuarioMySQL',
        'password' => 'senhaMySQL',
        'host' => 'localhost',
        //'port' => '3306',
        'dbname' => 'jw_shop',
        'tablesprefix' => 'jw_',
        'charset' => 'utf8'
    )
    
2 - Setando dados de envio de email 
    No array $settings['email']; atribua os dados da conta de acesso ao email
    $settings['email'] array(
        'smtpSettings' => array (
        'host' => 'seu.host.com',
        'port' => 587,
        'requireAuth' => true,
        'requireSSL' => false,
        'username' => 'hots_username',
        'password' => 'host_senha'
      )
    )

3 - Crie o Banco de dados jw_shop

4 - Carregue o arquivo jw_shop.sql para popular o banco

5 - Pra logar clique no botão login e escolha na caixa de seleção um dos usuários pre cadastrados apenas para teste.

