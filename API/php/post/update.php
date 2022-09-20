<?php
// Iniciar a sessão
session_start();

// Inicia a conexão com banco de dados
require_once '../includes/db_connect.php';

// Função de upload de imagem
require_once '../includes/upload.php';

// Import de bibliotecas de funções
include_once '../functions/sanitizar.php';
include_once '../functions/validar.php';
include_once '../functions/processar.php';

// Definindo as constantes globais
define('PATH', '../../perfis.php'); // Caminho da pagina
define('CONNECT', db_connect());   // Conexão

// Armazenado o id da sessão em uma variavel
$id = $_SESSION['id_usuario'];

// Verifica se houve a requisição POST para esta pagina
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: {$_SERVER['HTTP_REFERER']}");
}
else if (isset($_POST['btnIncrement'])) {
    // Verifica a a imagem existe
    if ($_FILES['foto']['error'] < 0) {        
        // Nome da foto, tamanho da foto, nome temporario no servidor
        $foto_nome = $_FILES['foto']['name'];
        $foto_size = $_FILES['foto']['size'];
        $path_temp = $_FILES['foto']['tmp_name'];
        
        // Prepara o nome do arquivo para ser movido
        $foto_nome = atualizaNomeFotoUsuario($foto_nome);

        // Atualiza o nome no banco e move o arquivo
        uploadImagemPerfil($foto_nome, $foto_size, $path_temp);  
    } 

    if (verificaInjectHtml($_POST, PATH)) {
        // Sanitização
        $_POST = sanitizaCaractersPOST($_POST);

        // Atribui os conteudos obtido dos camps nome e email do formulario
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $acesso = $_POST['acesso'];

        // Nivel de acesso recebido via post em um hyden input
        switch ($acesso) {
            case 3:
                // Atribui o conteudo obtido dos campos modulo e curso do formulario
                $modulo = $_POST['modulo'];
                $curso = $_POST['curso'];

                atualizarDadosUsuarioAluno($id, $modulo, $curso);

            case 4:
                // Atribui o conteudo obtido do campo regras do formulario
                $regras = $_POST['regras'];

                atualizarDadosUsuarioProfessor($id, $regras);
        }

        // Validações
        if (validaNome($nome, PATH) && validaEmail($email, PATH)) {
            // Verificações
            if (verificaEmail($email, PATH)) {
                // Atualiza o nome e email de um usuário
                atualizarDadosUsuario($id, $nome, $email, PATH);
            }
        }   
    }
} 
// Encerando a conexão
pg_close(CONNECT);
?>