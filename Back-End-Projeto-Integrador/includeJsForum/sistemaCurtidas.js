const SistemaCurtidas = {
    init: function() {
        this.vincularCurtidasPosts();
        this.vincularCurtidasComentarios();
    },

    vincularCurtidasPosts: function() {
        document.querySelectorAll('.like-btn').forEach(botaoCurtir => {
            botaoCurtir.addEventListener('click', function(e) {
                e.preventDefault();
                const postId = this.getAttribute('data-post-id');
                SistemaCurtidas.curtirPost(postId, this);
            });
        });
    },

    vincularCurtidasComentarios: function() {
        document.querySelectorAll('.like-comment-btn').forEach(botaoCurtir => {
            botaoCurtir.addEventListener('click', function(e) {
                e.preventDefault();
                const comentarioId = this.getAttribute('data-comentario-id');
                SistemaCurtidas.curtirComentario(comentarioId, this);
            });
        });
    },

    curtirPost: function(postId, elemento) {
        this.enviarRequisicaoCurtida('curtir_post', 'post_id', postId)
            .then(data => {
                if (data.success) {
                    this.atualizarUICurtida(elemento, data.esta_curtido, data.total_curtidas);
                } else {
                    alert('Erro ao curtir post: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao processar curtida');
            });
    },

    curtirComentario: function(comentarioId, elemento) {
        this.enviarRequisicaoCurtida('curtir_comentario', 'comentario_id', comentarioId)
            .then(data => {
                if (data.success) {
                    this.atualizarUICurtidaComentario(elemento, data.esta_curtido, data.total_curtidas);
                } else {
                    alert('Erro ao curtir comentário: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao processar curtida');
            });
    },

    enviarRequisicaoCurtida: function(acao, nomeParametro, id) {
        return fetch(`../controleForum/postsForum.php?action=${acao}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `${nomeParametro}=${id}`
        }).then(response => response.json());
    },

    atualizarUICurtida: function(elemento, estaCurtido, totalCurtidas) {
        const iconeCoracao = elemento.querySelector('i');
        const spanContador = elemento.querySelector('.like-count');
        this.atualizarIconeCoracao(iconeCoracao, estaCurtido);
        spanContador.textContent = totalCurtidas;
    },

    atualizarUICurtidaComentario: function(elemento, estaCurtido, totalCurtidas) {
        const iconeCoracao = elemento.querySelector('i');
        const spanContador = elemento.querySelector('.comment-like-count');
        this.atualizarIconeCoracao(iconeCoracao, estaCurtido);
        spanContador.textContent = totalCurtidas;
    },

    atualizarIconeCoracao: function(iconeCoracao, estaCurtido) {
        if (estaCurtido) {
            iconeCoracao.classList.remove('bi-heart');
            iconeCoracao.classList.add('bi-heart-fill', 'text-danger');
        } else {
            iconeCoracao.classList.remove('bi-heart-fill', 'text-danger');
            iconeCoracao.classList.add('bi-heart');
        }
    }
};