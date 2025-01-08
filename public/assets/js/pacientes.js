function calculateSchoolCycle() {
    const controlNumber = document.getElementById("controlNumber").value; // Obtiene el valor del campo de número de control
    if (controlNumber.length >= 2) { // Verifica si el número de control tiene al menos 2 caracteres
        const yearPrefix = controlNumber.substring(0, 2); // Toma los primeros 2 caracteres (los dos primeros digitos del año)
        const year = parseInt("20" + yearPrefix); // Convierte esos digitos en un año completo (asume que es del siglo actual)
        const schoolCycle = `${year}-${year + 1}`; // Genera el ciclo escolar como "Año-Año+1"
        document.getElementById("schoolCycle").value = schoolCycle; // Asigna el ciclo escolar al campo correspondiente
    } else {
        document.getElementById("schoolCycle").value = ''; // Si no cumple la condición, deja el campo vacio
    }
}


