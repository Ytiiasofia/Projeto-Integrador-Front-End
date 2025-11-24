// sistemaTags.js
const sistemaTags = {
  iniciar: function() {
    this.etiquetas = document.querySelectorAll('.tag-badge');
    this.containerTags = document.getElementById('tag-container');
    this.tagsSelecionadasInput = document.getElementById('selected-tags');
    this.novaTagInput = document.getElementById('new-tag');
    this.tagsSelecionadas = [];
    
    if (this.etiquetas.length > 0) {
      this.configurarEventos();
    }
  },

  configurarEventos: function() {
    // Event listeners para tags existentes
    this.etiquetas.forEach(etiqueta => {
      etiqueta.addEventListener('click', () => {
        this.alternarTag(etiqueta);
      });
    });
    
    // Event listener para nova tag
    if (this.novaTagInput) {
      this.novaTagInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
          e.preventDefault();
          this.adicionarNovaTag();
        }
      });
    }
  },

  alternarTag: function(etiqueta) {
    const tag = etiqueta.getAttribute('data-tag');
    
    if (etiqueta.classList.contains('selected')) {
      // Remove a tag se já estiver selecionada
      etiqueta.classList.remove('selected');
      this.tagsSelecionadas = this.tagsSelecionadas.filter(t => t !== tag);
    } else {
      // Adiciona a tag se não estiver selecionada
      etiqueta.classList.add('selected');
      this.tagsSelecionadas.push(tag);
    }
    
    this.atualizarContainerTags();
    this.atualizarInputTagsSelecionadas();
  },

  adicionarNovaTag: function() {
    const novaTag = this.novaTagInput.value.trim();
    
    if (novaTag && !this.tagsSelecionadas.includes(novaTag)) {
      this.tagsSelecionadas.push(novaTag);
      this.atualizarContainerTags();
      this.atualizarInputTagsSelecionadas();
      this.novaTagInput.value = '';
    }
  },

  atualizarContainerTags: function() {
    if (!this.containerTags) return;
    
    this.containerTags.innerHTML = '';
    this.tagsSelecionadas.forEach(tag => {
      const etiqueta = document.createElement('span');
      etiqueta.className = 'badge me-1 mb-1';
      etiqueta.style.backgroundColor = '#6a62d4';
      etiqueta.style.color = 'white';
      etiqueta.style.cursor = 'default';
      etiqueta.textContent = tag;
      
      const botaoRemover = document.createElement('span');
      botaoRemover.innerHTML = ' &times;';
      botaoRemover.style.cursor = 'pointer';
      botaoRemover.style.fontWeight = 'bold';
      botaoRemover.addEventListener('click', () => {
        this.removerTag(tag);
      });
      
      etiqueta.appendChild(botaoRemover);
      this.containerTags.appendChild(etiqueta);
    });
  },

  removerTag: function(tag) {
    this.tagsSelecionadas = this.tagsSelecionadas.filter(t => t !== tag);
    this.atualizarContainerTags();
    this.atualizarInputTagsSelecionadas();
    
    // Remove a seleção da tag na lista de opções
    const etiqueta = document.querySelector(`.tag-badge[data-tag="${tag}"]`);
    if (etiqueta) {
      etiqueta.classList.remove('selected');
    }
  },

  atualizarInputTagsSelecionadas: function() {
    if (this.tagsSelecionadasInput) {
      this.tagsSelecionadasInput.value = this.tagsSelecionadas.join(',');
    }
  },

  limparTags: function() {
    this.tagsSelecionadas = [];
    this.atualizarContainerTags();
    this.atualizarInputTagsSelecionadas();
    this.etiquetas.forEach(etiqueta => etiqueta.classList.remove('selected'));
  }
};