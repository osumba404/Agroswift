jQuery(document).ready(function ($) {
    function initializeImageUpload(buttonClass) {
        $(document).on('click', buttonClass, function (e) {
            e.preventDefault();

            const button = $(this);
            const file_frame = wp.media.frames.file_frame = wp.media({
                title: 'Select or Upload an Image',
                library: { type: 'image' },
                button: { text: 'use these image' },
                multiple: false
            });

            file_frame.on('select', function () {
                const attachment = file_frame.state().get('selection').first().toJSON();
                button.siblings('input[type="hidden"]').val(attachment.id);
                button.siblings('img').attr('src', attachment.url).show();
            });

            file_frame.open();
        });
    }

    $('#submit-slider, .btn.btn-primary[type="submit"]').click(function () {
        $('#slider-form').submit(); // Submit the form
    });

    initializeImageUpload('.upload_image_button');

    // $('#add_slide_button').click(function() {
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
                <label for="slide_image_${slideCount}">Image</label>
                <input type="hidden" id="slide_image_${slideCount}" name="slide_images[]" />
                <img src="" style="max-width: 100px; max-height: 100px; display: none;" />
                <button type="button" class="upload_image_button button btn btn-primary mt-2">Upload Image</button>
            
                <label for="slide_bg_color_${slideCount}">Background Color:</label>
                <input type="color" id="slide_bg_color_${slideCount}" name="slide_bg_color[]" />
            </div>
            <div class="form-group">
                <label for="slide_title_${slideCount}">Title</label>
                <input type="text" id="slide_title_${slideCount}" name="slide_titles[]" class="form-control" placeholder="Enter slide title" />
            </div>
            <div class="form-group">
                <label for="slide_description_${slideCount}">Description</label>
                <textarea id="slide_description_${slideCount}" name="slide_descriptions[]" rows="3" class="form-control" placeholder="Enter slide description"></textarea>
            </div>
            <div class="form-group">
                <label for="slide_thumbnail_image_${slideCount}">Thumbnail Image</label>
                <input type="hidden" id="slide_thumbnail_image_${slideCount}" name="slide_thumbnail_images[]" />
                <img src="" style="max-width: 100px; max-height: 100px; display: none;" />
                <button type="button" class="upload_image_button button btn btn-primary mt-2">Upload Thumbnail Image</button>
            </div>
            <div class="form-group">
                <label for="slide_thumbnail_title_${slideCount}">Thumbnail Title</label>
                <input type="text" id="slide_thumbnail_title_${slideCount}" name="slide_thumbnail_titles[]" class="form-control" placeholder="Enter thumbnail title" />
            </div>
            <div class="form-group">
                <label for="slide_head_tag_${slideCount}">Head Tag</label>
                <input type="text" id="slide_head_tag_${slideCount}" name="slide_head_tags[]" class="form-control" placeholder="Enter head tag" />
            </div>



                <button type="button" class="remove_slide_button btn btn-danger">Remove Slide</button>
                <button type="button" class="add_slide_button" class="btn btn-success">Add Slide</button>
            </div>`;
        $('#slider-slides').append(newSlide);

        // initializeImageUpload('.upload_image_button');
    });

    $(document).on('click', '.remove_slide_button', function () {
        $(this).closest('.slide-container').remove();
    });
});


// for live preview 

jQuery(document).ready(function ($) {
    function updateLivePreview() {
        console.log('Live preview update triggered');
        var slideImageID = $('#slide_image_0').val();
        var slideBgColor = $('#slide_bg_color_0').val();
        var slidePreview = $('.swiper-slide.slide-outer.active');

        if (slideImageID) {
            var attachment = wp.media.attachment(slideImageID);
            attachment.fetch().then(function () {
                if (attachment && attachment.get('url')) {
                    var imageUrl = attachment.get('url');
                    slidePreview.css('background-image', 'url(' + imageUrl + ')');
                    slidePreview.css('background-color', slideBgColor); // Apply the background color
                }
            });
        } else {
            slidePreview.css('background-image', 'url(https://via.placeholder.com/1200x600?text=Default+Image)');
            slidePreview.css('background-color', slideBgColor); // Apply the background color
        }

        var slideTitle = $('#slide_title_0').val();
        $('.content-wrapper .heading').text(slideTitle || 'Slide Title');

        var slideDescription = $('#slide_description_0').val();
        $('.content-wrapper .theme-para').text(slideDescription || 'Slide Description');

        var headTag = $('#slide_head_tag_0').val();
        $('.content-wrapper .offer-tag').text(headTag || 'Head Tag');

        var buttonText = $('#slide_button_text_0').val();
        $('.swiper-slide.active .theme-btn').text(buttonText || 'Button Text');

        var buttonURL = $('#slide_button_url_0').val();
        $('.swiper-slide.active .theme-btn').attr('href', buttonURL || '#');

        var thumbnailImageID = $('#slide_thumbnail_image_0').val();
        var thumbnailPreview = $('.slider-nav .nav-item[data-index="0"] .item-img img');

        if (thumbnailImageID) {
            var thumbnailAttachment = wp.media.attachment(thumbnailImageID);
            thumbnailAttachment.fetch().then(function () {
                if (thumbnailAttachment && thumbnailAttachment.get('url')) {
                    var thumbnailUrl = thumbnailAttachment.get('url');
                    thumbnailPreview.attr('src', thumbnailUrl);
                }
            });
        } else {
            thumbnailPreview.attr('src', 'https://via.placeholder.com/100x100?text=Thumbnail');
        }

        var thumbnailTitle = $('#slide_thumbnail_title_0').val();
        $('.slider-nav .nav-item[data-index="0"] .item-name').text(thumbnailTitle || 'Thumbnail Title');


        //for font size settings live preview

        var fontSize1 = $('#head_font_size').val();
        $('.content-wrapper .offer-tag').css('font-size', fontSize1 + 'px');

        var fontSize2 = $('#heading_font_size').val();
        $('.content-wrapper .heading').css('font-size', fontSize2 + 'px');

        var fontSize3 = $('#banner_font_size').val();
        $('.content-wrapper .theme-para').css('font-size', fontSize3 + 'px');


        var fontSize5 = $('#ov_mini_title_font_size').val();
        $('.nav-item .item-name').css('font-size', fontSize5 + 'px');

    }

    $('#ov_mini_title_font_size , #banner_font_size , #heading_font_size ,#head_font_size ,#slide_image_0, #slide_title_0, #slide_description_0, #slide_head_tag_0, #slide_button_text_0, #slide_button_url_0, #slide_thumbnail_image_0, #slide_thumbnail_title_0 , #slide_bg_color_0').on('input change paste keyup mouseenter oncontextmenu', function () {
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

