<?php if (isset($component)) { $__componentOriginal2a2e454b2e62574a80c8110e5f128b60 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2a2e454b2e62574a80c8110e5f128b60 = $attributes; } ?>
<?php $component = App\View\Components\Header::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Header::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e($title); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2a2e454b2e62574a80c8110e5f128b60)): ?>
<?php $attributes = $__attributesOriginal2a2e454b2e62574a80c8110e5f128b60; ?>
<?php unset($__attributesOriginal2a2e454b2e62574a80c8110e5f128b60); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2a2e454b2e62574a80c8110e5f128b60)): ?>
<?php $component = $__componentOriginal2a2e454b2e62574a80c8110e5f128b60; ?>
<?php unset($__componentOriginal2a2e454b2e62574a80c8110e5f128b60); ?>
<?php endif; ?>

<body>
    <?php if (isset($component)) { $__componentOriginalb9eddf53444261b5c229e9d8b9f1298e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb9eddf53444261b5c229e9d8b9f1298e = $attributes; } ?>
<?php $component = App\View\Components\Navbar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('Navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Navbar::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb9eddf53444261b5c229e9d8b9f1298e)): ?>
<?php $attributes = $__attributesOriginalb9eddf53444261b5c229e9d8b9f1298e; ?>
<?php unset($__attributesOriginalb9eddf53444261b5c229e9d8b9f1298e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb9eddf53444261b5c229e9d8b9f1298e)): ?>
<?php $component = $__componentOriginalb9eddf53444261b5c229e9d8b9f1298e; ?>
<?php unset($__componentOriginalb9eddf53444261b5c229e9d8b9f1298e); ?>
<?php endif; ?>
    <div class="edit-profile-container">
        <div class="edit-profile">
            
            <div class="pilih-foto">
                <div class="image">
                    <img id="profile-image" src="<?php echo e(Storage::url(Auth::user()->photo)); ?>" alt="Foto Profil">
                </div>
                <div class="pilih-foto-container">
                    <div class="pilih-image">Pilih Foto</div>
                    <input type="file" id="file-input" accept="image/*" style="display: none;">
                    <div class="description-foto">
                        Besaran maksimal file: 10 Megabytes. Ekstensi file yang diperbolehkan: .jpg .jpeg .png.
                    </div>
                </div>
            </div>

            
            <div class="data-diri">
                <div class="title-data">Data Diri</div>
                <div class="isi-data-form">
                    <div class="isi-data">
                        <div class="title-isi-data">NIK</div>
                        <div><?php echo e(Auth::user()->nik); ?></div>
                    </div>
                    <br>
                    <div class="isi-data">
                        <div class="title-isi-data">Nama Lengkap</div>
                        <div><?php echo e(Auth::user()->name); ?></div>
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

                
                <div class="title-data">Kontak</div>
                <div class="isi-data-form">
                    <div class="isi-data">
                        <div class="title-isi-data">Email</div>
                        <div><?php echo e(Auth::user()->email); ?> <span>Ubah</span></div>
                    </div>
                    <div class="isi-data">
                        <div class="title-isi-data">Nomor HP</div>
                        <div><?php echo e(Auth::user()->nomorhp); ?> <span>Ubah</span></div>
                    </div>
                </div>
                <br>
                <div class="logout">
                    <a href="<?php echo e(route('logout')); ?>"><button>Logout</button></a>
                    
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
                        <?php echo csrf_field(); ?> <!-- Tambahkan token CSRF untuk keamanan -->
                        <input type="hidden" name="_method" value="PUT"> <!-- Hidden method for PUT -->
                        <input type="text" id="new_data" name="new_data" value="" required>
                        <button type="submit" id="submit-button">Simpan</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($component)) { $__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa = $attributes; } ?>
<?php $component = App\View\Components\Footer::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('Footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Footer::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa)): ?>
<?php $attributes = $__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa; ?>
<?php unset($__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa)): ?>
<?php $component = $__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa; ?>
<?php unset($__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa); ?>
<?php endif; ?>

    
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
    span.addEventListener("click", function () {
        const parent = span.parentElement.previousElementSibling;
        const currentValue = span.parentElement.textContent.trim().split(' ')[0];

        if (parent.textContent.includes("Email")) {
            openModal('email', currentValue);
        } else if (parent.textContent.includes("Nomor HP")) {
            openModal('phone', currentValue);
        }
    });
});

closeBtn.onclick = function () {
    modal.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

form.addEventListener("submit", function (event) {
    event.preventDefault();
    const newData = newDataInput.value;

    if (currentType === 'email') {
        form.action = "<?php echo e(route('edit.email', Crypt::encryptString(Auth::user()->id))); ?>";
    } else if (currentType === 'phone') {
        form.action = "<?php echo e(route('edit.phone', Crypt::encryptString(Auth::user()->id))); ?>";
    }

    modal.style.display = "none";

    // Submit the form using AJAX to handle validation errors
    fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: {
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        }
    }).then(response => response.json())
      .then(data => {
          if (data.success) {
              alert(currentType === 'email' ? 'Email berhasil diubah!' : 'Nomor HP berhasil diubah!');
              location.reload(); // Reload the page to show updated data
          } else {
              // Display error message if email or phone is already in use
              alert(data.error || 'Terjadi kesalahan. Silakan coba lagi.');
          }
      }).catch(error => {
          console.error('Error:', error);
          alert('Terjadi kesalahan. Silakan coba lagi.');
      });
});

    </script>

    
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
    formData.append('_token', '<?php echo e(csrf_token()); ?>'); // Menyertakan CSRF token

    fetch("<?php echo e(route('edit.profilePicture', Crypt::encryptString(Auth::user()->id))); ?>", {
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
<?php /**PATH C:\Users\LENOVO\Documents\GitHub\WebsiteDataTerminal\mdt\resources\views/edit-profile.blade.php ENDPATH**/ ?>