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
    
    <div class="laporan">
        <div class="laporan-barang-hilang">
            <div class="navbar-laporan">
                <div class="title-laporan">Laporan Barang Hilang</div>
                <div class="navbar-laporan-urutkan">
                    <div class="urutkan">Urutkan :</div>
                    <form action="<?php echo e(route('lapor.barang')); ?>">
                        <select class="terbaru" name="sort" id="sort" onchange="this.form.submit()">
                            <option value="latest" <?php echo e(request('sort') == 'latest' ? 'selected' : ''); ?> class="opsi-urutkan">Terbaru</option>
                            <option value="oldest" <?php echo e(request('sort') == 'oldest' ? 'selected' : ''); ?> class="opsi-urutkan">Terlama</option>
                        </select>
                    </form>
                </div>
            </div>
            
            <?php $__currentLoopData = $barangHilang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hilang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="main-laporan" data-id="<?php echo e($hilang->id); ?>">
                    <div class="header-laporan">
                        <div class="title-user">
                            <div class="title"><?php echo e($hilang->nama_barang); ?></div>
                            <div class="user">
                                <img src="<?php echo e(Storage::url($hilang->user->photo)); ?>" alt=""><?php echo e($hilang->user->name); ?>

                            </div>
                        </div>
                        <div class="date-time">
                            <div class="date"><?php echo e(\Carbon\Carbon::parse($hilang->created_at)->translatedFormat('d F Y')); ?></div>
                            <div class="time"><?php echo e(\Carbon\Carbon::parse($hilang->created_at)->setTimezone('Asia/Jakarta')->format('H:i')); ?></div>
                        </div>
                    </div>
                    
                    <div class="body-laporan">
                        <div class="body-laporan-1">
                            <div class="content-laporan">
                                <div class="terakhir-dilihat">Lokasi Terakhir : <span><?php echo e($hilang->alamat_barang); ?></span></div>
                                <div class="terakhir-dilihat">Terakhir dilihat : <span><?php echo e(\Carbon\Carbon::parse($hilang->tanggal_hilang)->translatedFormat('d F Y')); ?></span></div>
                                
                                <!-- Conditional Styling for Status -->
                                <div class="status">
                                    Status : 
                                    <span style="<?php echo e($hilang->status == 'Sudah Ditemukan' ? 'color: black;' : ''); ?>">
                                        <?php echo e($hilang->status); ?>

                                    </span>
                                </div>
                                
                                <div class="detail">Detail :</div>
                                <div class="content-detail">
                                    <p><?php echo e($hilang->deskripsi_barang); ?></p>
                                </div>
                            </div>
                            
                            <div class="image-laporan">
                                <div class="arrow">
                                    <div class="arrow-left" style="display:none;"><</div>
                                </div>
                                <div>
                                    <img src="<?php echo e(Storage::url($hilang->gambar_barang1)); ?>" alt="" class="clickable-image">
                                </div>
                                <div class="arrow">
                                    <div class="arrow-right" style="display:none;">></div>
                                </div>
                            </div>
                        </div>
                        <div class="footer-laporan" data-id="<?php echo e($hilang->id); ?>">
                            <div><span>comment-alt</span> <?php echo e($hilang->comments->count()); ?></div>
                            <div><span>share-alt</span> 11</div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- Popup section -->
    <div class="popup" style="display: none">
        <div class="popup-main">
            <?php $__currentLoopData = $barangHilang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hilang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="main-laporan" data-id="<?php echo e($hilang->id); ?>">
                    <div class="header-laporan">
                        <div class="title-user">
                            <div class="title"><?php echo e($hilang->nama_barang); ?></div>
                            <div class="user">
                                <img src="<?php echo e(Storage::url($hilang->user->photo)); ?>" alt=""><?php echo e($hilang->user->name); ?>

                            </div>
                        </div>
                        <div class="button-close-popup">
                            <div class="date-time">
                                <div class="date"><?php echo e(\Carbon\Carbon::parse($hilang->created_at)->translatedFormat('d F Y')); ?></div>
                                <div class="time"><?php echo e(\Carbon\Carbon::parse($hilang->created_at)->setTimezone('Asia/Jakarta')->format('H:i')); ?></div>
                            </div>
                            <div class="container-button-close">
                                <div class="button-close">X</div>
                            </div>
                        </div>
                    </div>
                    <div class="body-laporan">
                        <div class="body-laporan-1">
                            <div class="content-laporan">
                                <div class="terakhir-dilihat">Lokasi Terakhir : <span><?php echo e($hilang->alamat_barang); ?></span></div>
                                <div class="terakhir-dilihat">Terakhir dilihat : <span><?php echo e(\Carbon\Carbon::parse($hilang->tanggal_hilang)->translatedFormat('d F Y')); ?></span></div>
                                <div class="status">Status : <span><?php echo e($hilang->status); ?></span></div>
                                <div class="detail">Detail :</div>
                                <div class="content-detail">
                                    <p><?php echo e($hilang->deskripsi_barang); ?></p>
                                </div>
                            </div>
                            <div class="image-laporan">
                                <div class="arrow">
                                    <div class="arrow-left" style="display:none;"><</div>
                                </div>
                                <div>
                                    <img src="<?php echo e(Storage::url($hilang->gambar_barang1)); ?>" alt="">
                                </div>
                                <div class="arrow">
                                    <div class="arrow-right" style="display:none;">></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-message">
                        <div class="message-laporan">
                            <?php if($hilang->comments && $hilang->comments->count()): ?>
                                <?php
                                    $lastDate = null; // Variable to store the last displayed date
                                ?>
                                <?php $__currentLoopData = $hilang->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $currentDate = \Carbon\Carbon::parse($comment->created_at)->translatedFormat('d F Y');
                                    ?>
                                    <?php if($currentDate !== $lastDate): ?> 
                                        <!-- Only render the date if it's different from the last displayed one -->
                                        <div class="date-laporan">
                                            <div class="garis1"></div>
                                            <div class="date-laporan2"><?php echo e($currentDate); ?></div>
                                            <div class="garis2"></div>
                                        </div>
                                        <?php
                                            $lastDate = $currentDate; // Update the last displayed date
                                        ?>
                                    <?php endif; ?>
                        
                                    <!-- The rest of the comment structure remains unchanged -->
                                    <div class="container-chat-message">
                                        <div class="chat-message-main">
                                            <div class="time-message"><?php echo e($comment->created_at->format('H:i')); ?></div>
                                            <div class="profile-message">
                                                <img src="<?php echo e(Storage::url($comment->user->photo)); ?>" alt="">
                                            </div>
                                            <div class="chat-message"><?php echo e($comment->komentar); ?></div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <p>Belum ada komentar.</p>
                            <?php endif; ?>
                        </div>

                        <div class="container-send-message">
                            <form id="message-form" action="<?php echo e(route('komentar.barang', Crypt::encryptString($hilang->id))); ?>" method="POST">
                                <?php echo csrf_field(); ?>
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div class="buat-laporan">
        <a href="<?php echo e(route('buat.laporan')); ?>">
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
                    "<?php echo e(Storage::url($hilang->gambar_barang2)); ?>",
                    "<?php echo e(Storage::url($hilang->gambar_barang3)); ?>",
                    "<?php echo e(Storage::url($hilang->gambar_barang4)); ?>",
                    "<?php echo e(Storage::url($hilang->gambar_barang5)); ?>"
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
<?php /**PATH C:\Users\LENOVO\Documents\GitHub\WebsiteDataTerminal\mdt\resources\views/laporan.blade.php ENDPATH**/ ?>