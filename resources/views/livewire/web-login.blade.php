<div class="d-flex justify-content-center align-items-center min-vh-100" style="background-color: #f8f9fa;">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden" style="max-width: 850px; width: 95%;">
        <div class="row g-0 m-2">
            
            <!-- Bagian kiri: Gambar -->
            <div class="col-md-5 d-none d-md-block p-4">
                <img src="{{ asset('images/login-bg.jpg') }}" 
                     alt="Login Illustration" 
                     class="img-fluid h-100 w-100" 
                     style="object-fit: contain; background-color: #ffffff;">
            </div>

            <!-- Bagian kanan: Form login -->
            <div class="col-md-7 d-flex align-items-center p-4">
                <div class="w-100">
                    <h3 class="text-center fw-bold text-primary mb-4">
                        
                        Masuk Ke Aplikasi {{ config('app.name') }}
                    </h3>

                    <form wire:submit.prevent="login_act">

                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">Username</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3">
                                    <i class="bi bi-person text-primary"></i>
                                </span>
                                <input type="text" 
                                       wire:model="username" 
                                       id="username" 
                                       class="form-control border-start-0 rounded-end-3" 
                                       placeholder="Masukkan username">
                            </div>
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3">
                                    <i class="bi bi-lock text-primary"></i>
                                </span>
                                <input type="password" 
                                       wire:model="password" 
                                       id="password" 
                                       class="form-control border-start-0 border-end-0" 
                                       placeholder="Masukkan password">
                                <span class="input-group-text bg-light border-start-0 rounded-end-3" style="cursor: pointer;" onclick="togglePassword()">
                                    <i id="toggleIcon" class="bi bi-eye"></i>
                                </span>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Tombol -->
                        <div class="row mt-4">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold shadow-sm">
                                    <i class="bi bi-door-open me-1"></i> Masuk
                                </button>
                            </div>
                            <div class="col-6">
                                <a href="/register" class="btn btn-outline-primary w-100 py-2 fw-semibold">
                                    <i class="bi bi-person-plus me-1"></i> Daftar
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Pesan Error -->
                    @if (session('error'))
                        <div id="error_msg" class="alert alert-danger text-center mt-4 rounded-3 shadow-sm">
                            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                        </div>
                        <script>
                            setTimeout(() => {
                                const errorMsg = document.getElementById('error_msg');
                                if (errorMsg) errorMsg.style.display = 'none';
                            }, 5000);
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script show/hide password -->
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
    }
}
</script>
