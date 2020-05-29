//menu

$(".hamburger_btn").click(function () {
  $(this).toggleClass("active");
  $(".menu").toggleClass("active");
});

//modal window

!(function (e) {
  "function" != typeof e.matches &&
    (e.matches =
      e.msMatchesSelector ||
      e.mozMatchesSelector ||
      e.webkitMatchesSelector ||
      function (e) {
        for (
          var t = this,
            o = (t.document || t.ownerDocument).querySelectorAll(e),
            n = 0;
          o[n] && o[n] !== t;

        )
          ++n;
        return Boolean(o[n]);
      }),
    "function" != typeof e.closest &&
      (e.closest = function (e) {
        for (var t = this; t && 1 === t.nodeType; ) {
          if (t.matches(e)) return t;
          t = t.parentNode;
        }
        return null;
      });
})(window.Element.prototype);

document.addEventListener("DOMContentLoaded", function () {
  /* Записываем в переменные массив элементов-кнопок и подложку.
       Подложке зададим id, чтобы не влиять на другие элементы с классом overlay*/
  var modalButtons = document.querySelectorAll(".js-open-modal"),
    overlay = document.querySelector(".js-overlay-modal"),
    closeButtons = document.querySelectorAll(".js-modal-close");

  /* Перебираем массив кнопок */
  modalButtons.forEach(function (item) {
    /* Назначаем каждой кнопке обработчик клика */
    item.addEventListener("click", function (e) {
      /* Предотвращаем стандартное действие элемента. Так как кнопку разные
               люди могут сделать по-разному. Кто-то сделает ссылку, кто-то кнопку.
               Нужно подстраховаться. */
      e.preventDefault();

      /* При каждом клике на кнопку мы будем забирать содержимое атрибута data-modal
               и будем искать модальное окно с таким же атрибутом. */
      var modalId = this.getAttribute("data-modal"),
        modalElem = document.querySelector(
          '.modal[data-modal="' + modalId + '"]'
        );

      /* После того как нашли нужное модальное окно, добавим классы
               подложке и окну чтобы показать их. */
      modalElem.classList.add("active");
      overlay.classList.add("active");
    }); // end click
  }); // end foreach

  closeButtons.forEach(function (item) {
    item.addEventListener("click", function (e) {
      var parentModal = this.closest(".modal");

      parentModal.classList.remove("active");
      overlay.classList.remove("active");
    });
  }); // end foreach

  document.body.addEventListener(
    "keyup",
    function (e) {
      var key = e.keyCode;

      if (key == 27) {
        document.querySelector(".modal.active").classList.remove("active");
        document.querySelector(".overlay").classList.remove("active");
      }
    },
    false
  );

  overlay.addEventListener("click", function () {
    document.querySelector(".modal.active").classList.remove("active");
    this.classList.remove("active");
  });
}); // end ready

// Маски

$(document).ready(function () {
  $("#telephone").mask("9 (999) 999-99-99");
});

$(document).ready(function () {
  $("#data_time").mask("99/99   99h:99m");
});

$(document).ready(function () {
  $("#mesta").mask("99");
});

$(document).ready(function () {
  $("#FIO").mask("");
});

//log-reg

var x = document.getElementById("login-form");
var y = document.getElementById("register-form");
var z = document.getElementById("btn");

function register() {
  x.style.left = "-350px";
  y.style.left = "0px";
  z.style.left = "142px";
}

function login() {
  x.style.left = "0px";
  y.style.left = "350px";
  z.style.left = "0px";
}

//profile
$(".heart").click(function () {
  $(this).toggleClass("active");
  $(".heart::after, .heart::before").toggleClass("active");
});

$(".circle_btn").click(function () {
  $(this).toggleClass("active");
  $(".sett_ings").toggleClass("active");
});

//content
const tabs = document.querySelectorAll("[data-tab-target]");
const tabContents = document.querySelectorAll("[data-tab-content]");

tabs.forEach((tab) => {
  tab.addEventListener("click", () => {
    const target = document.querySelector(tab.dataset.tabTarget);
    tabContents.forEach((tabContent) => {
      tabContent.classList.remove("active");
    });
    target.classList.add("active");
  });
});

//File input
var inputs = document.querySelectorAll(".inputfile");
Array.prototype.forEach.call(inputs, function (input) {
  var label = input.nextElementSibling,
    labelVal = label.innerHTML;

  input.addEventListener("change", function (e) {
    var fileName = "";
    if (this.files && this.files.length > 1)
      fileName = (this.getAttribute("data-multiple-caption") || "").replace(
        "{count}",
        this.files.length
      );
    else fileName = e.target.value.split("\\").pop();

    if (fileName) label.querySelector("span").innerHTML = fileName;
    else label.innerHTML = labelVal;
  });
});

//Initialize Swiper
var swiper = new Swiper(".swiper-container", {
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: "auto",
  coverflowEffect: {
    rotate: 20,
    stretch: 0,
    depth: 200,
    modifier: 1,
    slideShadows: true,
  },
  loop: true,
  autoplay: {
    delay: 1000,
    disableOnInteraction: false,
  },
});

// Загрузочный экран

function preloader() {
  $(() => {
    setInterval(() => {
      let p = $(".preloader");
      p.css("opacity", 0);

      setInterval(() => p.remove(), parseInt(p.css("--duration")) * 1000);
    }, 1000);
  });
}

preloader();

//comment

$("#submit_comm").click(function () {
  if ($("#form10").val() == "") {
    $(".successComm")
      .removeClass("none")
      .text("Комментарий не был добавлен, проверьте правильность полей!");
  } else {
    $.ajax({
      type: "post",
      url: "../admin/comments.php",
      data: $("#form_comm").serialize(),
      success: function () {
        $("#form10").val("");
        $(".successComm")
          .removeClass("none")
          .text(
            "Комментарий успешно отправлен, перезагрузите страницу, чтобы увидеть его!"
          );
      },
    });
  }
});
