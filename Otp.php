<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Forgot Password</title>
  <link rel="icon" type="image/ico" href="img/buslogo.png">
  <link rel="stylesheet" href="css/otp.css">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    

</head>

<body>
  <div class="container">

    <h1>Otp Verification </h1><br>

    <form action="#" method="POST">

      <div class="input-field">
        <input type="number" />
        <input type="number" disabled />
        <input type="number" disabled />
        <input type="number" disabled />
      </div>

      <div class="action">
        <br>
        <button>Verify OTP</button>
      </div>
    </form>
  </div>
  <!-- wave  -->
  <div>
    <div class="wave"></div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const inputs = document.querySelectorAll("input");
      const button = document.querySelector("button");

      inputs.forEach((input, index1) => {
        input.addEventListener("keyup", (e) => {
          const currentInput = input;
          const nextInput = input.nextElementSibling;
          const prevInput = input.previousElementSibling;

          if (currentInput.value.length > 1) {
            currentInput.value = "";
            return;
          }

          if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
            nextInput.removeAttribute("disabled");
            nextInput.focus();
          }

          if (e.key === "Backspace") {
            inputs.forEach((input, index2) => {
              if (index1 <= index2 && prevInput) {
                input.setAttribute("disabled", true);
                currentInput.value = "";
                prevInput.focus();
              }
            });
          }

          if (!inputs[3].disabled && inputs[3].value !== "") {
            button.classList.add("active");
            return;
          }

          button.classList.remove("active");
        });
      });

      inputs[0].focus();
    });
  </script>
</body>

</html>