<x-header>{{ $title }}</x-header>

<body>
    <x-Navbar></x-Navbar>
    
    <div class="laporan">
        <div class="laporan-barang-hilang">
            <div class="navbar-laporan">
                <div class="title-laporan">Laporan Barang Hilang</div>
                <div class="navbar-laporan-urutkan">
                    <div class="urutkan">Urutkan :</div>
                    <form action="{{ route('lapor.barang') }}">
                        <select class="terbaru" name="sort" id="sort" onchange="this.form.submit()">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }} class="opsi-urutkan">Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }} class="opsi-urutkan">Terlama</option>
                        </select>
                    </form>
                </div>
            </div>
            
            @foreach($barangHilang as $hilang)
                <div class="main-laporan" data-id="{{ $hilang->id }}">
                    <div class="header-laporan">
                        <div class="title-user">
                            <div class="title">{{ $hilang->nama_barang }}</div>
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
                                <div class="terakhir-dilihat">Lokasi Terakhir : <span>{{ $hilang->alamat_barang }}</span></div>
                                <div class="terakhir-dilihat">Terakhir dilihat : <span>{{ \Carbon\Carbon::parse($hilang->tanggal_hilang)->translatedFormat('d F Y') }}</span></div>
                                
                                <!-- Conditional Styling for Status -->
                                <div class="status">
                                    Status : 
                                    <span style="{{ $hilang->status == 'Sudah Ditemukan' ? 'color: black;' : '' }}">
                                        {{ $hilang->status }}
                                    </span>
                                </div>
                                
                                <div class="detail">Detail :</div>
                                <div class="content-detail">
                                    <p>{{ $hilang->deskripsi_barang }}</p>
                                </div>
                            </div>
                            
                            <div class="image-laporan">
                                <div class="arrow">
                                    <div class="arrow-left" style="display:none;"><</div>
                                </div>
                                <div>
                                    <img src="{{ Storage::url($hilang->gambar_barang1) }}" alt="" class="clickable-image">
                                </div>
                                <div class="arrow">
                                    <div class="arrow-right" style="display:none;">></div>
                                </div>
                            </div>
                        </div>
                        <div class="footer-laporan" data-id="{{ $hilang->id }}">
                            <div><span>comment-alt</span> {{ $hilang->comments->count() }}</div>
                            <div><span>share-alt</span> 11</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Popup section -->
    <div class="popup" style="display: none">
        <div class="popup-main">
            @foreach ($barangHilang as $hilang)
                <div class="main-laporan" data-id="{{ $hilang->id }}">
                    <div class="header-laporan">
                        <div class="title-user">
                            <div class="title">{{ $hilang->nama_barang }}</div>
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
                                <div class="terakhir-dilihat">Lokasi Terakhir : <span>{{ $hilang->alamat_barang }}</span></div>
                                <div class="terakhir-dilihat">Terakhir dilihat : <span>{{ \Carbon\Carbon::parse($hilang->tanggal_hilang)->translatedFormat('d F Y') }}</span></div>
                                <div class="status">Status : <span>{{ $hilang->status }}</span></div>
                                <div class="detail">Detail :</div>
                                <div class="content-detail">
                                    <p>{{ $hilang->deskripsi_barang }}</p>
                                </div>
                            </div>
                            <div class="image-laporan">
                                <div class="arrow">
                                    <div class="arrow-left" style="display:none;"><</div>
                                </div>
                                <div>
                                    <img src="{{ Storage::url($hilang->gambar_barang1) }}" alt="">
                                </div>
                                <div class="arrow">
                                    <div class="arrow-right" style="display:none;">></div>
                                </div>
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
                        
                                    <!-- The rest of the comment structure remains unchanged -->
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
        <a href="{{ route('buat.laporan') }}">
            <img src="./img/buatlaporan.png" alt="">
        </a>
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
                const popUp = document.querySelector(".popup");
                if (event.key === 'Escape') {
                    popUp.style.display = "none";
                    imagePopup.style.display = 'none';
                }
            });

            // Initialize slide navigation for each report item on the main page
            laporanItems.forEach(function (item) {
                initializeImageNavigation(item);

                const footerLaporan = item.querySelector(".footer-laporan");

                footerLaporan.addEventListener("click", function () {
                    // Get the ID of the clicked report
                    const laporanId = footerLaporan.getAttribute('data-id');

                    // Find the popup element
                    const popUp = document.querySelector(".popup");
                    if (!popUp) {
                        console.error("Popup tidak ditemukan di DOM.");
                        return;
                    }

                    // Find the report element matching the clicked ID inside the popup
                    const hilangData = popUp.querySelector(`.main-laporan[data-id="${laporanId}"]`);
                    if (!hilangData) {
                        console.error("Data laporan dengan ID yang relevan tidak ditemukan.");
                        return;
                    }

                    // Show the popup
                    buatLaporan.style.display = 'none';
                    popUp.style.display = "flex";

                    // Hide all other reports and show only the relevant one
                    popUp.querySelectorAll('.main-laporan').forEach(element => {
                        if (element === hilangData) {
                            element.style.display = 'block';
                        } else {
                            element.style.display = 'none';
                        }
                    });

                    // Initialize image navigation inside the popup
                    initializeImageNavigation(hilangData);

                    // Add event listener for the close button of the popup
                    const buttonClose = hilangData.querySelector(".button-close");
                    buttonClose.addEventListener("click", function () {
                        buatLaporan.style.display = 'flex';
                        popUp.style.display = "none";
                    });
                });

                // Attach click event to the images to open in a larger view
                const images = item.querySelectorAll(".image-laporan img");
                images.forEach(image => {
                    image.addEventListener('click', function () {
                        enlargedImage.src = this.src; // Set the src of the enlarged image
                        imagePopup.style.display = 'flex'; // Show the popup
                    });
                });
            });

            // Function to initialize image navigation
            function initializeImageNavigation(laporanElement) {
                // Array of image URLs
                const imageUrls = [
                    laporanElement.querySelector(".image-laporan img").getAttribute("src"),
                    "{{ Storage::url($hilang->gambar_barang2) }}",
                    "{{ Storage::url($hilang->gambar_barang3) }}",
                    "{{ Storage::url($hilang->gambar_barang4) }}",
                    "{{ Storage::url($hilang->gambar_barang5) }}"
                ];

                const images = []; // Array to hold valid images
                let loadImagePromises = []; // Array to hold promises for image loading

                imageUrls.forEach(url => {
                    if (url) { // Only proceed if URL is not empty
                        const img = new Image(); // Create a new image object
                        img.src = url; // Set the image source
                        
                        // Create a promise that resolves if the image loads successfully
                        loadImagePromises.push(new Promise((resolve) => {
                            img.onload = () => {
                                images.push(url); // Add the valid image to the array
                                resolve(); // Resolve the promise
                            };
                            img.onerror = () => {
                                resolve(); // Resolve the promise even if the image fails to load
                            };
                        }));
                    }
                });

                // After all images are checked, set up the slider
                Promise.all(loadImagePromises).then(() => {
                    if (images.length > 0) { // Only proceed if there are valid images
                        let currentIndex = 0;
                        const imageContainer = laporanElement.querySelector(".image-laporan");
                        const imageElement = imageContainer.querySelector("img");
                        const arrowLeft = imageContainer.querySelector(".arrow-left");
                        const arrowRight = imageContainer.querySelector(".arrow-right");

                        function updateImage(index) {
                            if (images[index]) {
                                imageElement.src = images[index];
                            }
                        }

                        function updateNavigationButtons() {
                            arrowLeft.style.display = currentIndex === 0 ? "none" : "block";
                            arrowRight.style.display = currentIndex === images.length - 1 ? "none" : "block";
                        }

                        // Set the initial image
                        updateImage(currentIndex);
                        updateNavigationButtons();

                        // Event listener for the left arrow
                        arrowLeft.onclick = function () {
                            if (currentIndex > 0) {
                                currentIndex--;
                                updateImage(currentIndex);
                                updateNavigationButtons();
                            }
                        };

                        // Event listener for the right arrow
                        arrowRight.onclick = function () {
                            if (currentIndex < images.length - 1) {
                                currentIndex++;
                                updateImage(currentIndex);
                                updateNavigationButtons();
                            }
                        };
                    } else {
                        console.warn("No valid images found."); // Log a warning if no valid images are found
                    }
                });
            }
        });
    </script>


    <x-Footer></x-Footer>
</body>
