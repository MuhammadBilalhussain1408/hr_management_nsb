// Countries
 var country_arr = new Array("Dhaka", "Barisal", "Chittagong", "Khulna", "Mymensingh", "Rajshahi ", "Rangpur", "Sylhet");


// States
var s_a = new Array();
s_a[0] = "";
s_a[1] = "Adabor|Aftabnagar|Agargaon|Ashulia|Azimpur|Badda|Badda/Khilgaon|Banani|Banani D.O.H.S (Old)|Bangla Motor|Banglabazar|Baridhara|Bashabo|Bashundhara|Bonoshree|Boro Bobarea|Cantonment|Central Road|Chamelibag|Crescent Road|Dhanmondi|Elephant Road|Eskatan|Fakirapool|Farmgate|Gazipur|Gazipur|Goran|Green Road|Gulshan-1|Gulshan-2|Gulshan-2|Hatirpul|Ibrahimpur|Indira Road|Japan Garden City|Jatrabari|Jigatola|Kakrail|Kalabagan|Kalyanpur|Kathalbagan|Kawran Bazar|Kazipara|Khilgaon|Khilkhet|Lalbagh|Lalmatia|Luxmi Bazar|Malibagh|Meradia|Mirpur|Mirpur D.O.H.S|Mirpur Road|Moghbazar|Mohakhali C/A|Mohakhali D.O.H.S (New)|Mohammadpur|Monipuripara|Motijheel|Mouchak|Narayangong|Near Nandan Park|New Baily Road|Niketon, Gulshan-1|Nobodoy|North Road|Nowabpur|Old Dhaka|Paltan|Panthapath|Pollobi|Poribagh|Purbachal|Rampura|Santinagar|Savar|Shabujbag|Shagunbagicha|Shaorapra<|Shenpara|Sheorapara|Sheowrapara|Shyamoli|Siddeshwari|Sobanbag|Sonargaon Road|Sukrabad|Tejgaon|Tikatuli|Tongi|Tongie|Uttara|Vutergoli|Warrie|Zigatola";
s_a[2] = "Bhola|Patuakhali|Pirojpur|Jhalokati|Barguna|Amtali|Bakerganj|Char Fasson|Gaurnadi|Swarupkati|Kuakata";
s_a[3] =  "Bandarban|Khagrachhari|Rangamati|Rangunia|Sandwip|Fatikchhari|Nazir Hat|Baroiyarhat|Mirsharai|Sitakunda|Hathazari|Raozan|Patiya|Chandanaish|Lohagara|Satkania|Boalkhali|Akhaura|Sarail|Chandpur|Chaumuhani|Laksam|Lakshmipur|Burichong";
s_a[4] = "Bagherhat|Chuadanga|Darshana,Chuadanga|Jhenaidah |Magura|Meherpur|Narail|Shatkhira";
s_a[5] = "Shomvugonj|Muktagasa|Bhaluka|Gouripur|Phulpur|Trishal|Nandail|Gofargaon|Ishwargonj|Haluaghat|Fulbaria|Netrokona|Sherpur";
s_a[6] = "Joypurhat|Kalai|Khetlal|Akkelpur|Panchbibi|Mundumala|Naogaon|Natore|Shahjadpur|Ullapara|Iswardi|Santhia|Sherpur,Bogra|Tanore|Pabna";
s_a[7] = "Gaibandha|Kurigram|Lalmonirhat|Nilphamari|Panchagarh|Thakurgaon|Saidpur";
s_a[8] = "Golapganj|Habiganj |Maulvibazar|Sreemangal|Sunamganj (town)|Beanibazar|Barlekha|Zakiganj|Chhatak";





function populateStates(countryElementId, stateElementId) {

    var selectedCountryIndex = document.getElementById(countryElementId).selectedIndex;

    var stateElement = document.getElementById(stateElementId);

    stateElement.length = 0; // Fixed by Julian Woods
    stateElement.options[0] = new Option('Select Area', '');
    stateElement.selectedIndex = 0;

    var state_arr = s_a[selectedCountryIndex].split("|");

    for (var i = 0; i < state_arr.length; i++) {
        stateElement.options[stateElement.length] = new Option(state_arr[i], state_arr[i]);
    }
}

function populateCountries(countryElementId, stateElementId) {
    // given the id of the <select> tag as function argument, it inserts <option> tags
    var countryElement = document.getElementById(countryElementId);
    countryElement.length = 0;
    countryElement.options[0] = new Option('Select City', '-1');
    countryElement.selectedIndex = 0;
    for (var i = 0; i < country_arr.length; i++) {
        countryElement.options[countryElement.length] = new Option(country_arr[i], country_arr[i]);
    }

    // Assigned all countries. Now assign event listener for the states.

    if (stateElementId) {
        countryElement.onchange = function () {
            populateStates(countryElementId, stateElementId);
        };
    }
}