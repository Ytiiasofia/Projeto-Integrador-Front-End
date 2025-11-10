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
            // Conexão com o banco de dados via require
            require("../Include/conexao.php");

            // LIMPEZA AUTOMÁTICA - Executa sempre que a página é carregada
            // 1. Fechar oportunidades vencidas
            $sql_fechar = "UPDATE oportunidades 
                          SET status_edital = 'Fechado' 
                          WHERE data_fechamento < CURDATE() 
                          AND status_edital != 'Fechado'";
            mysqli_query($con, $sql_fechar);
            
            // 2. Excluir oportunidades fechadas há mais de 10 dias
            $sql_excluir = "DELETE FROM oportunidades 
                           WHERE status_edital = 'Fechado' 
                           AND data_fechamento <= DATE_SUB(CURDATE(), INTERVAL 10 DAY)";
            mysqli_query($con, $sql_excluir);

            // Consulta para buscar TODAS as oportunidades
            $sql = "SELECT * FROM oportunidades ORDER BY data_fechamento ASC";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($oportunidade = mysqli_fetch_assoc($result)) {
                    // Calcular datas
                    $data_fechamento = new DateTime($oportunidade['data_fechamento']);
                    $data_atual = new DateTime();
                    $data_exclusao = clone $data_fechamento;
                    $data_exclusao->modify('+10 days');
                    
                    // Verificar status atual
                    $esta_fechada = ($oportunidade['status_edital'] === 'Fechado');
                    $esta_vencida = ($data_fechamento < $data_atual);
                    
                    // Se está vencida mas não foi fechada ainda, mostrar como será fechada
                    $sera_fechada = ($esta_vencida && !$esta_fechada);

                    // Determinar a classe do badge com base na modalidade
                    $badgeClass = '';
                    if ($oportunidade['modalidade'] === 'Online') $badgeClass = 'badge-online';
                    else if ($oportunidade['modalidade'] === 'Presencial') $badgeClass = 'badge-presencial';
                    else if ($oportunidade['modalidade'] === 'Híbrido') $badgeClass = 'badge-hibrido';
                    
                    // Determinar a classe do badge com base no status
                    $statusClass = '';
                    $statusIcon = '';
                    $statusTexto = $oportunidade['status_edital'];
                    
                    if ($sera_fechada) {
                        $statusClass = 'badge-fechado';
                        $statusIcon = 'bi-clock';
                        $statusTexto = 'A Fechar';
                    } else if ($oportunidade['status_edital'] === 'Aberto') {
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
                    $disabled = ($esta_fechada || $sera_fechada) ? 'disabled' : '';
                    $btnClass = ($esta_fechada || $sera_fechada) ? 'btn-outline-secondary' : 'btn-details';
                    
                    // Formatar datas para exibição
                    $data_abertura_formatada = date('d/m/Y', strtotime($oportunidade['data_abertura']));
                    $data_fechamento_formatada = date('d/m/Y', strtotime($oportunidade['data_fechamento']));
                    $data_exclusao_formatada = date('d/m/Y', strtotime($oportunidade['data_fechamento'] . ' + 10 days'));
                    
                    echo "
                    <tr data-id=\"{$oportunidade['id_oportunidade']}\">
                        <td>
                            <strong>{$oportunidade['titulo']}</strong>
                            <br>
                            <small class=\"text-muted\">
                                Aberto em: {$data_abertura_formatada}
                                <br>
                                " . ($esta_fechada ? 
                                    'Encerrou em: <span class=\"text-danger\">' . $data_fechamento_formatada . '</span>' : 
                                    ($sera_fechada ?
                                        'Encerrou em: <span class=\"text-warning\">' . $data_fechamento_formatada . '</span>' :
                                        'Encerra em: <span class=\"text-success\">' . $data_fechamento_formatada . '</span>'
                                    )
                                ) . "
                            </small>
                        </td>
                        <td class=\"text-center\">{$oportunidade['tipo']}</td>
                        <td class=\"text-center\"><span class=\"badge {$badgeClass} rounded-pill\">{$oportunidade['modalidade']}</span></td>
                        <td class=\"text-center\">{$oportunidade['local']}</td>
                        <td class=\"text-center\">{$oportunidade['area']}</td>
                        <td class=\"text-center\">
                            <span class=\"badge {$statusClass} rounded-pill\">
                                <i class=\"bi {$statusIcon} me-1\"></i> {$statusTexto}
                            </span>
                            " . ($esta_fechada ? 
                                '<br><small class=\"text-muted mt-1 d-block\">Exclui em:<br>' . $data_exclusao_formatada . '</small>' : 
                                ($sera_fechada ?
                                    '<br><small class=\"text-warning mt-1 d-block\">Fechará automaticamente</small>' :
                                    ''
                                )
                            ) . "
                        </td>
                        <td class=\"text-center\">
                            <div class=\"d-flex justify-content-center gap-2\">
                                <a href=\"{$oportunidade['link_detalhes']}\" class=\"btn btn-sm {$btnClass} rounded-pill px-3\" {$disabled}>
                                    Detalhes
                                </a>
                                <button class=\"btn btn-sm btn-trash delete-oportunidade\" data-oportunidade-id=\"{$oportunidade['id_oportunidade']}\">
                                    <i class=\"bi bi-trash\"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    ";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>Nenhuma oportunidade encontrada.</td></tr>";
            }
            
            // Fechar conexão
            mysqli_close($con);
            ?>
        </tbody>
    </table>
    
    <!-- Modal de Exclusão de Oportunidade -->
    <div class="modal fade" id="deleteOportunidadeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Você tem certeza que deseja excluir esta oportunidade?</p>
                    <p class="text-danger"><i class="bi bi-exclamation-triangle-fill"></i> Esta ação não pode ser desfeita.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="POST" action="../controleTabela/deleteOportunidades.php" style="display:inline;">
                        <input type="hidden" name="oportunidade_id" id="oportunidadeIdToDelete">
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-oportunidade');
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteOportunidadeModal'));
            const oportunidadeIdToDelete = document.getElementById('oportunidadeIdToDelete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    oportunidadeIdToDelete.value = this.getAttribute('data-oportunidade-id');
                    deleteModal.show();
                });
            });
        });
    </script>
</div>