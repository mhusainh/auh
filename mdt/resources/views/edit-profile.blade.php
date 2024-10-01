<x-header>{{ $title }}</x-header>

<body>
    <x-Navbar></x-Navbar>
    <div class="edit-profile-container">
        <div class="edit-profile">
            {{-- Pilih Foto --}}
            <div class="pilih-foto">
                <div class="image">
                    <img id="profile-image" src="{{ Storage::url(Auth::user()->photo) }}" alt="Foto Profil">
                </div>
                <div class="pilih-foto-container">
                    <div class="pilih-image">Pilih Foto</div>
                    <input type="file" id="file-input" accept="image/*" style="display: none;">
                    <div class="description-foto">
                        Besaran maksimal file: 10 Megabytes. Ekstensi file yang diperbolehkan: .jpg .jpeg .png.
                    </div>
                </div>
            </div>

            {{-- Data Diri --}}
            <div class="data-diri">
                <div class="title-data">Data Diri</div>
                <div class="isi-data-form">
                    <div class="isi-data">
                        <div class="title-isi-data">NIK</div>
                        <div>{{ Auth::user()->nik }}</div>
                    </div>
                    <br>
                    <div class="isi-data">
                        <div class="title-isi-data">Nama Lengkap</div>
                        <div>{{ Auth::user()->name }}</div>
                    </div>
                    <div class="isi-data">
                        <div class="title-isi-data">Tanggal Lahir</div>
                        <div>30 Februari 2024</div>
                    </div>
                    <div class="isi-data">
                        <div class="title-isi-data">Jenis Kelamin</div>
                        <div>Pria</div>
                    </div>
                </div>
                <br>

                {{-- Kontak --}}
                <div class="title-data">Kontak</div>
                <div class="isi-data-form">
                    <div class="isi-data">
                        <div class="title-isi-data">Email</div>
                        <div>{{ Auth::user()->email }} <span>Ubah</span></div>
                    </div>
                    <div class="isi-data">
                        <div class="title-isi-data">Nomor HP</div>
                        <div>{{ Auth::user()->nomorhp }} <span>Ubah</span></div>
                    </div>
                </div>
            </div>

            <!-- Modal Pop-Up -->
            <div id="modal-popup" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 id="modal-title">Ubah Data</h2>
                    <p id="modal-description">Description here...</p>

                    <!-- Form dengan action dinamis -->
                    <form id="update-form" method="POST" action="">
                        @csrf <!-- Tambahkan token CSRF untuk keamanan -->
                        <input type="hidden" name="_method" value="PUT"> <!-- Hidden method for PUT -->
                        <input type="text" id="new_data" name="new_data" value="" required>
                        <button type="submit" id="submit-button">Simpan</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>

    <x-Footer></x-Footer>

    {{-- Script Modal untuk Ubah Email dan Nomor HP --}}
    <script>
        const modal = document.getElementById("modal-popup");
        const spans = document.querySelectorAll("div.isi-data span");
        const closeBtn = document.getElementsByClassName("close")[0];
        const modalTitle = document.getElementById("modal-title");
        const modalDescription = document.getElementById("modal-description");
        const newDataInput = document.getElementById("new_data");
        const form = document.getElementById("update-form");
        

        let currentType = '';

        function openModal(type, currentValue) {
            currentType = type;

            if (type === 'email') {
                modalTitle.innerText = 'Ubah Email';
                modalDescription.innerText = 'Email hanya bisa diubah 1 kali dalam sebulan. Pastikan Email sudah benar.';
                newDataInput.value = currentValue;
                newDataInput.type = "email";

            } else if (type === 'phone') {
                modalTitle.innerText = 'Ubah Nomor HP';
                modalDescription.innerText =
                    'Nomor HP hanya bisa diubah 1 kali dalam sebulan. Pastikan Nomor HP sudah benar.';
                newDataInput.value = currentValue;
                newDataInput.type = "text";
            }

            modal.style.display = "block";
        }

        spans.forEach((span) => {
            span.addEventListener("click", function() {
                const parent = span.parentElement.previousElementSibling;
                const currentValue = span.parentElement.textContent.trim().split(' ')[0];

                if (parent.textContent.includes("Email")) {
                    openModal('email', currentValue);
                } else if (parent.textContent.includes("Nomor HP")) {
                    openModal('phone', currentValue);
                }
            });
        });

        closeBtn.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        form.addEventListener("submit", function(event) {
    event.preventDefault();
    const newData = newDataInput.value;

    if (currentType === 'email') {
        form.action = "{{ route('edit.email', Auth::user()->id) }}";
    } else if (currentType === 'phone') {
        form.action = "{{ route('edit.phone', Auth::user()->id) }}";
    }

    modal.style.display = "none";
    form.submit(); // Now it will submit as POST with _method set to PUT
});
    </script>

    {{-- Script Pilih Foto --}}
    <script>
        const fileInput = document.getElementById('file-input');
        const profileImage = document.getElementById('profile-image');
        const pilihImageDiv = document.querySelector('.pilih-image');
    
        pilihImageDiv.addEventListener('click', function() {
            fileInput.click();
        });
    
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profileImage.src = e.target.result;
                }
                reader.readAsDataURL(file);
    
                // Mengirim gambar ke server via AJAX
                uploadProfilePicture(file);
            } else {
                alert("Silakan pilih file gambar dengan format .jpg, .jpeg, atau .png.");
            }
        });
    
        function uploadProfilePicture(file) {
    let formData = new FormData();
    formData.append('file', file); // Sesuaikan penamaan dengan yang diterima backend
    formData.append('_token', '{{ csrf_token() }}'); // Menyertakan CSRF token

    fetch("{{ route('edit.profilePicture', Auth::user()->id) }}", {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Gambar berhasil diunggah');
            setTimeout(() => {
                    location.reload(); // Refresh the page
                }, 200);
        } else {
            alert('Gagal mengunggah gambar');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
    </script>
</body>

</html>
