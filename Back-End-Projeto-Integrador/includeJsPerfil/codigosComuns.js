//  Funcionalidades compartilhadas entre usuário e admin

class ProfileManager {
    constructor() {
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.setupModalHandlers();
    }

    // Função para mostrar mensagens (comum a ambos)
    showMessage(message, isSuccess = true) {
        let messageDiv = document.getElementById('message-alert');
        if (!messageDiv) {
            messageDiv = document.createElement('div');
            messageDiv.id = 'message-alert';
            messageDiv.className = `alert ${isSuccess ? 'alert-success' : 'alert-danger'} alert-dismissible fade show`;
            messageDiv.style.position = 'fixed';
            messageDiv.style.top = '20px';
            messageDiv.style.right = '20px';
            messageDiv.style.zIndex = '9999';
            messageDiv.style.minWidth = '300px';
            messageDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(messageDiv);
        } else {
            messageDiv.className = `alert ${isSuccess ? 'alert-success' : 'alert-danger'} alert-dismissible fade show`;
            messageDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
        }
        
        setTimeout(() => {
            if (messageDiv && messageDiv.parentNode) {
                messageDiv.parentNode.removeChild(messageDiv);
            }
        }, 5000);
    }

    // Upload e preview de foto (comum a ambos)
    setupPhotoUpload() {
        const photoUpload = document.getElementById('photoUpload');
        const currentPhotoPreview = document.getElementById('currentPhotoPreview');
        const savePhotoBtn = document.getElementById('savePhotoBtn');

        if (photoUpload && savePhotoBtn) {
            photoUpload.addEventListener('change', (e) => {
                const file = e.target.files[0];
                const feedback = document.getElementById('photoFeedback');
                
                if (file) {
                    // Validar tipo de arquivo
                    const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                    if (!validTypes.includes(file.type)) {
                        feedback.textContent = 'Formato de arquivo inválido. Use JPG, PNG ou GIF.';
                        feedback.style.color = 'red';
                        savePhotoBtn.disabled = true;
                        return;
                    }
                    
                    // Validar tamanho do arquivo (2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        feedback.textContent = 'Arquivo muito grande. Máximo 2MB.';
                        feedback.style.color = 'red';
                        savePhotoBtn.disabled = true;
                        return;
                    }
                    
                    feedback.textContent = 'Arquivo válido';
                    feedback.style.color = 'green';
                    savePhotoBtn.disabled = false;
                    
                    // Preview da imagem
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        currentPhotoPreview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Salvar foto
            savePhotoBtn.addEventListener('click', () => {
                this.savePhoto();
            });
        }
    }

    // Salvar foto (comum)
    savePhoto() {
        const fileInput = document.getElementById('photoUpload');
        const file = fileInput.files[0];
        
        if (!file) {
            this.showMessage('Selecione uma imagem para upload', false);
            return;
        }
        
        const formData = new FormData();
        formData.append('action', 'update_photo');
        formData.append('foto_perfil', file);
        
        // Determinar o caminho correto baseado no tipo de usuário
        const isAdmin = document.querySelector('.admin-badge') !== null;
        const endpoint = isAdmin ? '../UserCadastrado/atualizar_perfil.php' : 'atualizar_perfil.php';
        
        fetch(endpoint, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Atualizar a foto na página
                document.getElementById('currentProfilePhoto').src = data.foto_url + '?t=' + new Date().getTime();
                bootstrap.Modal.getInstance(document.getElementById('editPhotoModal')).hide();
                this.showMessage(data.message, true);
                
                // Resetar o formulário
                document.getElementById('photoUploadForm').reset();
                document.getElementById('photoFeedback').textContent = '';
            } else {
                this.showMessage(data.message, false);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            this.showMessage('Erro ao fazer upload da foto', false);
        });
    }

    // Validação de senha (comum)
    setupPasswordValidation() {
        const newPasswordInput = document.getElementById('newPassword');
        const passwordFeedback = document.getElementById('passwordFeedback');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const confirmFeedback = document.getElementById('confirmFeedback');
        
        if (newPasswordInput) {
            newPasswordInput.addEventListener('input', () => {
                const password = newPasswordInput.value;
                this.validatePassword(password, passwordFeedback);
                
                // Verificar confirmação
                if (confirmPasswordInput.value) {
                    this.validatePasswordConfirmation(password, confirmPasswordInput.value, confirmFeedback);
                }
            });
        }
        
        if (confirmPasswordInput) {
            confirmPasswordInput.addEventListener('input', () => {
                const password = newPasswordInput ? newPasswordInput.value : '';
                this.validatePasswordConfirmation(password, confirmPasswordInput.value, confirmFeedback);
            });
        }
    }

    validatePassword(password, feedbackElement) {
        if (password.length < 8) {
            feedbackElement.textContent = 'A senha deve ter pelo menos 8 caracteres';
            feedbackElement.style.color = 'red';
            return false;
        } else if (!/\d/.test(password) || !/[a-zA-Z]/.test(password)) {
            feedbackElement.textContent = 'A senha deve conter letras e números';
            feedbackElement.style.color = 'red';
            return false;
        } else {
            feedbackElement.textContent = 'Senha válida';
            feedbackElement.style.color = 'green';
            return true;
        }
    }

    validatePasswordConfirmation(password, confirmPassword, feedbackElement) {
        if (password !== confirmPassword) {
            feedbackElement.textContent = 'As senhas não coincidem';
            feedbackElement.style.color = 'red';
            return false;
        } else {
            feedbackElement.textContent = 'Senhas coincidem';
            feedbackElement.style.color = 'green';
            return true;
        }
    }

    // Salvar senha (comum)
    setupPasswordSave() {
        const savePasswordBtn = document.getElementById('savePasswordBtn');
        if (savePasswordBtn) {
            savePasswordBtn.addEventListener('click', () => {
                this.savePassword();
            });
        }
    }

    savePassword() {
        const currentPassword = document.getElementById('currentPassword').value;
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        
        if (!currentPassword || !newPassword || !confirmPassword) {
            this.showMessage('Todos os campos são obrigatórios', false);
            return;
        }
        
        if (newPassword !== confirmPassword) {
            this.showMessage('As senhas não coincidem', false);
            return;
        }
        
        if (!this.validatePassword(newPassword, document.getElementById('passwordFeedback'))) {
            return;
        }
        
        // Determinar o caminho correto baseado no tipo de usuário
        const isAdmin = document.querySelector('.admin-badge') !== null;
        const endpoint = isAdmin ? '../UserCadastrado/atualizar_perfil.php' : 'atualizar_perfil.php';
        
        const formData = new FormData();
        formData.append('action', 'update_password');
        formData.append('senha_atual', currentPassword);
        formData.append('nova_senha', newPassword);
        formData.append('confirmar_senha', confirmPassword);
        
        fetch(endpoint, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Limpar campos
                document.getElementById('currentPassword').value = '';
                document.getElementById('newPassword').value = '';
                document.getElementById('confirmPassword').value = '';
                
                bootstrap.Modal.getInstance(document.getElementById('editPasswordModal')).hide();
                this.showMessage(data.message, true);
            } else {
                this.showMessage(data.message, false);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            this.showMessage('Erro ao atualizar senha', false);
        });
    }

    // Setup de event listeners comuns
    setupEventListeners() {
        this.setupPhotoUpload();
        this.setupPasswordValidation();
        this.setupPasswordSave();
    }

    // Setup de handlers para modais
    setupModalHandlers() {
        this.setupPhotoModalHandler();
        this.setupPasswordModalHandler();
    }

    setupPhotoModalHandler() {
        const editPhotoModal = document.getElementById('editPhotoModal');
        if (editPhotoModal) {
            editPhotoModal.addEventListener('hidden.bs.modal', () => {
                document.getElementById('photoUploadForm').reset();
                document.getElementById('photoFeedback').textContent = '';
                const savePhotoBtn = document.getElementById('savePhotoBtn');
                if (savePhotoBtn) savePhotoBtn.disabled = false;
                
                // Restaurar preview original
                const currentProfilePhoto = document.getElementById('currentProfilePhoto').src;
                document.getElementById('currentPhotoPreview').src = currentProfilePhoto;
            });
        }
    }

    setupPasswordModalHandler() {
        const editPasswordModal = document.getElementById('editPasswordModal');
        if (editPasswordModal) {
            editPasswordModal.addEventListener('hidden.bs.modal', () => {
                // Limpar campos de senha
                document.getElementById('currentPassword').value = '';
                document.getElementById('newPassword').value = '';
                document.getElementById('confirmPassword').value = '';
                
                const passwordFeedback = document.getElementById('passwordFeedback');
                const confirmFeedback = document.getElementById('confirmFeedback');
                if (passwordFeedback) passwordFeedback.textContent = '';
                if (confirmFeedback) confirmFeedback.textContent = '';
            });
        }
    }
}

// Inicializar quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', function() {
    window.profileManager = new ProfileManager();
});