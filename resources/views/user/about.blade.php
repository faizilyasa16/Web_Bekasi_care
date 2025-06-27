@extends('user.layout')

@section('content')
<section class="container-fluid p-0">
    <div class="d-flex flex-column flex-md-row align-items-center ">
        <div class="p-4 ms-5 rounded-3 p-md-5 bg-primary text-white flex-grow-1 text-center text-md-start">
            <h1 class="mb-3 poppins">Siapa Kami?</h1>
            <p class="mb-0 poppins-light">Bekasi Care adalah platform digital yang dibangun untuk menjawab tantangan banjir di Kota Bekasi. Kami menjadi penghubung antara warga dan pemerintah dengan sistem pelaporan yang cepat, akurat, dan terintegrasi, demi respons yang lebih sigap dan tepat sasaran.</p>
        </div>
        <div class="p-3 p-md-5" style="max-width: 100%;">
            <img src="{{ asset('img/handphone.png') }}" alt="Aplikasi Pelaporan Banjir" class="img-fluid" style="max-height: 1400px;">
        </div>
    </div>
    <div class="mt-5 mb-5 d-flex justify-content-center flex-column align-items-center">
        <h3 class="mb-3 text-decoration-underline text-primary poppins">Apa yang Kami Tawarkan?</h3>
        <p class="mb-4 poppins-light">Di Bekasi Care, kami menyediakan solusi modern untuk penanganan banjir. Antara lain:</p>
        <div class="container-fluid">
        <div class="row g-4 poppins">
            <div class="col-12 col-md-6">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <div class="card-body d-flex align-items-start">
                        <i class="bi bi-exclamation-triangle-fill fs-1 me-3"></i>
                        <div>
                            <h5 class="card-title">Lapor Banjir</h5>
                            <p class="card-text poppins-light">Melaporkan banjir melalui aplikasi Bekasi Care.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <div class="card-body d-flex align-items-start">
                        <i class="bi bi-lightning-charge-fill fs-1 me-3"></i>
                        <div>
                            <h5 class="card-title">Tanggap Banjir</h5>
                            <p class="card-text poppins-light">Tanggap cepat banjir dari pemerintah kota.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card h-100 shadow-sm border-0 card-hover">
                    <div class="card-body d-flex align-items-start">
                        <i class="bi bi-chat-dots-fill fs-1 me-3"></i>
                        <div>
                            <h5 class="card-title">Diskusi</h5>
                            <p class="card-text poppins-light">Diskusi masalah banjir, solusi warga, dan dukungan RT/RW.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div   div class="card h-100 shadow-sm border-0 card-hover">
                    <div class="card-body d-flex align-items-start">
                        <i class="bi bi-newspaper fs-1 me-3"></i>
                        <div>
                            <h5 class="card-title">Berita</h5>
                            <p class="card-text poppins-light">Berita terkini tentang banjir di Bekasi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>

</section>
@endsection