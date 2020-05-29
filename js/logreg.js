//

$(".login-btn-btn").click(function (e) {
  e.preventDefault();

  let login = $('input[name="login"]').val(),
    password = $('input[name="password"]').val();

  $.ajax({
    url: "php/signin.php",
    type: "POST",
    dataType: "json",
    data: {
      login: login,
      password: password,
    },
    success(data) {
      if (data.status) {
        document.location.href = "profile.php";
      } else {
        if (data.type === 1) {
          data.fields.forEach(function (field) {
            $(`input[name="${field}"]`).addClass("error");
          });
        }

        $(".msg").removeClass("none").text(data.message);
      }
    },
  });
});

/*
    Получение аватарки с поля
 */

let avatar = false;

$('input[name="avatar"]').change(function (e) {
  avatar = e.target.files[0];
});

/*
    Регистрация
 */

$(".register-btn-btn").click(function (e) {
  e.preventDefault();

  let login = $('input[name="login1"]').val(),
    email = $('input[name="email"]').val(),
    password = $('input[name="password1"]').val(),
    password_2 = $('input[name="password_2"]').val();

  let formData = new FormData();
  formData.append("login", login);
  formData.append("email", email);
  formData.append("password", password);
  formData.append("password_2", password_2);
  formData.append("avatar", avatar);

  $.ajax({
    url: "php/signup.php",
    type: "POST",
    dataType: "json",
    processData: false,
    contentType: false,
    cache: false,
    data: formData,
    success(data) {
      if (data.status) {
        $(".msg1").removeClass("none").text(data.message1);
        $("form[name=register-form-clear]").trigger("reset");
        $("label[name=register-form-clear]").trigger("reset");
      } else {
        if (data.type === 1) {
          data.fields.forEach(function (field) {
            $(`input[name="${field}"]`).addClass("error");
          });
        }

        $(".msg1").removeClass("none").text(data.message1);
      }
    },
  });
});
