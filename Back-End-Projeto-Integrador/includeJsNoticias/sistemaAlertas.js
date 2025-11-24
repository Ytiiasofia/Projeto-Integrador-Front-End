// sistemaAlertas.js
const sistemaAlertas = {
  iniciar: function() {
    // Inicialização se necessário
  },

  mostrarAlerta: function(mensagem, tipo) {
    // Remove alertas existentes
    const alertaExistente = document.querySelector('.custom-alert');
    if (alertaExistente) {
      alertaExistente.remove();
    }

    // Cria novo alerta
    const alerta = document.createElement('div');
    alerta.className = `custom-alert alert alert-${tipo === 'error' ? 'danger' : tipo} alert-dismissible fade show`;
    alerta.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
      min-width: 300px;
    `;
    alerta.innerHTML = `
      ${mensagem}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    document.body.appendChild(alerta);

    // Remove automaticamente após 5 segundos
    setTimeout(() => {
      if (alerta.parentNode) {
        alerta.remove();
      }
    }, 5000);
  }
};