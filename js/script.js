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

// Funktion zur Überprüfung der Felder vor dem Absenden des Formulars
function validateForm(event) {
    let hasErrors = false;
    const errorMessages = [];

    const fieldsToCheck = [
        'owner_name',      
        'owner_street',    
        'owner_postalcode',
        'owner_place',
        'operator_name',
        'operator_street',
        'operator_postalcode',
        'operator_place'
    ];

    fieldsToCheck.forEach(function(id) {
        const field = document.getElementById(id);
        if (field) {
            const value = field.value.trim();
            if (!value) {
                hasErrors = true;
                field.classList.add('error');
                errorMessages.push(`Das Feld "${field.placeholder}" muss ausgefüllt werden.`);
            } else {
                field.classList.remove('error');
            }
        }
    });

    if (hasErrors) {
        event.preventDefault();
        alert("Bitte fülle alle erforderlichen Felder aus:\n" + errorMessages.join('\n'));
    }
}

// Initialisierung beim Laden der Seite
window.onload = function() {
    // Füge den Event-Listener für das Formular hinzu
    const form = document.querySelector('form');
    form.addEventListener('submit', validateForm);

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

    // Setze das "required"-Attribut nur für sichtbare Felder (Aktuelles Problem: Es werden ALLE der folgenden Felder als sichtbar erkannt, daher wird auch bei den ausgeblendeten das required Feld gesetzt)
    const formElements = [
        'owner_name',       
        'owner_street',     
        'owner_postalcode', 
        'owner_place',
        'operator_name',
        'operator_street',
        'operator_postalcode',
        'operator_place'       
    ];

    formElements.forEach(function(id) {
        const element = document.getElementById(id);
        if (element && isElementVisible(element)) {
            element.setAttribute('required', 'true');
        }
    });

    // Überprüfen, ob das Element sichtbar ist
    function isElementVisible(el) {
        const style = window.getComputedStyle(el);
        return style.display !== 'none' && style.visibility !== 'hidden';
    }

    console.log("Seite geladen, Standardoptionen gesetzt");
};
