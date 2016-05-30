 $(document).ready(function () {
            // Show or hide the sticky footer button
            $(window).scroll(function () {
                if ($(this).scrollTop() > 200) {
                    $('.flecha-top').fadeIn(200);
                } else {
                    $('.flecha-top').fadeOut(200);
                }
            });

            // Animate the scroll to top
            $('.flecha-top').click(function (event) {
                event.preventDefault();

                $('html, body').animate({scrollTop: 0}, 300);
            })
        });

