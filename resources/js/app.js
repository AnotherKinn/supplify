import './bootstrap';
import Alpine from 'alpinejs';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

// Import langsung icon marker (supaya bisa dipakai di Vite)
import markerIcon2x from 'leaflet/dist/images/marker-icon-2x.png';
import markerIcon from 'leaflet/dist/images/marker-icon.png';
import markerShadow from 'leaflet/dist/images/marker-shadow.png';

// Fix path icon di Leaflet
delete L.Icon.Default.prototype._getIconUrl;

L.Icon.Default.mergeOptions({
    iconRetinaUrl: markerIcon2x,
    iconUrl: markerIcon,
    shadowUrl: markerShadow,
});

window.Alpine = Alpine;

document.addEventListener('DOMContentLoaded', () => {
    const totalSlides = document.querySelectorAll('.mySwiper .swiper-slide').length;

    // supaya selalu < totalSlides, biar bisa geser walau slide cuma 4
    const perViewDesktop = Math.min(3, Math.max(1, totalSlides - 1));
    const perViewTablet = Math.min(2, Math.max(1, totalSlides - 1));
    const perViewMobile = 1;

    new Swiper('.mySwiper', {
        direction: 'horizontal',
        spaceBetween: 20,
        slidesPerView: perViewMobile,
        loop: totalSlides > perViewMobile, // loop hanya jika cukup slide
        loopedSlides: totalSlides, // gandakan biar loop mulus
        autoplay: {
            delay: 1, // jalan terus (jangan 0)
            disableOnInteraction: false,
            reverseDirection: false, // kanan → kiri
        },
        speed: 3000, // atur kecepatan geser
        grabCursor: true,
        breakpoints: {
            640: {
                slidesPerView: perViewTablet
            },
            1024: {
                slidesPerView: perViewDesktop
            }
        }
    });
});

// Leaflet Map
const mapElement = document.getElementById("map");
if (mapElement) {
    const latitude = -6.423545;
    const longitude = 106.940072;

    const map = L.map('map').setView([latitude, longitude], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    L.marker([latitude, longitude]).addTo(map)
        .bindPopup("<b>SMKN 1 Gunungputri</b><br>Jl. Barokah No.06, Wanaherang, Kec.Gn. Putri, Kabupaten Bogor")
        .openPopup();
}

Alpine.start();
