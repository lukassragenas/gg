var swiper = new Swiper(".main-section", {
  loop: true,
});

 var swiperposts = new Swiper(".productPopularSwiper", {
        draggable: true,
        navigation: {
          nextEl: "#product-popular-swiper-button-next",
          prevEl: "#product-popular-swiper-button-prev"
        },
        breakpoints: {
          0: {
            slidesPerView: 2,
          },
        640: {
          slidesPerView: 3,
          },
          992: {
            slidesPerView: 4,
            spaceBetween: 20,
          }
        },
      });


      var swiperposts = new Swiper(".productNewSwiper", {
        draggable: true,
        navigation: {
          nextEl: "#product-new-swiper-button-next",
          prevEl: "#product-new-swiper-button-prev"
        },
        breakpoints: {
          0: {
            slidesPerView: 2,
          },
        640: {
          slidesPerView: 3,
          },
          992: {
            slidesPerView: 4,
            spaceBetween: 20,
          }
        },
      });

      var swiperposts = new Swiper(".productSaleSwiper", {
        draggable: true,
        navigation: {
          nextEl: "#product-sale-swiper-button-next",
          prevEl: "#product-sale-swiper-button-prev"
        },
        breakpoints: {
          0: {
            slidesPerView: 2,
          },
        640: {
          slidesPerView: 3,
          },
          992: {
            slidesPerView: 4,
            spaceBetween: 20,
          }
        },
      });

      var swiperposts = new Swiper(".productRelatedSwiper", {
        draggable: true,
        navigation: {
          nextEl: "#product-related-swiper-button-next",
          prevEl: "#product-related-swiper-button-prev"
        },
        breakpoints: {
          0: {
            slidesPerView: 2,
          },
        640: {
          slidesPerView: 3,
          },
          992: {
            slidesPerView: 4,
            spaceBetween: 20,
          }
        },
      });
      

      var swiperposts = new Swiper(".recipesSwiper", {
        draggable: true,
        navigation: {
          nextEl: ".swiper-button-next-recipe",
          prevEl: ".swiper-button-prev-recipe"
        },
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
        640: {
          slidesPerView: 3,
          },
          992: {
            slidesPerView: 4,
            spaceBetween: 20,
          }
        },
      });
      