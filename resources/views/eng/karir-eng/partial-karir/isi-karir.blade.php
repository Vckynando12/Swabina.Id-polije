<section class="section-pengumuman">
    <h1 class="judul-karir">Career</h1>
    <h5 class="sub-judul-karir" style="margin-left:50px; color:white; font-weight:bold; margin-top: 50px;">Job Vacancies Available :</h5>
    <div class="owl-carousel">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Bakul Es</h5>
          <img src="/assets/gambar_karir/bakul_es.jpg" alt="Logo 1" class="pamflet-kerja" >
          <div class="d-flex justify-content-between">
            <a href="#" class="btn btn-primary tombol-card">Apply</a>
            <a href="#" class="btn btn-secondary tombol-card">Download</a> <!-- Tambahan tombol kedua -->
          </div>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>
          <img src="/assets/gambar_karir/bakul_es.jpg" alt="Logo 1" class="pamflet-kerja" >
          <div class="d-flex justify-content-between">
            <a href="#" class="btn btn-primary tombol-card">Apply</a>
            <a href="#" class="btn btn-secondary tombol-card">Download</a> <!-- Tambahan tombol kedua -->
          </div>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>
          <img src="/assets/gambar_karir/karir.png" alt="Logo 1" class="pamflet-kerja" >
          <div class="d-flex justify-content-between">
            <a href="#" class="btn btn-primary tombol-card">Apply</a>
            <a href="#" class="btn btn-secondary tombol-card">Download</a> <!-- Tambahan tombol kedua -->
          </div>
        </div>
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


    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">The Availabe Vacancies</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @foreach($karirs as $karir)
          <div class="karir-item mb-3 d-flex align-items-center">
              <h5 class="mb-0 me-3">{{ $karir->judul }}</h5>
              <a href="{{ asset('storage/documents/' . $karir->file) }}" class="btn btn-sm btn-primary me-3" target="_blank">
                  Download Requirements
              </a>
              <div class="file-icon">
                  @php
                      $extension = pathinfo($karir->file, PATHINFO_EXTENSION);
                      $iconClass = '';
                      switch(strtolower($extension)) {
                          case 'pdf':
                              $iconClass = 'far fa-file-pdf text-danger';
                              break;
                          case 'doc':
                          case 'docx':
                              $iconClass = 'far fa-file-word text-primary';
                              break;
                          case 'xls':
                          case 'xlsx':
                              $iconClass = 'far fa-file-excel text-success';
                              break;
                          default:
                              $iconClass = 'far fa-file text-secondary';
                      }
                  @endphp
                  <i class="{{ $iconClass }} fa-2x"></i>
              </div>
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


