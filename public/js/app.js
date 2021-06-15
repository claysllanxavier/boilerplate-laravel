/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

(function ($) {
  "use strict"; // Start of use strict

  var url = window.location;
  resizeSidebar();
  $('[data-toggle="tooltip"]').tooltip(); // Toggle the side navigation

  $("#sidebarToggle, #sidebarToggleTop").on("click", function (e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");

    if ($(".sidebar").hasClass("toggled")) {
      $(".sidebar .collapse").collapse("hide");
    }
  }); // Close any open menu accordions when window is resized below 768px

  $(window).resize(function () {
    resizeSidebar();
  }); // Prevent the content wrapper from scrolling when the fixed side navigation hovered over

  $("body.fixed-nav .sidebar").on("mousewheel DOMMouseScroll wheel", function (e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
          delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  }); // Scroll to top button appear

  $(document).on("scroll", function () {
    var scrollDistance = $(this).scrollTop();

    if (scrollDistance > 100) {
      $(".scroll-to-top").fadeIn();
    } else {
      $(".scroll-to-top").fadeOut();
    }
  }); // Smooth scrolling using jQuery easing

  $(document).on("click", "a.scroll-to-top", function (e) {
    var $anchor = $(this);
    $("html, body").stop().animate({
      scrollTop: $($anchor.attr("href")).offset().top
    }, 1000, "easeInOutExpo");
    e.preventDefault();
  });
  var element = $(".nav-item a").filter(function () {
    return this.href == url || url.href.indexOf(this.href) == 0;
  });

  if (element.hasClass("collapse-item")) {
    element.addClass("active");
  }

  $(element.parents()).each(function () {
    if (this.className.indexOf("nav-item") != -1) {
      $(this).addClass("active");
    }

    if (this.className.indexOf("collapse") != -1) {
      $(this).addClass("show");
      $(this).siblings(".nav-link").removeClass("collapsed");
    }
  });
  $("input[required], select[required], textarea[required]").siblings("label").addClass("required");
  $("div.alert-close").delay(10000).fadeOut(10000);
  $(".btn-delete").on("click", function (e) {
    var _swal;

    e.preventDefault();
    var form = $(this).parents("form").attr("id");
    swal((_swal = {
      title: "Você está certo?",
      text: "Uma vez deletado, você não poderá recuperar esse item novamente!",
      icon: "warning",
      buttons: true
    }, _defineProperty(_swal, "buttons", ["Cancelar", "Excluir"]), _defineProperty(_swal, "dangerMode", true), _swal)).then(function (isConfirm) {
      if (isConfirm) {
        document.getElementById(form).submit();
      } else {
        swal("Este item está salvo!");
      }
    });
  });
  $(".multi-select").bootstrapDualListbox({
    nonSelectedListLabel: "Disponíveis",
    selectedListLabel: "Selecionados",
    filterPlaceHolder: "Filtrar",
    filterTextClear: "Mostrar Todos",
    moveSelectedLabel: "Mover Selecionados",
    moveAllLabel: "Mover Todos",
    removeSelectedLabel: "Remover Selecionado",
    removeAllLabel: "Remover Todos",
    infoText: "Mostrando Todos - {0}",
    infoTextFiltered: '<span class="label label-warning">Filtrado</span> {0} DE {1}',
    infoTextEmpty: "Sem Dados",
    moveOnSelect: false
  });
  var customSettings = $(".multi-select").bootstrapDualListbox("getContainer");
  customSettings.find(".moveall i").removeClass().addClass("fa fa-angle-double-right").next().remove();
  customSettings.find(".move i").removeClass().addClass("fa fa-angle-right").next().remove();
  customSettings.find(".removeall i").removeClass().addClass("fa fa-angle-double-left").next().remove();
  customSettings.find(".remove i").removeClass().addClass("fa fa-angle-left").next().remove();
})(jQuery); // End of use strict


function resizeSidebar() {
  if ($(window).width() < 768) {
    $(".sidebar .collapse").collapse("hide");
  } // Toggle the side navigation when window is resized below 480px


  if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
    $("body").addClass("sidebar-toggled");
    $(".sidebar").addClass("toggled");
    $(".sidebar .collapse").collapse("hide");
  }
}

__webpack_require__(/*! ./components/inputmask */ "./resources/js/components/inputmask.js");

__webpack_require__(/*! ./components/select2 */ "./resources/js/components/select2.js");

/***/ }),

/***/ "./resources/js/components/inputmask.js":
/*!**********************************************!*\
  !*** ./resources/js/components/inputmask.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  $.instantiatingInputMask();
});

$.instantiatingInputMask = function () {
  try {
    $("[data-mask]").each(function (index) {
      var inputmask = $(this);
      var options = {
        clearIncomplete: false,
        placeholder: "_"
      };
      var op = {};

      switch (inputmask.data("mask")) {
        case "integer":
          options.allowMinus = false;
          inputmask.inputmask("integer", options);
          break;

        case "numeric":
          options.allowMinus = false;
          inputmask.inputmask("numeric", options);
          break;

        case "decimal":
          op = {
            radixPoint: ",",
            groupSeparator: ".",
            allowMinus: false,
            prefix: "",
            digits: 2,
            digitsOptional: false,
            rightAlign: true,
            unmaskAsNumber: true
          };
          inputmask.inputmask("decimal", op);
          break;

        case "phone":
          options.greedy = false;
          options.removeMaskOnSubmit = true;
          inputmask.inputmask("(99) 9999[9]-9999", options);
          break;

        case "money":
          inputmask.inputmask("currency", options);
          break;

        case "real":
          op = {
            radixPoint: ",",
            groupSeparator: ".",
            allowMinus: false,
            prefix: "",
            digits: 2,
            digitsOptional: false,
            rightAlign: true,
            unmaskAsNumber: true
          };
          inputmask.inputmask("currency", op);
          break;

        case "cpf":
          inputmask.inputmask("999.999.999-99", options);
          break;

        case "cnpj":
          inputmask.inputmask("99.999.999/9999-99", options);
          break;

        case "cpfcnpj":
          options.keepStatic = true;
          options.mask = ["999.999.999-99", "99.999.999/9999-99"];
          inputmask.inputmask(options);
          break;

        case "cep":
          inputmask.inputmask("99.999-999", options);
          break;

        default:
          console.log("Tipo de máscara '" + inputmask.data("mask") + "' não implementado!");
      }
    });
  } catch (e) {
    console.log(e.message);
  }
};

/***/ }),

/***/ "./resources/js/components/select2.js":
/*!********************************************!*\
  !*** ./resources/js/components/select2.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  $(".select2").select2({
    language: "pt-BR",
    placeholder: "Selecione...",
    width: "100%",
    theme: "bootstrap4"
  });
});

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/claysllanxavier/Projects/Study/boilerplate-laravel/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /Users/claysllanxavier/Projects/Study/boilerplate-laravel/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });