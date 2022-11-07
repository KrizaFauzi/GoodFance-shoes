<style>
    .dropdown-produk:hover .dropdown-content-produk {
        display: none;
    }

    nav .dropdown-content-produk:before {
        position: absolute;
        content: '';
        height: 17px;
        width: 17px;
        background: white;
        left: 95px;
        top: -7px;
        transform: rotate(45deg);
        z-index: -1;
    }

    .dropbtn-produk {
        display: inline-block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .dropbtn-produk:hover {
        color: white;
    }

    .dropdown-produk {
        display: inline-block;
    }

    .dropdown-content-produk {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 200px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 2;
        left: 10px;
    }

    .dropdown-content-produk a {
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

    .dropdown-content-produk a:hover {
        background-color: #f1f1f1;
    }

    .dropdown-produk:hover .dropdown-content-produk {
        display: block;
    }

</style>

<nav class="navbar bg-white shadow-sm">
    <div class="container-fluid">
        <div class="dropdown-produk">
            <button class="dropbtn-produk">Dropdown</button>
            <div class="dropdown-content-produk">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
        </div>
    </div>

</nav>
