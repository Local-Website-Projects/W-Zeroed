<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/phosphor-icons.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/leaflet.js"></script>
<script src="assets/js/swiper-bundle.min.js"></script>
<script src="assets/js/main.js"></script>

<script>
    const currentUrl = window.location.href;
    const urlObject = new URL(currentUrl);
    console.log(urlObject.pathname);
    if (
        (urlObject.pathname !== '/W-Zeroed/' && urlObject.pathname !== '') && !urlObject.pathname.endsWith('Home')) {
        const myDiv = document.getElementById('header');
        if (myDiv) {
            myDiv.classList.add('-style-white');
        }
    }
</script>