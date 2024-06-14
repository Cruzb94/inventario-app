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

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                            <h4 class="mt-1 mb-5 pb-1">Iniciar sesion:</h4>
                          </div>
          
                          <form action="{{route('login')}}" class="needs-validation" novalidate method="post">
                            @csrf
                            <p>Ingresa tu Correo y Contraseña</p>

                            <div class="form-outline mb-4">
                              <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" id="form2Example11" class="form-control" placeholder="Correo electrónico" required />
                                <div class="invalid-feedback">
                                  Por favor ingrese un correo valido
                                </div>
                              </div>
                              <label class="form-label" for="form2Example11">Usuario</label>


                            </div>
                            
                            <div class="form-outline mb-4">
                              <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" id="form2Example22" class="form-control" placeholder="Contraseña" required />
                                <div class="invalid-feedback">
                                  Por favor ingrese la contraseña
                                </div>
                              </div>
                              <label class="form-label"  for="form2Example22">Contraseña</label>
                            </div>
                            
                            <div class="text-center pt-1 mb-5 pb-1">
                              <button class="btn btn-bg-purple  mb-3" type="submit">Ingresar
                            </button>
                            <!-- <a href="/register" class="btn btn-dark mb-3">Registrar</a> -->
                              <a class="text-muted ms-2 " href="{{ route('password.request') }}">Olvide mi Contraseña?</a>
                            </div>
          

          
                          </form>
          
                        </div>
                      </div>
                      <div class="col-lg-6 d-flex align-items-center gradien ">
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


        <script>
      (function () {
  'use strict'

  var forms = document.querySelectorAll('.needs-validation')

  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        } else {
          // Aquí puedes agregar una lógica adicional si es necesario
        }

        form.classList.add('was-validated')
      }, false)
    })

  // Mostrar el mensaje de error si existe
  var error = "{{ session('error') }}";
  if (error) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: error,
    });
  }
})()

        </script>
        
        
    </body>
</html>
