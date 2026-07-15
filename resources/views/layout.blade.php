<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Catálogo de Productos')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
      :root {
        --bs-font-sans-serif: 'Outfit', sans-serif;
        --primary-soft: #eef2ff;
      }
      body {
        font-family: var(--bs-font-sans-serif);
        background-color: #f8fafc;
        color: #334155;
      }
      /* Hover effects para botones */
      .btn {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
      }
      .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      }
      /* Glassmorphism sutil para cards */
      .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
      }
      /* Animación Scale-Up para Modales */
      .modal.fade .modal-dialog {
        transition: transform 0.3s ease-out;
        transform: scale(0.95);
      }
      .modal.show .modal-dialog {
        transform: scale(1);
      }
      /* Skeleton loader (shimmer effect) */
      .skeleton {
        background: #e2e8f0;
        background: linear-gradient(90deg, #e2e8f0 25%, #cbd5e1 50%, #e2e8f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
        border-radius: 4px;
        min-height: 20px;
        width: 100%;
      }
      @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container">
        <a class="navbar-brand" href="{{ route('products.index') }}">Catálogo de Productos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('products.index') }}">Productos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('products.create') }}">Nuevo producto</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <main class="py-4">
      <div class="container">
        <!-- Toasts are dynamically rendered in the toast-container at the bottom -->

        @yield('content')
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Global delete modal -->
    <div class="modal fade" id="globalDeleteModal" tabindex="-1" aria-labelledby="globalDeleteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="globalDeleteModalLabel">Confirmar eliminación</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <p id="globalDeleteMessage"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <form method="POST" id="globalDeleteForm" class="m-0">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener('click', function (e) {
        const btn = e.target.closest('.delete-product-button');
        if (!btn) return;

        const action = btn.dataset.action;
        const name = btn.dataset.name;
        const msg = document.getElementById('globalDeleteMessage');
        const form = document.getElementById('globalDeleteForm');

        if (msg) msg.textContent = `¿Deseas eliminar el producto "${name}"?`;
        if (form) form.action = action;
      });

      // Inicializar Toasts
      document.addEventListener('DOMContentLoaded', function () {
        const toastElList = [].slice.call(document.querySelectorAll('.toast'))
        const toastList = toastElList.map(function (toastEl) {
          return new bootstrap.Toast(toastEl, { autohide: true, delay: 5000 })
        });
        toastList.forEach(toast => toast.show());
      });

      // Validación Inline en Formularios
      document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
          
          // Validación en tiempo real (blur e input)
          const inputs = form.querySelectorAll('.form-control');
          inputs.forEach(input => {
            input.addEventListener('blur', () => {
              if (input.value) { // Remove backend feedback only if field was interacted with
                input.classList.remove('is-invalid'); 
              }
              if (!input.checkValidity()) {
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
              } else if(input.value) {
                input.classList.add('is-valid');
                input.classList.remove('is-invalid');
              }
            });
            input.addEventListener('input', () => {
              if (input.classList.contains('is-invalid') || input.classList.contains('is-valid')) {
                if (!input.checkValidity()) {
                  input.classList.add('is-invalid');
                  input.classList.remove('is-valid');
                } else {
                  input.classList.add('is-valid');
                  input.classList.remove('is-invalid');
                }
              }
            });
          });
        });
      });
    </script>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100">
      @if (session('success'))
        <div class="toast align-items-center text-bg-success border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
            <div class="toast-body fw-medium">
              <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      @endif

      @if ($errors->any())
        <div class="toast align-items-center text-bg-danger border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
            <div class="toast-body fw-medium">
              <i class="bi bi-exclamation-triangle-fill me-2"></i> Revisa los datos ingresados.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      @endif
    </div>
    @yield('scripts')
  </body>
</html>
