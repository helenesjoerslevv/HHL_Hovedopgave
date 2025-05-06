document.addEventListener("DOMContentLoaded", function () {
  // HAMBURGER
  const hamburgerMenu = document.querySelector('.hamburger');
  const mobileMenu = document.querySelector('#mobileMenu');
  if (hamburgerMenu && mobileMenu) {
    hamburgerMenu.addEventListener('click', () => {
      mobileMenu.classList.toggle('active');
    });
  }

  // BANNER KARUSEL
  const carousel = document.querySelector('.banner-carousel');
  const slides = document.querySelectorAll('.slide');
  const dots = document.querySelectorAll('.carousel-dots .dot');
  if (carousel && slides.length && dots.length) {
    let currentIndex = 0;
    const totalSlides = slides.length;
    function showSlide(index) {
      const offset = -index * 100;
      carousel.style.transform = `translateX(${offset}vw)`;
      dots.forEach(dot => dot.classList.remove('active'));
      dots[index].classList.add('active');
    }
    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        currentIndex = index;
        showSlide(currentIndex);
      });
    });
    setInterval(() => {
      currentIndex = (currentIndex + 1) % totalSlides;
      showSlide(currentIndex);
    }, 5000);
  }

  // FILTER PANEL
  const filterBtn = document.getElementById('filterToggleBtn');
  const filterPanel = document.getElementById('filterPanel');
  const closeBtn = document.getElementById('closeFilter');
  if (filterBtn && filterPanel && closeBtn) {
    filterBtn.addEventListener('click', function () {
      filterPanel.classList.add('active');
    });
    closeBtn.addEventListener('click', function () {
      filterPanel.classList.remove('active');
    });
    document.addEventListener('click', function (event) {
      if (!filterPanel.contains(event.target) && event.target !== filterBtn) {
        filterPanel.classList.remove('active');
      }
    });
  }

  // ANTALVÆLGER
  const upButton = document.querySelector('.quantity-plus');
  const downButton = document.querySelector('.quantity-minus');
  const quantityInput = document.querySelector('.quantity-input');
  if (upButton && downButton && quantityInput) {
    downButton.addEventListener('click', function () {
      let currentValue = parseInt(quantityInput.value);
      if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
      }
    });
    upButton.addEventListener('click', function () {
      let currentValue = parseInt(quantityInput.value);
      quantityInput.value = currentValue + 1;
    });
  }

  // ACCORDION (her er det vigtige)
  const accordions = document.querySelectorAll(".accordion-toggle");
  accordions.forEach((accordion) => {
    accordion.addEventListener("click", function () {
      this.classList.toggle("active");
      const content = this.nextElementSibling;
      if (content.style.maxHeight) {
        content.style.maxHeight = null;
      } else {
        content.style.maxHeight = content.scrollHeight + "px";
      }
    });
  });
});
