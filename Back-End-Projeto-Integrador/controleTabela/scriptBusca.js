// Função para filtrar a tabela
document.getElementById('search-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Obter valores dos filtros
    const tipo = document.getElementById('tipo').value.toLowerCase();
    const modalidade = document.getElementById('modalidade').value.toLowerCase();
    const local = document.getElementById('local').value.toLowerCase();
    const area = document.getElementById('area').value.toLowerCase();
    const edital = document.getElementById('edital').value.toLowerCase();
    
    // Filtrar linhas da tabela
    const rows = document.querySelectorAll('#opportunities-table tbody tr');
    let resultadosEncontrados = 0;
    
    rows.forEach(row => {
        const rowTipo = row.cells[1].textContent.toLowerCase();
        const rowModalidade = row.cells[2].textContent.toLowerCase();
        const rowLocal = row.cells[3].textContent.toLowerCase();
        const rowArea = row.cells[4].textContent.toLowerCase();
        const rowEdital = row.cells[5].textContent.toLowerCase();
        
        const tipoMatch = !tipo || rowTipo.includes(tipo);
        const modalidadeMatch = !modalidade || rowModalidade.includes(modalidade);
        const localMatch = !local || rowLocal.includes(local);
        const areaMatch = !area || rowArea.includes(area);
        const editalMatch = !edital || rowEdital.includes(edital);
        
        if (tipoMatch && modalidadeMatch && localMatch && areaMatch && editalMatch) {
            row.style.display = '';
            resultadosEncontrados++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Mostrar mensagem se nenhum resultado for encontrado
    const mensagemVazio = document.getElementById('mensagem-vazia');
    if (resultadosEncontrados === 0) {
        if (!mensagemVazio) {
            const tr = document.createElement('tr');
            tr.id = 'mensagem-vazia';
            tr.innerHTML = '<td colspan="7" class="text-center">Nenhuma oportunidade encontrada com os filtros selecionados.</td>';
            document.querySelector('#opportunities-table tbody').appendChild(tr);
        }
    } else {
        if (mensagemVazio) {
            mensagemVazio.remove();
        }
    }
});

// Função para limpar a busca
document.getElementById('limpar-busca').addEventListener('click', function() {
    // Resetar os selects
    document.getElementById('tipo').value = '';
    document.getElementById('modalidade').value = '';
    document.getElementById('local').value = '';
    document.getElementById('area').value = '';
    document.getElementById('edital').value = '';
    
    // Mostrar todas as linhas
    const rows = document.querySelectorAll('#opportunities-table tbody tr');
    rows.forEach(row => {
        if (row.id !== 'mensagem-vazia') {
            row.style.display = '';
        }
    });
    
    // Remover mensagem de vazio
    const mensagemVazio = document.getElementById('mensagem-vazia');
    if (mensagemVazio) {
        mensagemVazio.remove();
    }
});