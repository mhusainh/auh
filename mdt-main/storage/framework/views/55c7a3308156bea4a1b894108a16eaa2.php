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
    <div class="profile-container">
        <div class="profile">
            <div class="profile-header">
                <div class="profile-name">
                    <div class="profile-image-name">
                        <div><img src="<?php echo e(Storage::url(Auth::user()->photo)); ?>" alt="tes"></div>
                        <div><?php echo e(Auth::user()->name); ?></div>
                    </div>
                    <div>
                        <a href="<?php echo e(route('edit.profile', Crypt::encryptString(Auth::user()->id))); ?>">
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
                <?php $__currentLoopData = $barangHilang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hilang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div id="barangHilang" class="profile-main">
                        <div class="profile-laporan-image">
                            <div><img src="<?php echo e(Storage::url($hilang->gambar_barang1)); ?>" alt="tes"></div>
                            <div class="profile-laporan-description">
                                <div class="profile-laporan-title">
                                    <div class="profile-laporan-title-name"><?php echo e($hilang->nama_barang); ?></div>
                                    <div class="profile-laporan-container">
                                        <div class="profile-laporan-lokasi">
                                            <div>Lokasi terakhir : </div>
                                            <div><span><?php echo e($hilang->alamat_barang); ?></span></div>
                                        </div>
                                        <div class="profile-laporan-status">
                                            <div>Status : </div>
                                            <div>
                                                <span class="status-text <?php echo e($hilang->status === 'Sudah Ditemukan' ? 'status-found' : ''); ?>">
                                                    <?php echo e($hilang->status); ?>

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
                                    <a href="<?php echo e(route('edit.laporan', Crypt::encryptString($hilang->id))); ?>">
                                        <div class="dropdown-main-1">
                                            <img src="img/edit.png" alt="">
                                            <div>Ubah</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-main">
                                    <form id="status-form-<?php echo e($hilang->id); ?>"
                                        action="<?php echo e(route('update.status', Crypt::encryptString($hilang->id))); ?>"
                                        method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <input type="hidden" name="status" value="Sudah Ditemukan">
                                        <a href="javascript:void(0);"
                                            onclick="document.getElementById('status-form-<?php echo e($hilang->id); ?>').submit()">
                                            <div class="dropdown-main-1">
                                                <img src="img/check_box.png" alt="">
                                                <div>Sudah ditemukan</div>
                                            </div>
                                        </a>
                                    </form>
                                </div>
                                <div class="dropdown-main">
                                    <form id="delete-form-<?php echo e($hilang->id); ?>"
                                        action="<?php echo e(route('delete.laporan', Crypt::encryptString($hilang->id))); ?>"
                                        method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <a href="javascript:void(0);"
                                            onclick="confirmDelete('delete-form-<?php echo e($hilang->id); ?>')">
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="profile-main-container-2" style="display: none">
                <?php $__currentLoopData = $orangHilang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div id="orangHilang" class="profile-main-2">
                    <div class="profile-laporan-image">
                        <div><img src="<?php echo e(storage::url($orang->gambar_orang)); ?>" alt="tes"></div>
                        <div class="profile-laporan-description">
                            <div class="profile-laporan-title">
                                <div class="profile-laporan-title-name"><?php echo e($orang->nama_orang); ?></div>
                                <div class="profile-laporan-container">
                                    <div class="profile-laporan-lokasi">
                                        <div>Lokasi terakhir : </div>
                                        <div><span><?php echo e($orang->alamat_orang); ?></span></div>
                                    </div>
                                    <div class="profile-laporan-status">
                                        <div>Status : </div>
                                        <div><span class="status-text <?php echo e($orang->status === 'Sudah Ditemukan' ? 'status-found' : ''); ?>">
                                            <?php echo e($orang->status); ?>

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
                                <a href="<?php echo e(route('edit.laporan.orang', Crypt::encryptString($orang->id))); ?>">
                                    <div class="dropdown-main-1">
                                        <img src="img/edit.png" alt="">
                                        <div>Ubah</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-main">
                                <form id="status-form-<?php echo e($orang->id); ?>"
                                    action="<?php echo e(route('update.status.orang', Crypt::encryptString($orang->id))); ?>" 
                                    method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?> <!-- Method override for PUT -->
                                    <input type="hidden" name="status" value="Sudah Ditemukan">
                                    <a href="javascript:void(0);" 
                                        onclick="document.getElementById('status-form-<?php echo e($orang->id); ?>').submit()">
                                        <div class="dropdown-main-1">
                                            <img src="img/check_box.png" alt="">
                                            <div>Sudah ditemukan</div>
                                        </div>
                                    </a>
                                </form>
                            </div>
                            <div class="dropdown-main">
                                <form id="delete-form-<?php echo e($orang->id); ?>"
                                    action="<?php echo e(route('delete.laporan.orang', Crypt::encryptString($orang->id))); ?>"
                                    method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <a href="javascript:void(0);"
                                        onclick="confirmDelete('delete-form-<?php echo e($orang->id); ?>')">
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH C:\Users\LENOVO\Documents\GitHub\WebsiteDataTerminal\mdt\resources\views/profile.blade.php ENDPATH**/ ?>