// RenderBullet function
function renderBullet(index, className) {
    console.log(qc_engagement_obj.postTitles[index]);
    var slideIndex = index,
        number = (index <= 8) ? '0' + (slideIndex + 1) : (slideIndex + 1);

    var paginationItem = '<span class="slideshow-pagination-item">';
    paginationItem += '<span class="pagination-number">' + qc_engagement_obj.postTitles[index] + '<i class="fa-solid fa-arrow-right"></i></span>';
    paginationItem = (index <= 8) ? paginationItem + '<span class="pagination-separator"><span class="pagination-separator-loader"></span></span>' : paginationItem;
    paginationItem += '</span>';

    return paginationItem;
}

// The Slideshow class.
class Slideshow {
    constructor(el) {
        this.DOM = { el: el };
        this.config = {
            slideshow: {
                delay: 3000,
                pagination: {
                    duration: 3,
                }
            }
        };

        // Set the slideshow
        this.init();
    }

    init() {
        var self = this;

        // Charmed title
      this.DOM.slideTitle = this.DOM.el.querySelectorAll('.slide-title');
      this.DOM.slideTitle.forEach((slideTitle) => {
        charming(slideTitle);
      });

        // Set the slider
        this.slideshow = new Swiper(this.DOM.el, {
          direction: qc_engagement_obj.is_mobile == 'true'?'horizontal':'vertical',
          slidesPerView: 1,
          spaceBetween: 10,
          mousewheel: false,
          loop: false,
          autoHeight: true,
          autoplay: {
            delay: this.config.slideshow.delay,
            disableOnInteraction: false,
          },
          speed: 500,
          preloadImages: true,
          updateOnImagesReady: true,
            
            pagination: {
                el: '.slideshow-pagination',
                clickable: true,
                bulletClass: 'slideshow-pagination-item',
                bulletActiveClass: 'active',
                clickableClass: 'slideshow-pagination-clickable',
                modifierClass: 'slideshow-pagination-',

                renderBullet: renderBullet,
            },

            // Navigation arrows
          navigation: {
            nextEl: '.slideshow-navigation-button.next',
            prevEl: '.slideshow-navigation-button.prev',
          },

           // And if we need scrollbar
          scrollbar: {
            el: '.swiper-scrollbar',
          },

          on: {
            init: function() {
              self.animate('next');
            },
          }
        });

        // Init/Bind events.
        this.initEvents();
    }

    initEvents() {
        // Your event handling code...
    }

    animate(direction = 'next') {
        // Your animation code...
    }
}

const slideshow = new Slideshow(document.querySelector('.slideshow'));
