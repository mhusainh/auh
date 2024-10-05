<x-header>{{ $title }}</x-header>


<body>
    <x-Navbar></x-Navbar>
    
    <div class="laporan">
        <div class="laporan-barang-hilang">
            <div class="navbar-laporan">
                <div class="title-laporan">Laporan Barang Hilang</div>
                <div class="navbar-laporan-urutkan">
                    <div class="urutkan">Urutkan : </div>
                    <form action="{{ route('lapor.barang') }}">
                        <select class="terbaru" name="sort" id="sort" onchange="this.form.submit()">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        </select>
                    </form>
                </div>
            </div>
            @foreach($barangHilang as $hilang)
                <div class="main-laporan">
                    <div class="header-laporan">
                        <div class="title-user">
                            <div class="title">{{ $hilang->nama_barang }}</div>
                            <div class="user"><img src="{{ Storage::url($hilang->user->photo) }}" alt="">{{ $hilang->user->name }}</div>
                        </div>
                        <div class="date-time">
                            <div class="date">{{ \Carbon\Carbon::parse($hilang->created_at)->translatedFormat('d F Y') }}</div>
                            <div class="time">{{ \Carbon\Carbon::parse($hilang->created_at)->setTimezone('Asia/Jakarta')->format('H:i') }}</div>
                        </div>
                    </div>
                    <div class="body-laporan">
                        <div class="body-laporan-1">
                            <div class="content-laporan">
                                <div class="terakhir-dilihat">Lokasi Terakhir : <span>{{ $hilang->alamat_barang }}</span></div>
                                <div class="terakhir-dilihat">terakhir dilihat : <span>{{ \Carbon\Carbon::parse($hilang->tanggal_hilang)->translatedFormat('d F Y') }}</span></div>
                                <div class="status">status : <span>{{ $hilang->status }}</span></div>
                                <div class="detail">Detail : </div>
                                <div class="content-detail">
                                    <p>{{ $hilang->deskripsi_barang }}</p>
                                </div>
                            </div>
                            <div class="image-laporan">
                                <div class="arrow">
                                    <div class="arrow-left"><</div>
                                </div>
                                <div><img src="{{ Storage::url($hilang->gambar_barang1) }}" alt=""></div>
                                <div class="arrow">
                                    <div class="arrow-right">></div>
                                </div>
                            </div>
                        </div>
                        <div class="footer-laporan">
                            <div><span>comment-alt </span>11</div>
                            <div><span>share-alt </span>11</div>
                        </div>
                    </div>
                    <div class="popup">
                        <div class="popup-main">
                    <div class="container-message">
                        <div class="message-laporan">
                            @foreach($hilang->comments as $comment)
                            <div class="container-chat-message">
                                <div class="chat-message-main">
                                    <div class="time-message">11:21</div>
                                    <div class="profile-message"><img src="{{ Storage::url($comment->user->photo) }}" alt=""></div>
                                    <div class="chat-message">{{ $comment->komentar }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="container-send-message">
                            <form id="message-form" action="{{ route('komentar.barang', Crypt::encryptString($hilang->id)) }}" method="POST">
                                @csrf <!-- Ini akan menyisipkan token CSRF di dalam form -->
                                <div>
                                    <input type="text" id="message" name="komentar" placeholder="Tulis sesuatu" required>
                                </div>
                                <div>
                                    <button type="submit"><img src="./img/send.png" alt="Send"></button>                                    
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            @endforeach
        </div>
    </div>
    
    
                {{-- <div class="container-message">
                    <div class="message-laporan">
                        <div class="date-laporan">
                            <div class="garis1"></div>
                            <div class="date-laporan2">11 September 2024</div>
                            <div class="garis2"></div>
                        </div>
                        
                    </div>
                    <div class="container-send-message">
                        <form id="message-form" action="{{ route('komentar.barang', Crypt::encryptString($barangHilang->id)) }}" method="POST">
                            @csrf <!-- Ini akan menyisipkan token CSRF di dalam form -->
                            <div>
                                <input type="text" id="message" name="komentar" placeholder="Tulis sesuatu" required>
                            </div>
                            <div>
                                <button type="submit"><img src="./img/send.png" alt=""></button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div> --}}
            
        
    
    <div class="buat-laporan">
        <a href={{ route('buat.laporan') }}><img src="./img/buatlaporan.png" alt=""></a>
    </div>
    
    @foreach($barangHilang as $hilang)
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const images = [
            "{{ Storage::url($hilang->gambar_barang1) }}",
            "{{ Storage::url($hilang->gambar_barang2) }}",
            "{{ Storage::url($hilang->gambar_barang3) }}",
            "{{ Storage::url($hilang->gambar_barang4) }}",
            "{{ Storage::url($hilang->gambar_barang5) }}",
        ];
        let currentIndex = 0;
        const buatLaporan = document.querySelector('.buat-laporan')
        function updateImage(imageElement, index) {
            imageElement.src = images[index];
        }
    
        function initializeImageNavigation(imageContainer) {
            const imageElement = imageContainer.querySelector("img");
            const arrowLeft = imageContainer.querySelector(".arrow-left");
            const arrowRight = imageContainer.querySelector(".arrow-right");
    
            function updateNavigationButtons() {
                arrowLeft.style.display = currentIndex === 0 ? "none" : "block";
                arrowRight.style.display =
                    currentIndex === images.length - 1 ? "none" : "block";
            }
    
            updateImage(imageElement, currentIndex);
            updateNavigationButtons();
    
            arrowRight.onclick = function () {
                if (currentIndex < images.length - 1) {
                    currentIndex++;
                    updateImage(imageElement, currentIndex);
                    updateNavigationButtons();
                }
            };
    
            arrowLeft.onclick = function () {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateImage(imageElement, currentIndex);
                    updateNavigationButtons();
                }
            };
        }
    
        const laporanItems = document.querySelectorAll(".main-laporan");
        laporanItems.forEach(function (item) {
            const imageContainer = item.querySelector(".image-laporan");
            initializeImageNavigation(imageContainer);
    
            const footerLaporan = item.querySelector(".footer-laporan");
    
            footerLaporan.addEventListener("click", function () {
                const title = item.querySelector(".title").textContent;
                const user = item.querySelector(".user").innerHTML;
                const date = item.querySelector(".date").textContent;
                const time = item.querySelector(".time").textContent;
                const lastSeen = item.querySelector(
                    ".terakhir-dilihat span"
                ).textContent;
                const status = item.querySelector(".status span").textContent;
                const detail = item.querySelector(".content-detail").innerHTML;
                const imageSrc = item
                    .querySelector(".image-laporan img")
                    .getAttribute("src");
    
                const popUp = document.querySelector(".popup");
                popUp.querySelector(".title").textContent = title;
                popUp.querySelector(".user").innerHTML = user;
                popUp.querySelector(".date").textContent = date;
                popUp.querySelector(".time").textContent = time;
                popUp.querySelector(".terakhir-dilihat span").textContent =
                    lastSeen;
                popUp.querySelector(".status span").textContent = status;
                popUp.querySelector(".content-detail").innerHTML = detail;
                popUp
                    .querySelector(".image-laporan img")
                    .setAttribute("src", imageSrc);
                currentIndex = images.indexOf(imageSrc);
                const imageContainerPopup = popUp.querySelector(".image-laporan");
                initializeImageNavigation(imageContainerPopup);
                buatLaporan.style.display = 'none';
                popUp.style.display = "flex";
            });
        });
        
        const buttonClose = document.querySelector(".button-close");
        buttonClose.addEventListener("click", function () {
            const popUp = document.querySelector(".popup");
            buatLaporan.style.display = 'flex';
            popUp.style.display = "none";
        });
    });
    </script>
    @endforeach
    <x-Footer></x-Footer>
</body>

</html>