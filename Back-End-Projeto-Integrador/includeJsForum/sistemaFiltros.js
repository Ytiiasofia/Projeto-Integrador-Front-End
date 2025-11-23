const SistemaFiltros = {
    init: function() {
        this.vincularLinksFiltro();
    },

    vincularLinksFiltro: function() {
        document.querySelectorAll('.dropdown-item[href*="filtro"]').forEach(link => {
            link.addEventListener('click', function(e) {
                SistemaFiltros.mostrarCarregamento();
            });
        });
    },

    mostrarCarregamento: function() {
        const containerPosts = document.getElementById('posts-container');
        if (containerPosts) {
            containerPosts.innerHTML = SistemaFiltros.getHTMLCarregamento();
        }
    },

    getHTMLCarregamento: function() {
        return `
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Carregando...</span>
                </div>
                <p class="mt-2">Aplicando filtro...</p>
            </div>
        `;
    }
};