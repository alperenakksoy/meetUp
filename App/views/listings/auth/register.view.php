<?= loadWelcomePartial('headWl'); ?>

<body class="bg-lightbg min-h-screen flex flex-col items-center pt-20">
    <!-- Header -->
    <?= loadWelcomePartial('headerWl'); ?>

    <!-- Main Content -->
    <div class="bg-white rounded-lg w-full max-w-md mb-10 py-5 shadow-md">
        <form method="POST" action="/register">
            <h1 class="mt-2.5 text-3xl text-center font-sans font-bold">Create Account</h1>
            <p class="text-center text-gray-600 mb-4">Join SocialLoop and start connecting</p>

            <?= loadPartial('errors', ['errors' => $errors ?? []]) ?>
            <?= loadPartial('message') ?>

            <div class="flex w-[90%] h-12 my-6 mx-5 justify-between">
                <input type="text" name="first_name" placeholder="First Name" value="<?= $user['first_name'] ?? '' ?>" required class="w-[48%] h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 placeholder-black">
                <input type="text" name="last_name" placeholder="Last Name" value="<?= $user['last_name'] ?? '' ?>" required class="w-[48%] h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 placeholder-black">
            </div>
            
            <div class="w-[90%] h-12 my-6 mx-5">
                <input type="email" name="email" placeholder="Email" value="<?= $user['email'] ?? '' ?>" required class="w-full h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 placeholder-black">
            </div>
            
            <div class="w-[90%] h-12 my-6 mx-5">
                <input type="password" name="password" placeholder="Password" required class="w-full h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 placeholder-black">
                <p class="text-xs text-gray-500 mt-1 ml-2">Password must be at least 6 characters long</p>
            </div>
            
            <div class="w-[90%] h-12 my-6 mx-5">
                <input type="password" name="confirm_password" placeholder="Confirm Password" required class="w-full h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 placeholder-black">
            </div>
            
            <!-- Country dropdown -->
            <div class="w-[90%] h-12 my-6 mx-5">
                <select id="country" name="country" required class="w-full h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 text-black appearance-none cursor-pointer">
                    <option value="" disabled selected>Select Country</option>
                    <!-- Countries will be populated via JS -->
                </select>
            </div>
            
            <!-- City input container - will hold either select or input -->
            <div class="w-[90%] h-12 my-6 mx-5" id="cityContainer">
                <select id="city" name="city" required class="w-full h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 text-black appearance-none cursor-pointer" disabled>
                    <option value="" disabled selected>Select City (Choose a country first)</option>
                </select>
            </div>

            <div class="flex w-[90%] h-12 my-6 mx-5 justify-between gap-2.5">
                <input type="date" name="date_of_birth" value="<?= $user['date_of_birth'] ?? '' ?>" class="w-[48%] h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 text-black" required>
                <select name="gender" class="w-[48%] h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 text-black appearance-none cursor-pointer" required>
                    <option value="" disabled <?= empty($user['gender']) ? 'selected' : '' ?>>Select Gender</option>
                    <option value="Male" <?= isset($user['gender']) && $user['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= isset($user['gender']) && $user['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                    <option value="Other" <?= isset($user['gender']) && $user['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                    <option value="Prefer not to say" <?= isset($user['gender']) && $user['gender'] == 'Prefer not to say' ? 'selected' : '' ?>>Prefer not to say</option>
                </select>
            </div>

            <div class="w-[90%] mx-5 my-2">
                <div class="flex items-center gap-2 mb-4">
                    <input type="checkbox" id="terms" name="terms" required class="h-4 w-4 text-orange-500 focus:ring-orange-500 rounded">
                    <label for="terms" class="text-sm text-gray-700">I agree to the <a href="#" class="text-orange-500 hover:underline">Terms of Service</a> and <a href="#" class="text-orange-500 hover:underline">Privacy Policy</a></label>
                </div>
            </div>

            <button type="submit" class="w-[90%] h-[45px] mx-5 bg-secondary text-white border-none outline-none rounded-3xl cursor-pointer text-base font-semibold hover:bg-gray-700 transition-colors">Create Account</button>

            <div class="login-link p-4 text-center">
                <p>Already have an account? <a href="/login" class="text-orange-500 no-underline font-semibold hover:underline">Log In</a></p>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <?= loadWelcomePartial('footerWl'); ?>

    <script>
   // Replace the existing JavaScript for country and city selection with this improved version

// Country and City selectors
const countrySelect = document.getElementById('country');
const cityContainer = document.getElementById('cityContainer');
let citySelect = document.getElementById('city');

// Function to switch between city select and city input
function switchToCityInput(prefilledValue = '') {
    cityContainer.innerHTML = `
        <input type="text" id="city" name="city" placeholder="Enter your city" value="${prefilledValue}" 
        required class="w-full h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 placeholder-black">
    `;
}

// Function to switch to city select with loading state
function showCityLoadingState() {
    cityContainer.innerHTML = `
        <select id="city" name="city" required class="w-full h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 text-black appearance-none cursor-pointer">
            <option value="" disabled selected>Loading cities...</option>
        </select>
    `;
    return document.getElementById('city');
}

// Function to reset city select to default state
function resetCitySelect() {
    cityContainer.innerHTML = `
        <select id="city" name="city" required class="w-full h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 text-black appearance-none cursor-pointer" disabled>
            <option value="" disabled selected>Select City (Choose a country first)</option>
        </select>
    `;
    return document.getElementById('city');
}

// Function to populate city select with data
function populateCitySelect(cities, previousCity = '') {
    const citySelect = document.getElementById('city');
    citySelect.innerHTML = '<option value="" disabled selected>Select City</option>';
    
    cities.forEach(city => {
        const option = document.createElement('option');
        option.value = city;
        option.textContent = city;
        citySelect.appendChild(option);
    });
    
    citySelect.disabled = false;
    
    // If there was a previously selected city, reselect it
    if (previousCity && citySelect.querySelector(`option[value="${previousCity}"]`)) {
        citySelect.value = previousCity;
    }
    
    return citySelect;
}

// Function to fill country selector with countries from API
function loadCountries() {
    fetch('https://restcountries.com/v3.1/all?fields=name,cca2')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Sort countries alphabetically
            data.sort((a, b) => a.name.common.localeCompare(b.name.common));
            
            // Add countries to select dropdown
            data.forEach(country => {
                const option = document.createElement('option');
                option.value = country.name.common;
                option.textContent = country.name.common;
                // Store country code as data attribute for city lookup
                option.dataset.code = country.cca2;
                countrySelect.appendChild(option);
            });
            
            // If there was a previously selected country (form validation error), reselect it
            const previousCountry = "<?= $user['country'] ?? '' ?>";
            if (previousCountry) {
                countrySelect.value = previousCountry;
                // Trigger change event to load cities
                const event = new Event('change');
                countrySelect.dispatchEvent(event);
            }
        })
        .catch(error => {
            console.error('Error fetching countries:', error);
            // Fallback to text input for country
            const countryContainer = countrySelect.parentElement;
            countryContainer.innerHTML = `
                <input type="text" name="country" placeholder="Country" value="<?= $user['country'] ?? '' ?>" 
                required class="w-full h-full bg-transparent border border-gray-500 outline-none rounded-3xl px-5 placeholder-black">
            `;
            
            // Also switch to text input for city
            switchToCityInput("<?= $user['city'] ?? '' ?>");
        });
}

// Load countries when page loads
loadCountries();

// Handle country selection to populate cities
countrySelect.addEventListener('change', function() {
    const selectedCountry = this.value;
    
    if (!selectedCountry) {
        citySelect = resetCitySelect();
        return;
    }
    
    // Get the selected option and its country code
    const selectedOption = this.options[this.selectedIndex];
    const countryCode = selectedOption?.dataset?.code;
    
    if (!countryCode) {
        // If we can't get the country code, fall back to text input
        switchToCityInput("<?= $user['city'] ?? '' ?>");
        return;
    }
    
    // Show loading state
    citySelect = showCityLoadingState();
    
    // Use GeoDB Cities API - this is a free API with reasonable limits
    // Documentation: https://rapidapi.com/wirefreethought/api/geodb-cities/
    const options = {
        method: 'GET',
        headers: {
            'X-RapidAPI-Key': 'YOUR_RAPIDAPI_KEY', // You'll need to replace this with your actual key
            'X-RapidAPI-Host': 'wft-geo-db.p.rapidapi.com'
        }
    };
    
    fetch(`https://wft-geo-db.p.rapidapi.com/v1/geo/countries/${countryCode}/regions`, options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch cities');
            }
            return response.json();
        })
        .then(data => {
            // Extract region names, which are more practical than trying to load all cities
            if (data.data && data.data.length > 0) {
                // Sort regions alphabetically
                const regions = data.data
                    .map(region => region.name)
                    .sort((a, b) => a.localeCompare(b));
                
                // Populate select with regions
                citySelect = populateCitySelect(regions, "<?= $user['city'] ?? '' ?>");
            } else {
                // If no regions found, switch to text input
                switchToCityInput("<?= $user['city'] ?? '' ?>");
            }
        })
        .catch(error => {
            console.error('Error fetching cities:', error);
            
            // As a fallback, try fetching a static list of major cities for the country
            fetch(`https://countriesnow.space/api/v0.1/countries/cities`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    country: selectedCountry
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch cities from backup API');
                }
                return response.json();
            })
            .then(data => {
                if (data.data && data.data.length > 0) {
                    // Sort cities alphabetically and limit to first 100 to avoid performance issues
                    const cities = data.data
                        .sort((a, b) => a.localeCompare(b))
                        .slice(0, 100);
                    
                    // Populate select with cities
                    citySelect = populateCitySelect(cities, "<?= $user['city'] ?? '' ?>");
                } else {
                    // If no cities found, switch to text input
                    switchToCityInput("<?= $user['city'] ?? '' ?>");
                }
            })
            .catch(backupError => {
                console.error('Error fetching from backup API:', backupError);
                // Finally fall back to text input if both APIs fail
                switchToCityInput("<?= $user['city'] ?? '' ?>");
            });
        });
});

// Select styling
document.addEventListener('change', function(e) {
    if (e.target.tagName === 'SELECT') {
        if (e.target.value) {
            e.target.classList.add('text-gray-800');
        } else {
            e.target.classList.remove('text-gray-800');
        }
    }
});
    </script>
</body>
</html>