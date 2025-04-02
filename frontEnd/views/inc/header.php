<header>

  <div class="container-fluid">
    <div class="row py-3 border-bottom">

      <div class="col-sm-4 col-lg-3 text-center text-sm-start">
        <div class="main-logo">
          <a href="index.php">
            <img src="../images/logo.png" alt="logo" class="img-fluid">
          </a>
        </div>
      </div>

      <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-none d-lg-block">
        <div class="search-bar row bg-light p-2 my-2 rounded-4">

          <div class="col-11 col-md-11">
            <form id="search-form" class="text-center" action="index.php" method="post">
              <input type="text" class="form-control border-0 bg-transparent"
                placeholder="Search for more than 20,000 products">
            </form>
          </div>
          <div class="col-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
            </svg>
          </div>
        </div>
      </div>

      <div
        class="col-sm-8 col-lg-4 d-flex justify-content-end gap-5 align-items-center mt-4 mt-sm-0 justify-content-center justify-content-sm-end">
        <ul class="d-flex justify-content-end list-unstyled m-0">

          <li id="user-menu">
            <a href="#" class="rounded-circle bg-light p-2 mx-1" onclick="toggleLoginForm()">
              <svg width="24" height="24" viewBox="0 0 24 24">
                <use xlink:href="#user"></use>
              </svg>
            </a>
          </li>

          <!-- Form đăng nhập ẩn -->
          <div id="loginForm" class="login-container">
            <div class="login-box">
              <span class="close-btn" onclick="toggleLoginForm()">&times;</span>
              <div class="text">Login</div>
              <form onsubmit="loginUser(event)">
                <div class="data">
                  <label>Email</label>
                  <input type="text" id="email" required>
                </div>
                <div class="data">
                  <label>Password</label>
                  <input type="password" id="password" required>
                </div>

                <div class="btn">
                  <button type="submit">Login</button>
                </div>
                <div class="signup-link">
                  Not a member? <a href="#" onclick="toggleForms()">Signup now</a>
                </div>
              </form>
            </div>
          </div>

          <div id="signupForm" class="login-container">
            <div class="login-box">
              <span class="close-btn" onclick="toggleSignupForm()">&times;</span>
              <div class="text">Signup</div>
              <form onsubmit="signupUser(event)">
                <div class="data">
                  <label>Username</label>
                  <input type="text" id="signup-username" required>
                </div>
                <div class="data">
                  <label>Email</label>
                  <input type="email" id="signup-email" required>
                </div>
                <div class="data">
                  <label>Password</label>
                  <input type="password" id="signup-password" required>
                </div>
                <div class="btn">
                  <button type="submit">Signup</button>
                </div>
                <div class="signup-link">
                  Already have an account? <a href="#" onclick="toggleForms()">Login now</a>
                </div>
              </form>
            </div>
          </div>
          <li class="d-lg-none">
            <a href="#" class="rounded-circle bg-light p-2 mx-1" data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasSearch" aria-controls="offcanvasSearch">
              <svg width="24" height="24" viewBox="0 0 24 24">
                <use xlink:href="#search"></use>
              </svg>
            </a>
          </li>

          <li>
            <a href="#" class="rounded-circle bg-light p-2 mx-1" data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
              <svg width="24" height="24" viewBox="0 0 24 24">
                <use xlink:href="#cart"></use>
              </svg>
            </a>
          </li>

        </ul>

      </div>

    </div>
  </div>
  <div class="container-fluid">
    <div class="row py-3">
      <div class="d-flex  justify-content-center justify-content-sm-between align-items-center">
        <nav class="main-menu d-flex navbar navbar-expand-lg">

          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">

            <div class="offcanvas-header justify-content-center">
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
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
          <span class="badge bg-primary rounded-pill">0</span>
        </h4>
        <ul class="list-group mb-3">
          <!-- Các sản phẩm sẽ được thêm vào đây bằng JavaScript -->
        </ul>
        <button class="w-100 btn btn-primary btn-lg" onclick="redirectToOrder()">Continue to checkout</button>

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
</header>
<script>
  function toggleForms() {
    var loginForm = document.getElementById("loginForm");
    var signupForm = document.getElementById("signupForm");

    if (loginForm.classList.contains("show")) {
      loginForm.classList.remove("show");
      signupForm.classList.add("show");
    } else {
      signupForm.classList.remove("show");
      loginForm.classList.add("show");
    }
  }

  function toggleLoginForm() {
    var form = document.getElementById("loginForm");
    form.classList.toggle("show");
  }

  function toggleSignupForm() {
    var form = document.getElementById("signupForm");
    form.classList.toggle("show");
  }

  async function signupUser(event) {
    event.preventDefault();

    const username = document.getElementById("signup-username").value;
    const email = document.getElementById("signup-email").value;
    const password = document.getElementById("signup-password").value;

    if (!username || !email || !password) {
      alert("Vui lòng nhập đầy đủ thông tin!");
      return;
    }

    const signupData = {
      username: username,
      email: email,
      password: password
    };

    try {
      const response = await fetch("http://localhost/webbangiay/api/register", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(signupData)
      });

      const data = await response.json();

      if (data.error) {
        alert(data.error); // Hiển thị lỗi từ API
      } else {
        alert("Đăng ký thành công! Vui lòng đăng nhập.");

        // Ẩn form đăng ký, hiển thị form đăng nhập
        document.getElementById("signupForm").classList.remove("show");
        document.getElementById("loginForm").classList.add("show");
      }
    } catch (error) {
      console.error("Lỗi kết nối API:", error);
      alert("Lỗi kết nối API, vui lòng thử lại!");
    }
  }

  
  async function loginUser(event) {
    event.preventDefault(); // Ngăn chặn reload trang

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    if (!email || !password) {
        alert("Vui lòng nhập đầy đủ email và mật khẩu!");
        return;
    }

    const loginData = {
        email: email,
        password: password
    };

    try {
        const response = await fetch("http://localhost/webbangiay/api/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(loginData)
        });

        const data = await response.json();

        if (data.error) {
            alert(data.error); // Hiển thị lỗi từ API
        } else {
            // Lưu token và thông tin user vào localStorage
            localStorage.setItem("userToken", data.token);
            localStorage.setItem("userInfo", JSON.stringify(data.user));

            updateUserUI(); // Cập nhật giao diện người dùng

            // Kiểm tra vai trò của user và chuyển hướng phù hợp
            if (data.user.role === "Admin") {
                window.location.href = "http://localhost/webbangiay/frontEnd/admin/views/shoemanager/index.php"; 
            } else {
                window.location.href = "index.php"; // Nếu là User, chuyển hướng index.php
            }
        }
    } catch (error) {
        console.error("Lỗi kết nối API:", error);
        alert("Lỗi kết nối API, vui lòng thử lại!");
    }
}



  function updateUserUI() {
    const userInfo = JSON.parse(localStorage.getItem("userInfo"));
    const userMenu = document.getElementById("user-menu");
    if (userInfo) {
      const userMenu = document.getElementById("user-menu");
      userMenu.innerHTML = `
      <span class="mx-2">${userInfo.username}</span>
      <a href="#" class="rounded-circle bg-light p-2 mx-1" onclick="logoutUser()">
        <svg width="24" height="24" viewBox="0 0 24 24">
          <use xlink:href="#logout"></use>
        </svg>
      </a>
    `;
    }
  }

  // Gọi hàm này khi trang load để kiểm tra xem user đã đăng nhập chưa
  document.addEventListener("DOMContentLoaded", updateUserUI);

  function logoutUser() {
    localStorage.removeItem("userToken");
    localStorage.removeItem("userInfo");
    window.location.reload(); // Refresh lại trang để cập nhật giao diện
  }


  document.addEventListener("DOMContentLoaded", function() {

    // Get user info from local storage
    const userInfoString = localStorage.getItem('userInfo');
      if (!userInfoString) {
        alert("Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.");
        return;
      }

    const userInfo = JSON.parse(userInfoString);
    const userid = userInfo?.id;


    // Lấy giỏ hàng từ API khi trang tải xong
    
    fetch(`http://localhost/webbangiay/api/cart/${userid}`) 
      .then(response => response.json())
      .then(data => {
      if (data.status === 'success') {
        updateCartUI(data.cart); 
      } else {
        console.error('Error fetching cart data: ' + data.message);
      }
    })
    .catch(error => console.error('Error:', error));

    // Cập nhật giỏ hàng trên giao diện người dùng
    function updateCartUI(cart) {
      const cartList = document.querySelector('.offcanvas-body .list-group');
      const cartCount = document.querySelector('.badge.bg-primary');
      let total = 0;
      cartList.innerHTML = ''; // Xóa danh sách hiện tại

      // Duyệt qua các sản phẩm trong giỏ hàng và thêm vào danh sách
        Object.keys(cart).forEach(product_id => {
          const product = cart[product_id];
          const listItem = document.createElement('li');
          listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'lh-sm');

          const productName = `${product_id}`; // Có thể thay bằng tên sản phẩm thật
          const productPrice = `${(product.quantity * product.price).toLocaleString('vi-VN')} VND`;

          listItem.innerHTML = `
                <div>
                    <h6 class="my-0">${productName}</h6>
                </div>
                <span class="text-body-secondary">${productPrice}</span>
            `;

          // Thêm sản phẩm vào danh sách giỏ hàng
          cartList.appendChild(listItem);

          // Cập nhật tổng tiền
          total += product.quantity * product.price;
        });

      // Cập nhật số lượng giỏ hàng
      cartCount.textContent = Object.keys(cart).length;

      // Cập nhật tổng giá giỏ hàng
      const totalItem = document.createElement('li');
      totalItem.classList.add('list-group-item', 'd-flex', 'justify-content-between');
      totalItem.innerHTML = `
    <span>Total (VND)</span>
    <strong>${total.toLocaleString('vi-VN')} đ</strong>
`;
      cartList.appendChild(totalItem);
    }
  });
  function redirectToOrder() {
    // Lấy giỏ hàng từ API
    fetch('http://localhost/webbangiay/api/cart')
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Chuyển hướng qua trang order.php và truyền dữ liệu giỏ hàng
            localStorage.setItem("cart", JSON.stringify(data.cart));
            window.location.href = "order.php";
        } else {
            alert("Giỏ hàng của bạn đang trống!");
        }
    })
    .catch(error => console.error('Lỗi lấy giỏ hàng:', error));
}
</script>




<style>
  /* Chỉ áp dụng cho form đăng nhập */
  .login-container {
    display: none;
    /* Ẩn form mặc định */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 1000;
  }

  .login-container.show {
    display: flex;
  }

  .login-box {
    background: #fff;
    width: 400px;
    padding: 30px;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    position: relative;
  }

  .close-btn {
    position: absolute;
    right: 20px;
    top: 15px;
    font-size: 24px;
    cursor: pointer;
    color: #333;
  }

  .close-btn:hover {
    color: #3498db;
  }

  .text {
    font-size: 30px;
    font-weight: 600;
    text-align: center;
    margin-bottom: 20px;
  }

  form .data {
    margin-bottom: 15px;
  }

  form .data label {
    font-size: 16px;
    font-weight: 500;
    display: block;
  }

  form .data input {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  form .data input:focus {
    border-color: #3498db;
  }

  .forgot-pass {
    text-align: right;
    margin-bottom: 15px;
  }

  .forgot-pass a {
    color: #3498db;
    text-decoration: none;
  }

  .forgot-pass a:hover {
    text-decoration: underline;
  }

  .btn {
    width: 100%;
    height: 45px;
    position: relative;
    overflow: hidden;
  }

  .btn .inner {
    height: 100%;
    width: 300%;
    position: absolute;
    left: -100%;
    z-index: -1;
    background: linear-gradient(to right, #56d8e4, #9f01ea);
    transition: all 0.4s;
  }

  .btn:hover .inner {
    left: 0;
  }

  .btn button {
    width: 100%;
    height: 100%;
    border: none;
    background: none;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
    cursor: pointer;
    background: linear-gradient(to right, #56d8e4, #9f01ea);
    border-radius: 5px;
  }

  .signup-link {
    text-align: center;
    margin-top: 15px;
  }

  .signup-link a {
    color: #3498db;
    text-decoration: none;
  }

  .signup-link a:hover {
    text-decoration: underline;
  }
</style>