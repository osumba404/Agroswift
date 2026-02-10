jQuery(document).ready(function ($) {
    $('.remove_image_button').hide();
    function initializeImageUpload(buttonClass, hiddenInputClass, imgTag) {

        $(document).on('click', buttonClass, function (e) {
            e.preventDefault();

            const button = $(this);
            let fileFrame = button.data('file_frame');

            if (!fileFrame) {
                fileFrame = wp.media({
                    title: 'Select or Upload an Image',
                    library: { type: 'image' },
                    button: { text: 'Use this image' },
                    multiple: false
                });

                fileFrame.on('select', function () {
                    const attachment = fileFrame.state().get('selection').first().toJSON();
                    button.siblings(hiddenInputClass).val(attachment.id);
                    button.siblings(imgTag).attr('src', attachment.url).show();

                    const removeButton = button.siblings('.remove_image_button');
                    if (attachment.url) {
                        removeButton.show(); // Show the button
                    }

                });

                button.data('file_frame', fileFrame);
            }

            fileFrame.open();
        });
    }


    $('#submit-slider, .btn.btn-primary[type="submit"]').click(function () {
        $('#slider-form').submit(); // Submit the form
    });

    $(document).on('click', '.upload_corner_images_button', function (e) {
        e.preventDefault();

        const button = $(this);
        let fileFrameCornerImages = button.data('file_frame');

        if (!fileFrameCornerImages) {
            fileFrameCornerImages = wp.media({
                title: 'Select or Upload Corner Images',
                library: { type: 'image' },
                button: { text: 'Use these image' },
                multiple: false
            });

            fileFrameCornerImages.on('select', function () {
                const attachment = fileFrameCornerImages.state().get('selection').first().toJSON();
                const cornerImagesContainer = button.prev('.corner-images-container');
                const hiddenInput = button.prevAll('input[type="hidden"]');

                cornerImagesContainer.empty().append(
                    `<img src="${attachment.url}" style="max-width: 100px; max-height: 100px; display: inline-block; margin-right: 10px;" />`
                );

                hiddenInput.val(attachment.id);
            });

            button.data('file_frame', fileFrameCornerImages);
        }

        fileFrameCornerImages.open();
    });

    // Initialize image upload for other buttons
    initializeImageUpload('.upload_mini_image_1_button', 'input[type="hidden"]', 'img');
    initializeImageUpload('.upload_mini_image_2_button', 'input[type="hidden"]', 'img');
    initializeImageUpload('.upload_image_button', 'input[type="hidden"]', 'img');
    initializeImageUpload('.upload_icon_button', 'input[type="hidden"]', 'img');


    $('#slider-slides').on('click', '.add_slide_button', function () {
        const slideCount = $('.slide-container').length;

        // Check if user is premium 
        if (!sliderData.isPremiumUser && slideCount >= sliderData.maxSlides) {
            const proButton = `
                <div class="go-pro-container text-center mt-3">
                    <button class="btn btn-primary go-pro-button">
                        <a href="https://www.ovationthemes.com/products/ovation-elements-pro" target="_blank" style="color: white; text-decoration: none;">
                            Go Pro to Add More Slides
                        </a>
                    </button>
                </div>
            `;

            if (!$('.slide-container').eq(slideCount - 1).find('.go-pro-container').length) {
                $('.slide-container').eq(slideCount - 1).append(proButton);
            }
            return; // Stop adding new slides
        }
        //ended


        const newSlide = `
            <div class="slide-container mb-4 p-3 border rounded" data-index="${slideCount}">
                <h3>Slide ${slideCount + 1}</h3>
                <div class="form-group">
                    <label for="slide_image_${slideCount}">Image:</label>
                    <input type="hidden" id="slide_image_${slideCount}" name="slide_images[]" />
                    <img src="" style="max-width: 100px; max-height: 100px; display: none;" />
                    <button type="button" class="upload_image_button button mt-2">Upload Image:</button>
                    <!-- Add Remove Image Button -->
                    <!-- Add Remove Image Button (Initially hidden) -->
                    <button type="button" class="remove_image_button button btn btn-danger mt-2" style="margin-left: 10px; display: none;">Remove Background Image</button>
                
                    <label for="slide_bg_color_${slideCount}">Background Color:</label>
                    <input type="color" id="slide_bg_color_${slideCount}" name="slide_bg_color[]" />
                </div>
                <div class="form-group">
                    <label for="slide_title_${slideCount}">Title:</label>
                    <input type="text" id="slide_title_${slideCount}" name="slide_titles[]" class="form-control" placeholder="Enter slide title here" />
                </div>
                <div class="form-group">
                    <label for="slide_description_${slideCount}">Description:</label>
                    <textarea id="slide_description_${slideCount}" name="slide_descriptions[]" rows="3" class="form-control" placeholder="Enter slide description here"></textarea>
                </div>
                <div class="form-group">
                    <label for="slide_button_text_${slideCount}">Button Text:</label>
                    <input type="text" id="slide_button_text_${slideCount}" name="slide_button_texts[]" class="form-control" placeholder="Enter button text here" />
                </div>
                <div class="form-group">
                    <label for="slide_button_url_${slideCount}">Button URL:</label>
                    <input type="url" id="slide_button_url_${slideCount}" name="slide_button_urls[]" class="form-control" placeholder="Enter button URL here" />
                </div>

                <button type="button" class="remove_slide_button btn btn-danger">Remove Slide</button>
                <button type="button" class="add_slide_button" class="btn btn-success">Add Slide</button>
            </div>
        `;
        $('#slider-slides').append(newSlide);

        // Reinitialize image upload for new slides
        initializeImageUpload('.upload_image_button', 'input[type="hidden"]', 'img');

    });

    // Handle remove image functionality
    $(document).on('click', '.remove_image_button', function () {
        const parent = $(this).closest('.form-group');

        // Clear the image input and preview
        parent.find('input[type="hidden"]').val('');
        const imageElement = parent.find('img');
        if (imageElement.length > 0) {
            imageElement.attr('src', '').hide();
        }
        $(this).hide();
    });
    //end

    // Remove slide functionality
    $('#slider-slides').on('click', '.remove_slide_button', function () {
        $(this).closest('.slide-container').remove();
    });
});

jQuery(document).ready(function ($) {
    function updateLivePreview() {
        console.log('Live preview update triggered');

        // Slide Image Preview
        var slideImageID = $('#slide_image_0').val();
        var slideBgColor = $('#slide_bg_color_0').val();
        var swiperWrapper = $('.swiper-wrapper.swiper-wrapper-business');

        if (slideImageID) {
            var attachment = wp.media.attachment(slideImageID);

            attachment.fetch().then(function () {
                if (attachment && attachment.get('url')) {
                    var imageUrl = attachment.get('url');
                    swiperWrapper.css({
                        'background': 'url(' + imageUrl + ') no-repeat center center',
                        'background-size': 'cover',
                        'background-color': slideBgColor
                    });

                } else {
                    console.error("Attachment URL not found for ID:", slideImageID);
                }
            }).catch(function (err) {
                console.error("Error fetching attachment:", err);
            });
        } else {
            swiperWrapper.css({
                'background': 'url(https://via.placeholder.com/1200x600?text=Default+Image) no-repeat center center',
                'background-size': 'cover',
                'background-color': slideBgColor // Apply the selected background color
            });
        }

        //new add for bg
        // Update background color dynamically when color picker value changes
        $('#slide_bg_color_0').on('input', function () {
            var newColor = $(this).val();
            swiperWrapper.css('background-color', newColor);
        });

        //end


        //new for review text
        var ovreview = $('#ov_template_review_text').val();
        $('.social-media-wrap').eq(0).find('.follow-title').text(ovreview || 'reviewtext');

        var ovreview = $('#ov_template_social_review_text').val();
        $('.client-images').eq(0).find('.oe-client-text').text(ovreview || 'happy client');
        //end

        var title = $('#slide_title_0').val();
        $('.oe-slider-content h1').text(title || 'Slide Title');

        var description = $('#slide_description_0').val();
        $('.oe-slider-content p').text(description || 'Slide description goes here.');

        var buttonText = $('#slide_button_text_0').val();
        $('.oe-slider-content .theme-btn').text(buttonText || 'Button Text');

        var buttonURL = $('#slide_button_url_0').val();
        $('.oe-slider-content .theme-btn').attr('href', buttonURL || '#');

        var miniTitle = $('#slide_mini_title_0').val();
        $('.information-card').eq(0).find('.heading').text(miniTitle || 'Mini Title 1');

        var miniDescription = $('#slide_mini_description_0').val();
        $('.information-card').eq(0).find('.description').text(miniDescription || 'Mini description goes here.');

        var miniTitle2 = $('#slide_mini_title2_0').val();
        $('.information-card').eq(1).find('.heading').text(miniTitle2 || 'Mini Title 2');

        var miniDescription2 = $('#slide_mini_description2_0').val();
        $('.information-card').eq(1).find('.description').text(miniDescription2 || 'Mini description 2 goes here.');

        var miniImage1 = $('#slide_mini_image_1_0').val();
        if (miniImage1) {
            var miniImageAttachment1 = wp.media.attachment(miniImage1);
            miniImageAttachment1.fetch().then(function () {
                $('.information-card').eq(0).find('.icon img').attr('src', miniImageAttachment1.get('url'));
            });
        }

        var miniImage2 = $('#slide_mini_image_2_0').val();
        if (miniImage2) {
            var miniImageAttachment2 = wp.media.attachment(miniImage2);
            miniImageAttachment2.fetch().then(function () {
                $('.information-card').eq(1).find('.icon img').attr('src', miniImageAttachment2.get('url'));
            });
        }

        var cornerImages = $('#slide_corner_images_0').val();
        var cornerImagesContainer = $('.oe-slider-clients .corner-images-container');
        cornerImagesContainer.empty();

        if (cornerImages) {
            var cornerImageIds = cornerImages.split(',');
            cornerImageIds.forEach(function (imageID) {
                var attachment = wp.media.attachment(imageID);
                attachment.fetch().then(function () {
                    cornerImagesContainer.append(
                        '<img src="' + attachment.get('url') + '" style="max-width: 100px; max-height: 100px; margin-right: 10px;" alt="Corner Image" />'
                    );
                });
            });
        }

        //for font size settings live preview

        var fontSize1 = $('#heading_font_size').val();
        $('.oe-slider-content h1').css('font-size', fontSize1 + 'px');

        var fontSize2 = $('#banner_font_size').val();
        $('.oe-slider-content p').css('font-size', fontSize2 + 'px');

        var fontSize3 = $('#button_font_size').val();
        $('.oe-slider-content .theme-btn').css('font-size', fontSize3 + 'px');

        var fontSize4 = $('#ov_mini_title_font_size').val();
        $('.info-inner .heading').css('font-size', fontSize4 + 'px');

        var fontSize5 = $('#mini_description_font_size').val();
        $('.info-inner .description').css('font-size', fontSize5 + 'px');

        var fontSize6 = $('#ov_review_text_font_size').val();
        $('.client-images .oe-client-text').css('font-size', fontSize6 + 'px');

        var fontSize7 = $('#ov_social_text_font_size').val();
        $('.social-media-wrap .follow-title').css('font-size', fontSize7 + 'px');

        //new css 

        var socialIconColor = $('#social_icon_active_color').val();
        $('.oe-icons-container .icons a i').css('color', socialIconColor); // Update the icon color
        var socialIconHoverColor = $('#social_icon_hover_color').val();

        // Remove any hover
        $('#social-icon-hover-style').remove();
        // remove hover
        if (socialIconHoverColor) {
            var hoverStyle = `
                <style id="social-icon-hover-style">
                   
                .icons i:hover {

                    color: ${socialIconHoverColor} !important;
                    background: #0090FF !important;
                }
 
                </style>
            `;
            $('head').append(hoverStyle);
        }

        // Social Icon Size

        var socialIconSize = $('#social_icon_size').val();
        $('.social-media-wrap .icons a i').css('font-size', socialIconSize + 'px');


        //slide button
        var buttonBgColor = $('#button_bg_color').val();
        $('.oe-slider-content .theme-btn').css('background-color', buttonBgColor);

        var buttonTextColor = $('#button_text_color').val();
        $('.oe-slider-content .theme-btn').css('color', buttonTextColor);


        // New for Button Hover Background Color
        var buttonHoverBgColor = $('#button_hover_bg_color').val();
        var buttonHoverTextColor = $('#button_hover_text_color').val();

        // Remove older
        $('#button-hover-bg-style').remove();

        // Add new hover
        if (buttonHoverBgColor) {
            var hoverStyle = `
                <style id="button-hover-bg-style">
                .oe-slider-content .theme-btn .a:hover {
                        
                        background-color: ${buttonHoverBgColor} !important;
                        color: ${buttonHoverTextColor} !important;
                    }

                    .theme-btn:hover {
                        background-color: ${buttonHoverBgColor} !important;
                        color: ${buttonHoverTextColor} !important;
                    }

                </style>
            `;
            $('head').append(hoverStyle);
        }
        //end


    }

    $('body').on('input change paste keyup mouseenter oncontextmenu', '#slide_image_0, #slide_title_0, #slide_description_0, #slide_button_text_0, #slide_button_url_0, #slide_mini_title_0, #slide_mini_description_0, #slide_mini_title2_0, #slide_mini_description2_0, #slide_mini_image_1_0, #slide_mini_image_2_0, #slide_corner_images_0 , #ov_template_review_text ,#ov_template_social_review_text , #heading_font_size , #banner_font_size , #button_font_size, #ov_mini_title_font_size , #mini_description_font_size , #ov_review_text_font_size , #ov_social_text_font_size , #social_icon_active_color , .social_icon_active_color , .static-container , #advanced-settings , .plugin_output_content ', function () {
        updateLivePreview();
    });

    updateLivePreview();
});

// tab base settings 

document.addEventListener("DOMContentLoaded", function () {
    const tabLinks = document.querySelectorAll("#settingsTabs a");
    tabLinks.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            const tab = new bootstrap.Tab(link);
            tab.show();
        });
    });
});

// end 
//color picker code

jQuery(document).ready(function ($) {
    console.log('color picker load');
    //for check button is disable or not
    if (!$('#button_bg_color').prop('disabled')) {
        $('#button_bg_color').wpColorPicker();
    }

    if (!$('#button_hover_bg_color').prop('disabled')) {
        $('#button_hover_bg_color').wpColorPicker();
    }

    if (!$('#button_text_color').prop('disabled')) {
        $('#button_text_color').wpColorPicker();
    }

    if (!$('#button_hover_text_color').prop('disabled')) {
        $('#button_hover_text_color').wpColorPicker();
    }

    if (!$('#social_icon_active_color').prop('disabled')) {
        $('#social_icon_active_color').wpColorPicker();
    }

    if (!$('#social_icon_hover_color').prop('disabled')) {
        $('#social_icon_hover_color').wpColorPicker();
    }
});

//end


//for compressor and croping 

jQuery(document).ready(function ($) {
    const fileInput = $("#slider_image");
    const compressedImage = $("#compressed_image");
    const cropButton = $("#crop_button");
    const previewContainer = $("#compressed_image_preview");

    let cropper;

    fileInput.on("change", function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                const img = new Image();
                img.src = event.target.result;
                img.id = "cropper_image"; // Add ID for reference

                // Clear any previous cropper and image
                previewContainer.empty();
                previewContainer.append(img);

                img.onload = function () {
                    // Initialize cropper on the newly added image
                    if (cropper) cropper.destroy();
                    cropper = new Cropper(img, {
                        aspectRatio: 16 / 9,
                        rotatable: true,
                    });
                };

                compressedImage.attr("src", img.src).show();
            };
            reader.readAsDataURL(file);
        }
    });

    cropButton.on("click", function () {
        if (cropper) {
            const croppedCanvas = cropper.getCroppedCanvas();

            // Convert canvas to blob and prepare for upload
            croppedCanvas.toBlob((blob) => {
                const fileName = "cropped_image.jpg";
                const formData = new FormData();
                formData.append("action", "upload_cropped_image");
                formData.append("cropped_image", blob, fileName);
                formData.append("_ajax_nonce", wpVars.nonce); // Add nonce to the request

                // AJAX request to upload the cropped image
                $.ajax({
                    url: wpVars.ajaxUrl,
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.success) {
                            alert("Image uploaded successfully!");
                            console.log("Uploaded Image URL:", response.data.url);

                            // Refresh WordPress Media Library
                            if (wp && wp.media) {
                                wp.media.frame.state().get("library")._requery(true);
                            }
                        } else {
                            alert("Failed to upload image: " + response.data.message);
                            console.error(response.data.message);
                        }
                    },
                    error: function (error) {
                        alert("Error occurred while uploading.");
                        console.error(error);
                    },
                });
            }, "image/jpeg");
        } else {
            alert("No image is loaded for cropping.");
        }
    });
});
