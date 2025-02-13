<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{asset("frontend/css/style.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("admin/css/custom.css")}}">
</head>
<body>
    <main class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        {{-- <div class="mb-4 pb-4"></div> --}}
        <section class="login-register container border pb-5 pt-2">
          <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link nav-link_underscore active" id="login-tab" data-bs-toggle="tab" href="#tab-item-login"
                role="tab" aria-controls="tab-item-login" aria-selected="true">Login</a>
            </li>
          </ul>
          <div class="tab-content pt-2" id="login_register_tab_content">
            <div class="tab-pane fade show active" id="tab-item-login" role="tabpanel" aria-labelledby="login-tab">
              <div class="login-form">
                <form method="POST" action="{{route('admin.login')}}" name="login-form" class="needs-validation" novalidate="" enctype="multipart/form-data">
                  @csrf
                  <div class="form-floating mb-3">
                    <input class="form-control form-control_gray " name="email" value="" required="" autocomplete="email"
                      autofocus="">
                    <label for="email">Email address *</label>
                    @error('email')
                        <p class="error-message">{{ $message }}</p>  
                    @enderror
                  </div>
    
                  <div class="pb-3"></div>
    
                  <div class="form-floating mb-3">
                    <input id="password" type="password" class="form-control form-control_gray " name="password" required=""
                      autocomplete="current-password">
                    <label for="customerPasswodInput">Password *</label>
                    @error('password')
                        <p class="error-message">{{ $message }}</p>  
                    @enderror
                  </div>
                  <button class="btn btn-primary w-100 text-uppercase" type="submit">Log In</button>
                </form>
              </div>
            </div>
          </div>
        </section>
    </main>
</body>
</html>