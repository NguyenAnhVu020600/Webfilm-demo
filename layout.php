<body>
    <header>
        <div class="logo_film">
            <a href="index.php">
                <img class="logo" src="Data/logo.jpg" alt="logo" />
            </a>
        </div>
        <div class="icon-bars">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <nav class="nav_header">

            <ul class="nav_links">
                <li>
                    <div class="select_box1">
                        <a href="index.php">Trang chủ</a>
                    </div>
                </li>
                <li>
                    <div class="select_box2">
                        <a href="#">Mới & Phổ biến</a>
                    </div>
                </li>
                <li>
                    <div class="select_box3 dropdown">
                        <a href="#">Thể loại</a>
                        <div class=" dropbtn">

                            <div class="dropdown-content">
                                <?php
                                require 'config.php';
                                $q_cate = "SELECT * 
                                FROM general_cate";
                                $r_cate = $conn->query($q_cate);
                                if (!$r_cate) echo "cau truy van bi sai";
                                if ($r_cate->num_rows != 0) {
                                    while ($row = $r_cate->fetch_assoc()) {
                                        $id_general_cate = $row['id_general_cate'];
                                        $name = $row['name'];
                                ?>
                                        <a href="category.php?id_general_cate=<?= $id_general_cate ?>"><?= $name ?></a>

                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </li>
                <li>
                    <div class="select_box4">
                        <a href="news.php">Tin tức</a>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="search-box">
            <form method="post" action="search.php">
                <input class="search-box__input" type="text" name="word" placeholder="Tìm kiếm..." />
            </form>
            <button class="search-box__btn" name="search" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <div class="toggle">
            <i class="fas fa-moon toggle-icon"></i>
            <i class="fas fa-sun toggle-icon"></i>
            <div class="toggle-ball"></div>
        </div>

        <div class="navbar-left " id="navbar-left">
            <div class="navbar-header">
                <div class="navbar-header-logo">
                    <a class="logo" href="index.php">
                        <img src="Data/logo.jpg" alt="">
                    </a>
                </div>
                <div class="navbar-close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </div>
                
            </div>
            <div class="navbar-search">
                <div class="search-box">
                <form method="post" action="search.php">
                    <input class="search-box__input" type="text" name="word" placeholder="Tìm kiếm..." />
                </form>
                <button class="search-box__btn" name="search" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            </div>
            <div class="navbar-menu">
                <div class="navbar-menu-item">
                    <a href="#">
                        <i class="fa fa-film" aria-hidden="true"></i> Anime
                    </a>
                </div>
                <a class="navbar-menu-item" href="#">
                    <i class="fa fa-star" aria-hidden="true"></i> Movie
                </a>
                <div class="navbar-menu-item">
                    <a href="#">
                        <i class="fa fa-camera" aria-hidden="true"></i> Ưu Đãi
                    </a>
                </div>

                <div class="navbar-menu-item">
                    <a href="/truyen-tranh">
                    <i class="fa fa-book" aria-hidden="true"></i> Truyện
                    </a>
                </div>

                <div class="navbar-menu-item">
                    <a href="#">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i> BXH
                    </a>
                </div>

            </div>
            
           
        </div>

        <?php
        if (!isset($_SESSION['id_user'])) {
        ?>
            <a href="login.php"><button class="login">Đăng nhập</buttons></a>
        <?php
        } else {

        ?>
            <div class="logo_user" id="close">
                <a href="#">
                    <img class="img_avatar" src="Data/img_user/<?= $_SESSION['avatar']; ?>" />
                </a>
            </div>
            <div class="navbar-right">
                <div class="slidebar">
                    <div class="close_btn">
                        <a href="#">
                            <i class="fa fa-times" aria-hidden="true" id="close_1"></i>
                        </a>
                    </div>
                    <div class="navbar_user">
                        <div class="navbar_avatar" id="avatar">
                            <a href="#">
                                <img src="Data/img_user/<?= $_SESSION["avatar"]; ?>" />
                            </a>

                        </div>
                        <div class="navbar_welcome">
                            <span>Xin chào <?= $_SESSION["username"] ?> ! </span>
                        </div>
                        <div class="navbar_tab">
                            <div class="navbar_tab_info_noti"></div>
                            <div class="navbar_tab_info_noti active" data-id="1">
                                Thông tin
                            </div>
                            <div class="navbar_tab_info_noti" data-id="2">
                                Thông báo
                            </div>
                        </div>
                    </div>
                    <div class="tab-content active-tab-content" data-id="1">
                        <ul>
                            <li>
                                <a href="user_page.php">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <span class="link_name">Trang cá nhân</span>
                                </a>
                            </li>
                            <li>
                                <a href="change_password.php">
                                    <i class="fa fa-unlock" aria-hidden="true"></i>
                                    <span class="link_name">Đổi mật khẩu</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-film" aria-hidden="true"></i>
                                    <span class="link_name">Phim đã xem</span>
                                </a>
                            </li>
                            <li>
                                <a href="movie_like.php">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                    <span class="link_name">Phim đã thích</span>
                                </a>
                            </li>
                            <li>
                                <a href="movie_folow.php">
                                    <i class="fa fa-bell" aria-hidden="true"></i>
                                    <span class="link_name">phim đang theo dõi</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-diamond" aria-hidden="true"></i>
                                    <span class="link_name">Nâng cấp vip</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    <span class="link_name">Lịch sử giao dịch</span>
                                </a>
                            </li>

                            <!-- @using (Html.BeginForm("Logout", "user_ad", FormMethod.Post, new { id = "logoutForm", @class = "navbar-righ" }))
                                    { -->
                            <li>
                                <a href="logout.php">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    <span class="link_name">Đăng xuất</span>
                                </a>
                            </li>
                            <!-- } -->

                        </ul>
                    </div>

                    <div class="tab-content hidden" data-id="2">

                        <div class="notification-item">
                            <a href="#">
                                <div class="notification-item-thumbnail">
                                    <img class="img_avatar" src="Data/img_user/user.jpg" />
                                </div>
                            </a>
                            <div class="notification-item-body">
                                <a href="#">

                                    <div class="notification-item-title">
                                        <strong>Minh Quan</strong>
                                        đã trả lời bình luận của bạn: 1 tuần 1 tập nha
                                    </div>
                                </a>
                                <div class="notification-item-time">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    26-07-2021
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

    </header>
</body>