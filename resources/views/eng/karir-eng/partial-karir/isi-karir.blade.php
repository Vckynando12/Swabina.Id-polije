<section class="section-pengumuman">
    <h1 class="judul-karir">Career</h1>
    <p class="teks-lowongan">Let's join and have a career with SWA. To apply, please click on 
    <a href="https://www.facebook.com/share/g/1CHndD9XWq/" class="link">The Available Vacancies</a>
    and fill out the link form below:
    </p>
    <!-- Link Form Data Pelamar-->
    <p class="teks-link">
        <a href="https://swabina.isc-hr.id/apply" class="link-form">Applicant Data Form</a>
    </p>


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


