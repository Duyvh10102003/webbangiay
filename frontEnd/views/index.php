<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'inc/head.php'; ?>
</head>

<body>
  <?php
  include 'inc/header.php';
  include 'inc/icon.php';
  ?>

  <div class="preloader-wrapper">
    <div class="preloader">
    </div>
  </div>
  <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart">
    <div class="offcanvas-header justify-content-center">
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div class="order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Your cart</span>
          <span class="badge bg-primary rounded-pill">3</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Product One</h6>
              <small class="text-body-secondary">Brief description</small>
            </div>
            <span class="text-body-secondary">$120</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Product Two</h6>
              <small class="text-body-secondary">Brief description</small>
            </div>
            <span class="text-body-secondary">$80</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Product Three</h6>
              <small class="text-body-secondary">Brief description</small>
            </div>
            <span class="text-body-secondary">$50</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (USD)</span>
            <strong>$300</strong>
          </li>
        </ul>

        <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
      </div>
    </div>
  </div>

  <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasSearch">
    <div class="offcanvas-header justify-content-center">
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div class="order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Search</span>
        </h4>
        <form role="search" action="index.php" method="get" class="d-flex mt-3 gap-0">
          <input class="form-control rounded-start rounded-0 bg-light" type="email"
            placeholder="What are you looking for?" aria-label="What are you looking for?">
          <button class="btn btn-dark rounded-end rounded-0" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
  <section>
    <div>
      <div
        class="slideshow slide-in arrow-absolute text-white" style="height: 70vh;">
        <div class="swiper-wrapper">
          <div class="swiper-slide jarallax swiper-slide-next">
            <img src="../images/slide-2.jpg" class="jarallax-img" alt="slideshow">
            <div class="banner-content w-100">
              <div class="container-fluid">
                <div class="row justify-content-center text-center">
                  <div class="col-md-10 pt-5">
                    <h2 class="display-xl text-white ls-0 mt-5 pt-5 txt-fx slide-up">Sports Collection</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide jarallax">
            <img src="../images/slide-3.jpg" class="jarallax-img" alt="slideshow">
            <div class="banner-content w-100">
              <div class="container-fluid">
                <div class="row justify-content-center text-center">
                  <div class="col-md-10 pt-5">
                    <h2 class="display-xl text-white ls-0 mt-5 pt-5 txt-fx slide-up">Casual Shoes</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide jarallax">
            <img src="../images/slide-4.jpg" class="jarallax-img" alt="slideshow">
            <div class="banner-content w-100">
              <div class="container-fluid">
                <div class="row justify-content-center text-center">
                  <div class="col-md-10 pt-5">
                    <h2 class="display-xl text-white ls-0 mt-5 pt-5 txt-fx slide-up">Clearance Sale</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="pagination-wrapper position-absolute">
          <div class="container">
            <div class="slideshow-swiper-pagination text-center"></div>
          </div>
        </div>
        <div class="icon-arrow icon-arrow-left text-white"><svg width="50" height="50" viewBox="0 0 24 24">
            <use xlink:href="#arrow-left"></use>
          </svg></div>
        <div class="icon-arrow icon-arrow-right text-white"><svg width="50" height="50" viewBox="0 0 24 24">
            <use xlink:href="#arrow-right"></use>
          </svg></div>

      </div>
    </div>
  </section>

  <section class="features" style="position:relative; margin-top: -100px; z-index: 2;">
    <div class="container-lg">
      <div class="bg-white p-5">
        <div class="row">
          <div class="col-md-4">
            <div class="row">
              <div class="col-2">
                <svg width="40" height="40">
                  <use xlink:href="#cart"></use>
                </svg>
              </div>
              <div class="col-10">
                <h4 class="element-title text-capitalize mb-2">Pick up in store</h4>
                <p>At imperdiet dui accumsan sit amet nulla risus est ultricies quis.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="row">
              <div class="col-2">
                <svg width="40" height="40">
                  <use xlink:href="#gift"></use>
                </svg>
              </div>
              <div class="col-10">
                <h4 class="element-title text-capitalize mb-2">Special packaging</h4>
                <p>At imperdiet dui accumsan sit amet nulla risus est ultricies quis.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="row">
              <div class="col-2">
                <svg width="40" height="40">
                  <use xlink:href="#love"></use>
                </svg>
              </div>
              <div class="col-10">
                <h4 class="element-title text-capitalize mb-2">Free global returns</h4>
                <p>At imperdiet dui accumsan sit amet nulla risus est ultricies quis.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-4">
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-6">
          <div class="banner-ad bg-secondary-subtle mb-3"
            style="background: url('../images/ad-image-1.png');background-repeat: no-repeat;background-position: right bottom;">
            <div class="banner-content p-5">

              <div class="fs-6 pt-5">Upto 25% Off</div>
              <h3 class="banner-title">Sports Shoes</h3>
              <a href="#" class="btn btn-dark text-uppercase">Show Now</a>

            </div>

          </div>
        </div>
        <div class="col-md-6">
          <div class="banner-ad bg-secondary-subtle"
            style="background: url('../images/ad-image-2.png');background-repeat: no-repeat;background-position: right bottom;">
            <div class="banner-content p-5">

              <div class="fs-6 pt-5">Upto 25% Off</div>
              <h3 class="banner-title">Kids Collection</h3>
              <a href="#" class="btn btn-dark text-uppercase">Show Now</a>

            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h3>Trending Products</h3>
          <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5" id="product-container">
            <!-- Sản phẩm sẽ được render tại đây -->
          </div>
        </div>
      </div>

      <script>
        document.addEventListener("DOMContentLoaded", function() {
          fetch("http://localhost/webbangiay/api/shoe") // Thay đổi đường dẫn API nếu cần
            .then(response => response.json())
            .then(data => {
              let productContainer = document.getElementById("product-container");
              productContainer.innerHTML = ""; // Xóa nội dung cũ
              data.forEach(product => {
                let formattedPrice = new Intl.NumberFormat("vi-VN", {
                  style: "currency",
                  currency: "VND"
                }).format(product.price);

                let productItem = `
                <div class="col">
                    <div class="product-item">
                        <figure>
                            <a href="single-product.php?id=${product.id}" title="${product.title}">
                                <img src="${product.path_image}" alt="${product.title}" class="img-fluid">
                            </a>
                        </figure>
                        <span>${product.title}</span>
                        <div class="d-flex justify-content-between">
                            
                            <p><span class="text-dark">Giá: ${formattedPrice}</span></p>
                        </div>
                    </div>
                </div>`;
                productContainer.innerHTML += productItem;
              });
            })
            .catch(error => console.error("Error fetching products:", error));
        });
      </script>
    </div>
  </section>

  <section class="py-5">
    <div class="container-fluid">
      <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-5">
        <div class="col">
          <div class="card mb-3 border-0">
            <div class="row">
              <div class="col-md-2 text-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M21.5 15a3 3 0 0 0-1.9-2.78l1.87-7a1 1 0 0 0-.18-.87A1 1 0 0 0 20.5 4H6.8l-.33-1.26A1 1 0 0 0 5.5 2h-2v2h1.23l2.48 9.26a1 1 0 0 0 1 .74H18.5a1 1 0 0 1 0 2h-13a1 1 0 0 0 0 2h1.18a3 3 0 1 0 5.64 0h2.36a3 3 0 1 0 5.82 1a2.94 2.94 0 0 0-.4-1.47A3 3 0 0 0 21.5 15Zm-3.91-3H9L7.34 6H19.2ZM9.5 20a1 1 0 1 1 1-1a1 1 0 0 1-1 1Zm8 0a1 1 0 1 1 1-1a1 1 0 0 1-1 1Z" />
                </svg>
              </div>
              <div class="col-md-10">
                <div class="card-body p-0">
                  <h5>Free delivery</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card mb-3 border-0">
            <div class="row">
              <div class="col-md-2 text-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M19.63 3.65a1 1 0 0 0-.84-.2a8 8 0 0 1-6.22-1.27a1 1 0 0 0-1.14 0a8 8 0 0 1-6.22 1.27a1 1 0 0 0-.84.2a1 1 0 0 0-.37.78v7.45a9 9 0 0 0 3.77 7.33l3.65 2.6a1 1 0 0 0 1.16 0l3.65-2.6A9 9 0 0 0 20 11.88V4.43a1 1 0 0 0-.37-.78ZM18 11.88a7 7 0 0 1-2.93 5.7L12 19.77l-3.07-2.19A7 7 0 0 1 6 11.88v-6.3a10 10 0 0 0 6-1.39a10 10 0 0 0 6 1.39Zm-4.46-2.29l-2.69 2.7l-.89-.9a1 1 0 0 0-1.42 1.42l1.6 1.6a1 1 0 0 0 1.42 0L15 11a1 1 0 0 0-1.42-1.42Z" />
                </svg>
              </div>
              <div class="col-md-10">
                <div class="card-body p-0">
                  <h5>100% secure payment</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card mb-3 border-0">
            <div class="row">
              <div class="col-md-2 text-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M22 5H2a1 1 0 0 0-1 1v4a3 3 0 0 0 2 2.82V22a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-9.18A3 3 0 0 0 23 10V6a1 1 0 0 0-1-1Zm-7 2h2v3a1 1 0 0 1-2 0Zm-4 0h2v3a1 1 0 0 1-2 0ZM7 7h2v3a1 1 0 0 1-2 0Zm-3 4a1 1 0 0 1-1-1V7h2v3a1 1 0 0 1-1 1Zm10 10h-4v-2a2 2 0 0 1 4 0Zm5 0h-3v-2a4 4 0 0 0-8 0v2H5v-8.18a3.17 3.17 0 0 0 1-.6a3 3 0 0 0 4 0a3 3 0 0 0 4 0a3 3 0 0 0 4 0a3.17 3.17 0 0 0 1 .6Zm2-11a1 1 0 0 1-2 0V7h2ZM4.3 3H20a1 1 0 0 0 0-2H4.3a1 1 0 0 0 0 2Z" />
                </svg>
              </div>
              <div class="col-md-10">
                <div class="card-body p-0">
                  <h5>Quality guarantee</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card mb-3 border-0">
            <div class="row">
              <div class="col-md-2 text-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M12 8.35a3.07 3.07 0 0 0-3.54.53a3 3 0 0 0 0 4.24L11.29 16a1 1 0 0 0 1.42 0l2.83-2.83a3 3 0 0 0 0-4.24A3.07 3.07 0 0 0 12 8.35Zm2.12 3.36L12 13.83l-2.12-2.12a1 1 0 0 1 0-1.42a1 1 0 0 1 1.41 0a1 1 0 0 0 1.42 0a1 1 0 0 1 1.41 0a1 1 0 0 1 0 1.42ZM12 2A10 10 0 0 0 2 12a9.89 9.89 0 0 0 2.26 6.33l-2 2a1 1 0 0 0-.21 1.09A1 1 0 0 0 3 22h9a10 10 0 0 0 0-20Zm0 18H5.41l.93-.93a1 1 0 0 0 0-1.41A8 8 0 1 1 12 20Z" />
                </svg>
              </div>
              <div class="col-md-10">
                <div class="card-body p-0">
                  <h5>guaranteed savings</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card mb-3 border-0">
            <div class="row">
              <div class="col-md-2 text-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M18 7h-.35A3.45 3.45 0 0 0 18 5.5a3.49 3.49 0 0 0-6-2.44A3.49 3.49 0 0 0 6 5.5A3.45 3.45 0 0 0 6.35 7H6a3 3 0 0 0-3 3v2a1 1 0 0 0 1 1h1v6a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3v-6h1a1 1 0 0 0 1-1v-2a3 3 0 0 0-3-3Zm-7 13H8a1 1 0 0 1-1-1v-6h4Zm0-9H5v-1a1 1 0 0 1 1-1h5Zm0-4H9.5A1.5 1.5 0 1 1 11 5.5Zm2-1.5A1.5 1.5 0 1 1 14.5 7H13ZM17 19a1 1 0 0 1-1 1h-3v-7h4Zm2-8h-6V9h5a1 1 0 0 1 1 1Z" />
                </svg>
              </div>
              <div class="col-md-10">
                <div class="card-body p-0">
                  <h5>Daily offers</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include 'inc/footer.php'; ?>
  <script src="../js/jquery-1.11.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="../js/plugins.js"></script>
  <script src="../js/script.js"></script>
</body>
</html>