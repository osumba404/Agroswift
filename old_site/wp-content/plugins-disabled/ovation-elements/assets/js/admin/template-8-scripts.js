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

    //new add above 
    $('#submit-slider, .btn.btn-primary[type="submit"]').click(function (event) {
        var form = $('#slider-form')[0];  // Get the form element

        if (form.checkValidity()) {
            $('#slider-form').submit();
        } else {
            event.preventDefault();
            form.reportValidity();
        }
    });


    //end

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

        if (videoUploader) {
            videoUploader.open();
            return;
        }

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

        videoUploader.on('select', function () {
            var attachment = videoUploader.state().get('selection').first().toJSON();
            $videoInput.val(attachment.url);
            $videoPreview.find('source').attr('src', attachment.url);
            $videoPreview[0].load();
            $videoPreview.show();
        });

        // Open the uploader
        videoUploader.open();
    });

    //end 

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

        // Generate course options dynamically
        let courseOptions = `<option value="">Select a course</option>`;
        if (Array.isArray(localizedCourses)) {
            localizedCourses.forEach(course => {
                courseOptions += `<option value="${course.id}">${course.title}</option>`;
            });
        }

        const newSlide = `
            <div class="slide-container mb-4 p-3 border rounded" data-index="${slideCount}">
                <h3>Slide ${slideCount + 1}</h3>
                
                <div class="form-group">
                    <label for="slide_title_${slideCount}">Title:</label>
                    <input type="text" id="slide_title_${slideCount}" name="slide_titles[]" class="form-control" required placeholder="Enter the title "/>
                </div>
    
                <div class="form-group">
                    <label for="slide_course_${slideCount}">Select Course:</label>
                    <select id="slide_course_${slideCount}" name="slide_courses[]" class="form-control">
                        ${courseOptions}
                    </select>
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


// live preview code start


jQuery(document).ready(function ($) {
    function updateLivePreview() {
        console.log('Live preview update triggered');
        var slideImageID = $('#slide_image_0').val();
        var previewSlideImage = $('.oe-restaurant-slider-bg-image');

        if (slideImageID) {
            var attachment = wp.media.attachment(slideImageID);
            attachment.fetch().then(function () {
                if (attachment && attachment.get('url')) {
                    var imageUrl = attachment.get('url');
                    if (previewSlideImage) {
                        previewSlideImage.css('background-image', 'url(' + imageUrl + ')');
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

        var miniImage1 = $('#slide_mini_image_1_0').val();
        if (miniImage1) {
            $('.oe-education-slider-rating-img-box').eq(0).find('.ov_img').attr('src', wp.media.attachment(miniImage1).get('url'));
        }

        // Button Text Preview
        var ovrtext = $('#slide_mini_title_0').val();
        $('.oe-education-slider-rating-text').text(ovrtext || 'Satisfaction');

        var ovheadtag = $('#slide_mini_title2_0').val();
        $('.oe-education-slider-sub-head').text(ovheadtag || 'head');

        var ovstathead = $('#ov_static_title').val();
        $('.oe-education-slider-banner-heading-box').eq(0).find('.oe-education-slider-banner-main-head').text(ovstathead || 'tittle');

        // Mini Title and Description 2 Preview
        var ovlisttitle = $('#list_title').val();
        $('.oe-education-slider-banner-heading-box').eq(0).find('.oe-education-slider-banner-main-head').text(ovlisttitle || '');

        // Button Text Preview
        var ovlistdes = $('#list_description').val();
        $('.oe-education-slider-banner-sec-para').text(ovlistdes || 'description');


        var enterList = $('#enter_list').val();
        if (enterList) {
            var listItems = enterList.split(',').map(function (item) {
                return item.trim();
            });

            var listHtml = '';
            listItems.forEach(function (item, index) {
                if (index % 2 === 0) {
                    listHtml += '<div class="col-lg-6"><i class="fa fa-check me-3"></i><span class="oe-education-slider-banner-point-text">' + item + '</span></div>';
                } else {
                    listHtml += '<div class="col-lg-12"><i class="fa fa-check me-3"></i><span class="oe-education-slider-banner-point-text">' + item + '</span></div>';
                }
            });
            var finalHtml = '<div class="row oe-education-slider-banner-points">' + listHtml + '</div>';

            $('.oe-education-slider-banner-points').html(finalHtml);
        } else {
            $('.oe-education-slider-banner-points').html('<div class="col-lg-12"><i class="fa fa-check me-3"></i><span class="oe-education-slider-banner-point-text">No items listed</span></div>');
        }




        var ovreview = $('#ov_template_review_text').val();
        $('.oe-education-slider-followers-img-box').eq(0).find('.oe-education-slider-followers-text').text(ovreview || 'reviewtext');


        var ovno = $('#ov_template_review_no').val();
        $('.oe-education-slider-followers-count').text(ovno || '800');

        var miniImage2 = $('#slide_corner_images_0').val();
        if (miniImage2) {
            $('.oe-education-slider-post-side-box').find('.ov-right-img').attr('src', wp.media.attachment(miniImage2).get('url'));
        }

        // Button Text Preview
        var ovstatbutton = $('#static_button_text').val();
        $('.oe-education-slider-explore-btn').text(ovstatbutton || 'Text ');


        // Button Text Preview
        var ovstatbutton2 = $('static_button2_text').val();
        $('.oe-education-slider-appointement-btn').text(ovstatbutton2 || 'Button Text2');

        var ovloader = $('static_loader_percentage').val();
        $('.oe-travel-slider-appointement-btn').text(ovloader || 'Button Text2');


        //for font size settings live preview

        var fontSize1 = $('#title_head_font_size').val();
        $('.oe-education-slider-banner-content-box .oe-education-slider-sub-head').css('font-size', fontSize1 + 'px');

        var fontSize2 = $('#list_title_font_size').val();
        $('.oe-education-slider-banner-content-box .oe-education-slider-banner-main-head').css('font-size', fontSize2 + 'px');

        var fontSize3 = $('#list_description_font_size').val();
        $('.oe-education-slider-banner-content-box .oe-education-slider-banner-sec-para').css('font-size', fontSize3 + 'px');

        var fontSize4 = $('#list_content_font_size').val();
        $('.oe-education-slider-banner-content-box .oe-education-slider-banner-point-text').css('font-size', fontSize4 + 'px');

        var fontSize5 = $('#static_button_text_font_size').val();
        $('.oe-education-slider-banner-content-box .oe-education-slider-explore-btn').css('font-size', fontSize5 + 'px');

        var fontSize55 = $('#static_button_text_font_size').val();
        $('.oe-education-slider-banner-content-box .oe-education-slider-appointement-btn').css('font-size', fontSize55 + 'px');


        var fontSize12 = $('#review_text_font_size').val();
        $('.oe-education-slider-followers-content-box .oe-education-slider-followers-text').css('font-size', fontSize12 + 'px');

        var fontSize13 = $('#review_no_font_size').val();
        $('.oe-education-slider-followers-content-box .oe-education-slider-followers-count').css('font-size', fontSize13 + 'px');

        var fontSize6 = $('#ov_mini_title_font_size').val();
        $('.oe-education-slider-rating-img-box .oe-education-slider-rating-text').css('font-size', fontSize6 + 'px');

        //new css
        var socialIconColor = $('#social_icon_active_color').val();
        $('.e-education-slider-bg-image_edu .oe-education-slider-content-outer-box .oe-education-slider-video-rating-content-box .oe-education-slider-followers-content-box .oe-education-slider-social-icon-box .oe-icons-container a i').css('color', socialIconColor); // Update the icon color


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

                    .e-education-slider-bg-image_edu .oe-education-slider-content-outer-box .oe-education-slider-video-rating-content-box .oe-education-slider-followers-content-box .oe-education-slider-social-icon-box .oe-icons-container a i {
                        background: #000;
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
        $('.oe-education-slider-banner-btn-box .oe-education-slider-explore-btn').css('background-color', buttonBgColor);

        var buttonTextColor = $('#button_text_color').val();
        $('.oe-education-slider-banner-btn-box .oe-education-slider-explore-btn').css('color', buttonTextColor);

        var buttonBgColor = $('#button_bg_color').val();
        $('.oe-education-slider-banner-btn-box .oe-education-slider-appointement-btn').css('background-color', buttonBgColor);

        var buttonTextColor = $('#button_text_color').val();
        $('.oe-education-slider-banner-btn-box .oe-education-slider-appointement-btn').css('color', buttonTextColor);


        // New for Button Hover Background Color
        var buttonHoverBgColor = $('#button_hover_bg_color').val();
        var buttonHoverTextColor = $('#button_hover_text_color').val();

        // Remove older
        $('#button-hover-bg-style').remove();

        // Add new hover
        if (buttonHoverBgColor) {
            var hoverStyle = `
               <style id="button-hover-bg-style">
               .oe-education-slider-banner-btn-box .oe-education-slider-appointement-btn .a:hover {
                       
                       background-color: ${buttonHoverBgColor} !important;
                       color: ${buttonHoverTextColor} !important;
                   }

                   .oe-education-slider-appointement-btn:hover {
                       background-color: ${buttonHoverBgColor} !important;
                       color: ${buttonHoverTextColor} !important;
                   }

                   .oe-education-slider-banner-btn-box .oe-education-slider-explore-btn .a:hover {
                       
                    background-color: ${buttonHoverBgColor} !important;
                    color: ${buttonHoverTextColor} !important;
                }

                .oe-education-slider-explore-btn:hover {
                    background-color: ${buttonHoverBgColor} !important;
                    color: ${buttonHoverTextColor} !important;
                }

               </style>
           `;
            $('head').append(hoverStyle);
        }
        //end

        //end


    }


    // Bind the live preview update function to the new set of form input changes
    $('#ov_mini_title_font_size, #review_no_font_size, #review_text_font_size, #static_button_text_font_size, #list_content_font_size , #list_description_font_size, #list_title_font_size ,#title_head_font_size , #upload_minheadimage, #ov_travel_head_tag, #ov_static_title, #button_text_0, #button2_text_0, #tour_info_0, #static_description, #ov_button_text, #ov_button_url, #ov_review_text, #ov_review_no , #slide_mini_title_0 , #slide_mini_image_1_0 ,#slide_mini_title2_0 , #enter_list ,#ov_template_review_no , .social_icon_active_color , .static-container , #advanced-settings , .plugin_output_content')

        .on('input change paste keyup mouseenter oncontextmenu', function () {
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


//for tutor plugin 
jQuery(document).ready(function ($) {
    $('#tutor-action-button').on('click', function () {
        const action = $(this).data('action');
        const button = $(this);

        if (!action) return;

        button.prop('disabled', true).text('Processing...');

        $.post(ajax_object.ajax_url, {
            action: 'tutor_plugin_action',
            action_type: action,
            nonce: ajax_object.nonce,
        })
            .done(function (response) {
                let message = "An error occurred";
                try {
                    response = JSON.parse(response);
                    message = response.message || message; //  JSON 
                } catch (e) {
                    // HTML
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = response;
                    const messageElement = tempDiv.querySelector('p:last-of-type');
                    if (messageElement) {
                        message = messageElement.textContent.trim();
                    }
                }

                // Show the relevant message in an alert
                alert(message);
                location.reload();

                // Handle success or failure actions
                if (response.success) {
                    if (response.is_active) {
                        button.text('Tutor LMS Activated').prop('disabled', true);
                    }
                    location.reload();
                } else {
                    button.prop('disabled', false).text(action === 'install' ? 'Install Tutor LMS' : 'Activate Tutor LMS');
                }
            })

            .fail(function () {
                alert('An error occurred. Please try again.');
                button.prop('disabled', false).text(action === 'install' ? 'Install Tutor LMS' : 'Activate Tutor LMS');
            });
    });
});

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


//upload bg image for all slider 

jQuery(document).ready(function ($) {
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
            $('#bg_slide_image').val(attachment.url);

            // Update the preview image dynamically
            if ($('.preview-bg-slide-image img').length) {
                $('.preview-bg-slide-image img').attr('src', attachment.url);
            } else {
                $('.preview-bg-slide-image').remove(); // Remove old div if needed
                $('#bg_slide_image').after('<div class="preview-bg-slide-image" style="margin-top: 10px;"><img src="' + attachment.url + '" style="max-width: 150px; height: auto; border: 1px solid #ddd; padding: 5px;"></div>');
            }
        });
        imageFrame.open();
    });
});