<!-- Struktur Owl Carousel -->
<section class="panggen-berita">
    <h1 class="judule-berita">Berita SWA</h1>

    <div class="owl-carousel">
        @foreach($berita as $index => $item)
            <div class="item">
                <img src="{{ asset('storage/' . $item->image) }}" alt="Berita {{ $index + 1 }}">
                <button class="read-more-btn" data-target="desc{{ $index + 1 }}">Baca Selengkapnya</button>
            </div>
        @endforeach
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
</section>

<section class="deskripsi-berita">
    @foreach($berita as $index => $item)
        <div id="desc{{ $index + 1 }}" class="description">
            <h3 class="sub-judul">{{ $item->title }}</h3>
            <p class="pengaturan-font-deskripsi">
                {!! nl2br(e($item->description)) !!}
            </p>
        </div>
    @endforeach
</section>