<x-header>{{ $title }}</x-header>


<body>
    <x-Navbar></x-Navbar>
    <div class="profile-container">
        <div class="profile">
            <div class="profile-header">
                <div class="profile-name">
                    <div class="profile-image-name">
                        <div><img src="img/dompet2.png" alt="tes"></div>
                        <div>Husain</div>
                    </div>
                    <div>
                        <a href="/edit-profile"><img src="img/settings.png" alt="tes"
                                style="width: 30px; cursor:pointer"></a>
                    </div>
                </div>
                <div class="profile-laporan">
                    <div class="profile-laporan-1 active" onclick="toggleActive('laporan1')">Laporan Barang Hilang</div>
                    <div class="profile-laporan-2 inactive" onclick="toggleActive('laporan2')">Laporan Orang Hilang
                    </div>
                </div>
            </div>
            <div class="profile-main-container">
                <div id="barangHilang" class="profile-main">
                    <div class="profile-laporan-image">
                        <div><img src="img/dompet2.png" alt="tes"></div>
                        <div class="profile-laporan-description">
                            <div class="profile-laporan-title">
                                <div class="profile-laporan-title-name">Dompet Eiger Hitam</div>
                                <div class="profile-laporan-container">
                                    <div class="profile-laporan-lokasi">
                                        <div>Lokasi terakhir : </div>
                                        <div><span>Jl. Gajah Raya</span></div>
                                    </div>
                                    <div class="profile-laporan-status">
                                        <div>Status : </div>
                                        <div><span class="status-text">Belum ditemukan</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <img src="img/more_vert.png" alt="more" onclick="toggleDropdown(this)"
                            style="cursor: pointer">
                        <div class="dropdown-content">
                            <div class="dropdown-main"><a href="/edit-laporan">
                                    <div class="dropdown-main-1">
                                        <img src="img/edit.png" alt="">
                                        <div>Ubah</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-main"><a href="javascript:void(0);" onclick="markAsFound(this)">
                                    <div class="dropdown-main-1">
                                        <img src="img/check_box.png" alt="">
                                        <div>Sudah ditemukan</div>
                                    </div>
                                </a></div>

                            <div class="dropdown-main"><a href="#">
                                    <div class="dropdown-main-1">
                                        <img src="img/delete.png" alt="">
                                        <div><span>Hapus</span></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="orangHilang" class="profile-main" style="display: none;">
                    <div class="profile-laporan-image">
                        <div><img src="img/orang_hilang.png" alt="tes"></div>
                        <div class="profile-laporan-description">
                            <div class="profile-laporan-title">
                                <div class="profile-laporan-title-name">Budi Santoso</div>
                                <div class="profile-laporan-container">
                                    <div class="profile-laporan-lokasi">
                                        <div>Lokasi terakhir : </div>
                                        <div><span>Jl. Merdeka</span></div>
                                    </div>
                                    <div class="profile-laporan-status">
                                        <div>Status : </div>
                                        <div><span class="status-text">Belum ditemukan</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <img src="img/more_vert.png" alt="more" onclick="toggleDropdown(this)"
                            style="cursor: pointer">
                        <div class="dropdown-content">
                            <div class="dropdown-main"><a href="/edit-laporan">
                                    <div class="dropdown-main-1">
                                        <img src="img/edit.png" alt="">
                                        <div>Ubah</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-main"><a href="javascript:void(0);" onclick="markAsFound(this)">
                                    <div class="dropdown-main-1">
                                        <img src="img/check_box.png" alt="">
                                        <div>Sudah ditemukan</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-main"><a href="#">
                                    <div class="dropdown-main-1">
                                        <img src="img/delete.png" alt="">
                                        <div><span>Hapus</span></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <x-Footer></x-Footer>
    <script>
        function toggleDropdown(element) {
            const dropdown = element.nextElementSibling;
            dropdown.classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('img')) {
                const dropdowns = document.getElementsByClassName("dropdown-content");
                for (let i = 0; i < dropdowns.length; i++) {
                    const openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

        function toggleActive(laporan) {
            const laporan1 = document.querySelector('.profile-laporan-1');
            const laporan2 = document.querySelector('.profile-laporan-2');
            const barangHilang = document.getElementById('barangHilang');
            const orangHilang = document.getElementById('orangHilang');

            if (laporan === 'laporan1') {
                laporan1.classList.add('active');
                laporan1.classList.remove('inactive');
                laporan2.classList.add('inactive');
                laporan2.classList.remove('active');
                barangHilang.style.display = 'flex';
                orangHilang.style.display = 'none';
            } else if (laporan === 'laporan2') {
                laporan2.classList.add('active');
                laporan2.classList.remove('inactive');
                laporan1.classList.add('inactive');
                laporan1.classList.remove('active');
                barangHilang.style.display = 'none';
                orangHilang.style.display = 'flex';
            }
        }

        // Fungsi untuk mengganti status menjadi "Sudah ditemukan" dan warna menjadi hitam
        function markAsFound(element) {
            const statusElement = element.closest('.profile-main').querySelector('.status-text');
            if (statusElement) {
                statusElement.innerText = 'Sudah ditemukan'; // Ganti teks status
                statusElement.classList.add('status-found'); // Tambahkan kelas untuk mengganti warna ke hitam
                statusElement.classList.remove('status-text'); // Hapus kelas yang membuat warna merah
            }
            element.closest('.dropdown-content').classList.remove('show'); // Tutup dropdown setelah perubahan
        }
    </script>


</body>


</html>
