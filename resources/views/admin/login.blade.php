<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow"/>
    <title>Login</title>
    <link rel="stylesheet" href="{{ url('admin/css/login.css') }}">
    <style>
      .login-container {
        margin-top: 60px;
      }
      .text-danger {
        color: red;
        font-size: 14px;
    }

    .alert-danger {
        text-align: center;
        background: red;
        padding: 8px 4px;
        color: #fff;
        font-size: 14px;
        margin-bottom: 10px;
        border-radius: 4px;
    }
    </style>
</head>

<body onmousemove="getCursorPosition(event)">
  <div class="wrapper">
    <main>
      <section>
        <div class="login-container">
          <div class="social-login">
            <div class="logo">
              <img src="https://assets.codepen.io/9277864/robot-face-3.svg" alt="Gravam Company Logo" width="100" height="100" />
              <p>ECOM</p>
            </div>
            {{-- <p>Login using social media to get quick access</p>
            <div class="social-grp">
              <div class="btn"><a href="#"><img src="https://assets.codepen.io/9277864/social-media-twitter.svg" alt="" width="32" height="32" /><span>Twitter</span></a></div>
              <div class="btn"><a href="#"><img src="https://assets.codepen.io/9277864/social-media-facebook.svg" alt="" width="32" height="32" /><span>Facebook</span></a></div>
              <div class="btn"><a href="#"><img src="https://assets.codepen.io/9277864/social-media-google.svg" alt="" width="32" height="32" /><span>Google</span></a></div>
            </div> --}}
          </div>
          <div class="email-login">
            <div class="login-h-container">
              @if(session()->has('error'))
                  <div class="alert alert-danger">
                      {{ session()->get('error') }}
                  </div>
                  @endif
              <h1>Login to your account</h1>
              {{-- <p>Don’t have an account? <a href="#">Sign up Free!</a></p> --}}
            </div>
            <form action="{{ url('login-action') }}" method="post">
              @csrf
              <label for="email">
                <input id="email" name="email" type="email" placeholder="" value="{{ old('email') }}" class="@error('email') is-invalid @enderror" autocomplete="off">
                <span id="span-email">Email</span>
              </label>
              @error('email')
              <span class="text-danger d-block">{{ $message }}</span>
              @enderror 
              <label for="password">
                <input id="password" name="password" type="password" class="@error('password') is-invalid @enderror" placeholder="">
                <span id="span-password">Password</span>
              </label>
              @error('password')
              <span class="text-danger d-block">{{ $message }}</span>
              @enderror
              <div class="recovery">
                <div>
                  <input type="checkbox" id="remember" name="remember">
                  <label for="remember">Remember me</label>
                </div>
                <a href="">Forgot Password?</a>
              </div>
              <input type="submit" value="Login with Email">
            </form>
          </div>
        </div>
      </section>
    </main>
  </div>
  <script>
    function getCursorPosition(event) {
  const x = (event.clientX * 100) / window.innerWidth + "%";
  const y = (event.clientY * 100) / window.innerHeight + "%";

  const eyes1 = document.getElementById("eyes1");
  const eyes2 = document.getElementById("eyes2");

  eyes1.style.left = x;
  eyes1.style.top = y;
  eyes1.style.transform = `translate(-${x}, -${y})`;

  eyes2.style.left = x;
  eyes2.style.top = y;
  eyes2.style.transform = `translate(-${x}, -${y})`;
}

const email = document.getElementById("email");
const emailSpan = document.getElementById("span-email");
const password = document.getElementById("password");
const passwordSpan = document.getElementById("span-password");

email.addEventListener("input", () => {
  if (email.value) {
    emailSpan.classList.add("focus-span");
  } else {
    emailSpan.classList.remove("focus-span");
  }
});

password.addEventListener("input", () => {
  if (password.value) {
    passwordSpan.classList.add("focus-span");
  } else {
    passwordSpan.classList.remove("focus-span");
  }
});

  </script>
</body>
</html>