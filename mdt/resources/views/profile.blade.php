<x-header>{{ $title }}</x-header>

<body>
    <x-Navbar></x-Navbar>
    <div class="profile-container">
        <div class="profile">
            <div class="profile-header">
                <div class="profile-name">
                    <div class="profile-image-name">
                        <div><img src="{{ Storage::url(Auth::user()->photo) }}" alt="tes"></div>
                        <div>{{ Auth::user()->name }}</div>
                    </div>
                    <div>
                        <a href="{{ route('edit.profile', Crypt::encryptString(Auth::user()->id)) }}">
                            <img src="img/settings.png" alt="tes" style="width: 30px; cursor:pointer">
                        </a>
                    </div>
                </div>
                <div class="profile-laporan">
                    <div class="profile-laporan-1 active" onclick="toggleActive('laporan1')">Laporan Barang Hilang</div>
                    <div class="profile-laporan-2 inactive" onclick="toggleActive('laporan2')">Laporan Orang Hilang</div>
                </div>
            </div>
            <div class="profile-main-container">
                @foreach ($barangHilang as $hilang)
                    <div id="barangHilang" class="profile-main">
                        <div class="profile-laporan-image">
                            <div><img src="{{ Storage::url($hilang->gambar_barang1) }}" alt="tes"></div>
                            <div class="profile-laporan-description">
                                <div class="profile-laporan-title">
                                    <div class="profile-laporan-title-name">{{ $hilang->nama_barang }}</div>
                                    <div class="profile-laporan-container">
                                        <div class="profile-laporan-lokasi">
                                            <div>Lokasi terakhir : </div>
                                            <div><span>{{ $hilang->alamat_barang }}</span></div>
                                        </div>
                                        <div class="profile-laporan-status">
                                            <div>Status : </div>
                                            <div>
                                                <span class="status-text {{ $hilang->status === 'Sudah Ditemukan' ? 'status-found' : '' }}">
                                                    {{ $hilang->status }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown">
                            <img src="img/more_vert.png" alt="more" onclick="toggleDropdown(this)"
                                style="cursor: pointer">
                            <div class="dropdown-content">
                                <div class="dropdown-main">
                                    <a href="{{ route('edit.laporan', Crypt::encryptString($hilang->id)) }}">
                                        <div class="dropdown-main-1">
                                            <img src="img/edit.png" alt="">
                                            <div>Ubah</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-main">
                                    <form id="status-form-{{ $hilang->id }}"
                                        action="{{ route('update.status', Crypt::encryptString($hilang->id)) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="Sudah Ditemukan">
                                        <a href="javascript:void(0);"
                                            onclick="document.getElementById('status-form-{{ $hilang->id }}').submit()">
                                            <div class="dropdown-main-1">
                                                <img src="img/check_box.png" alt="">
                                                <div>Sudah ditemukan</div>
                                            </div>
                                        </a>
                                    </form>
                                </div>
                                <div class="dropdown-main">
                                    <form id="delete-form-{{ $hilang->id }}"
                                        action="{{ route('delete.laporan', Crypt::encryptString($hilang->id)) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="javascript:void(0);"
                                            onclick="confirmDelete('delete-form-{{ $hilang->id }}')">
                                            <div class="dropdown-main-1">
                                                <img src="img/delete.png" alt="">
                                                <div><span>Hapus</span></div>
                                            </div>
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="profile-main-container-2" style="display: none">
                @foreach ( $orangHilang as $orang )
                <div id="orangHilang" class="profile-main-2">
                    <div class="profile-laporan-image">
                        <div><img src="{{ storage::url($orang->gambar_orang) }}" alt="tes"></div>
                        <div class="profile-laporan-description">
                            <div class="profile-laporan-title">
                                <div class="profile-laporan-title-name">{{ $orang->nama_orang }}</div>
                                <div class="profile-laporan-container">
                                    <div class="profile-laporan-lokasi">
                                        <div>Lokasi terakhir : </div>
                                        <div><span>{{ $orang->alamat_orang }}</span></div>
                                    </div>
                                    <div class="profile-laporan-status">
                                        <div>Status : </div>
                                        <div><span class="status-text {{ $orang->status === 'Sudah Ditemukan' ? 'status-found' : '' }}">
                                            {{ $orang->status }}
                                        </span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <img src="img/more_vert.png" alt="more" onclick="toggleDropdown(this)"
                            style="cursor: pointer">
                        <div class="dropdown-content">
                            <div class="dropdown-main">
                                <a href="{{ route('edit.laporan.orang', Crypt::encryptString($orang->id)) }}">
                                    <div class="dropdown-main-1">
                                        <img src="img/edit.png" alt="">
                                        <div>Ubah</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-main">
                                <form id="status-form-{{ $orang->id }}"
                                    action="{{ route('update.status.orang', Crypt::encryptString($orang->id)) }}" 
                                    method="POST">
                                    @csrf
                                    @method('PUT') <!-- Method override for PUT -->
                                    <input type="hidden" name="status" value="Sudah Ditemukan">
                                    <a href="javascript:void(0);" 
                                        onclick="document.getElementById('status-form-{{ $orang->id }}').submit()">
                                        <div class="dropdown-main-1">
                                            <img src="img/check_box.png" alt="">
                                            <div>Sudah ditemukan</div>
                                        </div>
                                    </a>
                                </form>
                            </div>
                            <div class="dropdown-main">
                                <form id="delete-form-{{ $orang->id }}"
                                    action="{{ route('delete.laporan.orang', Crypt::encryptString($orang->id)) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="javascript:void(0);"
                                        onclick="confirmDelete('delete-form-{{ $orang->id }}')">
                                        <div class="dropdown-main-1">
                                            <img src="img/delete.png" alt="">
                                            <div><span>Hapus</span></div>
                                        </div>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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
            const barangHilang = document.querySelector('.profile-main-container');
            const orangHilang = document.querySelector('.profile-main-container-2');

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

        function markAsFound(element) {
            const statusElement = element.closest('.profile-main').querySelector('.status-text');
            if (statusElement) {
                statusElement.innerText = 'Sudah ditemukan'; // Ganti teks status
                statusElement.classList.add('status-found'); // Tambahkan kelas untuk mengganti warna ke hitam
                statusElement.classList.remove('status-text'); // Hapus kelas yang membuat warna merah
            }
            element.closest('.dropdown-content').classList.remove('show'); // Tutup dropdown setelah perubahan
        }

        // Fungsi konfirmasi penghapusan
        function confirmDelete(formId) {
            if (confirm('Apakah Anda yakin ingin menghapus laporan ini?')) {
                document.getElementById(formId).submit();
            }
        }
    </script>
</body>

</html>
