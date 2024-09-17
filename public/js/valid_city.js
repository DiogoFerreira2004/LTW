const countryCities = {
    "Portugal": ["Lisbon", "Porto", "Penafiel", "Other"],
    "Angola": ["Luanda", "Benguela", "Huambo", "Other"],
    "Argentina": ["Buenos Aires", "Córdoba", "Rosario", "Other"],
    "Australia": ["Sydney", "Melbourne", "Brisbane", "Other"],
    "Belgium": ["Brussels", "Antwerp", "Ghent", "Other"],
    "Brazil": ["São Paulo", "Rio de Janeiro", "Brasília", "Other"],
    "Canada": ["Toronto", "Vancouver", "Montreal", "Other"],
    "China": ["Beijing", "Shanghai", "Guangzhou", "Other"],
    "Colombia": ["Bogotá", "Medellín", "Cali", "Other"],
    "Croatia": ["Zagreb", "Split", "Rijeka", "Other"],
    "Egypt": ["Cairo", "Alexandria", "Giza", "Other"],
    "France": ["Paris", "Lyon", "Marseille", "Other"],
    "Germany": ["Berlin", "Munich", "Frankfurt", "Other"],
    "Iceland": ["Reykjavik", "Kopavogur", "Hafnarfjordur", "Other"],
    "Ireland": ["Dublin", "Cork", "Galway", "Other"],
    "Italy": ["Rome", "Milan", "Naples", "Other"],
    "Jamaica": ["Kingston", "Montego Bay", "Spanish Town", "Other"],
    "Japan": ["Tokyo", "Osaka", "Nagoya", "Other"],
    "Luxembourg": ["Luxembourg City", "Esch-sur-Alzette", "Differdange", "Other"],
    "Mexico": ["Mexico City", "Guadalajara", "Monterrey", "Other"],
    "Morocco": ["Casablanca", "Marrakech", "Rabat", "Other"],
    "Mozambique": ["Maputo", "Matola", "Beira", "Other"],
    "Nepal": ["Kathmandu", "Pokhara", "Lalitpur", "Other"],
    "Netherlands": ["Amsterdam", "Rotterdam", "The Hague", "Other"],
    "Nigeria": ["Lagos", "Abuja", "Kano", "Other"],
    "Norway": ["Oslo", "Bergen", "Trondheim", "Other"],
    "Peru": ["Lima", "Cusco", "Arequipa", "Other"],
    "Philippines": ["Manila", "Quezon City", "Davao City", "Other"],
    "Poland": ["Warsaw", "Krakow", "Wroclaw", "Other"],
    "Russia": ["Moscow", "Saint Petersburg", "Novosibirsk", "Other"],
    "Saudi Arabia": ["Riyadh", "Jeddah", "Mecca", "Other"],
    "Senegal": ["Dakar", "Touba", "Thiès", "Other"],
    "South Africa": ["Johannesburg", "Cape Town", "Durban", "Other"],
    "South Korea": ["Seoul", "Busan", "Incheon", "Other"],
    "Sweden": ["Stockholm", "Gothenburg", "Malmö", "Other"],
    "Switzerland": ["Zurich", "Geneva", "Basel", "Other"],
    "Thailand": ["Bangkok", "Chiang Mai", "Phuket", "Other"],
    "Turkey": ["Istanbul", "Ankara", "Izmir", "Other"],
    "UK": ["London", "Manchester", "Birmingham", "Other"],
    "USA": ["New York", "Los Angeles", "Chicago", "Other"],
    "Ukrania": ["Kyiv", "Kharkiv", "Odessa", "Other"],
    "Uruguay": ["Montevideo", "Salto", "Paysandú", "Other"]
};

function validateForm() {

    // Validate City for Country
    const country = document.querySelector('select[name="country"]').value;
    const city = document.querySelector('input[name="city"]').value;
    if (!countryCities[country].includes(city)) {
        alert(`City must be a valid city in ${country}.`);
        return false;
    }

    return true;
}
