jQuery(document).ready(function ($) {

    // $('#add_slide_button').click(function() {
    // $('#slider-slides').on('click', '.add_slide_button', function () {
    // $(document).on('click', '.add_slide_button', function() {
    function addSlide() {

        var index = $('#slider-slides .slide-container').length;

        if (!sliderData.isPremiumUser && index >= sliderData.maxSlides) {
            const proButton = `
                 <div class="go-pro-container text-center mt-3">
                     <button class="btn btn-primary go-pro-button">
                         <a href="https://www.ovationthemes.com/products/ovation-elements-pro" target="_blank" style="color: white; text-decoration: none;">
                             Go Pro to Add More Slides
                         </a>
                     </button>
                 </div>
             `;

            if (!$('.slide-container').eq(index - 1).find('.go-pro-container').length) {
                $('.slide-container').eq(index - 1).append(proButton);
            }
            return;
        }

        //  for vedio upload
        function bindVideoUpload() {
            $(".video-upload-btn").off("click").on("click", function (e) {
                e.preventDefault();
                var button = $(this);
                var targetInput = $("#" + button.data("target"));

                var frame = wp.media({
                    title: "Upload or Select Video",
                    library: { type: "video" },
                    button: { text: "Use this video" },
                    multiple: false
                });

                frame.on("select", function () {
                    var attachment = frame.state().get("selection").first().toJSON();
                    targetInput.val(attachment.url);
                });

                frame.open();
            });
        }

        bindVideoUpload(); // Bind for existing elements
        //end

        $.ajax({
            url: ova_elems_template_script.ajaxurl,
            type: 'POST',
            data: {
                action: 'ova_elems_get_posts_for_slider'
            },
            success: function (response) {
                var newSlideHtml = `
                     <div class="slide-container mb-4 p-3 border rounded" data-index="${index}">
                         <h3>Slide ${index + 1}</h3>
                         <div class="form-group">
                             <label for="select_post_${index}">Select Post</label>
                             <select id="select_post_${index}" name="selected_posts[]" class="form-control">
                                 ${response}
                             </select>
                         </div>
 
                         <div class="form-group">
                           <label for="button_text_${index}">Button Text</label>
                           <input type="text" id="button_text_${index}" name="button_data[${index}][text]" class="form-control" placeholder="Enter button text" />
                         </div>
                         <div class="form-group">
                             <label for="button_url_${index}">Button URL</label>
                             <input type="url" id="button_url_${index}" name="button_data[${index}][url]" class="form-control" placeholder="Enter button URL" />
                         </div>
                         
                         <div class="form-group">
                             <label for="button2_text_${index}">Button2 Text</label>
                             <input type="text" id="button2_text_${index}" name="button_data[${index}][text2]" class="form-control" placeholder="Enter button2 text" />
                         </div>
                         <div class="form-group">
                             <label for="button2_url_${index}">Button2 URL</label>
                             <input type="url" id="button2_url_${index}" name="button_data[${index}][url2]" class="form-control" placeholder="Enter button2 URL" />
                         </div>
                         
                         <div class="form-group">
                             <label for="tour_info_${index}">Tour Info</label>
                             
                             <textarea id="tour_info_${index}" name="tour_info_data[${index}]" class="form-control" rows="2"></textarea>


                         </div>
 
                         
                         <div class="form-group">
                             <label for="uploaded_video_${index}">Upload Video</label>
                             <input type="text" id="uploaded_video_${index}" name="video_data[${index}][upload_video]" class="form-control video-upload-url" placeholder="Enter video URL" />
                             <button type="button" class="button video-upload-btn" data-target="uploaded_video_${index}">Upload</button>
                         </div>
 
                         
                             <button type="button" class="remove_slide_button btn btn-danger">Remove Slide</button>
                             <button type="button" class="add_slide_button" class="btn btn-success">Add Slide</button>
                         </div>
 
                         </div>
 
                     
                 `;
                $('#slider-slides').append(newSlideHtml);
                bindVideoUpload();
            }
        });
        // });
    }

    // addSlide();

    // Optionally, you can still keep the manual add button functionality
    $('#slider-slides').on('click', '.add_slide_button', function () {
        addSlide();
    });

    $('#submit-slider, .btn.btn-primary[type="submit"]').click(function () {
        $('#slider-form').submit(); // Submit the form
    });

    // Remove slide functionality
    $(document).on('click', '.remove_slide_button', function () {
        $(this).closest('.slide-container').remove();
    });


    let mediaUploader;

    $('#upload_minheadimage_button').on('click', function (e) {
        e.preventDefault();

        var mediaUploader = wp.media({
            title: 'Select or Upload an Image',
            button: {
                text: 'Use this Image'
            },
            multiple: false
        });

        mediaUploader.on('select', function () {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            var imageUrl = attachment.url;

            $('#upload_minheadimage').val(imageUrl);

            $('#upload_minheadimage_preview')
                .attr('src', imageUrl)
                .css('display', 'block');

            $('#remove_minheadimage_button').css('display', 'inline-block');


            $('.ovation-head').find('.icon img').attr('src', imageUrl);
        });

        mediaUploader.open();
    });

    $(document).ready(function () {
        // Check if an image URL exists on page load and display it
        var savedImageUrl = $('#ov_client_image').val();
        if (savedImageUrl) {
            $('#ov_client_image_preview_img').attr('src', savedImageUrl).show();
            $('.oe-travel-slider-review-text .icon img').attr('src', savedImageUrl).show();
        }

        // Handle image upload
        $('.upload-image-button').on('click', function (e) {
            e.preventDefault();

            var mediaUploader = wp.media({
                title: 'Select or Upload an Image',
                button: {
                    text: 'Use this Image'
                },
                multiple: false
            });

            mediaUploader.on('select', function () {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                var imageUrl = attachment.url;

                // Set the image preview in the img tag inside #ov_client_image_preview
                $('#ov_client_image_preview_img').attr('src', imageUrl).show();

                // Set the image URL in the input field
                $('#ov_client_image').val(imageUrl);

                // Append the image for live preview inside .icon img
                $('.oe-travel-slider-review-text .icon img').attr('src', imageUrl).show();
            });

            mediaUploader.open();
        });
    });





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

        var ovheadtag = $('#ov_travel_head_tag').val();
        $('.ovtraveltittle').find('.oe-travel-slider-sub-head').text(ovheadtag || 'head');

        var ovtittle = $('#ov_static_title').val();
        $('.oe-travel-slider-banner-heading-box').eq(0).find('.oe-travel-slider-banner-main-head').text(ovtittle || 'tittle');

        var ovdes = $('#static_description').val();
        $('.oe-travel-slider-banner-content-box').eq(0).find('.oe-travel-slider-banner-sec-para').text(ovdes || 'description');

        var buttonText = $('#ov_button_text').val();
        $('.oe-travel-slider-explore-btn').text(buttonText || 'Button Text');

        var slideinfoText = $('#tour_info_0').val();
        $('.oe-travel-slider-post-banner-schedule-text').text(slideinfoText || 'Tour info ');

        var slidebuttonText = $('#button_text_0').val();
        $('.oe-travel-slider-explore-btn').text(slidebuttonText || 'Button Text1');

        var slidebutton2Text = $('#button2_text_0').val();
        $('.oe-travel-slider-appointement-btn').text(slidebutton2Text || 'Button Text2');

        var buttonURL = $('#ov_button_url').val();
        $('.oe-travel-slider-explore-btn').attr('href', buttonURL || '#');



        var ovreview = $('#ov_review_text').val();
        $('.oe-travel-slider-review-text').eq(0).find('.oe-travel-slider-review-count-text').text(ovreview || 'reviewtext');

        var ovreview = $('#ov_template_review_text').val();
        $('.social-media-wrap').eq(0).find('.follow-title').text(ovreview || 'reviewtext');

        // Mini Title and Description 2 Preview
        var ovno = $('#ov_review_no').val();
        $('.oe-travel-slider-review-text').eq(0).find('.oe-travel-slider-review-count').text(ovno || 'reviewno');


        //for font size settings live preview

        //for font size settings live preview

        var fontSize1 = $('#list_title_font_size').val();
        $('.oe-travel-slider-post-banner-outer-box .oe-travel-slider-post-banner-main-head').css('font-size', fontSize1 + 'px');

        var fontSize2 = $('#list_description_font_size').val();
        $('.oe-travel-slider-post-banner-outer-box .oe-travel-slider-post-banner-sec-para').css('font-size', fontSize2 + 'px');

        var fontSize3 = $('#list_content_font_size').val();
        $('.oe-travel-slider-post-banner-outer-box .oe-travel-slider-post-banner-schedule-text').css('font-size', fontSize3 + 'px');

        var fontSize4 = $('#oe_button_font_size').val();
        $('.oe-travel-slider-post-banner-outer-box .oe-travel-slider-explore-btn').css('font-size', fontSize4 + 'px');

        var fontSize444 = $('#oe_button_font_size').val();
        $('.oe-travel-slider-banner-btn-box .oe-travel-slider-explore-btn').css('font-size', fontSize444 + 'px');

        var fontSize44 = $('#oe_button_font_size').val();
        $('.oe-travel-slider-post-banner-outer-box .oe-travel-slider-appointement-btn').css('font-size', fontSize44 + 'px');

        var fontSize5 = $('#title_head_font_size').val();
        $('.oe-travel-slider-post-bg-image .oe-travel-slider-post-sub-head').css('font-size', fontSize5 + 'px');
        //do now from here 

        var fontSize6 = $('#ov_mini_title_font_size').val();
        $('.oe-travel-slider-banner-custom-box .oe-travel-slider-sub-head').css('font-size', fontSize6 + 'px');


        var fontSize7 = $('#ov_mini_title_right_font_size').val();
        $('.oe-travel-slider-banner-custom-box .oe-travel-slider-banner-main-head').css('font-size', fontSize7 + 'px');

        var fontSize8 = $('#ov_mini_description_font_size').val();
        $('.oe-travel-slider-banner-custom-box .oe-travel-slider-banner-sec-para').css('font-size', fontSize8 + 'px');

        var fontSize12 = $('#review_text_font_size').val();
        $('.oe-travel-slider-review-text .oe-travel-slider-review-count-text').css('font-size', fontSize12 + 'px');

        var fontSize13 = $('#review_no_font_size').val();
        $('.oe-travel-slider-review-text .oe-travel-slider-review-count').css('font-size', fontSize13 + 'px');



        var fontSize9 = $('#thmhead_font_size').val();
        $('.oe-travel-slider-carousel-post-box .oe-travel-slider-carousel-post-sub-head').css('font-size', fontSize9 + 'px');

        var fontSize10 = $('#thmbtitle_font_size').val();
        $('.oe-travel-slider-carousel-post-box .oe-travel-slider-carousel-post-banner-main-head').css('font-size', fontSize10 + 'px');



        var fontSize11 = $('#thmbdesc_font_size').val();
        $('.oe-travel-slider-carousel-post-box .oe-travel-slider-carousel-post-banner-sec-para').css('font-size', fontSize11 + 'px');

        var fontSize12 = $('#ov_review_text_font_size').val();
        $('.social-media-wrap .follow-title').css('font-size', fontSize6 + 'px');


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
        $('.oe-restaurant-slider-explore-btn').css('background-color', buttonBgColor);

        var buttonTextColor = $('#button_text_color').val();
        $('.oe-travel-slider-appointement-btn').css('color', buttonTextColor);



        var buttonTextColor = $('#button_text_color').val();
        $('.oe-travel-slider-explore-btn').css('color', buttonTextColor);

        var buttonBgColor = $('#button_bg_color').val();
        $('.oe-travel-slider-banner-btn-box .oe-travel-slider-explore-btn').css('background-color', buttonBgColor);

        var buttonTextColor = $('#button_text_color').val();
        $('.oe-travel-slider-banner-btn-box .oe-travel-slider-explore-btn').css('color', buttonTextColor);



        // New for Button Hover Background Color
        var buttonHoverBgColor = $('#button_hover_bg_color').val();
        var buttonHoverTextColor = $('#button_hover_text_color').val();

        // Remove older
        $('#button-hover-bg-style').remove();

        // Add new hover
        if (buttonHoverBgColor) {
            var hoverStyle = `
               <style id="button-hover-bg-style">
                .oe-travel-slider-main-box_travel_tour .oe-travel-slider-post-bg-image .oe-travel-slider-banner-btn-box a:hover {
                    background-color: ${buttonHoverBgColor} !important;
                       color: ${buttonHoverTextColor} !important;
                }

               </style>
           `;
            $('head').append(hoverStyle);
        }
        //end
    }

    $('#ov_review_text_font_size, #thmbdesc_font_size ,#thmbtitle_font_size, #review_no_font_size, #review_text_font_size, #ov_mini_description_font_size, #ov_mini_title_right_font_size, #ov_mini_title_font_size, #title_head_font_size,#oe_button_font_size, #list_content_font_size , #list_description_font_size, #list_title_font_size, #upload_minheadimage, #ov_travel_head_tag, #ov_static_title, #button_text_0, #button2_text_0, #tour_info_0, #static_description, #ov_button_text, #ov_button_url, #ov_review_text, #ov_review_no , .social_icon_active_color , .static-container , #advanced-settings , .plugin_output_content')

        .on('input change paste keyup mouseenter oncontextmenu', function () {
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


jQuery(document).ready(function ($) {
    $('.video-upload-btn').click(function (e) {
        e.preventDefault();
        var button = $(this);
        var targetInput = $('#' + button.data('target'));

        var frame = wp.media({
            title: 'Select or Upload Video',
            library: { type: 'video' },
            button: { text: 'Use this video' },
            multiple: false
        });

        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();
            targetInput.val(attachment.url);
        });

        frame.open();
    });
});



