<x-header>{{ $title }}</x-header>


<body>
    <x-Navbar></x-Navbar>
    <div class="edit-profile-container">
        <div class="edit-profile">
            {{-- pilih foto --}}
            <div class="pilih-foto">
                <div class="image">
                    <img id="profile-image" src="img/pilih-foto.png" alt="Foto Profil">
                </div>
                <div class="pilih-foto-container">
                    <div class="pilih-image">Pilih Foto</div>
                    <input type="file" id="file-input" accept="image/*" style="display: none;">
                    <div class="description-foto">
                        Besaran maksimal File: 10 Megabytes. Ekstensi file yang diperbolehkan: .jpg .jpeg .png
                    </div>
                </div>
            </div>
            {{-- data diri --}}
            <div class="data-diri">
                {{-- data diri --}}
                <div class="title-data">Data Diri</div>
                <div class="isi-data-form">
                    <div class="isi-data">
                        <div class="title-isi-data">NIK</div>
                        <div>21712372184784124</div>
                    </div>
                    <br>
                    <div class="isi-data">
                        <div class="title-isi-data">Nama Lengkap</div>
                        <div>Mahmudi Husain Hasbullah</div>
                    </div>
                    <div class="isi-data">
                        <div class="title-isi-data">Tanggal Lahir</div>
                        <div>30 Februari 2024</div>
                    </div>
                    <div class="isi-data">
                        <div class="title-isi-data">jenis Kelamin</div>
                        <div>pria</div>
                    </div>
                </div>
                <br>
                {{-- kontak --}}
                <div class="title-data">Kontak</div>
                <div class="isi-data-form">
                    <div class="isi-data">
                        <div class="title-isi-data">Email</div>
                        <div>husain@gmail.com <span>Ubah</span></div>
                    </div>
                    <div class="isi-data">
                        <div class="title-isi-data">Nomor HP</div>
                        <div>081234567890 <span>Ubah</span></div>
                    </div>
                </div>
            </div>
            <!-- Modal Pop-Up -->
            <div id="modal-popup" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 id="modal-title">Ubah Data</h2>
                    <p id="modal-description">Description here...</p>
                    <form id="update-form">
                        <input type="text" id="new-data" name="new-data" value="" required>
                        <button type="submit" id="save-button">Simpan</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
    <x-Footer></x-Footer>
    {{-- ubah email dan no hp --}}
    <script>
        // Ambil elemen modal dan elemen-elemen lain yang dibutuhkan
        const modal = document.getElementById("modal-popup");
        const spans = document.querySelectorAll("div.isi-data span");
        const closeBtn = document.getElementsByClassName("close")[0];
        const modalTitle = document.getElementById("modal-title");
        const modalDescription = document.getElementById("modal-description");
        const newDataInput = document.getElementById("new-data");
        const form = document.getElementById("update-form");
        
        // Target data untuk email dan nomor HP
        let currentTarget = null;  // Untuk menyimpan elemen yang akan diperbarui (email/nomor HP)
        let currentType = '';      // Menyimpan tipe perubahan (email atau phone)
    
        // Fungsi untuk membuka modal dan mengubah title serta description
        function openModal(type, currentValue) {
            currentType = type;
            if (type === 'email') {
                modalTitle.innerText = 'Ubah Email';
                modalDescription.innerText = 'Email hanya bisa diubah 1 kali dalam sebulan. Pastikan Email sudah benar.';
                newDataInput.value = currentValue;  // Isi input dengan email saat ini
                newDataInput.type = "email";  // Pastikan input bertipe email
            } else if (type === 'phone') {
                modalTitle.innerText = 'Ubah Nomor HP';
                modalDescription.innerText = 'Nomor HP hanya bisa diubah 1 kali dalam sebulan. Pastikan Nomor HP sudah benar.';
                newDataInput.value = currentValue;  // Isi input dengan nomor HP saat ini
                newDataInput.type = "text";  // Pastikan input bertipe text
            }
            modal.style.display = "block";
        }
        
        // Ketika tombol "Ubah" diklik, buka modal dengan konten sesuai
        spans.forEach((span, index) => {
            span.addEventListener("click", function() {
                const parent = span.parentElement.previousElementSibling;  // Mengambil elemen sebelumnya (title-isi-data)
                const currentValue = span.parentElement.textContent.trim().split(' ')[0];  // Mengambil value saat ini
        
                if (parent.textContent.includes("Email")) {
                    currentTarget = span.parentElement;  // Element di mana email akan diubah
                    openModal('email', currentValue);
                } else if (parent.textContent.includes("Nomor HP")) {
                    currentTarget = span.parentElement;  // Element di mana nomor HP akan diubah
                    openModal('phone', currentValue);
                }
            });
        });
        
        // Ketika tombol "close" diklik, tutup modal
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }
        
        // Ketika pengguna mengklik di luar modal, tutup modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        
        // Fungsi untuk menangani form submit
        form.addEventListener("submit", function(event) {
            event.preventDefault();
            const newData = newDataInput.value;
    
            // Ganti nilai email atau nomor HP di tampilan utama, tetap simpan "Ubah" span
            if (currentTarget) {
                currentTarget.innerHTML = newData + ' <span>Ubah</span>';  // Tetap tambahkan <span>Ubah</span> setelah mengganti nilai
    
                // Tambahkan ulang event listener pada span yang baru
                const newSpan = currentTarget.querySelector("span");
                newSpan.addEventListener("click", function() {
                    const currentValue = currentTarget.textContent.trim().split(' ')[0];
                    if (currentType === 'email') {
                        openModal('email', currentValue);
                    } else if (currentType === 'phone') {
                        openModal('phone', currentValue);
                    }
                });
            }
            modal.style.display = "none";
        });
    </script>
    {{-- pilih foto --}}
    <script>
        // Ambil elemen input file dan elemen gambar
        const fileInput = document.getElementById('file-input');
        const profileImage = document.getElementById('profile-image');
        const pilihImageDiv = document.querySelector('.pilih-image');
    
        // Ketika area "Pilih Foto" diklik, buka file chooser
        pilihImageDiv.addEventListener('click', function() {
            fileInput.click();  // Membuka file chooser saat div "Pilih Foto" diklik
        });
    
        // Event listener ketika file diinputkan oleh pengguna
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0]; // Mengambil file yang dipilih
    
            // Pastikan file yang dipilih adalah gambar
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profileImage.src = e.target.result;  // Ganti source gambar dengan file yang dipilih
                }
                reader.readAsDataURL(file);  // Membaca file gambar sebagai URL data
            } else {
                alert("Silakan pilih file gambar dengan format .jpg, .jpeg, atau .png.");
            }
        });
    </script>

</body>


</html>
