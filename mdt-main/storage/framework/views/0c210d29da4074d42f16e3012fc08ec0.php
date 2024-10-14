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

    <div class="buat-laporan-container">
        <div class="halaman-buat-laporan">
            <div class="title-buat-laporan">Laporkan orang Hilang</div>
            <div class="warning-buat-laporan">
                <div>Perlu diingat, meskipun membagikan foto orang yang hilang dapat mempercepat penemuan orang
                    tersebut
                    dengan bantuan orang lain, hal ini juga bisa membuat Pencuri atau pihak yang tidak bertanggung jawab
                    mungkin akan semakin waspada jika mengetahui bahwa orang tersebut sedang dicari. Sebaiknya bagikan
                    dengan hati-hati dan pertimbangkan ke mana serta kepada siapa informasi tersebut disebarkan.</div>
                <div><img src="./img/warning.png" alt="tes"></div>
            </div>
            <form action="<?php echo e(route ('upload.laporan.orang')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="detail-barang">
                    <div class="title-detail-barang">
                        <div class="title-detail-barang1">Detail Orang</div>
                    </div>
                    <div class="detail-input-barang">
                        <div class="nama-barang">
                            <div class="title-barang">Nama Orang</div>
                            <div class="input-barang"><input type="text" placeholder="Contoh : Muhammad Ridwan"
                                    maxlength="30" name="nama_orang" id="nama_orang"></div>
                            <div class="ketentuan-penulisan">
                                <div class="text-penulisan">*Tulis ciri-ciri orang maks. 30 karakter</div>
                                <div class="maksimal-penulisan">0/30</div>
                            </div>
                        </div>
                        <div class="lokasi-barang">
                            <div class="title-barang">Lokasi orang hilang</div>
                            <div class="input-barang"><input type="text"
                                    placeholder="Contoh: Jl. Gajah raya" maxlength="60"
                                    name="alamat_orang" id="alamat_orang"></div>
                            <div class="ketentuan-penulisan">
                                <div class="text-penulisan">*Tulis alamat terakhir orang sebelum hilang maks. 60
                                    karakter
                                </div>
                                <div class="maksimal-penulisan">0/60</div>
                            </div>
                        </div>
                        <div class="terakhir-barang">
                            <div class="title-barang">Umur</div>
                            <div class="input-barang">
                                <input type="text" placeholder="10 Tahun" oninput="formatUsia(this)" maxlength="10" name="usia" id="usia">
                            </div>
                        </div>
                        <div class="foto-barang">
                            <div class="title-barang">Foto Orang</div>
                            <div class="input-gambar">
                                <div class="input-barang-1">
                                    <img id="img1" src="./img/addfoto1.png" alt=""
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
</body>

</html>
<?php /**PATH C:\Users\LENOVO\Documents\GitHub\WebsiteDataTerminal\mdt\resources\views/buat-laporan-orang.blade.php ENDPATH**/ ?>