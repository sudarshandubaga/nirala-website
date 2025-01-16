/**
 * Main
 */

"use strict";

let menu, animate;

(function () {
    $(document).on("click", ".btn-delete", function (event) {
        event.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to restore this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                let href = $(this).data("href");
                $("#deleteForm").attr("action", href).trigger("submit");
            }
        });
    });

    // Preview Image for Multiple Image Upload
    function previewImage(file, max_size) {
        // Ensure it's an image
        if (file.type.match(/image.*/)) {
            // console.log("An image has been loaded");

            let dataUrl;

            // Load the image

            return new Promise(function (resolve, reject) {
                var reader = new FileReader();
                reader.onload = function (readerEvent) {
                    var image = new Image();
                    image.onload = function () {
                        // Resize the image
                        var canvas = document.createElement("canvas"),
                            width = image.width,
                            height = image.height;

                        if (width > height) {
                            if (width > max_size) {
                                height *= max_size / width;
                                width = max_size;
                            }
                        } else {
                            if (height > max_size) {
                                width *= max_size / height;
                                height = max_size;
                            }
                        }

                        canvas.width = width;
                        canvas.height = height;

                        canvas
                            .getContext("2d")
                            .drawImage(image, 0, 0, width, height);

                        dataUrl = canvas.toDataURL("image/webp");

                        // $(imageTarget).val(dataUrl);

                        // target.src = dataUrl;

                        // return dataUrl;
                        resolve(dataUrl);
                    };
                    image.src = readerEvent.target.result;
                };
                reader.onerror = function (error) {
                    reject(error);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    $(document).on(
        "change",
        ".multiple-image-upload input[type=file]",
        async function () {
            let max_size = $(this).data("size");
            let name = $(this).data("field_name");

            const files = this.files;

            let parent = $(this).closest(".row");

            if (files.length) {
                for (const file of files) {
                    let image = await previewImage(file, max_size);
                    parent.append(`
                        <div class="col-4">
                            <div class="img-preview">
                                <button type="button" class="close remove-col">&times;</button>
                                <img src="${image}" class="w-100" />
                            </div>
                            <textarea name="${name}[]" class="d-none">${image}</textarea>
                        </div>
                    `);
                }
            }
        }
    );

    $(document).on("click", ".remove-col", function () {
        $(this).closest(".col-4").remove();
    });

    // Preview Image Before Upload
    $(document).on("change", ".upload-image input[type=file]", function () {
        let target = document.querySelector($(this).data("target"));
        let imageTarget = $(this).data("text-target");
        let max_size = $(this).data("size");

        const [file] = this.files;
        if (file) {
            // Ensure it's an image
            if (file.type.match(/image.*/)) {
                // console.log("An image has been loaded");

                // Load the image
                var reader = new FileReader();
                reader.onload = function (readerEvent) {
                    var image = new Image();
                    image.onload = function () {
                        // Resize the image
                        var canvas = document.createElement("canvas"),
                            width = image.width,
                            height = image.height;

                        if (width > height) {
                            if (width > max_size) {
                                height *= max_size / width;
                                width = max_size;
                            }
                        } else {
                            if (height > max_size) {
                                width *= max_size / height;
                                height = max_size;
                            }
                        }

                        canvas.width = width;
                        canvas.height = height;

                        canvas
                            .getContext("2d")
                            .drawImage(image, 0, 0, width, height);

                        var dataUrl = canvas.toDataURL("image/webp");

                        $(imageTarget).val(dataUrl);

                        target.src = dataUrl;
                    };
                    image.src = readerEvent.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    });

    // Initialize menu
    //-----------------

    let layoutMenuEl = document.querySelectorAll("#layout-menu");
    layoutMenuEl.forEach(function (element) {
        menu = new Menu(element, {
            orientation: "vertical",
            closeChildren: false,
        });
        // Change parameter to true if you want scroll animation
        window.Helpers.scrollToActive((animate = false));
        window.Helpers.mainMenu = menu;
    });

    // Initialize menu togglers and bind click on each
    let menuToggler = document.querySelectorAll(".layout-menu-toggle");
    menuToggler.forEach((item) => {
        item.addEventListener("click", (event) => {
            event.preventDefault();
            window.Helpers.toggleCollapsed();
        });
    });

    // Display menu toggle (layout-menu-toggle) on hover with delay
    let delay = function (elem, callback) {
        let timeout = null;
        elem.onmouseenter = function () {
            // Set timeout to be a timer which will invoke callback after 300ms (not for small screen)
            if (!Helpers.isSmallScreen()) {
                timeout = setTimeout(callback, 300);
            } else {
                timeout = setTimeout(callback, 0);
            }
        };

        elem.onmouseleave = function () {
            // Clear any timers set to timeout
            document
                .querySelector(".layout-menu-toggle")
                .classList.remove("d-block");
            clearTimeout(timeout);
        };
    };
    if (document.getElementById("layout-menu")) {
        delay(document.getElementById("layout-menu"), function () {
            // not for small screen
            if (!Helpers.isSmallScreen()) {
                document
                    .querySelector(".layout-menu-toggle")
                    .classList.add("d-block");
            }
        });
    }

    // Display in main menu when menu scrolls
    let menuInnerContainer = document.getElementsByClassName("menu-inner"),
        menuInnerShadow =
            document.getElementsByClassName("menu-inner-shadow")[0];
    if (menuInnerContainer.length > 0 && menuInnerShadow) {
        menuInnerContainer[0].addEventListener("ps-scroll-y", function () {
            if (this.querySelector(".ps__thumb-y").offsetTop) {
                menuInnerShadow.style.display = "block";
            } else {
                menuInnerShadow.style.display = "none";
            }
        });
    }

    // Init helpers & misc
    // --------------------

    // Init BS Tooltip
    const tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Accordion active class
    const accordionActiveFunction = function (e) {
        if (e.type == "show.bs.collapse" || e.type == "show.bs.collapse") {
            e.target.closest(".accordion-item").classList.add("active");
        } else {
            e.target.closest(".accordion-item").classList.remove("active");
        }
    };

    const accordionTriggerList = [].slice.call(
        document.querySelectorAll(".accordion")
    );
    const accordionList = accordionTriggerList.map(function (
        accordionTriggerEl
    ) {
        accordionTriggerEl.addEventListener(
            "show.bs.collapse",
            accordionActiveFunction
        );
        accordionTriggerEl.addEventListener(
            "hide.bs.collapse",
            accordionActiveFunction
        );
    });

    // Auto update layout based on screen size
    window.Helpers.setAutoUpdate(true);

    // Toggle Password Visibility
    window.Helpers.initPasswordToggle();

    // Speech To Text
    window.Helpers.initSpeechToText();

    // Manage menu expanded/collapsed with templateCustomizer & local storage
    //------------------------------------------------------------------

    // If current layout is horizontal OR current window screen is small (overlay menu) than return from here
    if (window.Helpers.isSmallScreen()) {
        return;
    }

    // If current layout is vertical and current window screen is > small

    // Auto update menu collapsed/expanded based on the themeConfig
    window.Helpers.setCollapsed(true, false);
})();
