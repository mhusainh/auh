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
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
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
                        <div class="date">{{ \Carbon\Carbon::parse($hilang->created_at)->translatedFormat('d F Y') }}</div>
                        <div class="time">{{ \Carbon\Carbon::parse($hilang->created_at)->setTimezone('Asia/Jakarta')->format('H:i') }}</div>
                    </div>
                </div>
                <div class="body-laporan">
                    <div class="body-laporan-1">
                        <div class="content-laporan">
                            <div class="terakhir-dilihat">Lokasi Terakhir : <span>{{ $hilang->alamat_orang }}</span></div>
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
                    <div class="footer-laporan">
                        <div><span>comment-alt </span>12</div>
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
            <div class="main-laporan">
                <div class="header-laporan">
                    <div class="title-user">
                        <div class="title">{{ $hilang->nama_orang }}</div>
                        <div class="user">
                            <img src="{{ Storage::url($hilang->user->photo) }}" alt="">{{ $hilang->user->name }}
                        </div>
                    </div>
                    <div class="button-close-popup">
                        <div class="date-time">
                            <div class="date">{{ \Carbon\Carbon::parse($hilang->created_at)->translatedFormat('d F Y') }}</div>
                            <div class="time">{{ \Carbon\Carbon::parse($hilang->created_at)->setTimezone('Asia/Jakarta')->format('H:i') }}</div>
                        </div>
                        <div class="container-button-close">
                            <div class="button-close">X</div>
                        </div>
                    </div>
                </div>
                <div class="body-laporan">
                    <div class="body-laporan-1">
                        <div class="content-laporan">
                            <div class="terakhir-dilihat">Lokasi Terakhir : <span>{{ $hilang->alamat_orang }}</span></div>
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
                        @if($hilang->comments && $hilang->comments->count())
                            @foreach($hilang->comments as $comment)
                                <div class="container-chat-message">
                                    <div class="date-laporan">
                                        <div class="garis1"></div>
                                        <div class="date-laporan2">11 September 2024</div>
                                        <div class="garis2"></div>
                                    </div>
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
                        <form id="message-form" action="{{ route('komentar.barang', Crypt::encryptString($hilang->id)) }}" method="POST">
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // console.log("halo")
            let currentIndex = 0;
            const buatLaporan = document.querySelector('.buat-laporan');

            // function updateImage(imageElement, index) {
            //     imageElement.src = images[index];
            // }

            // function initializeImageNavigation(imageContainer) {
            //     const imageElement = imageContainer.querySelector("img");
            //     const arrowLeft = imageContainer.querySelector(".arrow-left");
            //     const arrowRight = imageContainer.querySelector(".arrow-right");

            //     function updateNavigationButtons() {
            //         arrowLeft.style.display = currentIndex === 0 ? "none" : "block";
            //         arrowRight.style.display = currentIndex === images.length - 1 ? "none" : "block";
            //     }

            //     updateImage(imageElement, currentIndex);
            //     updateNavigationButtons();

            //     arrowRight.onclick = function () {
            //         if (currentIndex < images.length - 1) {
            //             currentIndex++;
            //             updateImage(imageElement, currentIndex);
            //             updateNavigationButtons();
            //         }
            //     };

            //     arrowLeft.onclick = function () {
            //         if (currentIndex > 0) {
            //             currentIndex--;
            //             updateImage(imageElement, currentIndex);
            //             updateNavigationButtons();
            //         }
            //     };
            // }

            const laporanItems = document.querySelectorAll(".main-laporan");
            laporanItems.forEach(function (item) {
                // const imageContainer = item.querySelector(".image-laporan");
                // initializeImageNavigation(imageContainer);

                const footerLaporan = item.querySelector(".footer-laporan");

                footerLaporan.addEventListener("click", function () {
                    const popUp = document.querySelector(".popup");

                    if (!popUp) {
                        console.error("Popup tidak ditemukan di DOM.");
                        return;
                    }

                    const title = item.querySelector(".title").textContent;
                    const user = item.querySelector(".user").innerHTML;
                    const date = item.querySelector(".date").textContent;
                    const time = item.querySelector(".time").textContent;
                    const lastSeen = item.querySelector(".terakhir-dilihat span").textContent;
                    const status = item.querySelector(".status span").textContent;
                    const detail = item.querySelector(".content-detail").innerHTML;
                    // const imageSrc = item.querySelector(".image-laporan img").getAttribute("src");

                    if (popUp.querySelector(".title") && popUp.querySelector(".user") && popUp.querySelector(".date") && popUp.querySelector(".time") && popUp.querySelector(".terakhir-dilihat span") && popUp.querySelector(".status span") && popUp.querySelector(".content-detail") && popUp.querySelector(".image-laporan img")) {
                        popUp.querySelector(".title").textContent = title;
                        popUp.querySelector(".user").innerHTML = user;
                        popUp.querySelector(".date").textContent = date;
                        popUp.querySelector(".time").textContent = time;
                        popUp.querySelector(".terakhir-dilihat span").textContent = lastSeen;
                        popUp.querySelector(".status span").textContent = status;
                        popUp.querySelector(".content-detail").innerHTML = detail;
                        // popUp.querySelector(".image-laporan img").src = imageSrc;
                    }
                    buatLaporan.style.display = 'none';
                    popUp.style.display = "flex";
                });
                const buttonClose = document.querySelector(".button-close");
            buttonClose.addEventListener("click", function () {
                console.log("tes");
                const buatLaporan = document.querySelector(".buat-laporan ");
                const popUp = document.querySelector(".popup");
             
                buatLaporan.style.display = 'flex';
                popUp.style.display = "none";
            });
                // const closeButton = document.querySelector(".button-close");
                // closeButton.addEventListener("click", function () {
                //     const popUp = document.querySelector(".popup");
                //     popUp.style.display = "none";
                // });
            });
          
        });
    </script>

    <x-Footer></x-Footer>
</body>
