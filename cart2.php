<!DOCTYPE html>
<html lang="en">

<head>
    <meta charshet="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Tailor | Product Details</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="style.css">

    <style>
        .small-img-group {
            display: flex;
            justify-content: space-between;
        }
        
        .small-img-col {
            flex-basis: 24%;
            cursor: pointer;
        }
        
        .sproduct select {
            display: block;
            padding: 5px 10px;
        }
        
        .sproduct input {
            width: 50px;
            height: 40px;
            padding-left: 10px;
            font-size: 16px;
            margin-right: 10px;
        }
        
        .sproduct input:focus {
            outline: none;
        }
        
        .buy-btn {
            background: #fb774b;
            opacity: 1;
            transition: 0.3s all;
        }
    </style>
</head>

<body>

    <!-- navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"> <span>VIR</span>TA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="shop.html">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="riwayat-pembelian.php">Riwayat Pembelian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="monitor_jahit.php">Monitoring Jahitan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="monitor_kirim.php">Monitoring Pengiriman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>

            </div>
        </div>
    </nav>

    <section class="container sproduct my-5 pt-5">
        <div class="row mt-5">
            <div class="col-lg-5 col-md-12 col-12">
                <img class="img-fluid w-50 pb-2" src="img/featured/bunga.jpg" id="MainImg">

            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <h6>Home / Gamis</h6>
                <h3 class="py-4">Gamis Bunga</h3>
                <section class="container detail-product my-2 pt-2">
    <div class="row mt-3">
        <div class="col-lg-6 col-md-12 col-12">
            <form action="" method="POST" >
                <h4 class="fw-bold">Masukkan Data Diri Kamu</h4>
                <div class="form-group">
                </div>
                <div class="col-12 py-2">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama">
                </div>
                <div class="col-12 py-2">
                    <label for="address">Alamat</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Masukkan alamat">
                </div>
                <div class="col-12 py-2">
                    <label for="phone">No. HP</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Masukkan no. HP">
                    <input type="hidden" name="product_id" id="product_id" value="">
                    <input type="hidden" name="seller_id" id="seller_id" value="">
                    <input type="hidden" name="quantity" id="quantity" value="">
                    <input type="hidden" name="total_price" id="total_price" value="">
                    <input type="hidden" name="stocks" id="stocks" value="">
                </div>
                <div class="col-12">
                    <input type="submit" class="btn btn-success rounded-pill float-end" value="Bayar" name="submit" onclick="return checkout();"> 
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-4 col-md-10 col-4">
            <h5 class="fw-bold"><?php echo $item['name']?></h5>
            <p class="fw-normal">Penjual: <?php $seller = mysqli_query($conn, "SELECT product.product_id, product.seller_id, seller.name FROM `product`,`seller` WHERE product_id='$product_id' && product.seller_id=seller.seller_id");
                while($s = mysqli_fetch_array($seller)){
                    echo $s['name'];
                } ?>
            </p>
            <h6 class="fw-bold">Total harga: Rp 
                <?php $price = $item['price'];
                    $total = (int)$quantity * (int)$price;
                    echo number_format($total, 0, ",", "."); ?>
            </h6>
        </div>
    </div>
            </div>
        </div>
    </section>

    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Pilihan Kain</h3>
            <hr class="mx-auto">
        </div>
        <div class="row mx-auto containter-fluid">
            <div class="product text-center col-lg-3 mb-5 col-md-3 col-sm-3 col-xs-3">
                <img src="img/kain/tulip.jpg" alt="">
                <h5 class="p-name">Katun Motif Tulip</h5>
            </div>
            <div class="product text-center col-lg-3 mb-5 col-md-3 col-sm-3 col-xs-3">
                <img src="img/kain/pentas.jpg" alt="">
                <h5 class="p-name">Katun Motif Pentas</h5>
            </div>
            <div class="product text-center col-lg-3 mb-5 col-md-3 col-sm-3 col-xs-3">
                <img src="img/kain/mawarmerah.jpg" alt="">
                <h5 class="p-name">Katun Motif Mawar Merah</h5>
            </div>
            <div class="product text-center col-lg-3 mb-5 col-md-3 col-sm-3 col-xs-3">
                <img src="img/kain/mawarpink.jpg" alt="">
                <h5 class="p-name">Katun Motif Mawar Pink</h5>
            </div>
        </div>
    </section>

    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-12">
                <a class="navbar-brand" href="#" style="color: white;"> <span>VIR</span>TA</a>
                <p class="pt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-12 mb-3">
                <h5 class="pb-2">Kontak Kami</h5>
                <div>
                    <h6 class="text-uppercase">Alamat</h6>
                    <p>STREET NAME 123, CITY, ID</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Telepon</h6>
                    <p>(+62) 123-4567</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Email</h6>
                    <p>admin@mail.com</p>
                </div>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-12">
                <h5 class="pb-2">Instagram</h5>
                <div class="row">
                    <img class="img-fluid w-25 h-100 m-2" src="img/insta/1.jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="img/insta/2.jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="img/insta/3.jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="img/insta/4.jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="img/insta/5.jpg" alt="">
                </div>
            </div>
        </div>

        <div class="copyright mt-5">
            <div class="row container mx-auto">
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <img src="img/payment.png" alt="">
                </div>
                <div class="col-lg-4 col-md-6 col-12 text-nowrap mb-2">
                    <p>Virtual Tailor © 2022. All Rights Reserved</p>
                </div>
                <!--  <div class="col-lg-4 col-md-6 col-12">
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                </div> -->
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
        var MainImg = document.getElementById('MainImg');
        var smallimg = document.getElementsByClassName('small-img');

        smallimg[0].onclick = function() {
            MainImg.src = smallimg[0].src;
        }
        smallimg[1].onclick = function() {
            MainImg.src = smallimg[1].src;
        }
        smallimg[2].onclick = function() {
            MainImg.src = smallimg[2].src;
        }
        smallimg[3].onclick = function() {
            MainImg.src = smallimg[3].src;
        }
    </script>
</body>

</html>