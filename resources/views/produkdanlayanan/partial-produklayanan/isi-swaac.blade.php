 <!-- Carousel Swaac-->

 <section>
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-pause="false" style="position: relative;">
        <div class="carousel-inner">
            @foreach($carousels as $index => $carousel)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/carousels/swaacademy/' . $carousel->image) }}" class="d-block w-100 carousel-image" alt="Slide {{ $index + 1 }}">
                </div>
            @endforeach
        </div>
    
        <div class="carousel-controls" style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); display: flex; gap: 10px; z-index: 1000;">
            @foreach($carousels as $index => $carousel)
                <span class="dot" data-bs-slide-to="{{ $index }}" style="width: 12px; height: 12px; background-color: white; border-radius: 50%; display: inline-block; transition: background-color 0.3s ease;"></span>
            @endforeach
        </div>
    </div>
  </section>

<!-- Artikel Swaac -->
<h1 class="judul-swaac">SWA Academy</h1>
<section class="content-section">
    <!-- Gambar Pertama -->
    <div class="content-item align-left">
        <img src="/assets/gambar_swaac/artikel-swaac1.jpg" alt="Gambar Pertama" class="image1">
        <p class="description">Sertifikasi profesi memastikan kompetensi seseorang dari pembelajaran, pelatihan, atau pengalaman kerja. 
            SWA Academy memenuhi kebutuhan ini dengan menawarkan berbagai program diklat dan pelatihan bersertifikat, 
            serta memiliki lisensi dari BNSP untuk menjamin kualitas dan pengakuan kompetensi profesional.</p>
    </div>
    <!-- Gambar Kedua -->
    <div class="content-item align-right">
        <img src="/assets/gambar_swaac/artikel-swaac2.png" alt="Gambar Kedua" class="image2">
        <p class="description">SWA Academy menawarkan layanan diklat profesi, lembaga sertifikasi, dan psikologi korporasi, dikelola 
            secara profesional dengan tenaga ahli berkualitas. Kami berkomitmen menjaga kualitas sertifikasi dengan mematuhi 
            standar yang berlaku, memastikan setiap proses memenuhi ekspektasi dan kebutuhan industri.</p>
    </div>
</section>




