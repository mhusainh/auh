<x-header>{{ $tittle }}</x-header>


<body>
    <x-Navbar></x-Navbar>
    
    <div class="contact">
        <div class="map-container">
            <!-- Google Maps Embed Code -->
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.4694985365127!2d110.4150251!3d-6.9971386!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b6769041ae9%3A0xc903b0320fc8986d!2sPolda%20Jawa%20Tengah!5e0!3m2!1sen!2sid!4v1693847814836!5m2!1sen!2sid"
                {{-- width="100"
                height="400" --}} style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <div class="info">
                <div class="hubungi-kami">
                    <h1>Hubungi Kami</h1>
                </div>
            </div>
        </div>
    
    </div>
    
    
    <x-Footer></x-Footer>
</body>

</html>
