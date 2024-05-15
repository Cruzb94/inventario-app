<!doctype html>
<html lang="es">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="{{asset('estilos/estilos.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css



        ">
    </head>

    <body>
        <section class="h-100 gradient-form" style="background-color: #eee;">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                  <div class="card rounded-3 text-black">
                    <div class="row g-0">
                      <div class="col-lg-6">
                        <div class="card-body p-md-5 mx-md-4">
          
                          <div class="text-center">
                            <img src="{{asset('vendor/adminlte/dist/img/lwb.png')}}"
                              style="width: 185px;" alt="logo">
                            <h4 class="mt-1 mb-5 pb-1">Crear cuenta:</h4>
                          </div>
          
                          <form action="{{route('register')}}" class="needs-validation" novalidate method="post">
                            @csrf
                            <p>Ingresa los datos</p>
                        
                            <div class="form-outline mb-4">
                                <label class="form-label" for="name">Nombre y Apellido</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Nombre y Apellido" pattern="[A-Za-z\s]+" required/>
                                    <div class="valid-feedback">
                                        ¡Se ve bien!
                                    </div>
                                    <div class="invalid-feedback">
                                        Por favor, ingresa solo letras y espacios y el campo no puede estar vacío.
                                    </div>
                                </div>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="email">Email</label>
                                <div class="input-group">
                                  <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                              <input type="email" name="email" id="email" class="form-control" placeholder="Correo electrónico" required/>
                              <div class="valid-feedback">
                                ¡Se ve bien!
                              </div>
                              <div class="invalid-feedback">
                                Por favor, ingresa un correo electrónico válido.
                              </div>
                                     
                            </div>
                            </div>
          
                            <div class="form-outline mb-4">
                                <label class="form-label"  for="form2Example22">Contraseña</label>
                                <div class="input-group">
                                  <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                              <input type="password" name="password" id="form2Example22" class="form-control" placeholder="Contraseña" required />
                              
                              <div id="passwordFeedback" class="valid-feedback" style="display: none;">
                                El campo no puede estar vacio
                            </div>
                            <div class="invalid-feedback">
                              El campo no puede estar vacio
                            </div>

                            </div> 
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label"  for="form2Example23">Confirmar Contraseña</label>
                                <div class="input-group">
                                  <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                              <input type="password" name="password_confirmation" id="form2Example23" class="form-control" placeholder="Confirmar Contraseña" required />
                              <div id="confirmPasswordFeedback" class="valid-feedback" style="display: none;">
                                El campo no puede estar vacio
                            </div>
                            <div class="invalid-feedback">
                              El campo no puede estar vacio
                            </div>
                            <div class="invalid-feedback" id="confirmPasswordErrorMessage">
                              Las contraseñas no coinciden.
                          </div>
                            

                            </div> 
                            </div>
          
                            <div class="text-center pt-1 mb-3 pb-1">
                                <button class="btn btn-bg-purple   mb-3" type="submit">Registrarse
                                </button>
                             
                            </div>
          
                            <div class="d-flex align-items-center justify-content-center pb-4">
                              <p class="mb-0 me-2">Ir al login</p>
                              <a href="{{route('login')}}" class="btn btn-outline-dark">login</a>
                            </div>
          
                          </form>
          
                        </div>
                      </div>
                      <div class="col-lg-6 d-flex align-items-center gradien">
                        <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                          <h4 class="mb-4">Lego Woman Boutique</h4>
                          <p class="small mb-0">
                            El trabajo en equipo es el cimiento sobre el cual se construyen grandes triunfos. 
                            Cuando un grupo de individuos se une con un propósito común y colabora en armonía, 
                            las posibilidades se vuelven ilimitadas. Cada miembro aporta su talento único y su perspectiva única, creando una 
                            sinergia poderosa que impulsa el éxito. En este espíritu de unidad y colaboración, reside la verdadera fuerza que impulsa los logros. Juntos, como equipo, enfrentamos desafíos con valentía, celebramos victorias con humildad y nos levantamos ante la adversidad con determinación. Porque en el trabajo en equipo, el triunfo está asegurado.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if(session('success_message'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '{{ session('success_message') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

<script>
  (function () {
      'use strict';

      var forms = document.querySelectorAll('.needs-validation');

      Array.prototype.slice.call(forms).forEach(function (form) {
          form.addEventListener('submit', function (event) {
              if (!form.checkValidity()) {
                  event.preventDefault();
                  event.stopPropagation();
              } else {
                  // Aquí puedes agregar la validación de contraseñas
                  var password = document.getElementById('form2Example22').value;
                  var confirmPassword = document.getElementById('form2Example23').value;

                  if (password !== confirmPassword) {
                      // Si las contraseñas no coinciden, mostrar mensaje de error
                      event.preventDefault(); // Evitar el envío del formulario
                      event.stopPropagation(); // Detener la propagación del evento

                      var confirmPasswordErrorMessage = document.getElementById('confirmPasswordErrorMessage');
                      confirmPasswordErrorMessage.style.display = 'block';

                      // Agregar clase de validación al formulario
                      form.classList.add('was-validated');
                  }
              }

              form.classList.add('was-validated');
          }, false);
      });

  })();
</script>


    </body>
</html>
