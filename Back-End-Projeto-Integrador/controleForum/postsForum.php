<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../Include/conexao.php';
require_once __DIR__ . '/forumModel.php';

class ForumController {
    private $forumModel;
    
    public function __construct() {
        $this->forumModel = new ForumModel();
    }
    
    public function getFotoPerfilUsuario($usuario_id) {
        return $this->forumModel->getFotoPerfilUsuario($usuario_id);
    }
    
    public function getTagsDoPost($post_id) {
        return $this->forumModel->getTagsDoPost($post_id);
    }
    
    public function criarPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['usuario_id'])) {
                header('Location: ../UserAnonimo/contact.php');
                exit;
            }
            
            $usuario_id = $_SESSION['usuario_id'];
            $titulo = trim($_POST['titulo']);
            $conteudo = trim($_POST['conteudo']);
            $tags = isset($_POST['tags']) ? trim($_POST['tags']) : '';
            
            if (empty($titulo) || empty($conteudo)) {
                $_SESSION['erro'] = 'Título e conteúdo são obrigatórios';
                header('Location: ../UserCadastrado/forumUserCad.php');
                exit;
            }
            
            $post_id = $this->forumModel->criarPost($usuario_id, $titulo, $conteudo, $tags);
            
            if ($post_id) {
                $_SESSION['sucesso'] = 'Post criado com sucesso!';
            } else {
                $_SESSION['erro'] = 'Erro ao criar post. Tente novamente.';
            }
            
            header('Location: ../UserCadastrado/forumUserCad.php');
            exit;
        }
    }
    
    public function adicionarComentario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['usuario_id'])) {
                header('Location: ../UserAnonimo/contact.php');
                exit;
            }
            
            $usuario_id = $_SESSION['usuario_id'];
            $post_id = intval($_POST['post_id']);
            $comentario = trim($_POST['comentario']);
            $comentario_pai_id = isset($_POST['comentario_pai_id']) ? intval($_POST['comentario_pai_id']) : null;
            
            if (empty($comentario) || $post_id <= 0) {
                $_SESSION['erro'] = 'Comentário e post são obrigatórios';
                header('Location: ../UserCadastrado/forumUserCad.php');
                exit;
            }
            
            $sucesso = $this->forumModel->adicionarComentario($usuario_id, $post_id, $comentario, $comentario_pai_id);
            
            if ($sucesso) {
                $_SESSION['sucesso'] = 'Comentário adicionado com sucesso!';
            } else {
                $_SESSION['erro'] = 'Erro ao adicionar comentário. Tente novamente.';
            }
            
            header('Location: ../UserCadastrado/forumUserCad.php');
            exit;
        }
    }
    
    public function listarPosts() {
        return $this->forumModel->listarPosts();
    }
    
    public function listarComentariosPorPost($post_id) {
        return $this->forumModel->listarComentariosPorPost($post_id);
    }
}

// Processar ações
if (isset($_GET['action'])) {
    $controller = new ForumController();
    
    switch ($_GET['action']) {
        case 'criar_post':
            $controller->criarPost();
            break;
        case 'adicionar_comentario':
            $controller->adicionarComentario();
            break;
        default:
            header('Location: ../UserCadastrado/forumUserCad.php');
            exit;
    }
}
?>