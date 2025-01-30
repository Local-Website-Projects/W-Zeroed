<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/phosphor-icons.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/leaflet.js"></script>
<script src="assets/js/swiper-bundle.min.js"></script>
<script src="assets/js/main.js"></script>

<!-- Toastr -->
<script src="vendor/toastr/js/toastr.min.js"></script>
<script src="assets/js/plugins-init/toastr-init.js"></script>

<script>
    const currentUrl = window.location.href;
    const urlObject = new URL(currentUrl);
    if (
        (urlObject.pathname !== '/W-Zeroed/' && urlObject.pathname !== '') && !urlObject.pathname.endsWith('Home')) {
        const myDiv = document.getElementById('header');
        if (myDiv) {
            myDiv.classList.add('-style-white');
        }
    }
</script>

<script>
    var config = {
        cUrl: 'https://api.countrystatecity.in/v1/countries',
        ckey: 'aDBxcHhBZHlCYldhS0ZXTWJlSnF6bXhnZWtkOWNOckRGVjBBU3FnbA=='
    }


    var countrySelect = document.querySelector('.country_select'),
        stateSelect = document.querySelector('.state_select'),
        citySelect = document.querySelector('.city_select')

    function loadCountries() {

        let apiEndPoint = config.cUrl

        fetch(apiEndPoint, {headers: {"X-CSCAPI-KEY": config.ckey}})
            .then(Response => Response.json())
            .then(data => {
                // console.log(data);

                data.forEach(country => {
                    const option = document.createElement('option')
                    option.value = country.iso2
                    option.textContent = country.name
                    countrySelect.appendChild(option)
                })
            })
            .catch(error => console.error('Error loading countries:', error))

        stateSelect.disabled = true
        citySelect.disabled = true
        stateSelect.style.pointerEvents = 'none'
        citySelect.style.pointerEvents = 'none'
    }
    function loadStates() {
        stateSelect.disabled = false
        citySelect.disabled = true
        stateSelect.style.pointerEvents = 'auto'
        citySelect.style.pointerEvents = 'none'

        const selectedCountryCode = countrySelect.value
        // console.log(selectedCountryCode);
        stateSelect.innerHTML = '<option value="">Select State</option>' // for clearing the existing states
        citySelect.innerHTML = '<option value="">Select City</option>' // Clear existing city options

        fetch(`${config.cUrl}/${selectedCountryCode}/states`, {headers: {"X-CSCAPI-KEY": config.ckey}})
            .then(response => response.json())
            .then(data => {
                // console.log(data);

                data.forEach(state => {
                    const option = document.createElement('option')
                    option.value = state.iso2
                    option.textContent = state.name
                    stateSelect.appendChild(option)
                })
            })
            .catch(error => console.error('Error loading countries:', error))
    }


    function loadCities() {
        citySelect.disabled = false
        citySelect.style.pointerEvents = 'auto'

        const selectedCountryCode = countrySelect.value
        const selectedStateCode = stateSelect.value
        // console.log(selectedCountryCode, selectedStateCode);

        citySelect.innerHTML = '<option value="">Select City</option>' // Clear existing city options

        fetch(`${config.cUrl}/${selectedCountryCode}/states/${selectedStateCode}/cities`, {headers: {"X-CSCAPI-KEY": config.ckey}})
            .then(response => response.json())
            .then(data => {
                // console.log(data);

                data.forEach(city => {
                    const option = document.createElement('option')
                    option.value = city.iso2
                    option.textContent = city.name
                    citySelect.appendChild(option)
                })
            })
    }

    window.onload = loadCountries
</script>