// sistemaDeletarNoticias.js
const sistemaDeletarNoticias = {
  iniciar: function() {
    this.configurarBotoesExclusao();
  },

  configurarBotoesExclusao: function() {
    const botoesExcluir = document.querySelectorAll('.delete-news');
    
    botoesExcluir.forEach(botao => {
      botao.addEventListener('click', function() {
        const noticiaId = this.getAttribute('data-id');
        const noticiaTitulo = this.getAttribute('data-title');
        
        // Confirmação antes de deletar
        if (confirm(`Tem certeza que deseja deletar a notícia "${noticiaTitulo}"?\nEsta ação não pode ser desfeita.`)) {
          sistemaDeletarNoticias.excluirNoticia(noticiaId, this);
        }
      });
    });
  },

  excluirNoticia: function(noticiaId, elementoBotao) {
    // Desabilitar botão
    elementoBotao.disabled = true;
    elementoBotao.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Deletando...';

    // Criar FormData
    const formData = new FormData();
    formData.append('noticia_id', noticiaId);
    
    // Enviar via AJAX
    fetch('../controleNoticias/deletar_noticia.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        sistemaAlertas.mostrarAlerta(data.message, 'success');
        this.removerNoticiaDaPagina(elementoBotao);
      } else {
        sistemaAlertas.mostrarAlerta('Erro: ' + data.message, 'error');
        this.reabilitarBotao(elementoBotao);
      }
    })
    .catch(error => {
      console.error('Erro:', error);
      sistemaAlertas.mostrarAlerta('Erro ao deletar notícia. Tente novamente.', 'error');
      this.reabilitarBotao(elementoBotao);
    });
  },

  removerNoticiaDaPagina: function(elementoBotao) {
    const elementoNoticia = elementoBotao.closest('.col-lg-6');
    elementoNoticia.style.opacity = '0';
    elementoNoticia.style.transition = 'opacity 0.3s ease';
    
    setTimeout(() => {
      elementoNoticia.remove();
      this.verificarNoticiasRestantes();
    }, 300);
  },

  verificarNoticiasRestantes: function() {
    const artigosRestantes = document.querySelectorAll('.col-lg-6');
    if (artigosRestantes.length === 0) {
      const secaoPosts = document.getElementById('blog-posts');
      const container = secaoPosts.querySelector('.container');
      container.innerHTML = '<div class="row gy-4"><div class="col-12"><p class="text-center">Nenhuma notícia publicada ainda.</p></div></div>';
    }
  },

  reabilitarBotao: function(elementoBotao) {
    elementoBotao.disabled = false;
    elementoBotao.innerHTML = '<i class="bi bi-trash"></i> Deletar';
  }
};