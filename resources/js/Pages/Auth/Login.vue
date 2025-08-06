<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import GuestLayout from '@/Layouts/GuestLayout.vue'

// Gunakan layout tanpa sidebar
defineOptions({ layout: GuestLayout })

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

function submit() {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  })
}
</script>

<template>
  <Head title="Login" />
  <div class="login-container">
    <!-- Animated background elements -->
    <div class="bg-decoration decoration-1"></div>
    <div class="bg-decoration decoration-2"></div>
    <div class="bg-decoration decoration-3"></div>
    <div class="bg-decoration decoration-4"></div>
    
    <div class="login-card">
      <div class="card-header">
        <div class="logo-section">
          <div class="logo-icon">
            <span class="train-emoji">🚂</span>
            <div class="logo-glow"></div>
          </div>
          <div class="decorative-line"></div>
        </div>
        <h2 class="login-title">Login</h2>
      </div>

      <div class="card-body">
        <form @submit.prevent="submit" class="login-form">
          <!-- Email -->
          <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <div class="input-wrapper">
              <input
                id="email"
                type="email"
                v-model="form.email"
                class="form-control"
                required
                autofocus
                placeholder="Masukkan email Anda"
              />
              <span class="input-icon">📧</span>
              <div class="input-focus-effect"></div>
            </div>
            <div v-if="form.errors.email" class="invalid-feedback">
              {{ form.errors.email }}
            </div>
          </div>

          <!-- Password -->
          <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <div class="input-wrapper">
              <input
                id="password"
                type="password"
                v-model="form.password"
                class="form-control"
                required
                placeholder="Masukkan password Anda"
              />
              <span class="input-icon">🔒</span>
              <div class="input-focus-effect"></div>
            </div>
            <div v-if="form.errors.password" class="invalid-feedback">
              {{ form.errors.password }}
            </div>
          </div>

          <!-- Remember me -->
          <div class="form-check">
            <div class="checkbox-wrapper">
              <input
                id="remember"
                type="checkbox"
                v-model="form.remember"
                class="form-check-input"
              />
              <div class="checkbox-custom">
                <svg class="checkbox-checkmark" viewBox="0 0 24 24">
                  <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                </svg>
              </div>
            </div>
            <label for="remember" class="form-check-label">
              Remember Me
            </label>
          </div>

          <!-- Submit -->
          <div class="submit-section">
            <button
              type="submit"
              class="btn-login"
              :class="{ processing: form.processing }"
              :disabled="form.processing"
            >
              <span class="btn-content">
                <div v-if="form.processing" class="loading-spinner"></div>
                <span class="btn-text">{{ form.processing ? 'Loading...' : 'Login' }}</span>
                <div v-if="!form.processing" class="btn-shine"></div>
              </span>
            </button>
          </div>

          <div class="text-center">
            <a href="#" class="btn-forgot">
              <span>Forgot Your Password?</span>
              <div class="forgot-underline"></div>
            </a>
          </div>
        </form>
      </div>
    </div>

    <!-- Additional footer info -->
  </div>
</template>

<style scoped>
:root {
  --kai-orange: #FF6B35;
  --kai-blue: #1E3A8A;
  --kai-light-blue: #3B82F6;
  --kai-dark-blue: #1E40AF;
  --kai-white: #FFFFFF;
  --kai-gray-light: #F8FAFC;
  --kai-gray-medium: #E2E8F0;
  --kai-gray-dark: #64748B;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.login-container {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 20px;
  background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 30%, #4F46E5 70%, #FF6B35 100%);
  background-attachment: fixed;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  position: relative;
  overflow: hidden;
}

/* Fallback untuk browser yang tidak support gradient */
.login-container::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: #1E3A8A;
  background: -webkit-linear-gradient(135deg, #1E3A8A 0%, #3B82F6 30%, #4F46E5 70%, #FF6B35 100%);
  background: -moz-linear-gradient(135deg, #1E3A8A 0%, #3B82F6 30%, #4F46E5 70%, #FF6B35 100%);
  background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 30%, #4F46E5 70%, #FF6B35 100%);
  z-index: -1;
}

/* Animated Background Decorations */
.bg-decoration {
  position: absolute;
  border-radius: 50%;
  opacity: 0.2;
  animation: float 20s ease-in-out infinite;
  z-index: 1;
}

.decoration-1 {
  width: 300px;
  height: 300px;
  background: radial-gradient(circle, #FF6B35, rgba(255, 107, 53, 0.3));
  top: -150px;
  right: -150px;
  animation-delay: 0s;
}

.decoration-2 {
  width: 200px;
  height: 200px;
  background: radial-gradient(circle, #3B82F6, rgba(59, 130, 246, 0.3));
  bottom: -100px;
  left: -100px;
  animation-delay: -5s;
}

.decoration-3 {
  width: 150px;
  height: 150px;
  background: radial-gradient(circle, #FFFFFF, rgba(255, 255, 255, 0.3));
  top: 20%;
  left: 10%;
  animation-delay: -10s;
}

.decoration-4 {
  width: 100px;
  height: 100px;
  background: radial-gradient(circle, #FF6B35, rgba(255, 107, 53, 0.3));
  bottom: 30%;
  right: 15%;
  animation-delay: -15s;
}

@keyframes float {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  25% { transform: translateY(-20px) rotate(90deg); }
  50% { transform: translateY(-10px) rotate(180deg); }
  75% { transform: translateY(-30px) rotate(270deg); }
}

.login-card {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(20px);
  border-radius: 24px;
  box-shadow: 
    0 32px 64px rgba(0, 0, 0, 0.2),
    0 0 0 1px rgba(255, 255, 255, 0.1);
  overflow: hidden;
  max-width: 480px;
  width: 100%;
  position: relative;
  transform: translateY(0);
  transition: transform 0.3s ease;
  z-index: 10;
}

.login-card:hover {
  transform: translateY(-5px);
}

.login-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 6px;
  background: linear-gradient(90deg, 
    var(--kai-orange) 0%, 
    var(--kai-light-blue) 25%,
    var(--kai-blue) 50%,
    var(--kai-light-blue) 75%,
    var(--kai-orange) 100%);
  animation: gradientShift 3s ease-in-out infinite;
}

@keyframes gradientShift {
  0%, 100% { transform: translateX(-100%); }
  50% { transform: translateX(100%); }
}

.card-header {
  background: linear-gradient(135deg, 
    var(--kai-blue) 0%, 
    var(--kai-dark-blue) 50%,
    var(--kai-blue) 100%);
  color: var(--kai-white);
  text-align: center;
  padding: 40px 30px;
  position: relative;
  overflow: hidden;
}

.card-header::before {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
  animation: headerShine 4s ease-in-out infinite;
}

@keyframes headerShine {
  0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
  50% { transform: translateX(100%) translateY(100%) rotate(45deg); }
  100% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
}

.card-header::after {
  content: '';
  position: absolute;
  bottom: -15px;
  left: 50%;
  transform: translateX(-50%);
  width: 0;
  height: 0;
  border-left: 20px solid transparent;
  border-right: 20px solid transparent;
  border-top: 15px solid var(--kai-dark-blue);
  filter: drop-shadow(0 5px 10px rgba(0,0,0,0.2));
}

.logo-section {
  margin-bottom: 25px;
  position: relative;
}

.logo-icon {
  width: 80px;
  height: 80px;
  background: linear-gradient(135deg, var(--kai-orange) 0%, var(--kai-blue) 100%);
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 15px;
  position: relative;
  overflow: hidden;
  animation: logoFloat 3s ease-in-out infinite;
}

@keyframes logoFloat {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-8px); }
}

.train-emoji {
  font-size: 2rem;
  z-index: 2;
  position: relative;
}

.logo-glow {
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(255,255,255,0.3), transparent 60%);
  animation: logoGlow 2s ease-in-out infinite alternate;
}

@keyframes logoGlow {
  0% { opacity: 0.3; }
  100% { opacity: 0.7; }
}

.company-name {
  font-size: 0.9rem;
  font-weight: 600;
  letter-spacing: 2px;
  opacity: 0.9;
  margin-bottom: 10px;
}

.decorative-line {
  width: 60px;
  height: 4px;
  background: linear-gradient(90deg, var(--kai-orange) 0%, var(--kai-white) 50%, var(--kai-blue) 100%);
  margin: 0 auto;
  border-radius: 2px;
  position: relative;
  overflow: hidden;
}

.decorative-line::after {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.8), transparent);
  animation: lineShine 2s ease-in-out infinite;
}

@keyframes lineShine {
  0% { left: -100%; }
  100% { left: 100%; }
}

.login-title {
  margin: 0;
  font-size: 1.8rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 2px;
  text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

.card-body {
  padding: 50px 40px 40px;
  position: relative;
}

.form-group {
  margin-bottom: 30px;
  position: relative;
}

.form-label {
  color: var(--kai-blue);
  font-weight: 600;
  margin-bottom: 10px;
  display: block;
  font-size: 1rem;
  transition: color 0.3s ease;
}

.input-wrapper {
  position: relative;
}

.form-control {
  border: 2px solid var(--kai-gray-medium);
  border-radius: 16px;
  padding: 18px 60px 18px 24px;
  font-size: 1rem;
  transition: all 0.4s ease;
  background: var(--kai-gray-light);
  width: 100%;
  position: relative;
  z-index: 1;
}

.form-control:focus {
  border-color: var(--kai-orange);
  background: var(--kai-white);
  outline: none;
  transform: translateY(-2px);
  box-shadow: 
    0 10px 25px rgba(255, 107, 53, 0.2),
    0 0 0 4px rgba(255, 107, 53, 0.1);
}

.input-focus-effect {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border-radius: 16px;
  background: linear-gradient(135deg, var(--kai-orange), var(--kai-light-blue));
  opacity: 0;
  z-index: 0;
  transition: opacity 0.3s ease;
}

.form-control:focus + .input-icon + .input-focus-effect {
  opacity: 0.1;
}

.input-icon {
  position: absolute;
  right: 20px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 1.2rem;
  z-index: 2;
  transition: all 0.3s ease;
  pointer-events: none;
}

.form-control:focus + .input-icon {
  transform: translateY(-50%) scale(1.1);
  filter: drop-shadow(0 0 8px rgba(255, 107, 53, 0.5));
}

.invalid-feedback {
  color: #dc3545;
  font-size: 0.875rem;
  margin-top: 8px;
  display: block;
  animation: fadeInUp 0.3s ease;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.form-check {
  display: flex;
  align-items: center;
  margin: 25px 0;
  position: relative;
}

.checkbox-wrapper {
  position: relative;
  margin-right: 12px;
}

.form-check-input {
  opacity: 0;
  position: absolute;
  cursor: pointer;
  width: 22px;
  height: 22px;
}

.checkbox-custom {
  width: 22px;
  height: 22px;
  border: 2px solid var(--kai-gray-medium);
  border-radius: 6px;
  background: var(--kai-gray-light);
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}

.form-check-input:checked + .checkbox-custom {
  background: linear-gradient(135deg, var(--kai-orange), #FF8A65);
  border-color: var(--kai-orange);
  transform: scale(1.05);
}

.checkbox-checkmark {
  width: 14px;
  height: 14px;
  fill: white;
  opacity: 0;
  transform: scale(0);
  transition: all 0.2s ease;
}

.form-check-input:checked + .checkbox-custom .checkbox-checkmark {
  opacity: 1;
  transform: scale(1);
}

.form-check-label {
  color: var(--kai-blue);
  font-weight: 500;
  cursor: pointer;
  transition: color 0.3s ease;
}

.form-check-label:hover {
  color: var(--kai-orange);
}

.submit-section {
  margin: 35px 0 20px;
}

.btn-login {
  background: linear-gradient(135deg, var(--kai-orange) 0%, #FF8A65 100%);
  border: none;
  border-radius: 16px;
  padding: 18px 35px;
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--kai-white);
  width: 100%;
  cursor: pointer;
  text-transform: uppercase;
  letter-spacing: 1px;
  position: relative;
  overflow: hidden;
  transition: all 0.4s ease;
  box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
}

.btn-login:hover:not(:disabled) {
  transform: translateY(-3px);
  box-shadow: 0 15px 35px rgba(255, 107, 53, 0.4);
  background: linear-gradient(135deg, #FF8A65 0%, var(--kai-orange) 100%);
}

.btn-login:active:not(:disabled) {
  transform: translateY(-1px);
}

.btn-login:disabled {
  opacity: 0.7;
  cursor: not-allowed;
  transform: none !important;
}

.btn-content {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  position: relative;
  z-index: 2;
}

.btn-shine {
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
  transition: left 0.5s ease;
}

.btn-login:hover .btn-shine {
  left: 100%;
}

.loading-spinner {
  width: 20px;
  height: 20px;
  border: 2px solid rgba(255,255,255,0.3);
  border-top: 2px solid white;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.text-center {
  text-align: center;
  margin-top: 25px;
}

.btn-forgot {
  color: var(--kai-blue);
  text-decoration: none;
  font-weight: 500;
  font-size: 1rem;
  display: inline-block;
  padding: 12px 0;
  position: relative;
  transition: all 0.3s ease;
}

.forgot-underline {
  position: absolute;
  bottom: 8px;
  left: 50%;
  transform: translateX(-50%);
  width: 0;
  height: 2px;
  background: linear-gradient(90deg, var(--kai-orange), var(--kai-light-blue));
  transition: width 0.3s ease;
}

.btn-forgot:hover {
  color: var(--kai-orange);
  transform: translateY(-2px);
}

.btn-forgot:hover .forgot-underline {
  width: 100%;
}

/* Footer Information */
.footer-info {
  margin-top: 30px;
  text-align: center;
  color: rgba(255, 255, 255, 0.8);
  font-size: 0.875rem;
}

.footer-info p {
  margin-bottom: 15px;
  text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}

.social-links {
  display: flex;
  justify-content: center;
  gap: 15px;
}

.social-link {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50%;
  text-decoration: none;
  font-size: 1.2rem;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.social-link:hover {
  background: rgba(255, 255, 255, 0.2);
  transform: translateY(-2px) scale(1.05);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* Focus visible for accessibility */
.btn-login:focus-visible,
.form-control:focus-visible,
.form-check-input:focus-visible,
.btn-forgot:focus-visible,
.social-link:focus-visible {
  outline: 2px solid var(--kai-orange);
  outline-offset: 2px;
}

/* Responsive Design */
@media (max-width: 576px) {
  .login-container {
    padding: 15px;
  }

  .login-card {
    border-radius: 20px;
  }
  
  .card-body {
    padding: 40px 25px 30px;
  }
  
  .card-header {
    padding: 35px 20px;
  }

  .form-control {
    padding: 16px 55px 16px 20px;
  }

  .btn-login {
    padding: 16px 30px;
    font-size: 1rem;
  }

  .logo-icon {
    width: 70px;
    height: 70px;
  }

  .train-emoji {
    font-size: 1.8rem;
  }

  .login-title {
    font-size: 1.5rem;
  }

  .footer-info {
    margin-top: 20px;
    font-size: 0.8rem;
  }

  .social-link {
    width: 35px;
    height: 35px;
    font-size: 1rem;
  }
}

/* Additional animations for enhanced UX */
@keyframes cardEntrance {
  from {
    opacity: 0;
    transform: translateY(50px) scale(0.9);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

.login-card {
  animation: cardEntrance 0.6s ease-out;
}

/* Pulse effect for loading state */
@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}

.btn-login.processing {
  animation: pulse 1.5s ease-in-out infinite;
}

/* Enhanced hover effects */
.form-control:hover:not(:focus) {
  border-color: var(--kai-light-blue);
  background: rgba(255, 255, 255, 0.8);
}

.login-card:hover .logo-icon {
  transform: scale(1.05);
}

/* Smooth transitions for all interactive elements */
* {
  transition: all 0.3s ease;
}

input, button, a {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

</style>