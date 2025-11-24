// sistemaFormulario.js
const sistemaFormulario = {
  iniciar: function() {
    this.formularioNoticias = document.getElementById('news-form');
    this.botaoLimpar = document.getElementById('clear-form');
    
    if (this.formularioNoticias) {
      this.configurarEventos();
    }
  },

  configurarEventos: function() {
    // Limpar formulário
    if (this.botaoLimpar) {
      this.botaoLimpar.addEventListener('click', () => {
        this.limparFormulario();
      });
    }

    // Enviar formulário
    this.formularioNoticias.addEventListener('submit', (e) => {
      this.enviarFormulario(e);
    });
  },

  limparFormulario: function() {
    this.formularioNoticias.reset();
    sistemaTags.limparTags();
    sistemaCategorias.limparSelecao();
  },

  enviarFormulario: function(e) {
    e.preventDefault();
    
    // Validação básica
    const titulo = document.getElementById('news-title').value.trim();
    const conteudo = document.getElementById('news-content').value.trim();
    const categoriaSelecionada = document.getElementById('selected-category').value;
    
    if (!this.validarFormulario(titulo, conteudo, categoriaSelecionada)) {
      return;
    }

    this.enviarDados();
  },

  validarFormulario: function(titulo, conteudo, categoria) {
    if (!titulo) {
      sistemaAlertas.mostrarAlerta('Por favor, digite um título para a notícia', 'warning');
      return false;
    }
    
    if (!conteudo) {
      sistemaAlertas.mostrarAlerta('Por favor, digite o conteúdo da notícia', 'warning');
      return false;
    }
    
    if (!categoria) {
      sistemaAlertas.mostrarAlerta('Por favor, selecione uma categoria', 'warning');
      return false;
    }
    
    if (sistemaTags.tagsSelecionadas.length === 0) {
      sistemaAlertas.mostrarAlerta('Por favor, adicione pelo menos uma tag', 'warning');
      return false;
    }

    return true;
  },

  enviarDados: function() {
    // Desabilitar botão para evitar múltiplos envios
    const botaoEnviar = document.getElementById('submit-btn');
    this.alterarEstadoBotao(botaoEnviar, true, 'Publicando...');

    // Criar FormData para enviar arquivos
    const formData = new FormData(this.formularioNoticias);
    
    // Enviar via AJAX
    fetch('../controleNoticias/processar_noticia.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        sistemaAlertas.mostrarAlerta(data.message, 'success');
        this.limparFormularioCompleto();
        
        // Recarregar a lista de notícias após 2 segundos
        setTimeout(() => {
          location.reload();
        }, 2000);
      } else {
        sistemaAlertas.mostrarAlerta('Erro: ' + data.message, 'error');
      }
    })
    .catch(error => {
      console.error('Erro:', error);
      sistemaAlertas.mostrarAlerta('Erro ao publicar notícia. Tente novamente.', 'error');
    })
    .finally(() => {
      // Reabilitar botão
      this.alterarEstadoBotao(botaoEnviar, false, 'Publicar Notícia');
    });
  },

  alterarEstadoBotao: function(botao, desabilitado, texto) {
    botao.disabled = desabilitado;
    botao.innerHTML = desabilitado 
      ? '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + texto
      : texto;
  },

  limparFormularioCompleto: function() {
    this.formularioNoticias.reset();
    sistemaTags.limparTags();
    sistemaCategorias.limparSelecao();
  }
};