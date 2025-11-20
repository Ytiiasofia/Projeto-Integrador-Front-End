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

    // ========== MÉTODOS PARA POSTS ==========

    public function criarPost($usuario_id, $titulo, $conteudo, $tags = null) {
        try {
            // Inserir o post
            $sql = "INSERT INTO forum_posts (usuario_id, titulo, conteudo) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iss", $usuario_id, $titulo, $conteudo);
            $stmt->execute();
            
            $post_id = $stmt->insert_id;
            $stmt->close();
            
            error_log("Post criado com ID: " . $post_id);
            
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
            
            error_log("SQL Executada: " . $sql);
            
            $result = $this->conn->query($sql);
            
            if (!$result) {
                error_log("Erro na query: " . $this->conn->error);
                return [];
            }
            
            $posts = [];
            
            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
            
            error_log("Posts encontrados: " . count($posts));
            return $posts;
            
        } catch (Exception $e) {
            error_log("Erro ao listar posts: " . $e->getMessage());
            return [];
        }
    }

    // ========== MÉTODO PARA FILTRAGEM DE POSTS ==========

    public function listarPostsFiltrados($filtro = 'recentes') {
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
                    WHERE fp.ativo = 1";
            
            // Aplicar filtros
            switch ($filtro) {
                case 'populares':
                    $sql .= " ORDER BY curtidas DESC, fp.data_criacao DESC";
                    break;
                case 'sem_respostas':
                    $sql .= " AND (SELECT COUNT(*) FROM post_comentarios pco WHERE pco.post_id = fp.post_id) = 0";
                    $sql .= " ORDER BY fp.data_criacao DESC";
                    break;
                case 'recentes':
                default:
                    $sql .= " ORDER BY fp.data_criacao DESC";
                    break;
            }
            
            error_log("SQL Executada (Filtro: $filtro): " . $sql);
            
            $result = $this->conn->query($sql);
            
            if (!$result) {
                error_log("Erro na query filtrada: " . $this->conn->error);
                return [];
            }
            
            $posts = [];
            
            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
            
            error_log("Posts encontrados com filtro '$filtro': " . count($posts));
            return $posts;
            
        } catch (Exception $e) {
            error_log("Erro ao listar posts filtrados: " . $e->getMessage());
            return [];
        }
    }

    // ========== MÉTODO PARA BUSCA DE POSTS ==========

    public function buscarPosts($termo) {
        try {
            $termo = $this->conn->real_escape_string($termo);
            $sql = "SELECT DISTINCT
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
                    LEFT JOIN post_tags pt ON fp.post_id = pt.post_id
                    LEFT JOIN forum_tags ft ON pt.tag_id = ft.tag_id
                    WHERE fp.ativo = 1
                    AND (fp.titulo LIKE '%$termo%' 
                         OR ft.nome LIKE '%$termo%')
                    ORDER BY fp.data_criacao DESC";
            
            error_log("SQL de Busca: " . $sql);
            
            $result = $this->conn->query($sql);
            
            if (!$result) {
                error_log("Erro na query de busca: " . $this->conn->error);
                return [];
            }
            
            $posts = [];
            
            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
            
            error_log("Posts encontrados na busca: " . count($posts));
            return $posts;
            
        } catch (Exception $e) {
            error_log("Erro ao buscar posts: " . $e->getMessage());
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

    // ========== MÉTODOS PARA CURTIDAS DE POSTS ==========

    public function curtirPost($usuario_id, $post_id) {
        try {
            // Verifica se o usuário já curtiu o post
            $sql = "SELECT curtida_id FROM post_curtidas WHERE usuario_id = ? AND post_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $usuario_id, $post_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $ja_curtiu = $result->fetch_assoc();
            $stmt->close();

            if ($ja_curtiu) {
                // Remove a curtida se já tiver curtido
                $sql = "DELETE FROM post_curtidas WHERE usuario_id = ? AND post_id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("ii", $usuario_id, $post_id);
                $result = $stmt->execute();
                $stmt->close();
                return ['action' => 'removed', 'success' => $result];
            } else {
                // Adiciona a curtida
                $sql = "INSERT INTO post_curtidas (usuario_id, post_id) VALUES (?, ?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("ii", $usuario_id, $post_id);
                $result = $stmt->execute();
                $stmt->close();
                return ['action' => 'added', 'success' => $result];
            }
        } catch (Exception $e) {
            error_log("Erro ao curtir post: " . $e->getMessage());
            return ['action' => 'error', 'success' => false];
        }
    }

    public function verificarCurtidaPost($usuario_id, $post_id) {
        try {
            $sql = "SELECT curtida_id FROM post_curtidas WHERE usuario_id = ? AND post_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $usuario_id, $post_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $curtida = $result->fetch_assoc();
            $stmt->close();
            
            return !empty($curtida);
        } catch (Exception $e) {
            error_log("Erro ao verificar curtida: " . $e->getMessage());
            return false;
        }
    }

    public function getTotalCurtidasPost($post_id) {
        try {
            $sql = "SELECT COUNT(*) as total FROM post_curtidas WHERE post_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $post_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $total = $result->fetch_assoc();
            $stmt->close();
            
            return $total['total'] ?? 0;
        } catch (Exception $e) {
            error_log("Erro ao buscar total de curtidas: " . $e->getMessage());
            return 0;
        }
    }

    // ========== MÉTODOS PARA COMENTÁRIOS ==========

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

    // ========== MÉTODOS PARA CURTIDAS DE COMENTÁRIOS ==========

    public function curtirComentario($usuario_id, $comentario_id) {
        try {
            // Verifica se o usuário já curtiu o comentário
            $sql = "SELECT curtida_id FROM comentario_curtidas WHERE usuario_id = ? AND comentario_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $usuario_id, $comentario_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $ja_curtiu = $result->fetch_assoc();
            $stmt->close();

            if ($ja_curtiu) {
                // Remove a curtida se já tiver curtido
                $sql = "DELETE FROM comentario_curtidas WHERE usuario_id = ? AND comentario_id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("ii", $usuario_id, $comentario_id);
                $result = $stmt->execute();
                $stmt->close();
                return ['action' => 'removed', 'success' => $result];
            } else {
                // Adiciona a curtida
                $sql = "INSERT INTO comentario_curtidas (usuario_id, comentario_id) VALUES (?, ?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("ii", $usuario_id, $comentario_id);
                $result = $stmt->execute();
                $stmt->close();
                return ['action' => 'added', 'success' => $result];
            }
        } catch (Exception $e) {
            error_log("Erro ao curtir comentário: " . $e->getMessage());
            return ['action' => 'error', 'success' => false];
        }
    }

    public function verificarCurtidaComentario($usuario_id, $comentario_id) {
        try {
            $sql = "SELECT curtida_id FROM comentario_curtidas WHERE usuario_id = ? AND comentario_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $usuario_id, $comentario_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $curtida = $result->fetch_assoc();
            $stmt->close();
            
            return !empty($curtida);
        } catch (Exception $e) {
            error_log("Erro ao verificar curtida comentário: " . $e->getMessage());
            return false;
        }
    }

    public function getTotalCurtidasComentario($comentario_id) {
        try {
            $sql = "SELECT COUNT(*) as total FROM comentario_curtidas WHERE comentario_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $comentario_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $total = $result->fetch_assoc();
            $stmt->close();
            
            return $total['total'] ?? 0;
        } catch (Exception $e) {
            error_log("Erro ao buscar total de curtidas comentário: " . $e->getMessage());
            return 0;
        }
    }

    // ========== MÉTODOS PARA ADMIN ==========

    public function deletarPost($post_id) {
        try {
            // Iniciar transação para garantir que tudo seja deletado ou nada
            $this->conn->begin_transaction();
            
            // 1. Deletar curtidas dos comentários deste post
            $sql1 = "DELETE cc FROM comentario_curtidas cc 
                    INNER JOIN post_comentarios pc ON cc.comentario_id = pc.comentario_id 
                    WHERE pc.post_id = ?";
            $stmt1 = $this->conn->prepare($sql1);
            $stmt1->bind_param("i", $post_id);
            $stmt1->execute();
            $stmt1->close();
            
            // 2. Deletar todos os comentários do post
            $sql2 = "DELETE FROM post_comentarios WHERE post_id = ?";
            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->bind_param("i", $post_id);
            $stmt2->execute();
            $stmt2->close();
            
            // 3. Deletar curtidas do post
            $sql3 = "DELETE FROM post_curtidas WHERE post_id = ?";
            $stmt3 = $this->conn->prepare($sql3);
            $stmt3->bind_param("i", $post_id);
            $stmt3->execute();
            $stmt3->close();
            
            // 4. Deletar tags associadas ao post
            $sql4 = "DELETE FROM post_tags WHERE post_id = ?";
            $stmt4 = $this->conn->prepare($sql4);
            $stmt4->bind_param("i", $post_id);
            $stmt4->execute();
            $stmt4->close();
            
            // 5. Finalmente deletar o post
            $sql5 = "DELETE FROM forum_posts WHERE post_id = ?";
            $stmt5 = $this->conn->prepare($sql5);
            $stmt5->bind_param("i", $post_id);
            $result = $stmt5->execute();
            $stmt5->close();
            
            // Confirmar transação
            $this->conn->commit();
            
            error_log("Post {$post_id} deletado com sucesso com todos os dados associados");
            return $result;
            
        } catch (Exception $e) {
            // Rollback em caso de erro
            $this->conn->rollback();
            error_log("Erro ao deletar post {$post_id}: " . $e->getMessage());
            return false;
        }
    }

    // ========== MÉTODOS AUXILIARES ==========

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

    // ========== MÉTODOS PRIVADOS ==========

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
}
?>