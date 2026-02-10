jQuery(document).ready(function ($) {
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
    $('#slider-slides').on('click', '.add_slide_button', function () {
        const slideCount = $('.slide-container').length;

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
            return;
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
            </div>
            <div class="form-group">
                <label for="slide_title_${slideCount}">Title:</label>
                <input type="text" id="slide_title_${slideCount}" name="slide_titles[]" class="form-control" placeholder="Enter slide title" />
            </div>
            <div class="form-group">
                <label for="slide_description_${slideCount}">Description:</label>
                <textarea id="slide_description_${slideCount}" name="slide_descriptions[]" rows="3" class="form-control" placeholder="Enter slide description"></textarea>
            </div>
            <div class="form-group">
                <label for="slide_head_tag_${slideCount}">Head Tag</label>
                <input type="text" id="slide_head_tag_${slideCount}" name="slide_head_tags[]" class="form-control" placeholder="Enter head tag" />
            </div>
            <div class="form-group">
                <label for="slide_button_text_${slideCount}">Button Text:</label>
                <input type="text" id="slide_button_text_${slideCount}" name="slide_button_texts[]" class="form-control" placeholder="Enter button text" />
            </div>
            <div class="form-group">
                <label for="slide_button_url_${slideCount}">Button URL:</label>
                <input type="url" id="slide_button_url_${slideCount}" name="slide_button_urls[]" class="form-control" placeholder="Enter button URL" />
            </div>
            
                <button type="button" class="remove_slide_button btn btn-danger">Remove Slide</button>
                <button type="button" class="add_slide_button" class="btn btn-success">Add Slide</button>
            </div>
        `;
        $('#slider-slides').append(newSlide);

    });

    // Remove slide functionality
    $('#slider-slides').on('click', '.remove_slide_button', function () {
        $(this).closest('.slide-container').remove();
    });
});



// for live preview 
jQuery(document).ready(function ($) {
    function updateLivePreview() {
        console.log('Live preview update triggered');

        var slideImageID = $('#slide_image_0').val();
        var previewSlideImage = $('.item-image img');

        if (slideImageID) {
            var attachment = wp.media.attachment(slideImageID);
            attachment.fetch().then(function () {
                if (attachment && attachment.get('url')) {
                    var imageUrl = attachment.get('url');

                    if (previewSlideImage) {
                        previewSlideImage.attr('src', imageUrl);
                    }
                } else {
                    console.error("Attachment URL not found for ID:", slideImageID);
                }
            }).catch(function (err) {
                console.error("Error fetching attachment:", err);
            });
        } else {
            if (previewSlideImage) {
                previewSlideImage.attr('src', 'https://via.placeholder.com/1200x600?text=Default+Image');
            }
        }

        var ovreview = $('#ov_template_review_text').val();
        $('.social-media-wrap').eq(0).find('.follow-title').text(ovreview || 'followtext');


        var title = $('#slide_title_0').val();
        $('.oe-banner-img h1').text(title || 'Slide Title');

        var description = $('#slide_description_0').val();
        $('.oe-banner-img p.banner-para').text(description || 'Slide description goes here.');

        var headTag = $('#slide_head_tag_0').val();
        $('.oe-banner-img .heading-tag').text(headTag || 'New Arrival');

        var buttonText = $('#slide_button_text_0').val();
        $('.oe-circular-slider-custom-nav .theme-btn').text(buttonText || 'Button Text');

        var buttonURL = $('#slide_button_url_0').val();
        $('.oe-circular-slider-custom-nav .theme-btn').attr('href', buttonURL || '#');

        var miniTitle = $('#slide_mini_title_0').val();
        $('.information-card').eq(0).find('.heading').text(miniTitle || 'Mini Title');

        var miniDescription = $('#slide_mini_description_0').val();
        $('.information-card').eq(0).find('.description').text(miniDescription || 'Mini description goes here.');

        var miniTitle2 = $('#slide_mini_title2_0').val();
        $('.information-card').eq(1).find('.heading').text(miniTitle2 || 'Mini Title 2');

        var miniDescription2 = $('#slide_mini_description2_0').val();
        $('.information-card').eq(1).find('.description').text(miniDescription2 || 'Mini description 2 goes here.');

        var miniImage1 = $('#slide_mini_image_1_0').val();
        if (miniImage1) {
            $('.information-card').eq(0).find('.icon img').attr('src', wp.media.attachment(miniImage1).get('url'));
        }

        var miniImage2 = $('#slide_mini_image_2_0').val();
        if (miniImage2) {
            $('.information-card').eq(1).find('.icon img').attr('src', wp.media.attachment(miniImage2).get('url'));
        }


        //for font size settings live preview

        var fontSize1 = $('#head_font_size').val();
        $('.oe-banner-img .heading-tag').css('font-size', fontSize1 + 'px');

        var fontSize2 = $('#heading_font_size').val();
        $('.oe-banner-img h1').css('font-size', fontSize2 + 'px');

        var fontSize3 = $('#banner_font_size').val();
        $('.oe-banner-img .banner-para').css('font-size', fontSize3 + 'px');

        var fontSize4 = $('#button_font_size').val();
        $('.oe-banner-img .theme-btn').css('font-size', fontSize4 + 'px');

        var fontSize5 = $('#ov_mini_title_font_size').val();
        $('.info-inner .heading').css('font-size', fontSize5 + 'px');

        var fontSize6 = $('#mini_description_font_size').val();
        $('.info-inner .description').css('font-size', fontSize6 + 'px');

        var fontSize55 = $('#slide_email_font_size').val();
        $('.info-wrap .info').css('font-size', fontSize55 + 'px');

        var fontSize66 = $('#slide_no_font_size').val();
        $('.info-wrap .info').css('font-size', fontSize66 + 'px');


        var fontSize8 = $('#ov_social_text_font_size').val();
        $('.social-media-wrap .follow-title').css('font-size', fontSize8 + 'px');


        //new css 
        var socialIconColor = $('#social_icon_active_color').val();
        $('.icons i').css('color', socialIconColor); // Update the icon color
        var socialIconHoverColor = $('#social_icon_hover_color').val();

        // Remove any hover
        $('#social-icon-hover-style').remove();
        // remove hover
        if (socialIconHoverColor) {
            var hoverStyle = `
                <style id="social-icon-hover-style">

                .icons i{
                    background: #000;
                }
                   
                .icons i:hover {

                    color: ${socialIconHoverColor} !important;
                    background: #000;
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
        $('.oe-circular-slider-custom-nav .theme-btn').css('background-color', buttonBgColor);

        var buttonTextColor = $('#button_text_color').val();
        $('.oe-circular-slider-custom-nav .theme-btn').css('color', buttonTextColor);


        // New for Button Hover Background Color
        var buttonHoverBgColor = $('#button_hover_bg_color').val();
        var buttonHoverTextColor = $('#button_hover_text_color').val();

        // Remove older
        $('#button-hover-bg-style').remove();

        // Add new hover
        if (buttonHoverBgColor) {
            var hoverStyle = `
               <style id="button-hover-bg-style">
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

    $('#ov_social_text_font_size , #slide_no_font_size , #slide_email_font_size , #mini_description_font_size, #ov_mini_title_font_size, #head_font_size, #heading_font_size, #banner_font_size ,#button_font_size ,  #slide_image_0, #slide_title_0, #slide_description_0, #slide_head_tag_0, #slide_button_text_0, #slide_button_url_0, #slide_mini_title_0, #slide_mini_description_0, #slide_mini_title2_0, #slide_mini_description2_0, #slide_email, #slide_no, #slide_mini_image_1_0, #slide_mini_image_2_0, #slide_corner_images_0 , #ov_template_review_text , .social_icon_active_color , .static-container , #advanced-settings , .plugin_output_content').on('input change paste keyup mouseenter oncontextmenu', function () {
        updateLivePreview();
    });

    // Initial preview update
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
