/* Geezthor - JavaScript Principal */

document.addEventListener('DOMContentLoaded', function() {
    
    // ===== INICIALIZAÇÃO GLOBAL =====
    initializeAnimations();
    initializeTooltips();
    initializeInteractions();
    
    // ===== ANIMAÇÕES =====
    function initializeAnimations() {
        // Observador de interseção para animações
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);
        
        // Observar elementos com animação
        document.querySelectorAll('.fade-in, .slide-up').forEach(el => {
            observer.observe(el);
        });
    }
    
    // ===== TOOLTIPS =====
    function initializeTooltips() {
        // Inicializar tooltips do Bootstrap se disponível
        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    }
    
    // ===== INTERAÇÕES =====
    function initializeInteractions() {
        // Smooth scroll para links âncora
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Loading states para botões
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.classList.add('loading');
                    submitBtn.disabled = true;
                    
                    // Remover loading após 3 segundos se não houver resposta
                    setTimeout(() => {
                        submitBtn.classList.remove('loading');
                        submitBtn.disabled = false;
                    }, 3000);
                }
            });
        });
        
        // Hover effects para cards
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    }
    
    // ===== FILTROS DE PROJETOS =====
    if (document.getElementById('filtro-projeto')) {
        initializeProjectFilters();
    }
    
    function initializeProjectFilters() {
        const filtroNome = document.getElementById('filtro-projeto');
        const filtroStatus = document.getElementById('filtro-status');
        const projetos = document.querySelectorAll('.projeto-item');
        
        function filtrarProjetos() {
            const termoBusca = filtroNome.value.toLowerCase();
            const statusSelecionado = filtroStatus.value;
            let visibleCount = 0;
            
            projetos.forEach(function(projeto) {
                const nome = projeto.querySelector('.card-title').textContent.toLowerCase();
                const clienteElement = projeto.querySelector('.text-muted');
                const cliente = clienteElement ? clienteElement.textContent.toLowerCase() : '';
                const status = projeto.dataset.status;
                
                const correspondeTexto = nome.includes(termoBusca) || cliente.includes(termoBusca);
                const correspondeStatus = !statusSelecionado || status === statusSelecionado;
                
                if (correspondeTexto && correspondeStatus) {
                    projeto.style.display = 'block';
                    projeto.style.animation = 'fadeIn 0.3s ease-in';
                    visibleCount++;
                } else {
                    projeto.style.display = 'none';
                }
            });
            
            // Mostrar mensagem se nenhum projeto for encontrado
            updateEmptyState(visibleCount === 0);
        }
        
        function updateEmptyState(isEmpty) {
            let emptyMessage = document.querySelector('.filter-empty-message');
            
            if (isEmpty && !emptyMessage) {
                emptyMessage = document.createElement('div');
                emptyMessage.className = 'col-12 text-center py-5 filter-empty-message';
                emptyMessage.innerHTML = `
                    <div class="empty-state">
                        <i class="bi bi-search text-muted" style="font-size: 4rem;"></i>
                        <h3 class="mt-3">Nenhum projeto encontrado</h3>
                        <p class="text-muted">Tente ajustar os filtros de busca</p>
                    </div>
                `;
                document.getElementById('lista-projetos').appendChild(emptyMessage);
            } else if (!isEmpty && emptyMessage) {
                emptyMessage.remove();
            }
        }
        
        // Event listeners com debounce para melhor performance
        let timeoutId;
        filtroNome.addEventListener('input', function() {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(filtrarProjetos, 300);
        });
        
        filtroStatus.addEventListener('change', filtrarProjetos);
    }
    
    // ===== VALIDAÇÃO DE FORMULÁRIOS =====
    function initializeFormValidation() {
        const forms = document.querySelectorAll('.needs-validation');
        
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    
                    // Focar no primeiro campo inválido
                    const firstInvalid = form.querySelector(':invalid');
                    if (firstInvalid) {
                        firstInvalid.focus();
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
                form.classList.add('was-validated');
            });
            
            // Validação em tempo real
            form.querySelectorAll('input, select, textarea').forEach(field => {
                field.addEventListener('blur', function() {
                    if (this.checkValidity()) {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    } else {
                        this.classList.remove('is-valid');
                        this.classList.add('is-invalid');
                    }
                });
            });
        });
    }
    
    // Inicializar validação se existirem formulários
    if (document.querySelector('.needs-validation')) {
        initializeFormValidation();
    }
    
    // ===== NOTIFICAÇÕES =====
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(notification);
        
        // Auto-remover após 5 segundos
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }
    
    // ===== UTILITÁRIOS GLOBAIS =====
    window.Geezthor = {
        showNotification: showNotification,
        
        // Função para confirmar ações
        confirm: function(message, callback) {
            if (confirm(message)) {
                callback();
            }
        },
        
        // Função para formatear moeda
        formatCurrency: function(value) {
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(value);
        },
        
        // Função para formatear data
        formatDate: function(date) {
            return new Intl.DateTimeFormat('pt-BR').format(new Date(date));
        }
    };
    
    // ===== DARK MODE (futuro) =====
    function initializeDarkMode() {
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        if (darkModeToggle) {
            darkModeToggle.addEventListener('click', function() {
                document.body.classList.toggle('dark-mode');
                localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
            });
            
            // Restaurar preferência
            if (localStorage.getItem('darkMode') === 'true') {
                document.body.classList.add('dark-mode');
            }
        }
    }
    
    initializeDarkMode();
});

// ===== CSS DINÂMICO =====
const dynamicStyles = `
.animate-in {
    animation: animateIn 0.6s ease-out forwards;
}

@keyframes animateIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.is-valid {
    border-color: #198754 !important;
}

.is-invalid {
    border-color: #dc3545 !important;
}

.dark-mode {
    --primary-color: #4a90e2;
    --secondary-color: #1a1a1a;
    background: #121212;
    color: #ffffff;
}

.dark-mode .card {
    background: #1e1e1e;
    color: #ffffff;
}

.dark-mode .navbar {
    background: #1a1a1a !important;
}
`;

// Adicionar estilos dinâmicos
const styleSheet = document.createElement('style');
styleSheet.textContent = dynamicStyles;
document.head.appendChild(styleSheet);
