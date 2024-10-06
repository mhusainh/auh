<x-header>{{ $title }}</x-header>

<body>
    <x-Navbar></x-Navbar>

    <div class="laporan">
        <div class="laporan-barang-hilang">
            <div class="navbar-laporan">
                <div class="title-laporan">Laporan Orang Hilang</div>
                <div class="navbar-laporan-urutkan">
                    <div class="urutkan">Urutkan : </div>
                    <form action="">
                        <select class="terbaru" name="sort" id="sort" onchange="this.form.submit()">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }} class="opsi-urutkan">Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }} class="opsi-urutkan">Terlama</option>
                        </select>
                    </form>
                </div>
            </div>

            @foreach ($orangHilang as $hilang)
                <div class="main-laporan">
                    <div class="header-laporan">
                        <div class="title-user">
                            <div class="title">{{ $hilang->nama_orang }}</div>
                            <div class="user">
                                <img src="{{ Storage::url($hilang->user->photo) }}" alt="">{{ $hilang->user->name }}
                            </div>
                        </div>
                        <div class="date-time">
                            <div class="date">
                                {{ \Carbon\Carbon::parse($hilang->created_at)->translatedFormat('d F Y') }}</div>
                            <div class="time">
                                {{ \Carbon\Carbon::parse($hilang->created_at)->setTimezone('Asia/Jakarta')->format('H:i') }}
                            </div>
                        </div>
                    </div>
                    <div class="body-laporan">
                        <div class="body-laporan-1">
                            <div class="content-laporan">
                                <div class="terakhir-dilihat">Lokasi Terakhir : <span>{{ $hilang->alamat_orang }}</span>
                                </div>
                                <div class="terakhir-dilihat">Umur : <span>{{ $hilang->usia }} Tahun</span></div>
                                <div class="status">
                                    Status : 
                                    <span style="{{ $hilang->status == 'Sudah Ditemukan' ? 'color: black;' : '' }}">
                                        {{ $hilang->status }}
                                    </span>
                                </div>
                                <div class="detail">Detail : </div>
                                <div class="content-detail">
                                    <p>{{ $hilang->deskripsi_orang }}</p>
                                </div>
                            </div>
                            <div class="image-laporan">
                                <div><img src="{{ Storage::url($hilang->gambar_orang) }}" alt="" class="clickable-image"></div>
                            </div>
                        </div>
                        <div class="footer-laporan" data-id="{{ $hilang->id }}">
                            <div><span>comment-alt </span>{{ $hilang->comments->count() }}</div>
                            <div><span>share-alt </span>11</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Popup section -->
    <div class="popup" style="display: none">
        <div class="popup-main">
            @foreach ($orangHilang as $hilang)
                <div class="main-laporan" data-id="{{ $hilang->id }}"> <!-- Tambahkan data-id -->
                    <div class="header-laporan">
                        <div class="title-user">
                            <div class="title">{{ $hilang->nama_orang }}</div>
                            <div class="user">
                                <img src="{{ Storage::url($hilang->user->photo) }}" alt="">{{ $hilang->user->name }}
                            </div>
                        </div>
                        <div class="button-close-popup">
                            <div class="date-time">
                                <div class="date">
                                    {{ \Carbon\Carbon::parse($hilang->created_at)->translatedFormat('d F Y') }}</div>
                                <div class="time">
                                    {{ \Carbon\Carbon::parse($hilang->created_at)->setTimezone('Asia/Jakarta')->format('H:i') }}
                                </div>
                            </div>
                            <div class="container-button-close">
                                <div class="button-close">X</div>
                            </div>
                        </div>
                    </div>
                    <div class="body-laporan">
                        <div class="body-laporan-1">
                            <div class="content-laporan">
                                <div class="terakhir-dilihat">Lokasi Terakhir :
                                    <span>{{ $hilang->alamat_orang }}</span></div>
                                <div class="terakhir-dilihat">Umur : <span>{{ $hilang->usia }} Tahun</span></div>
                                <div class="status">Status : <span>{{ $hilang->status }}</span></div>
                                <div class="detail">Detail : </div>
                                <div class="content-detail">
                                    <p>{{ $hilang->deskripsi_orang }}</p>
                                </div>
                            </div>
                            <div class="image-laporan">
                                <div><img src="{{ Storage::url($hilang->gambar_orang) }}" alt=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="container-message">
                        <div class="message-laporan">
                            @if ($hilang->comments && $hilang->comments->count())
                                @php
                                    $lastDate = null; // Variable to store the last displayed date
                                @endphp
                                @foreach ($hilang->comments as $comment)
                                    @php
                                        $currentDate = \Carbon\Carbon::parse($comment->created_at)->translatedFormat('d F Y');
                                    @endphp
                    
                                    @if ($currentDate !== $lastDate) 
                                        <!-- Only render the date if it's different from the last displayed one -->
                                        <div class="date-laporan">
                                            <div class="garis1"></div>
                                            <div class="date-laporan2">{{ $currentDate }}</div>
                                            <div class="garis2"></div>
                                        </div>
                                        @php
                                            $lastDate = $currentDate; // Update the last displayed date
                                        @endphp
                                    @endif
                    
                                    <!-- The rest of the comment structure -->
                                    <div class="container-chat-message">
                                        <div class="chat-message-main">
                                            <div class="time-message">{{ $comment->created_at->format('H:i') }}</div>
                                            <div class="profile-message">
                                                <img src="{{ Storage::url($comment->user->photo) }}" alt="">
                                            </div>
                                            <div class="chat-message">{{ $comment->komentar }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>Belum ada komentar.</p>
                            @endif
                        </div>
                    
                        <div class="container-send-message">
                            <form id="message-form"
                                  action="{{ route('komentar.orang', Crypt::encryptString($hilang->id)) }}"
                                  method="POST">
                                @csrf
                                <div class="send-button">
                                    <input type="text" id="message" name="komentar" placeholder="Tulis sesuatu" required>
                                    <button type="submit">
                                        <img src="./img/send.png" alt="Send">
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            @endforeach
        </div>
    </div>

    <div class="buat-laporan">
        <a href="buat-laporan-orang"><img src="./img/buatlaporan.png" alt=""></a>
    </div>

    <!-- Enlarged Image Popup Section -->
    <div class="image-popup" style="display: none;">
        <div class="image-popup-content">
            <span class="close-popup" style="cursor: pointer;">&times;</span>
            <img class="enlarged-image" src="" alt="">
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const buatLaporan = document.querySelector('.buat-laporan');
            const laporanItems = document.querySelectorAll(".main-laporan");
            const imagePopup = document.querySelector('.image-popup');
            const enlargedImage = document.querySelector('.enlarged-image');
            const closePopupButton = document.querySelector('.close-popup');

            // Close the enlarged image popup when the close button is clicked
            closePopupButton.addEventListener('click', function () {
                imagePopup.style.display = 'none';
            });

            // Close the popup when the 'Esc' key is pressed
            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    imagePopup.style.display = 'none';
                }
            });

            // Initialize image click events to show enlarged view
            const clickableImages = document.querySelectorAll('.clickable-image');
            clickableImages.forEach(image => {
                image.addEventListener('click', function () {
                    enlargedImage.src = this.src; // Set the src of the enlarged image
                    imagePopup.style.display = 'flex'; // Show the popup
                });
            });

            laporanItems.forEach(function (item) {
                const footerLaporan = item.querySelector(".footer-laporan");

                footerLaporan.addEventListener("click", function () {
                    // Ambil ID data untuk laporan yang diklik
                    const laporanId = footerLaporan.getAttribute('data-id');

                    // Temukan elemen popup
                    const popUp = document.querySelector(".popup");
                    if (!popUp) {
                        console.error("Popup tidak ditemukan di DOM.");
                        return;
                    }

                    // Temukan elemen laporan yang sesuai dengan data-id yang diklik di dalam popup
                    const hilangData = popUp.querySelector(`.main-laporan[data-id="${laporanId}"]`);
                    if (!hilangData) {
                        console.error("Data laporan dengan ID yang relevan tidak ditemukan.");
                        return;
                    }

                    // Tampilkan popup
                    buatLaporan.style.display = 'none';
                    popUp.style.display = "flex";

                    // Sembunyikan semua laporan lainnya dan hanya tampilkan yang relevan
                    popUp.querySelectorAll('.main-laporan').forEach(element => {
                        if (element === hilangData) {
                            element.style.display = 'block';
                        } else {
                            element.style.display = 'none';
                        }
                    });

                    // Setelah popup tampil, tambahkan event listener untuk tombol close
                    document.querySelectorAll(".button-close").forEach(buttonClose => {
                        buttonClose.addEventListener("click", function () {
                            console.log("Close button clicked");
                            buatLaporan.style.display = 'flex';
                            popUp.style.display = "none";
                        });
                    });
                });
            });
        });
    </script>


    <x-Footer></x-Footer>
</body>
