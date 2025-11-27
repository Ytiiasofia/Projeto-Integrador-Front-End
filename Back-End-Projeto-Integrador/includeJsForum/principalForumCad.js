document.addEventListener('DOMContentLoaded', function() {
    // Inicializar todos os sistemas
    // Eu criei esse segundo arquivo para que não ocorra o carregamento de scripts do adm quando o cadastrado estiver usando, não sabia dizer se inicializar a função de delete poderia gerar uma falha de segurança
    SistemaFiltros.init();
    SistemaBusca.init();
    SistemaCurtidas.init();
    SistemaRespostas.init();
});