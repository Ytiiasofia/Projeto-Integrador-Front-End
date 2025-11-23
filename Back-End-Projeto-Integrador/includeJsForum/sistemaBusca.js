const SistemaBusca = {
    init: function() {
        this.formularioBusca = document.querySelector('form[name="busca"]');
        this.campoBusca = document.querySelector('input[name="busca"]');
        
        if (this.formularioBusca && this.campoBusca) {
            this.vincularEventos();
        }
    },

    vincularEventos: function() {
        let timeoutBusca;
        
        this.campoBusca.addEventListener('input', () => {
            clearTimeout(timeoutBusca);
            timeoutBusca = setTimeout(() => {
                if (this.deveSubmeter()) {
                    this.submeterBusca();
                }
            }, 800);
        });

        this.campoBusca.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.submeterBusca();
            }
        });
    },

    deveSubmeter: function() {
        const valor = this.campoBusca.value.trim();
        return valor.length >= 2 || valor.length === 0;
    },

    submeterBusca: function() {
        this.mostrarCarregamento();
        this.formularioBusca.submit();
    },

    mostrarCarregamento: function() {
        const containerPosts = document.getElementById('posts-container');
        if (containerPosts) {
            containerPosts.innerHTML = this.getHTMLCarregamento();
        }
    },

    getHTMLCarregamento: function() {
        return `
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Buscando...</span>
                </div>
                <p class="mt-2">Buscando posts...</p>
            </div>
        `;
    }
};