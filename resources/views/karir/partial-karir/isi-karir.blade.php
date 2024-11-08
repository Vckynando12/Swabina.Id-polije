
<section class="section-pengumuman">
    <h1 class="judul-karir">Karir</h1>
    <h5 class="sub-judul-karir" style="margin-left:50px; color:white; font-weight:bold; margin-top: 50px">Berikut lowongan kerja yang tersedia :</h5>
    
    <!-- Tambahkan container untuk owl-carousel -->
    <div class="container-fluid px-4">
        <div class="owl-carousel">
            @foreach($karirs as $karir)
            <div class="card mx-2 my-4" style="width: 20rem; height: auto; overflow: hidden;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $karir->judul }}</h5>
                    @if($karir->gambar)
                        <img src="{{ asset('storage/images/' . $karir->gambar) }}" alt="{{ $karir->judul }}" class="pamflet-kerja img-fluid">
                    @else
                        <img src="/assets/gambar_karir/karir.png" alt="Default Image" class="pamflet-kerja img-fluid">
                    @endif
                    <p class="card-text mt-3 flex-grow-1" style="text-align: {{ $karir->text_align }}">
                        {{ $karir->deskripsi }}
                    </p>
                    <div class="d-flex justify-content-between mt-auto">
                        <a href="#" class="btn btn-primary tombol-card">Apply</a>
                        <a href="{{ asset('storage/documents/' . $karir->file) }}" class="btn btn-secondary tombol-card" target="_blank">Download</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
  

  <!-- Tombol Previous dan Next -->
  <div class="carousel-nav tombol-nav">
      <button class="prev-btn">
          <i class="bi bi-caret-left-fill"></i>
      </button>
      <button class="next-btn">
          <i class="bi bi-caret-right-fill"></i>
      </button>
  </div>
    <!--<p class="teks-lowongan">Mari bergabung dan berkarir bersama SWABINA. Untuk melamar silahkan klik 
    <a href="https://www.facebook.com/share/g/1CHndD9XWq/" class="link">Lowongan Yang Tersedia</a>
    dan isi form link di bawah ini:
    </p>
    <p class="teks-link">
        <a href="https://swabina.isc-hr.id/apply" class="link-form">Form Data Pelamar</a>
    </p>-->


    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Lowongan Yang Tersedia</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @foreach($karirs as $karir)
          <div class="karir-item mb-3 d-flex align-items-center">
              <h5 class="mb-0 me-3">{{ $karir->judul }}</h5>
              <a href="{{ asset('storage/documents/' . $karir->file) }}" class="btn btn-sm btn-primary me-3" target="_blank">
                  Download Persyaratan
              </a>
          </div>
          @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <img src="/assets/gambar_karir/karir.png" alt="Logo 1" class="bg-gambar-karir" >
</section>


