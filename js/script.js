// Funktion zur Berechnung der Gesamtsumme nur für die angegebenen Felder
function calculateTotal() {
    const fieldsToSum = [
        'eur_panels',
        'eur_inverter',
        'eur_transformer',
        'eur_supporting_structure',
        'eur_video',
        'eur_fence',
        'eur_miscellaneous'
    ];

    const total = sumFields(fieldsToSum);

    const formatter = new Intl.NumberFormat('de-DE', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });

    document.getElementById('total').textContent = formatter.format(total) + ' €';
}

// Funktion zur Berechnung der Gesamtsumme aus den Eingabefeldern (Ertragsausfall- und BU-Versicherung)
function calculate_BI_Total() {
    const fields = {
        feedAmount: 'BI_annual_feed',
        feedTariff: 'BI_feed_in_tariff',
        consumptionAmount: 'BI_annual_self_consumption',
        consumptionTariff: 'BI_self_consumption_tariff'
    };

    const total = sumFields(Object.values(fields));

    const formatter = new Intl.NumberFormat('de-DE', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });

    document.getElementById('BI_total').textContent = formatter.format(total) + ' €';
}

// Gemeinsame Funktion zur Berechnung der Summe der angegebenen Felder
function sumFields(fieldIds) {
    return fieldIds.reduce((sum, id) => {
        const field = document.getElementById(id);
        if (field) {
            const value = parseFloat(field.value.replace(',', '.')) || 0;
            sum += value;
        }
        return sum;
    }, 0);
}


// Initialisierung beim Laden der Seite
window.onload = function () {
    // Initiale Berechnung der Gesamtsummen
    calculateTotal();
    calculate_BI_Total();

    // Setze das Mindestdatum für das Feld "date_commencement"
    const dateInput = document.getElementById('date_commencement');
    const today = new Date().toISOString().split('T')[0];
    dateInput.setAttribute('min', today);
    dateInput.addEventListener('change', () => {
        if (new Date(dateInput.value) < new Date(today)) {
            alert('Das Datum darf nicht in der Vergangenheit liegen.');
        }
    });
};


// Function to toggle 'required' attribute for a group of form fields
const toggleRequiredAttributes = (fieldIds, isRequired) => {
    fieldIds.forEach((id) => {
        const element = document.getElementById(id);
        if (element) {
            // Add or remove the 'required' attribute based on the visibility state
            if (isRequired) {
                element.setAttribute('required', 'true');
            } else {
                element.removeAttribute('required');
            }
        }
    });
};

// Define form element IDs for "owner" scenario
const ownerFormFields = ['owner_name', 'owner_street', 'owner_postalcode', 'owner_place'];

// Define form element IDs for "operator" scenario
const operatorFormFields = ['operator_name', 'operator_street', 'operator_postalcode', 'operator_place'];

// Add event listeners to all radio buttons for toggling required attributes
document.querySelectorAll('input[name="relation_to_plant"]').forEach((radioButton) => {
    radioButton.addEventListener('change', (event) => {
        const selectedRelation = event.target.value; // Current selected radio button value

        // Handle the "operator_foreign_plant" scenario
        if (selectedRelation === 'operator_foreign_plant') {
            toggleRequiredAttributes(ownerFormFields, true); // Make owner fields required
        } else {
            toggleRequiredAttributes(ownerFormFields, false); // Remove required from owner fields
        }

        // Handle the "owner_only" scenario
        if (selectedRelation === 'owner_only') {
            toggleRequiredAttributes(operatorFormFields, true); // Make operator fields required
        } else {
            toggleRequiredAttributes(operatorFormFields, false); // Remove required from operator fields
        }
    });
});


// Define form fields for the "Address" scenario
const addressFormFields = ['address_street', 'address_postalcode', 'address_place'];

// Define form fields for the "Coordinates" scenario
const coordinatesFormFields = ['coordinates'];

// Add event listeners to radio buttons for toggling required attributes
document.querySelectorAll('input[name="address_or_coordinates"]').forEach((radioButton) => {
    radioButton.addEventListener('change', (event) => {
        const selectedOption = event.target.value; // Get the selected radio button value

        // Handle the "Address" option
        if (selectedOption === 'address') {
            toggleRequiredAttributes(addressFormFields, true); // Make address fields required
            toggleRequiredAttributes(coordinatesFormFields, false); // Remove required from coordinates fields
        }

        // Handle the "Coordinates" option
        if (selectedOption === 'coordinates') {
            toggleRequiredAttributes(coordinatesFormFields, true); // Make coordinates fields required
            toggleRequiredAttributes(addressFormFields, false); // Remove required from address fields
        }
    });
});


// Define form fields for the "Ausland" (Other Country) scenario
const otherCountryFields = ['name_other_land', 'applicant_share_50'];

// Add event listeners to radio buttons for toggling required attributes
document.querySelectorAll('input[name="insured_land"]').forEach((radioButton) => {
    radioButton.addEventListener('change', (event) => {
        const selectedOption = event.target.value; // Get the selected radio button value
        // Handle the "Ausland" (Other Country) option
        if (selectedOption === 'Ausland') {
            toggleRequiredAttributes(otherCountryFields, true); // Make other country fields required
        }else {
            toggleRequiredAttributes(otherCountryFields, false); // Make other country fields required
        }
    });
});


// Define form fields for the "Ja" (Yes) scenario
const businessInterruptionFields = ['BI_annual_feed', 'BI_feed_in_tariff'];

// Add event listeners to radio buttons for toggling required attributes
document.querySelectorAll('input[name="business_interruption"]').forEach((radioButton) => {
    radioButton.addEventListener('change', (event) => {
        const selectedOption = event.target.value; // Get the selected radio button value

        if (selectedOption === 'Ja') {
            // If "Ja" is selected, make the fields required
            toggleRequiredAttributes(businessInterruptionFields, true);
        } else {
            // If "Nein" is selected, remove the required attribute
            toggleRequiredAttributes(businessInterruptionFields, false);
        }
    });
});


// Define form fields for the "Ja" (Yes) scenario
const selfConsumptionFields = ['BI_annual_self_consumption', 'BI_self_consumption_tariff'];

// Add event listeners to radio buttons for toggling required attributes
document.querySelectorAll('input[name="self_consumption"]').forEach((radioButton) => {
    radioButton.addEventListener('change', (event) => {
        const selectedOption = event.target.value; // Get the selected radio button value

        if (selectedOption === 'Ja') {
            // If "Ja" is selected, make the fields required
            toggleRequiredAttributes(selfConsumptionFields, true);
        } else {
            // If "Nein" is selected, remove the required attribute
            toggleRequiredAttributes(selfConsumptionFields, false);
        }
    });
});


document.getElementById("closeModel").addEventListener("click" , () => {
    document.getElementById("showPass").classList.add("hidePass")
})


document.getElementById("closeModelButton").addEventListener("click" , () => {
    document.getElementById("showPass").classList.add("hidePass")
})