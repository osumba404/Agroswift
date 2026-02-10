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

    // new for upload bg image 

    // ended here 
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

    //add for vedio 
    $('.upload_video_button').on('click', function (e) {
        e.preventDefault();

        var videoUploader;
        var $videoInput = $('#slide_video_url');
        var $videoPreview = $('#uploaded_video_preview');

        // Check if the uploader already exists
        if (videoUploader) {
            videoUploader.open();
            return;
        }

        // Create a new media uploader
        videoUploader = wp.media({
            title: 'Select a Video',
            button: {
                text: 'Use this video'
            },
            library: {
                type: 'video'
            },
            multiple: false
        });

        // When a video is selected
        videoUploader.on('select', function () {
            var attachment = videoUploader.state().get('selection').first().toJSON();

            // Update hidden input value
            $videoInput.val(attachment.url);

            // Update video preview
            $videoPreview.find('source').attr('src', attachment.url);
            $videoPreview[0].load();
            $videoPreview.show();
        });

        // Open the uploader
        videoUploader.open();
    });

    //end 

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
            
                <label for="slide_bg_color_${slideCount}">Background Color:</label>
                <input type="color" id="slide_bg_color_${slideCount}" name="slide_bg_color[]" />
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
                <label for="slide_mini_head_image_${slideCount}">Head Tag Image :</label>
                <input type="hidden" id="slide_mini_head_image_${slideCount}" name="slide_mini_head_images[]" />
                <img src="" style="max-width: 100px; max-height: 100px; display: none;" />
                <button type="button" class="upload_image_button button mt-2">Upload Mini Head Tag Image</button>
            </div> 
            <div class="form-group">
                <label for="slide_button_text_${slideCount}">Button Text:</label>
                <input type="text" id="slide_button_text_${slideCount}" name="slide_button_texts[]" class="form-control" placeholder="Enter button text" />
            </div>
            <div class="form-group">
                <label for="slide_button_url_${slideCount}">Button URL:</label>
                <input type="url" id="slide_button_url_${slideCount}" name="slide_button_urls[]" class="form-control" placeholder="Enter button URL" />
            </div>
            
            <div class="form-group">
                <label for="slide_button2_text_${slideCount}">Button Text 2:</label>
                <input type="text" id="slide_button2_text_${slideCount}" name="slide_button2_texts[]" class="form-control" placeholder="Enter second button text" />
            </div>
            <div class="form-group">
                <label for="slide_button2_url_${slideCount}">Button URL 2:</label>
                <input type="url" id="slide_button2_url_${slideCount}" name="slide_button2_urls[]" class="form-control" placeholder="Enter second button URL" />
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

jQuery(document).on('click', '.minihead_upload_image_button', function (e) {
    e.preventDefault();
    let button = jQuery(this);
    let inputField = button.siblings('input[type="hidden"]');
    let imgPreview = button.siblings('img');

    let customUploader = wp.media({
        title: 'Select Image',
        button: {
            text: 'Use Image'
        },
        multiple: false
    })
        .on('select', function () {
            let attachment = customUploader.state().get('selection').first().toJSON();
            inputField.val(attachment.url);
            imgPreview.attr('src', attachment.url).show();
        })
        .open();
});



// for live preview 

jQuery(document).ready(function ($) {
    function updateLivePreview() {
        console.log('Live preview update triggered');
        var slideImageID = $('#slide_image_0').val();
        var slideBgColor = $('#slide_bg_color_0').val();
        var previewSlideImage = $('.oe-restaurant-slider-bg-image');

        if (slideImageID) {
            var attachment = wp.media.attachment(slideImageID);
            attachment.fetch().then(function () {
                if (attachment && attachment.get('url')) {
                    var imageUrl = attachment.get('url');

                    if (previewSlideImage) {
                        previewSlideImage.css('background-image', 'url(' + imageUrl + ')');
                        previewSlideImage.css('background-color', slideBgColor); // Apply the background color
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
                previewSlideImage.css('background-color', slideBgColor);
            }
        }

        var headTag = $('#slide_head_tag_0').val();
        $('.oe-restaurant-slider-sub-head').text(headTag || 'New Arrival');



        var title = $('#slide_title_0').val();
        $('.oe-restaurant-slider-banner-heading-box .oe-restaurant-slider-banner-main-head ').text(title || 'Slide Title');

        var description = $('#slide_description_0').val();
        $('.oe-restaurant-slider-banner-sec-para ').text(description || 'Slide description goes here.');
        var buttonText = $('#slide_button_text_0').val();
        $('.oe-restaurant-slider-explore-btn').text(buttonText || 'Button Text');

        var buttonText = $('#slide_button2_text_0').val();
        $('.oe-restaurant-slider-appointement-btn').text(buttonText || 'Button Text');

        var buttonURL = $('#slide_button_url_0').val();
        $('.oe-restaurant-slider-explore-btn').attr('href', buttonURL || '#');

        var buttonURL = $('#slide_button2_url_0').val();
        $('.oe-restaurant-slider-appointement-btn .theme-btn').attr('href', buttonURL || '#');

        var miniTitle = $('#slide_mini_title_0').val();
        $('.oe-restaurant-slider-address-box').eq(0).find('.oe-restaurant-slider-address-title').text(miniTitle || '');

        var miniDescription = $('#slide_mini_description_0').val();
        $('.oe-restaurant-slider-address-box').eq(0).find('.oe-restaurant-slider-address-para').text(miniDescription || '.');

        var miniTitle2 = $('#slide_mini_title2_0').val();
        $('.oe-restaurant-slider-call-box').eq(0).find('.oe-restaurant-slider-call-title').text(miniTitle2 || 'Mini Title 2');

        var miniDescription = $('#slide_no').val();
        $('.oe-restaurant-slider-call-box').eq(0).find('.oe-restaurant-slider-call-para').text(miniDescription || 'number');

        var review = $('#ov_template_review_text').val();
        $('.oe-restaurant-slider-review-text').find('.oe-restaurant-slider-review-count-text').text(review || 'review text');

        var reviewno = $('#ov_template_review_no').val();
        $('.oe-restaurant-slider-review-text').eq(0).find('.oe-restaurant-slider-review-count').text(reviewno || 'no');

        var listtittle = $('#list_title').val();
        $('.oe-restaurant-slider-special-box').eq(0).find('.oe-restaurant-slider-special-title').text(listtittle || '');

        var listdes = $('#list_description').val();
        $('.oe-restaurant-slider-special-box').find('.oe-restaurant-slider-special-text').text(listdes || '');


        var enterList = $('#enter_list').val();
        if (enterList) {
            var listItems = enterList.split(',').map(function (item) {
                return item.trim();
            });

            var listHtml = '';
            listItems.forEach(function (item) {
                listHtml += '<li>' + item + '</li>';
            });
            $('.oe-restaurant-slider-special-points-box ul').html(listHtml);
        } else {
            $('.oe-restaurant-slider-special-points-box ul').html('<li>No items listed</li>');
        }

        var miniTitle2 = $('#slide_mini_title2_0').val();
        $('.oe-restaurant-slider-call-box').eq(0).find('.oe-restaurant-slider-call-title').text(miniTitle2 || '');

        var miniImage1 = $('#slide_mini_head_image_0').val();
        if (miniImage1) {
            $('.oe-restaurant-slider-icon').eq(0).find('.icon img').attr('src', wp.media.attachment(miniImage1).get('url'));
        }

        var miniImage2 = $('#slide_mini_image_2_0').val();
        if (miniImage2) {
            $('.information-card').eq(1).find('.icon img').attr('src', wp.media.attachment(miniImage2).get('url'));
        }

        var ovclientimage = $('#slide_corner_images_0').val();
        if (ovclientimage) {
            $('.oe-restaurant-slider-review-image').eq(0).find('.icon img').attr('src', wp.media.attachment(ovclientimage).get('url'));
        }

        //for font size settings live preview

        var fontSize1 = $('#head_font_size').val();
        $('.oe-restaurant-slider-banner-content-box .oe-restaurant-slider-sub-head').css('font-size', fontSize1 + 'px');

        var fontSize2 = $('#heading_font_size').val();
        $('.oe-restaurant-slider-banner-content-box .oe-restaurant-slider-banner-main-head').css('font-size', fontSize2 + 'px');

        var fontSize3 = $('#banner_font_size').val();
        $('.oe-restaurant-slider-banner-content-box .oe-restaurant-slider-banner-sec-para').css('font-size', fontSize3 + 'px');

        var fontSize4 = $('#button_font_size').val();
        $('.oe-restaurant-slider-banner-content-box .oe-restaurant-slider-explore-btn').css('font-size', fontSize4 + 'px');

        var fontSize5 = $('#ov_mini_title_font_size').val();
        $('.oe-restaurant-slider-address-box .oe-restaurant-slider-address-title').css('font-size', fontSize5 + 'px');

        var fontSize6 = $('#mini_description_font_size').val();
        $('.oe-restaurant-slider-address-box .oe-restaurant-slider-address-para').css('font-size', fontSize6 + 'px');


        var fontSize7 = $('#ov_mini_title_font_size').val();
        $('.oe-restaurant-slider-call-box .oe-restaurant-slider-call-title').css('font-size', fontSize7 + 'px');

        var fontSize8 = $('#mini_description_font_size').val();
        $('.oe-restaurant-slider-call-box .oe-restaurant-slider-call-para').css('font-size', fontSize8 + 'px');



        var fontSize9 = $('#list_title_font_size').val();
        $('.oe-restaurant-slider-special-box .oe-restaurant-slider-special-title').css('font-size', fontSize9 + 'px');

        var fontSize10 = $('#list_description_font_size').val();
        $('.oe-restaurant-slider-special-box .oe-restaurant-slider-special-text').css('font-size', fontSize10 + 'px');



        var fontSize11 = $('#list_content_font_size').val();
        $('.oe-restaurant-slider-special-points-box ul li').css('font-size', fontSize11 + 'px');


        var fontSize12 = $('#review_text_font_size').val();
        $('.oe-restaurant-slider-review-text .oe-restaurant-slider-review-count-text').css('font-size', fontSize12 + 'px');

        var fontSize13 = $('#review_no_font_size').val();
        $('.oe-restaurant-slider-review-text .oe-restaurant-slider-review-count').css('font-size', fontSize13 + 'px');



        var buttonBgColor = $('#button_bg_color').val();
        $('.oe-restaurant-slider-banner-btn-box .oe-restaurant-slider-explore-btn').css('background-color', buttonBgColor);

        var buttonTextColor = $('#button_text_color').val();
        $('.oe-restaurant-slider-banner-btn-box .oe-restaurant-slider-explore-btn').css('color', buttonTextColor);

        var buttonBgColor = $('#button_bg_color').val();
        $('.oe-restaurant-slider-banner-btn-box .oe-restaurant-slider-appointement-btn').css('background-color', buttonBgColor);

        var buttonTextColor = $('#button_text_color').val();
        $('.oe-restaurant-slider-banner-btn-box .oe-restaurant-slider-appointement-btn').css('color', buttonTextColor);


        // New for Button Hover Background Color
        var buttonHoverBgColor = $('#button_hover_bg_color').val();
        var buttonHoverTextColor = $('#button_hover_text_color').val();

        // Remove older
        $('#button-hover-bg-style').remove();

        // Add new hover
        if (buttonHoverBgColor) {
            var hoverStyle = `
                <style id="button-hover-bg-style">
                .oe-restaurant-slider-banner-btn-box .oe-restaurant-slider-explore-btn .a:hover {
                        
                        background-color: ${buttonHoverBgColor} !important;
                        color: ${buttonHoverTextColor} !important;
                    }

                    .oe-restaurant-slider-explore-btn:hover {
                        background-color: ${buttonHoverBgColor} !important;
                        color: ${buttonHoverTextColor} !important;
                    }

                    .oe-restaurant-slider-banner-btn-box .oe-restaurant-slider-appointement-btn .a:hover {
                        
                        background-color: ${buttonHoverBgColor} !important;
                        color: ${buttonHoverTextColor} !important;
                    }

                    .oe-restaurant-slider-appointement-btn:hover {
                        background-color: ${buttonHoverBgColor} !important;
                        color: ${buttonHoverTextColor} !important;
                    }

                </style>
            `;
            $('head').append(hoverStyle);
        }
        //end


    }
    $('#review_no_font_size, #review_text_font_size, #list_content_font_size, #list_description_font_size, #list_title_font_size, #mini_description_font_size, #ov_mini_title_font_size ,#mini_description_font_size ,#ov_mini_title_font_size ,#button_font_size, #banner_font_size ,#heading_font_size ,#head_font_size ,#slide_image_0, #slide_title_0, #slide_description_0, #slide_head_tag_0, #slide_button_text_0, #slide_button_url_0, #slide_mini_title_0, #slide_mini_description_0, #slide_mini_title2_0, #slide_mini_description2_0, #slide_email, #slide_no, #slide_mini_image_1_0, #slide_mini_image_2_0, #slide_corner_images_0 , #slide_bg_color_0 , #ov-imp-client , .static-container, #advanced-settings ').on('input change paste keyup mouseenter oncontextmenu', function () {
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

//vedio bg img
jQuery(document).ready(function ($) {
    $('.upload_video_bg_image').click(function (e) {
        e.preventDefault();

        var frame = wp.media({
            title: 'Select or Upload Video Background Image',
            button: { text: 'Use this image' },
            multiple: false
        });

        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();
            $('#video_bg_image').val(attachment.url);
            $('#video_bg_preview').html('<img src="' + attachment.url + '" width="100" height="auto">');
        });

        frame.open();
    });
});
