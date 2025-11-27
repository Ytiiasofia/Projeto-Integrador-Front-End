<!-- Nessa parte tem coisa repetida do arquivo tabelaOportunidadesAdm.php, a única diferença é que aqui não tem a parte de limpeza automática e de exclusão, enfim da pra fazer um sisteminha de reaproveitamento de código no futuro -->
<div class="table-responsive" data-aos="fade-up">
    <table class="table table-hover align-middle" id="opportunities-table">
        <thead>
            <tr class="text-center">
                <th style="border-top-left-radius: 10px;">Título</th>
                <th>Tipo</th>
                <th>Modalidade</th>
                <th>Local</th>
                <th>Área</th>
                <th>Edital</th>
                <th style="border-top-right-radius: 10px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require("../Include/conexao.php");

            // Consulta para buscar todas as oportunidades cadastradas
            $sql = "SELECT * FROM oportunidades"; 
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($oportunidade = mysqli_fetch_assoc($result)) {
                    // Determinar a classe do badge com base na modalidade
                    $badgeClass = '';
                    if ($oportunidade['modalidade'] === 'Online') $badgeClass = 'badge-online';
                    else if ($oportunidade['modalidade'] === 'Presencial') $badgeClass = 'badge-presencial';
                    else if ($oportunidade['modalidade'] === 'Híbrido') $badgeClass = 'badge-hibrido';
                    
                    // Determinar a classe do badge com base no status
                    $statusClass = '';
                    $statusIcon = '';
                    if ($oportunidade['status_edital'] === 'Aberto') {
                        $statusClass = 'badge-aberto';
                        $statusIcon = 'bi-check-circle';
                    } else if ($oportunidade['status_edital'] === 'Vigente') {
                        $statusClass = 'badge-vigente';
                        $statusIcon = 'bi-clock';
                    } else if ($oportunidade['status_edital'] === 'Fechado') {
                        $statusClass = 'badge-fechado';
                        $statusIcon = 'bi-x-circle';
                    }

                    // Verificar se o botão de detalhes deve estar desabilitado
                    $disabled = ($oportunidade['status_edital'] === 'Fechado') ? 'disabled' : '';
                    $btnClass = ($oportunidade['status_edital'] === 'Fechado') ? 'btn-outline-secondary' : 'btn-details';
                    
                    echo "
                    <tr data-id=\"{$oportunidade['id_oportunidade']}\">
                        <td>{$oportunidade['titulo']}</td>
                        <td class=\"text-center\">{$oportunidade['tipo']}</td>
                        <td class=\"text-center\"><span class=\"badge {$badgeClass} rounded-pill\">{$oportunidade['modalidade']}</span></td>
                        <td class=\"text-center\">{$oportunidade['local']}</td>
                        <td class=\"text-center\">{$oportunidade['area']}</td>
                        <td class=\"text-center\">
                            <span class=\"badge {$statusClass} rounded-pill\">
                                <i class=\"bi {$statusIcon} me-1\"></i> {$oportunidade['status_edital']}
                            </span>
                        </td>
                        <td class=\"text-center\">
                            <div class=\"d-flex justify-content-center gap-2\">
                                <a href=\"{$oportunidade['link_detalhes']}\" class=\"btn btn-sm {$btnClass} rounded-pill px-3\" {$disabled}>Detalhes</a>
                            </div>
                        </td>
                    </tr>
                    ";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>Nenhuma oportunidade encontrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>