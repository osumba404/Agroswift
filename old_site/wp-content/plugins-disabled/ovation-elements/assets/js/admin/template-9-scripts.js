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

                    //new add for remove bg image
                    // Show the "Remove Background Image" button when an image is selected
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



    // Add slide functionality with upload button initialization
    // $('#add_slide_button').click(function () {

    //limit checked



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

    //new add for remove bg image
    // Handle remove image functionality
    // Handle remove image functionality
    $(document).on('click', '.remove_image_button', function () {
        const parent = $(this).closest('.form-group');

        // Clear the image input and preview
        parent.find('input[type="hidden"]').val('');
        const imageElement = parent.find('img');
        if (imageElement.length > 0) {
            imageElement.attr('src', '').hide();
        }

        // Hide the "Remove Background Image" button after clearing the image
        $(this).hide(); // Hide the button after removing the image
    });
    //end

    // Remove slide functionality
    $('#slider-slides').on('click', '.remove_slide_button', function () {
        $(this).closest('.slide-container').remove();
    });
});


//live preview

jQuery(document).ready(function ($) {
    function updateLivePreview() {
        console.log('Live preview update triggered');

        // Slide Image Preview
        var slideImageID = $('#slide_image_0').val();
        var slideBgColor = $('#slide_bg_color_0').val();
        var swiperWrapper = $('.swiper-wrapper.swiper-wrapper-business');
        var swiperSlide = $('.swiper-slide');
        var slideImage = swiperSlide.find('img');

        if (slideImageID) {
            var attachment = wp.media.attachment(slideImageID);

            attachment.fetch().then(function () {
                if (attachment && attachment.get('url')) {
                    var imageUrl = attachment.get('url');

                    // Update the img src in the swiper-slide
                    slideImage.attr('src', imageUrl);

                    // Optionally, set the background color for the swiper-slide (if needed)
                    swiperSlide.css('background-color', slideBgColor);
                } else {
                    console.error("Attachment URL not found for ID:", slideImageID);
                }
            }).catch(function (err) {
                console.error("Error fetching attachment:", err);
            });
        } else {
            // default image
            slideImage.attr('src', '');
            swiperSlide.css('background-color', slideBgColor);
        }
        //end


        //new for review text
        var ovreview = $('#ov_template_review_text').val();
        $('.business-follower-main').eq(0).find('.business-title').text(ovreview || 'reviewtext');

        var title = $('#slide_title_0').val();
        $('.foremost .foremost-title1').text(title || 'Slide Title');


        var buttonText = $('#slide_button_text_0').val();
        $('.explore-more-div .explore-more').text(buttonText || 'Button Text');

        var buttonURL = $('#slide_button_url_0').val();
        $('.explore-more-div .explore-more').attr('href', buttonURL || '#');




        //for font size settings live preview

        var fontSize1 = $('#heading_font_size').val();
        $('.foremost .foremost-title1').css('font-size', fontSize1 + 'px');


        var fontSize3 = $('#button_font_size').val();
        $('.explore-more-div .explore-more').css('font-size', fontSize3 + 'px');


        var fontSize7 = $('#ov_social_text_font_size').val();
        $('.business-follower-main .business-title').css('font-size', fontSize7 + 'px');

        //new css
        var socialIconColor = $('#social_icon_active_color').val();
        console.log(socialIconColor);
        $('.social-media-div .icons a i').css('color', socialIconColor); // Update the icon color


        var socialIconHoverColor = $('#social_icon_hover_color').val();

        // Remove any hover
        $('#social-icon-hover-style').remove();
        // remove hover
        if (socialIconHoverColor) {
            var hoverStyle = `
                <style id="social-icon-hover-style">
                   
                    .icons i:hover {

                        color: ${socialIconHoverColor} !important;
                    }
                </style>
            `;
            $('head').append(hoverStyle);
        }

        // Social Icon Size
        var socialIconSize = $('#social_icon_size').val();
        $('.social-media-div .icons a i').css('font-size', socialIconSize + 'px');


        //slide button
        var buttonBgColor = $('#button_bg_color').val();
        $('.explore-more-div .explore-more').css('background-color', buttonBgColor);

        var buttonTextColor = $('#button_text_color').val();
        $('.explore-more-div .explore-more').css('color', buttonTextColor);

        // New for Button Hover Background Color
        var buttonHoverBgColor = $('#button_hover_bg_color').val();
        var buttonHoverTextColor = $('#button_hover_text_color').val();
        //for overlay color
        // var imageOverlayColor = $('#image_overlay').val();
        // $('.swiper-slide .oe-overlay').css('background-color', imageOverlayColor);

        var imageOverlayColor = $('#image_overlay').val();

        if (imageOverlayColor) {
            var overlayStyle = `
                <style id="swiper-slide-overlay-style">
                    .swiper-slide::before {
                        content: "";
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-color: ${imageOverlayColor};
                        z-index: 99;
                        pointer-events: none;
                        opacity: 0.6;
                    }
                </style>
            `;

            // Remove existing style tag if already present to avoid duplicates
            $('#swiper-slide-overlay-style').remove();

            // Append new style to head
            $('head').append(overlayStyle);
        }


        // Remove older
        $('#button-hover-bg-style').remove();

        // Add new hover
        if (buttonHoverBgColor) {
            var hoverStyle = `
                <style id="button-hover-bg-style">
                    .explore-more-div .explore-more:hover {
                        background-color: ${buttonHoverBgColor} !important;
                        color: ${buttonHoverTextColor} !important;
                    }
                </style>
            `;
            $('head').append(hoverStyle);
        }

        //end

    }

    $('body').on('input change paste keyup mouseenter oncontextmenu', '#slide_image_0, #slide_title_0, #slide_description_0, #slide_button_text_0, #slide_button_url_0, #slide_mini_title_0, #slide_mini_description_0, #slide_mini_title2_0, #slide_mini_description2_0, #slide_mini_image_1_0, #slide_mini_image_2_0, #slide_corner_images_0 , #ov_template_review_text ,#ov_template_social_review_text , #heading_font_size , #banner_font_size , #button_font_size, #ov_mini_title_font_size , #mini_description_font_size , #ov_review_text_font_size , #ov_social_text_font_size , #social_icon_active_color , .social_icon_active_color , .static-container , #advanced-settings , .plugin_output_content', function () {
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

    if (!$('#image_overlay').prop('disabled')) {
        $('#image_overlay').wpColorPicker();
    }


});

//end


//upload bg image for slider
jQuery(document).ready(function ($) {
    var savedBgImage = $('#bg_slide_image').val();
    if (savedBgImage) {
        $('.business-foremost-container').css('background-image', 'url(' + savedBgImage + ')');
    }
    $('.upload-bg-slide-image').click(function (e) {
        e.preventDefault();
        var imageFrame;
        if (imageFrame) {
            imageFrame.open();
            return;
        }
        imageFrame = wp.media({
            title: 'Select Background Image',
            multiple: false,
            library: { type: 'image' },
            button: { text: 'Use this image' }
        });
        imageFrame.on('select', function () {
            var attachment = imageFrame.state().get('selection').first().toJSON();

            var imageUrl = attachment.url;

            // Update the value in the input field
            $('#bg_slide_image').val(imageUrl);

            $('#bg_slide_image').val(attachment.url);

            // Update the preview image dynamically
            if ($('.preview-bg-slide-image img').length) {
                $('.preview-bg-slide-image img').attr('src', attachment.url);
            } else {
                $('.preview-bg-slide-image').remove();
                $('#bg_slide_image').after('<div class="preview-bg-slide-image" style="margin-top: 10px;"><img src="' + attachment.url + '" style="max-width: 150px; height: auto; border: 1px solid #ddd; padding: 5px;"></div>');
            }

            //live preview
            $('.business-foremost-container').css('background-image', 'url(' + imageUrl + ')');
        });
        imageFrame.open();
    });
});