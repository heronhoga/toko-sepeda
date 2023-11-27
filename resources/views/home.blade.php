<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Pengelolaan Toko Sepeda Kelompok 16</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
            crossorigin="anonymous"
        />
        <style>
            #headerpenjualan {
                text-align: center;
                margin-top: 50px;
            }

            #headerpenjualan h1 {
                font-size: 50px;
                color: #333;
            }

            #tableOverview {
                width: 80%;
                margin: auto;
                margin-top: 20px;
                margin-bottom: 100px;
            }

            #supervisor {
                margin-left: 25px;
            }
        </style>
    </head>
    <body>
        <!--NAV-->
        <nav
            class="navbar navbar-expand-lg navbar-light bg-light fixed-top"
            id="topnav"
        >
            <a
                class="navbar-brand"
                href="/home"
                id="supervisor"
                >{{ session('user_data')->nama_supervisor }}</a
            >
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/selling">Data transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/supervise"
                            >Supervisi Penjual</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/seller">Penjual</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/bike">Sepeda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div
            id="carouselExampleSlidesOnly"
            class="carousel slide"
            data-ride="carousel"
        >
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img
                        class="d-block w-100"
                        src="{{ asset('images/bikethumb.JPG') }}"
                        alt="First slide"
                    />
                    <div class="carousel-caption">
                        <h1>Pengelolaan Basis Data Toko Sepeda Kelompok 16</h1>
                    </div>
                </div>
            </div>
        </div>

        <div id="headerpenjualan">
            <h1 id="headerpenjualantext">
                Overview 5 penjualan sepeda terakhir
            </h1>
        </div>

        <table class="table" id="tableOverview">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal pembelian</th>
                    <th scope="col">Nama sepeda</th>
                    <th scope="col">Jenis sepeda</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Nama Pembeli</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $row)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $row->tanggal_transaksi }}</td>
                    <td>{{ $row->nama_sepeda }}</td>
                    <td>{{ $row->jenis_sepeda }}</td>
                    <td>{{ $row->harga }}</td>
                    <td>{{ $row->nama_user }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
            integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
