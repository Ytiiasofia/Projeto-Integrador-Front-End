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
    
    // ========== MÉTODOS PARA FOTO DE PERFIL ==========
    
    public function getFotoPerfilUsuario($usuario_id) {
        return $this->forumModel->getFotoPerfilUsuario($usuario_id);
    }
    
    public function getTagsDoPost($post_id) {
        return $this->forumModel->getTagsDoPost($post_id);
    }
    
    // ========== MÉTODOS PARA CURTIDAS DE POSTS ==========
    
    public function curtirPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['usuario_id'])) {
                echo json_encode(['success' => false, 'message' => 'Usuário não logado']);
                exit;
            }
            
            $usuario_id = $_SESSION['usuario_id'];
            $post_id = intval($_POST['post_id']);
            
            $result = $this->forumModel->curtirPost($usuario_id, $post_id);
            
            if ($result['success']) {
                $total_curtidas = $this->forumModel->getTotalCurtidasPost($post_id);
                $esta_curtido = $this->forumModel->verificarCurtidaPost($usuario_id, $post_id);
                
                echo json_encode([
                    'success' => true,
                    'action' => $result['action'],
                    'total_curtidas' => $total_curtidas,
                    'esta_curtido' => $esta_curtido
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao processar curtida']);
            }
            exit;
        }
    }

    public function verificarCurtidaPost($usuario_id, $post_id) {
        return $this->forumModel->verificarCurtidaPost($usuario_id, $post_id);
    }

    public function getTotalCurtidasPost($post_id) {
        return $this->forumModel->getTotalCurtidasPost($post_id);
    }

    // ========== MÉTODOS PARA CURTIDAS DE COMENTÁRIOS ==========
    
    public function curtirComentario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['usuario_id'])) {
                echo json_encode(['success' => false, 'message' => 'Usuário não logado']);
                exit;
            }
            
            $usuario_id = $_SESSION['usuario_id'];
            $comentario_id = intval($_POST['comentario_id']);
            
            $result = $this->forumModel->curtirComentario($usuario_id, $comentario_id);
            
            if ($result['success']) {
                $total_curtidas = $this->forumModel->getTotalCurtidasComentario($comentario_id);
                $esta_curtido = $this->forumModel->verificarCurtidaComentario($usuario_id, $comentario_id);
                
                echo json_encode([
                    'success' => true,
                    'action' => $result['action'],
                    'total_curtidas' => $total_curtidas,
                    'esta_curtido' => $esta_curtido
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao processar curtida']);
            }
            exit;
        }
    }

    public function verificarCurtidaComentario($usuario_id, $comentario_id) {
        return $this->forumModel->verificarCurtidaComentario($usuario_id, $comentario_id);
    }

    public function getTotalCurtidasComentario($comentario_id) {
        return $this->forumModel->getTotalCurtidasComentario($comentario_id);
    }
    
    // ========== MÉTODOS PARA POSTS ==========
    
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
                // REDIRECIONAMENTO CORRIGIDO - Verifica se é admin
                if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
                    header('Location: ../UserADM/forumAdm.php');
                } else {
                    header('Location: ../UserCadastrado/forumUserCad.php');
                }
                exit;
            }
            
            $post_id = $this->forumModel->criarPost($usuario_id, $titulo, $conteudo, $tags);
            
            if ($post_id) {
                $_SESSION['sucesso'] = 'Post criado com sucesso!';
            } else {
                $_SESSION['erro'] = 'Erro ao criar post. Tente novamente.';
            }
            
            // REDIRECIONAMENTO CORRIGIDO - Verifica se é admin
            if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
                header('Location: ../UserADM/forumAdm.php');
            } else {
                header('Location: ../UserCadastrado/forumUserCad.php');
            }
            exit;
        }
    }
    
    public function listarPosts() {
        return $this->forumModel->listarPosts();
    }

    // ========== MÉTODOS PARA FILTRAGEM ==========

    public function listarPostsFiltrados($filtro = 'recentes') {
        return $this->forumModel->listarPostsFiltrados($filtro);
    }

    // ========== MÉTODOS PARA BUSCA ==========

    public function buscarPosts($termo) {
        return $this->forumModel->buscarPosts($termo);
    }
    
    // ========== MÉTODOS PARA COMENTÁRIOS ==========
    
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
                // REDIRECIONAMENTO CORRIGIDO - Verifica se é admin
                if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
                    header('Location: ../UserADM/forumAdm.php');
                } else {
                    header('Location: ../UserCadastrado/forumUserCad.php');
                }
                exit;
            }
            
            $sucesso = $this->forumModel->adicionarComentario($usuario_id, $post_id, $comentario, $comentario_pai_id);
            
            if ($sucesso) {
                $_SESSION['sucesso'] = 'Comentário adicionado com sucesso!';
            } else {
                $_SESSION['erro'] = 'Erro ao adicionar comentário. Tente novamente.';
            }
            
            // REDIRECIONAMENTO CORRIGIDO - Verifica se é admin
            if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
                header('Location: ../UserADM/forumAdm.php');
            } else {
                header('Location: ../UserCadastrado/forumUserCad.php');
            }
            exit;
        }
    }
    
    public function listarComentariosPorPost($post_id) {
        return $this->forumModel->listarComentariosPorPost($post_id);
    }

    // ========== MÉTODOS PARA ADMIN ==========
    
    public function deletarPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['usuario_id']) || $_SESSION['is_admin'] != 1) {
                $_SESSION['erro'] = 'Acesso negado. Apenas administradores podem deletar posts.';
                header('Location: ../UserADM/forumAdm.php');
                exit;
            }
            
            $post_id = intval($_POST['post_id']);
            
            $sucesso = $this->forumModel->deletarPost($post_id);
            
            if ($sucesso) {
                $_SESSION['sucesso'] = 'Post e todos os comentários associados foram deletados com sucesso!';
            } else {
                $_SESSION['erro'] = 'Erro ao deletar post. Tente novamente.';
            }
            
            header('Location: ../UserADM/forumAdm.php');
            exit;
        }
    }
}

// ========== PROCESSAR AÇÕES ==========

if (isset($_GET['action'])) {
    $controller = new ForumController();
    
    switch ($_GET['action']) {
        case 'criar_post':
            $controller->criarPost();
            break;
        case 'adicionar_comentario':
            $controller->adicionarComentario();
            break;
        case 'curtir_post':
            $controller->curtirPost();
            break;
        case 'curtir_comentario':
            $controller->curtirComentario();
            break;
        case 'deletar_post':
            $controller->deletarPost();
            break;
        default:
            header('Location: ../UserCadastrado/forumUserCad.php');
            exit;
    }
}
?>