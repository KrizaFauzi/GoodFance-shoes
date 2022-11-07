<style>
    .dropdown:hover .dropdown-content {
        display: none;
    }

    nav .dropdown-content:before {
        position: absolute;
        content: '';
        height: 17px;
        width: 17px;
        background: white;
        right: 75.5px;
        top: -7px;
        transform: rotate(45deg);
        z-index: -1;
    }

    .dropbtn {
        display: inline-block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .dropbtn:hover {
        color: white;
    }

    .dropdown {
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 200px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 2;
    }

    .dropdown-content a {
        color: #1b1b1b;
        padding: 5.5px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
        border-radius: 10px;
        width: 95%;
        margin: auto;
        font-size: 14.5px;
        margin-bottom: 2px;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    nav .dropdown-content-kategori:before {
        position: absolute;
        content: '';
        height: 17px;
        width: 17px;
        background: white;
        right: 24px;
        top: -7px;
        transform: rotate(45deg);
        z-index: -1;
    }

    .dropbtn-kategori {
        display: inline-block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .dropbtn-kategori:hover {
        color: white;
    }

    .dropdown-kategori {
        display: inline-block;
    }

    .dropdown-content-kategori {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 710px;
        left: 50px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 2;
    }

    .dropdown-content-kategori a {
        color: black;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .dropdown-content-kategori a:hover {
        text-decoration: underline;
        color: darkcyan;
    }

    .dropdown-kategori:hover .dropdown-content-kategori {
        display: block;
    }

    a,
    .dropdown-btn {
        text-decoration: none;
        color: #818181;
        display: block;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        outline: none;
    }

    @media only screen and (max-width: 600px) {
        .tab {
            width: 30%;
        }

        .tabcontent {
            float: left;
            padding: 0px 12px;
            width: 70%;
            border-left: none;
            height: 300px;
        }

        .dropdown-content-kategori {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 100%;
            height: auto;
            left: 0;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 2;
        }
    }

    @media only screen and (min-width: 960px) {
        .dropdown-content {
            right: -21.5px;
        }

        nav .dropdown-content:before {
            position: absolute;
            content: '';
            height: 17px;
            width: 17px;
            background: white;
            right: 33px;
            top: -7px;
            transform: rotate(45deg);
            z-index: -1;
        }

        nav .dropdown-content-kategori:before {
            position: absolute;
            content: '';
            height: 17px;
            width: 17px;
            background: white;
            left: 173px;
            top: -7px;
            transform: rotate(45deg);
            z-index: -1;
        }
    }

</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-0 py-md-1">
    <div class="container-fluid">
        <div class="d-flex justify-content-between flex-grow-1 me-0 me-md-2">
            <a class="navbar-brand align-self-center" href="/">Navbar</a>

            <!-- Dropdown Kategori -->
            <div class="dropdown-kategori align-self-center m-auto p-auto">
                <a href="javascript:void(0)" class="dropbtn-kategori dropdown-toggle fw-semibold fs-6">Semua Kategori</a>
                <div class="dropdown-content-kategori rounded">
                    <div class="row align-items-start p-2 px-3">
                        <div class="col">
                            <h5 class="mb-2" style="font-size: 19px;">Tas Pria</h5>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Aksesoris Tas Pria</a>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Briefcase Pria</a>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Clutch Pria</a>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Dompet Pria</a>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Tas Ransel Pria</a>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Tas Selempang Pria</a>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Waist Bag Pria</a>
                        </div>
                        <div class="col">
                            <h5 class="mb-2" style="font-size: 19px;">Tas Perempuan</h5>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Aksesoris Tas Wanita</a>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Clutch Wanita</a>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Dompet Wanita</a>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Hand Bag Wanita</a>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Shoulder Bag Wanita</a>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Tas Ransel Wanita</a>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Tas Selempang Wanita</a>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Tote Bag</a>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Waist Bag Wanita</a>
                        </div>
                        <div class="col">
                            <h5 class="mb-2" style="font-size: 19px;">Tas Anak</h5>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Dompet Anak</a>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Tas Koper Anak</a>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Tas Ransel Anak</a>
                            <a href="" style="font-size: 13.5px; margin-bottom: 2.5px;">Tas Selempang Anak</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Dropdown Kategori -->
        </div>

        <!-- Search -->
        <div class="position-relative w-100">
            <form class="d-flex" role="search">
                <input style="height: 42px;" class="form-control border border-0" type="text" placeholder=""
                    aria-label="Search">
                <button style="border-radius: 0 .375rem .375rem 0;"
                    class="btn btn-info position-absolute end-0 border border-0 align-self-center" type="submit">
                    <div style="font-size: 20px;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </button>
            </form>
        </div>
        <!-- End Search -->

        <div class="d-flex justify-content-between flex-grow-1 ms-0 ms-md-2 py-0">
            @guest
            <!-- akun guest -->
            <div class="d-flex mx-0 mx-md-2 py-1 py-md-0">
                @if (Route::has('register'))
                <a href="{{ route('register') }}" role="button"
                    class="btn btn-outline-info btn-sm fw-semibold text-white align-self-center px-3 py-2">Daftar</a>
                @endif
                <div class="vr text-white mx-2"></div>
                @if (Route::has('login'))
                <a href="{{ route('login') }}" role="button"
                    class="btn btn-info btn-sm fw-semibold text-light align-self-center px-3 py-2">Masuk</a>
                @endif
            </div>
            <!-- end akun guest -->
            @endguest

            @auth
            <!-- akun auth -->
            <div class="dropdown">
                <a href="javascript:void(0)" class="text-start dropbtn dropdown-toggle" style="font-size: 12px; line-height: 1.2;">
                    Hai, {{ Auth::user()->name }} <br>
                    <span class="fw-semibold" style="font-size: 15px;">Your Account</span>
                </a>
                <div class="dropdown-content py-2 rounded">
                    <a class="fw-normal" href="#">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </div>
            <!-- end akun auth -->
            @endauth

            <div class="align-self-center">
                <a href="" type="button" class="btn text-white d-flex fw-semibold">
                    <span><i class="fa-solid fa-cart-shopping fs-4 me-1"></i></span> Cart
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();

    //* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }

</script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
