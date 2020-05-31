require("./bootstrap");

//funcion que hace abrir y cerrar el sidebar

$(document).ready(function() {
    $(".button-left").click(function() {
        $(".sidebar").toggleClass("fliph");
        $(".iconX").toggle();
        $(".content-margin").toggleClass("content-margin-0");
    });

    $(document).on("change", 'input[type="file"]', function(event) {
        var filename = $(this).val();
        if (filename == undefined || filename == "") {
            $(this)
                .next(".custom-file-label")
                .html("No file chosen");
        } else {
            $(this)
                .next(".custom-file-label")
                .html(event.target.files[0].name);
        }
    });

    $("#lfm").filemanager("image");
    $("#lfm2").filemanager("image");
});

document.addEventListener(
    "readystatechange",
    evento => {
        if (document.readyState == "complete") {
            if (
                document.getElementById("thumbnail") &&
                document.getElementById("thumbnail").value !== ""
            ) {
                let img = document.createElement("img");
                img.setAttribute(
                    "src",
                    document.getElementById("thumbnail").value
                );
                img.setAttribute("alt", "preview de imagen cargada1");
                document.getElementById("holder").appendChild(img);
                if (
                    document.getElementById("thumbnail1") &&
                    document.getElementById("thumbnail1").value !== ""
                ) {
                    let img1 = document.createElement("img");
                    img1.setAttribute(
                        "src",
                        document.getElementById("thumbnail1").value
                    );
                    img1.setAttribute("alt", "preview de imagen cargada2");
                    document.getElementById("holder1").appendChild(img1);
                }
            }
        }
    },
    false
);

/*
Template Name: Admin Template
Author: Wrappixel

File: js
*/
// ==============================================================
// Auto select left navbar
// ==============================================================
$(function() {
    ("use strict");
    var url = window.location + "";
    var path = url.replace(
        window.location.protocol + "//" + window.location.host + "/",
        ""
    );
    var element = $("ul#sidebarnav a").filter(function() {
        return this.href === url || this.href === path; // || url.href.indexOf(this.href) === 0;
    });
    element.parentsUntil(".sidebar-nav").each(function(index) {
        if ($(this).is("li") && $(this).children("a").length !== 0) {
            $(this)
                .children("a")
                .addClass("active");
            $(this).parent("ul#sidebarnav").length === 0
                ? $(this).addClass("active")
                : $(this).addClass("selected");
        } else if (!$(this).is("ul") && $(this).children("a").length === 0) {
            $(this).addClass("selected");
        } else if ($(this).is("ul")) {
            $(this).addClass("in");
        }
    });

    element.addClass("active");
    $("#sidebarnav a").on("click", function(e) {
        if (!$(this).hasClass("active")) {
            // hide any open menus and remove all other classes
            $("ul", $(this).parents("ul:first")).removeClass("in");
            $("a", $(this).parents("ul:first")).removeClass("active");

            // open our new menu and add the open class
            $(this)
                .next("ul")
                .addClass("in");
            $(this).addClass("active");
        } else if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this)
                .parents("ul:first")
                .removeClass("active");
            $(this)
                .next("ul")
                .removeClass("in");
        }
    });
    $("#sidebarnav >li >a.has-arrow").on("click", function(e) {
        e.preventDefault();
    });

    // this is for close icon when navigation open in mobile view
    $(".nav-toggler").on("click", function() {
        $(".left-sidebar").toggleClass("show-sidebar");
        $(".ti-menu").toggle();
    });
});
