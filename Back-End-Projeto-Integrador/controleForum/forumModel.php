<?php
require_once __DIR__ . '/../Include/conexao.php';

class ForumModel {
    private $conn;
    
    public function __construct() {
        try {
            global $con;
            error_log("Criando ForumModel...");
            
            if (!isset($con)) {
                throw new Exception("Variável \$con não está definida");
            }
            
            $this->conn = $con;
            
            if (!$this->conn) {
                throw new Exception("Conexão com banco de dados falhou");
            }
            
            error_log("ForumModel criado com sucesso - Conexão: " . get_class($this->conn));
            
        } catch (Exception $e) {
            error_log("Erro ao criar ForumModel: " . $e->getMessage());
            throw $e;
        }
    }

public function getFotoPerfilUsuario($usuario_id) {
    try {
        $sql = "SELECT caminho_arquivo 
                FROM usuario_fotos 
                WHERE usuario_id = ? AND is_atual = 1 
                ORDER BY data_upload DESC 
                LIMIT 1";
        
        error_log("=== BUSCA FOTO USUÁRIO {$usuario_id} ===");
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $foto = $result->fetch_assoc();
        $stmt->close();
        
        if ($foto && !empty($foto['caminho_arquivo'])) {
            $caminho_bd = $foto['caminho_arquivo'];
            error_log("✅ FOTO ENCONTRADA - Caminho no BD: '{$caminho_bd}'");
            
            // Converte o caminho do BD para caminho web
            $caminho_limpo = ltrim($caminho_bd, './');
            $caminho_web = "/Back-End-Projeto-Integrador/" . $caminho_limpo;
            
            error_log("✅ Caminho web final: '{$caminho_web}'");
            return $caminho_web;
        } else {
            error_log("❌ NENHUMA FOTO - Usuário {$usuario_id} não tem foto na tabela usuario_fotos");
            return "/Back-End-Projeto-Integrador/assets/img/avatar-placeholder.png";
        }
        
    } catch (Exception $e) {
        error_log("❌ ERRO na tabela usuario_fotos: " . $e->getMessage());
        return "/Back-End-Projeto-Integrador/assets/img/avatar-placeholder.png";
    }
}
        public function criarPost($usuario_id, $titulo, $conteudo, $tags) {
            try {
                // Inserir o post
                $sql = "INSERT INTO forum_posts (usuario_id, titulo, conteudo) VALUES (?, ?, ?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("iss", $usuario_id, $titulo, $conteudo);
                $stmt->execute();
                
                $post_id = $stmt->insert_id;
                $stmt->close();
                
                error_log("Post criado com ID: " . $post_id); // DEBUG
                
                // Processar tags se existirem
                if (!empty($tags)) {
                    $this->processarTags($post_id, $tags);
                }
                
                return $post_id;
                
            } catch (Exception $e) {
                error_log("Erro ao criar post: " . $e->getMessage());
                return false;
            }
        }
    
    private function processarTags($post_id, $tags) {
        $tags_array = explode(',', $tags);
        
        foreach ($tags_array as $tag_nome) {
            $tag_nome = trim($tag_nome);
            if (empty($tag_nome)) continue;
            
            // Verificar se a tag já existe
            $sql = "SELECT tag_id FROM forum_tags WHERE nome = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $tag_nome);
            $stmt->execute();
            $result = $stmt->get_result();
            $tag = $result->fetch_assoc();
            $stmt->close();
            
            if ($tag) {
                $tag_id = $tag['tag_id'];
            } else {
                // Criar nova tag
                $sql = "INSERT INTO forum_tags (nome) VALUES (?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("s", $tag_nome);
                $stmt->execute();
                $tag_id = $stmt->insert_id;
                $stmt->close();
            }
            
            // Relacionar tag com o post
            $sql = "INSERT IGNORE INTO post_tags (post_id, tag_id) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $post_id, $tag_id);
            $stmt->execute();
            $stmt->close();
        }
    }
    
    public function adicionarComentario($usuario_id, $post_id, $comentario, $comentario_pai_id = null) {
        try {
            $sql = "INSERT INTO post_comentarios (post_id, usuario_id, comentario, comentario_pai_id) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iisi", $post_id, $usuario_id, $comentario, $comentario_pai_id);
            $result = $stmt->execute();
            $stmt->close();
            
            return $result;
            
        } catch (Exception $e) {
            error_log("Erro ao adicionar comentário: " . $e->getMessage());
            return false;
        }
    }
    
    public function listarPosts() {
    try {
        $sql = "SELECT 
                    fp.post_id,
                    fp.titulo,
                    fp.conteudo,
                    fp.data_criacao,
                    u.usuario_id,
                    u.nome_usuario,
                    (SELECT COUNT(*) FROM post_curtidas pc WHERE pc.post_id = fp.post_id) as curtidas,
                    (SELECT COUNT(*) FROM post_comentarios pco WHERE pco.post_id = fp.post_id) as total_comentarios
                FROM forum_posts fp
                INNER JOIN usuarios u ON fp.usuario_id = u.usuario_id
                WHERE fp.ativo = 1
                ORDER BY fp.data_criacao DESC";
        
        error_log("SQL Executada: " . $sql); // DEBUG
        
        $result = $this->conn->query($sql);
        
        if (!$result) {
            error_log("Erro na query: " . $this->conn->error);
            return [];
        }
        
        $posts = [];
        
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        
        error_log("Posts encontrados: " . count($posts)); // DEBUG
        return $posts;
        
    } catch (Exception $e) {
        error_log("Erro ao listar posts: " . $e->getMessage());
        return [];
    }
}
    
    public function listarComentariosPorPost($post_id) {
        try {
            $sql = "SELECT 
                        pc.comentario_id,
                        pc.comentario,
                        pc.data_criacao,
                        pc.comentario_pai_id,
                        u.usuario_id,
                        u.nome_usuario
                    FROM post_comentarios pc
                    INNER JOIN usuarios u ON pc.usuario_id = u.usuario_id
                    WHERE pc.post_id = ? AND pc.ativo = TRUE
                    ORDER BY 
                        CASE WHEN pc.comentario_pai_id IS NULL THEN pc.comentario_id ELSE pc.comentario_pai_id END,
                        pc.data_criacao ASC";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $post_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $comentarios = [];
            while ($row = $result->fetch_assoc()) {
                $comentarios[] = $row;
            }
            
            $stmt->close();
            return $comentarios;
            
        } catch (Exception $e) {
            error_log("Erro ao listar comentários: " . $e->getMessage());
            return [];
        }
    }
    
    public function getTagsDoPost($post_id) {
        try {
            $sql = "SELECT ft.nome 
                    FROM forum_tags ft
                    INNER JOIN post_tags pt ON ft.tag_id = pt.tag_id
                    WHERE pt.post_id = ?";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $post_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $tags = [];
            while ($row = $result->fetch_assoc()) {
                $tags[] = $row['nome'];
            }
            
            $stmt->close();
            return $tags;
            
        } catch (Exception $e) {
            error_log("Erro ao buscar tags: " . $e->getMessage());
            return [];
        }
    }
}
?>