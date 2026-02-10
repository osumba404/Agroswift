jQuery(document).ready(function ($) {

    function addSlide() {
        var index = $('#slider-slides .slide-container').length;

        // Check if the user is free and has reached the max slides limit
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
            return; // Stop further execution if limit is reached
        }

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
                        <button type="button" class="remove_slide_button btn btn-danger">Remove Slide</button>
                        <button type="button" class="add_slide_button btn btn-secondary">Add Slide</button>
                    </div>
                `;
                $('#slider-slides').append(newSlideHtml);
            }
        });
    }

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