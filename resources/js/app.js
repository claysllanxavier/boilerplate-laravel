require("./bootstrap");

(function($) {
    "use strict"; // Start of use strict

    var url = window.location;

    $('[data-toggle="tooltip"]').tooltip();

    // Toggle the side navigation
    $("#sidebarToggle, #sidebarToggleTop").on("click", function(e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
            $(".sidebar .collapse").collapse("hide");
        }
    });

    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function() {
        if ($(window).width() < 768) {
            $(".sidebar .collapse").collapse("hide");
        }

        // Toggle the side navigation when window is resized below 480px
        if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
            $("body").addClass("sidebar-toggled");
            $(".sidebar").addClass("toggled");
            $(".sidebar .collapse").collapse("hide");
        }
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $("body.fixed-nav .sidebar").on("mousewheel DOMMouseScroll wheel", function(
        e
    ) {
        if ($(window).width() > 768) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });

    // Scroll to top button appear
    $(document).on("scroll", function() {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $(".scroll-to-top").fadeIn();
        } else {
            $(".scroll-to-top").fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on("click", "a.scroll-to-top", function(e) {
        var $anchor = $(this);
        $("html, body")
            .stop()
            .animate(
                {
                    scrollTop: $($anchor.attr("href")).offset().top
                },
                1000,
                "easeInOutExpo"
            );
        e.preventDefault();
    });

    var element = $(".nav-item a").filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    });

    if (element.hasClass("collapse-item")) {
        element.addClass("active");
    }

    $(element.parents()).each(function() {
        if (this.className.indexOf("nav-item") != -1) {
            $(this).addClass("active");
        }
        if (this.className.indexOf("collapse") != -1) {
            $(this).addClass("show");
            $(this)
                .siblings(".nav-link")
                .removeClass("collapsed");
        }
    });

    $("input[required], select[required], textarea[required]")
        .siblings("label")
        .addClass("required");

    $("div.alert-close")
        .delay(10000)
        .fadeOut(10000);

    $(".btn-delete").on("click", function(e) {
        e.preventDefault();
        var form = $(this)
            .parents("form")
            .attr("id");
        swal({
            title: "Você está certo?",
            text:
                "Uma vez deletado, você não poderá recuperar esse item novamente!",
            icon: "warning",
            buttons: true,
            buttons: ["Cancelar", "Excluir"],
            dangerMode: true
        }).then(isConfirm => {
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
        infoTextFiltered:
            '<span class="label label-warning">Filtrado</span> {0} DE {1}',
        infoTextEmpty: "Sem Dados",
        moveOnSelect: false
    });

    var customSettings = $(".multi-select").bootstrapDualListbox(
        "getContainer"
    );
    customSettings
        .find(".moveall i")
        .removeClass()
        .addClass("fa fa-angle-double-right")
        .next()
        .remove();
    customSettings
        .find(".move i")
        .removeClass()
        .addClass("fa fa-angle-right")
        .next()
        .remove();
    customSettings
        .find(".removeall i")
        .removeClass()
        .addClass("fa fa-angle-double-left")
        .next()
        .remove();
    customSettings
        .find(".remove i")
        .removeClass()
        .addClass("fa fa-angle-left")
        .next()
        .remove();
})(jQuery); // End of use strict

require("./components/inputmask");
require("./components/select2");
