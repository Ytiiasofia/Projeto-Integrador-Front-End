// sistemaCategorias.js
const sistemaCategorias = {
  iniciar: function() {
    this.opcoesCategoria = document.querySelectorAll('.category-option');
    this.categoriaSelecionadaInput = document.getElementById('selected-category');
    
    if (this.opcoesCategoria.length > 0) {
      this.configurarEventos();
    }
  },

  configurarEventos: function() {
    this.opcoesCategoria.forEach(opcao => {
      opcao.addEventListener('click', () => {
        this.selecionarCategoria(opcao);
      });
    });
  },

  selecionarCategoria: function(opcao) {
    // Remove a seleção de todas as categorias
    this.opcoesCategoria.forEach(opt => opt.classList.remove('selected'));
    
    // Adiciona a seleção apenas à categoria clicada
    opcao.classList.add('selected');
    this.categoriaSelecionadaInput.value = opcao.getAttribute('data-category');
  },

  limparSelecao: function() {
    this.opcoesCategoria.forEach(opt => opt.classList.remove('selected'));
    this.categoriaSelecionadaInput.value = '';
  }
};