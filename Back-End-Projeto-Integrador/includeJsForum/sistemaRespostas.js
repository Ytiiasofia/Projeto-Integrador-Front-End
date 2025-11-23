const SistemaRespostas = {
    init: function() {
        this.vincularBotoesResponder();
    },

    vincularBotoesResponder: function() {
        document.addEventListener('click', (e) => {
            if (e.target.closest('.reply-btn')) {
                e.preventDefault();
                this.manusearResposta(e.target.closest('.reply-btn'));
            }
        });
    },

    manusearResposta: function(botaoResponder) {
        const comentarioId = botaoResponder.getAttribute('data-comentario-id');
        const formularioComentario = botaoResponder.closest('.comments-section').querySelector('.comment-form');
        
        this.definirComentarioPai(formularioComentario, comentarioId);
        this.focarCampoComentario(formularioComentario);
        this.mostrarNotificacaoResposta();
    },

    definirComentarioPai: function(formularioComentario, comentarioId) {
        let campoOculto = formularioComentario.querySelector('input[name="comentario_pai_id"]');
        if (!campoOculto) {
            campoOculto = document.createElement('input');
            campoOculto.type = 'hidden';
            campoOculto.name = 'comentario_pai_id';
            formularioComentario.appendChild(campoOculto);
        }
        campoOculto.value = comentarioId;
    },

    focarCampoComentario: function(formularioComentario) {
        const campoComentario = formularioComentario.querySelector('input[name="comentario"]');
        campoComentario.focus();
        campoComentario.placeholder = "Respondendo ao comentário...";
    },

    mostrarNotificacaoResposta: function() {
        alert('Agora você está respondendo a um comentário!');
    }
};