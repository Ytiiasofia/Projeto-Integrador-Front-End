// sistemaBusca.js
const sistemaBusca = {
  iniciar: function() {
    this.formularioBusca = document.getElementById('search-form');
    this.botoesLimparBusca = document.querySelectorAll('#clear-search');
    this.inputBusca = document.getElementById('search-input');
    
    if (this.formularioBusca) {
      this.configurarEventos();
    }
  },

  configurarEventos: function() {
    // Foco no campo de busca
    if (this.inputBusca) {
      this.inputBusca.focus();
    }

    // Limpar busca
    this.botoesLimparBusca.forEach(botao => {
      botao.addEventListener('click', () => {
        this.limparBusca();
      });
    });

    // Busca em tempo real (opcional)
    if (this.inputBusca) {
      this.inputBusca.addEventListener('input', () => {
        // Aqui você pode implementar busca em tempo real com AJAX se preferir
      });
    }

    // Validação do formulário de busca
    if (this.formularioBusca) {
      this.formularioBusca.addEventListener('submit', (e) => {
        this.validarBusca(e);
      });
    }
  },

  limparBusca: function() {
    window.location.href = window.location.pathname;
  },

  validarBusca: function(e) {
    const valorBusca = this.inputBusca.value.trim();
    if (!valorBusca) {
      e.preventDefault();
      sistemaAlertas.mostrarAlerta('Por favor, digite um termo para buscar', 'warning');
      this.inputBusca.focus();
    }
  }
};