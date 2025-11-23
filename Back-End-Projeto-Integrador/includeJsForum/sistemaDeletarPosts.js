const SistemaDeletarPosts = {
    init: function() {
        this.vincularBotoesDeletar();
    },

    vincularBotoesDeletar: function() {
        document.querySelectorAll('.delete-post-btn').forEach(function(botaoDeletar) {
            botaoDeletar.addEventListener('click', function(e) {
                e.preventDefault();
                SistemaDeletarPosts.manusearDelecao(this);
            });
        });
    },

    manusearDelecao: function(botaoDeletar) {
        const postId = botaoDeletar.getAttribute('data-post-id');
        const postTitulo = botaoDeletar.getAttribute('data-post-title');
        
        if (confirm(`Tem certeza que deseja deletar o post "${postTitulo}"?\n\nEsta ação é irreversível e deletará todos os comentários associados.`)) {
            SistemaDeletarPosts.executarDelecao(postId, botaoDeletar);
        }
    },

    executarDelecao: function(postId, botaoDeletar) {
        const elementoPost = document.getElementById('post-' + postId);
        SistemaDeletarPosts.mostrarCarregamento(elementoPost);
        
        const formData = new FormData();
        formData.append('post_id', postId);
        
        fetch('../controleForum/postsForum.php?action=deletar_post', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            window.location.reload();
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao deletar post. Tente novamente.');
            SistemaDeletarPosts.restaurarElemento(elementoPost);
        });
    },

    mostrarCarregamento: function(elementoPost) {
        elementoPost.style.opacity = '0.5';
        elementoPost.style.pointerEvents = 'none';
    },

    restaurarElemento: function(elementoPost) {
        elementoPost.style.opacity = '1';
        elementoPost.style.pointerEvents = 'auto';
    }
};