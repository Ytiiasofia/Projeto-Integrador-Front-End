<!-- Seção para Adicionar Nova Oportunidade -->
<div class="add-opportunity-section" data-aos="fade-up">
    <h4 class="mb-4">Adicionar Nova Oportunidade</h4>

    <?php
    // Verifique se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titulo'])) {
        $host = 'db';
        $dbname = 'meu_banco';
        $username = 'root';
        $password = 'root';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO oportunidades (titulo, tipo, modalidade, local, area, data_abertura, data_fechamento, link_detalhes, status_edital) 
                    VALUES (:titulo, :tipo, :modalidade, :local, :area, :data_abertura, :data_fechamento, :link_detalhes, :status_edital)";

            $stmt = $pdo->prepare($sql);

            $result = $stmt->execute([
                ':titulo' => $_POST['titulo'],
                ':tipo' => $_POST['tipo'],
                ':modalidade' => $_POST['modalidade'],
                ':local' => $_POST['local'],
                ':area' => $_POST['area'],
                ':data_abertura' => $_POST['data_abertura'],
                ':data_fechamento' => $_POST['data_fechamento'],
                ':link_detalhes' => $_POST['link_detalhes'],
                ':status_edital' => $_POST['status_edital']
            ]);

            if ($result) {
                $message = '<div class="alert alert-success">Oportunidade adicionada com sucesso!</div>';
                echo '<script>setTimeout(function(){ window.location.href = window.location.href; }, 1500);</script>';
            } else {
                $message = '<div class="alert alert-danger">Erro ao adicionar oportunidade.</div>';
            }
        } catch (PDOException $e) {
            $message = '<div class="alert alert-danger">Erro ao conectar com o banco: ' . $e->getMessage() . '</div>';
        }
    }
    ?>

    <?php if (!empty($message)) echo $message; ?>

    <form id="add-opportunity-form" method="POST" action="">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="new-title" class="form-label">Título</label>
                <input type="text" class="form-control" id="new-title" name="titulo" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="new-type" class="form-label">Tipo</label>
                <select class="form-select" id="new-type" name="tipo" required>
                    <option value="">Selecione...</option>
                    <option value="Estágio">Estágio</option>
                    <option value="Iniciação Científica">Iniciação Científica</option>
                    <option value="Concurso">Concurso</option>
                    <option value="Emprego">Vaga de Emprego</option>
                    <option value="Bootcamp">Bootcamp</option>
                    <option value="Treinamento">Treinamento</option>
                    <option value="Pós-graduação">Pós-graduação</option>
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="new-modality" class="form-label">Modalidade</label>
                <select class="form-select" id="new-modality" name="modalidade" required>
                    <option value="">Selecione...</option>
                    <option value="Online">Online</option>
                    <option value="Presencial">Presencial</option>
                    <option value="Híbrido">Híbrido</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="new-local" class="form-label">Local</label>
                <select id="new-local" class="form-select" name="local" required>
                    <option value="">Selecione...</option>
                    <option value="Acre">Acre</option>
                    <option value="Alagoas">Alagoas</option>
                    <option value="Amapá">Amapá</option>
                    <option value="Amazonas">Amazonas</option>
                    <option value="Bahia">Bahia</option>
                    <option value="Ceará">Ceará</option>
                    <option value="Distrito Federal">Distrito Federal</option>
                    <option value="Espírito Santo">Espírito Santo</option>
                    <option value="Goiás">Goiás</option>
                    <option value="Maranhão">Maranhão</option>
                    <option value="Mato Grosso">Mato Grosso</option>
                    <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                    <option value="Minas Gerais">Minas Gerais</option>
                    <option value="Pará">Pará</option>
                    <option value="Paraíba">Paraíba</option>
                    <option value="Paraná">Paraná</option>
                    <option value="Pernambuco">Pernambuco</option>
                    <option value="Piauí">Piauí</option>
                    <option value="Rio de Janeiro">Rio de Janeiro</option>
                    <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                    <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                    <option value="Rondônia">Rondônia</option>
                    <option value="Roraima">Roraima</option>
                    <option value="Santa Catarina">Santa Catarina</option>
                    <option value="São Paulo">São Paulo</option>
                    <option value="Sergipe">Sergipe</option>
                    <option value="Tocantins">Tocantins</option>
                    <option value="Exterior">Exterior</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="new-area" class="form-label">Área</label>
                <select id="new-area" class="form-select" name="area" required>
                    <option value="">Selecione...</option>
                    <option value="Desenvolvimento Full Stack">Desenvolvimento Full Stack</option>
                    <option value="Desenvolvimento Front-End">Desenvolvimento Front-End</option>
                    <option value="Desenvolvimento Back-End">Desenvolvimento Back-End</option>
                    <option value="Desenvolvimento Mobile">Desenvolvimento Mobile</option>
                    <option value="Desenvolvimento de Jogos">Desenvolvimento de Jogos</option>
                    <option value="Sistemas Embarcados">Sistemas Embarcados</option>
                    <option value="Inteligência Artificial">Inteligência Artificial</option>
                    <option value="Desenvolvimento Web">Desenvolvimento Web</option>
                    <option value="Segurança da Informação">Segurança da Informação</option>
                    <option value="Aplicativos Desktop">Aplicativos Desktop</option>
                    <option value="Banco de Dados">Banco de Dados</option>
                    <option value="Análise de Dados">Análise de Dados</option>
                    <option value="Infraestrutura">Infraestrutura</option>
                    <option value="DevOps">DevOps</option>
                    <option value="Ciência de Dados">Ciência de Dados</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="new-data-abertura" class="form-label">Data de Abertura</label>
                <input type="date" class="form-control" id="new-data-abertura" name="data_abertura" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="new-data-fechamento" class="form-label">Data de Fechamento</label>
                <input type="date" class="form-control" id="new-data-fechamento" name="data_fechamento" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="new-status" class="form-label">Status do Edital</label>
                <select class="form-select" id="new-status" name="status_edital" required>
                    <option value="">Selecione...</option>
                    <option value="Aberto">Aberto</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="new-link" class="form-label">Link para Detalhes</label>
                <input type="url" class="form-control" id="new-link" name="link_detalhes" required>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-search rounded-pill px-4 me-2">
                <i class="bi bi-plus-circle me-1"></i> Adicionar Oportunidade
            </button>
        </div>
    </form>
</div>
