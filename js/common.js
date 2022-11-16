$(document).ready(function () {

    // Toggle Navigation here
    $('.toggle').click(function() {
        $('.nav-mobile').toggleClass('menu-toggle');
        $('body').toggleClass('overflow-hidden');
    });
    
    $(document).on('click', function(e) {
        let target = e.target.closest('.toggle-action');
        if(target) {
            $('.floating-widget').toggleClass('openup');
        } else {
            $('.floating-widget').removeClass('openup');
        }
    });

    if ($('.owl-carousel')[0]) {
        $(".owl-carousel").owlCarousel({
            items : 3,
            margin: 30,
            loop: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 1500,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1,
                    margin: 0,
                },
                576: {
                    items: 2.6,
                    margin: 20,
                },
                769: {
                    items: 3,
                    margin: 20,
                }
            }
        });

        $('.popup-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true
            },
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 300,
                opener: function(element) {
                    return element.find('img');
                }
            }
        });
    }


    if($('.gallery')[0]) {
        setTimeout(function() {
            $.getJSON('json/data.json', function(data) {
                const result = data.gallery_images;
                
                $.each(result, function (indexInArray, valueOfElement) {
                    $(".gallery").prepend(`
                        <a href='images/gallery/${valueOfElement.name}' class='small'>
                            <img src='images/gallery/thumb/${valueOfElement.name}' class='lazy' alt='${valueOfElement.name}'>
                        </a>
                    `);
                });
                $('.loader').removeClass('d-flex').addClass('d-none');
                var gallery = $('.gallery a').simpleLightbox({
                    overlay: true,
                    captions: false,
                    animationSpeed: 200,
                    fileExt:'png|jpg|jpeg|gif',
                    enableKeyboard:true,
                    loop: true,
                    rel: false,
                });
            });
        }, 1500);
    }

    if($('.plans')[0]) {
        var plans = $('.plans a').simpleLightbox({
            overlay: true,
            captions: false,
            animationSpeed: 200,
            enableKeyboard:true,
            loop: true,
            rel: false,
        });
    }


    // $.ajax({
    //     url: "./images/gallery/",
    //     success: function(data){
    //         let elementLength = $(data).find("a:contains(.jpg)").length;
    //        $(data).find("a:contains(.jpg)").each(function(){
    //            var filename = this.textContent;
    //           $(".gallery").prepend(`
    //             <a href='images/gallery/${filename}' class='small'>
    //               <img src='images/gallery/${filename}' class='lazy' alt='${filename}'>
    //             </a>
    //           `);
    //        });
    //        var gallery = $('.gallery a').simpleLightbox({
    //            overlay: true,
    //            captions: false,
    //            animationSpeed: 200,
    //            fileExt:'png|jpg|jpeg|gif',
    //            enableKeyboard:true,
    //            loop: true,
    //            rel: false,
    //        });
    //     }
    // });

    // $(function() {
    //     setTimeout(function() {
    //         $('img.lazy').lazy({
    //             bind: 'event',
    //             afterLoad: function(event) {
    //                 console.log(event);
    //                 console.log('asasd');
    //             }
    //         });
    //     }, 5000);  
    // })
    // var gallery = $('.gallery a').simpleLightbox({
    //     overlay: true
    // });
});