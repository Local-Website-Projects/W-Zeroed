
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

    // Select the checkbox and the end date input field
    const tillDateCheckbox = document.getElementById('tillDateCheckbox');
    const endDateInput = document.getElementById('endDate');

    // Add event listener to checkbox
    tillDateCheckbox.addEventListener('change', function() {
        // If the checkbox is checked, disable the end date field
        if (this.checked) {
            endDateInput.disabled = true;
        } else {
            endDateInput.disabled = false;
        }
    });
</script>

<script>
    var config = {
        cUrl: 'https://api.countrystatecity.in/v1/countries',
        ckey: 'aDBxcHhBZHlCYldhS0ZXTWJlSnF6bXhnZWtkOWNOckRGVjBBU3FnbA=='  // Your API key
    }

    var countrySelect = document.querySelector('.country_select'),
        stateSelect = document.querySelector('.state_select'),
        citySelect = document.querySelector('.city_select');

    function loadCountries() {
        let apiEndPoint = config.cUrl;

        fetch(apiEndPoint, {headers: {"X-CSCAPI-KEY": config.ckey}})
            .then(response => response.json())
            .then(data => {
                data.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.iso2;
                    option.textContent = country.name;
                    countrySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error loading countries:', error));

        stateSelect.disabled = true;
        citySelect.disabled = true;
        stateSelect.style.pointerEvents = 'none';
        citySelect.style.pointerEvents = 'none';
    }

    function loadStates() {
        stateSelect.disabled = false;
        citySelect.disabled = true;
        stateSelect.style.pointerEvents = 'auto';
        citySelect.style.pointerEvents = 'none';

        const selectedCountryCode = countrySelect.value;
        stateSelect.innerHTML = '<option value="">Select State</option>';
        citySelect.innerHTML = '<option value="">Select City</option>';

        fetch(`${config.cUrl}/${selectedCountryCode}/states`, {headers: {"X-CSCAPI-KEY": config.ckey}})
            .then(response => response.json())
            .then(data => {
                data.forEach(state => {
                    const option = document.createElement('option');
                    option.value = state.iso2;
                    option.textContent = state.name;
                    option.setAttribute('data-name', state.name);  // Store state name in a data attribute
                    stateSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error loading states:', error));
    }

    function loadCities() {
        citySelect.disabled = false;
        citySelect.style.pointerEvents = 'auto';

        const selectedCountryCode = countrySelect.value;
        const selectedStateCode = stateSelect.value;

        citySelect.innerHTML = '<option value="">Select City</option>';

        fetch(`${config.cUrl}/${selectedCountryCode}/states/${selectedStateCode}/cities`, {headers: {"X-CSCAPI-KEY": config.ckey}})
            .then(response => response.json())
            .then(data => {
                data.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.iso2;
                    option.textContent = city.name;
                    option.setAttribute('data-name', city.name);  // Store city name in a data attribute
                    citySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error loading cities:', error));
    }

    // Update hidden input fields when state or city is selected
    function updateStateName() {
        const selectedOption = stateSelect.options[stateSelect.selectedIndex];
        document.getElementById('stateName').value = selectedOption.getAttribute('data-name');
    }

    function updateCityName() {
        const selectedOption = citySelect.options[citySelect.selectedIndex];
        document.getElementById('cityName').value = selectedOption.getAttribute('data-name');
    }

    // Attach the update functions to the onchange events
    stateSelect.addEventListener('change', updateStateName);
    citySelect.addEventListener('change', updateCityName);

    window.onload = loadCountries;

</script>