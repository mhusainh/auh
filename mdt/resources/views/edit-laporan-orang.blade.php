<x-header>{{ $title }}</x-header>


<body>
    <x-Navbar></x-Navbar>
    <div class="buat-laporan-container">
        <div class="halaman-buat-laporan">
            <div class="title-buat-laporan">Ubah Laporan Orang Hilang</div>
            <div class="warning-buat-laporan">
                <div>Perlu diingat, meskipun membagikan foto orang yang hilang dapat mempercepat penemuan orang
                    tersebut
                    dengan bantuan orang lain, hal ini juga bisa membuat Pencuri atau pihak yang tidak bertanggung jawab
                    mungkin akan semakin waspada jika mengetahui bahwa orang tersebut sedang dicari. Sebaiknya bagikan
                    dengan hati-hati dan pertimbangkan ke mana serta kepada siapa informasi tersebut disebarkan.</div>
                <div><img src="{{ asset('img/warning.png') }}" alt=""></div>
            </div>
            <form action="{{ route('update.laporan.orang', Crypt::encryptString($orangHilang->id)) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="detail-barang">
                    <div class="title-detail-barang">
                        <div class="title-detail-barang1">Detail Orang</div>
                    </div>
                    <div class="detail-input-barang">
                        <div class="nama-barang">
                            <div class="title-barang">Nama Orang</div>
                            <div class="input-barang"><input type="text"
                                    placeholder="{{ $orangHilang->nama_orang }}" maxlength="30" name="nama_orang"
                                    id="nama_orang"></div>
                            <div class="ketentuan-penulisan">
                                <div class="text-penulisan">*Tulis nama barang maks. 30 karakter</div>
                                <div class="maksimal-penulisan">0/30</div>
                            </div>
                        </div>
                        <div class="lokasi-barang">
                            <div class="title-barang">Lokasi orang hilang</div>
                            <div class="input-barang"><input type="text"
                                    placeholder="{{ $orangHilang->alamat_orang }}" maxlength="60" name="alamat_orang"
                                    id="alamat_orang"></div>
                            <div class="ketentuan-penulisan">
                                <div class="text-penulisan">*Tulis alamat terakhir barang sebelum hilang maks. 60
                                    karakter
                                </div>
                                <div class="maksimal-penulisan">0/60</div>
                            </div>
                        </div>
                        <div class="terakhir-barang">
                            <div class="title-barang">Umur</div>
                            <div class="input-barang">
                                <input type="text" placeholder="{{ $orangHilang->usia }} Tahun" oninput="formatUsia(this)" maxlength="10" name="usia" id="usia">
                            </div>
                        </div>
                        <div class="foto-barang">
                            <div class="title-barang">Foto Orang</div>
                            <div class="input-gambar">
                                <div class="input-barang-1">
                                    <img id="img1" src="{{ storage::url($orangHilang->gambar_orang) }}" alt=""
                                        onclick="triggerFileInput('fileInput1')">
                                    <input type="file" id="fileInput1" accept="image/*" style="display: none;"
                                        onchange="previewImage(this, 'img1')" name="gambar_orang" id="gambar_orang">
                                </div>
                            </div>
                        </div>
                        <div class="deskripsi-barang">
                            <div class="title-barang">Deskripsi orang hilang</div>
                            <div class="input-barang">
                                <textarea rows="5" maxlength="380" name="deskripsi_orang" id="deskripsi_orang"></textarea>
                            </div>
                            <div class="ketentuan-penulisan">
                                <div class="text-penulisan">*Tulis nama orang maks. 380 karakter</div>
                                <div class="maksimal-penulisan">0/380</div>
                            </div>
                        </div>
                    </div>
                    <div class="button-kirim-laporan">
                        <div><button type="submit" name="kirim">Kirim</button></div>
                    </div>
            </form>
        </div>
    </div>
    </div>


    <script>
        function updateCharacterCount(inputElement, counterElement, maxChars) {
            inputElement.addEventListener('input', function() {
                let currentLength = inputElement.value.length;
                counterElement.textContent = `${currentLength}/${maxChars}`;
                if (currentLength > maxChars) {
                    counterElement.classList.add('over-limit');
                } else {
                    counterElement.classList.remove('over-limit');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const namaBarangInput = document.querySelector('.nama-barang input');
            const namaBarangCounter = document.querySelector('.nama-barang .maksimal-penulisan');
            updateCharacterCount(namaBarangInput, namaBarangCounter, 30);

            const lokasiBarangInput = document.querySelector('.lokasi-barang input');
            const lokasiBarangCounter = document.querySelector('.lokasi-barang .maksimal-penulisan');
            updateCharacterCount(lokasiBarangInput, lokasiBarangCounter, 60);

            const deskripsiBarangInput = document.querySelector('.deskripsi-barang textarea');
            const deskripsiBarangCounter = document.querySelector('.deskripsi-barang .maksimal-penulisan');
            updateCharacterCount(deskripsiBarangInput, deskripsiBarangCounter, 380);
        });

        function formatDate(input) {
            let value = input.value.replace(/[^0-9]/g, '')
            if (value.length > 2) {
                value = value.substring(0, 2) + '/' + value.substring(2);
            }
            if (value.length > 5) {
                value = value.substring(0, 5) + '/' + value.substring(5);
            }
            if (value.length > 10) {
                value = value.substring(0, 10);
            }
            input.value = value;
        }

        function formatUsia(input) {
            // Ambil nilai input, hapus semua yang bukan angka
            let value = input.value.replace(/\D/g, ''); 

            // Tambahkan "Tahun" jika ada angka yang dimasukkan
            if (value.length > 0) {
                input.value = value + ' Tahun';
            } else {
                input.value = ''; // Jika tidak ada angka, kembalikan input ke keadaan awal
            }
        }

        function triggerFileInput(inputId) {
            document.getElementById(inputId).click();
        }

        // Fungsi untuk memuat dan menampilkan pratinjau gambar yang dipilih
        function previewImage(fileInput, imgId) {
            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(imgId).src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

    <x-Footer></x-Footer>
</body>

</html>
