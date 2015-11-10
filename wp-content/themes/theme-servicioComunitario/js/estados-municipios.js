var estados = new Array("Distrito Capital",
						"Amazonas",
						"Anzoátegui",
						"Apure",
						"Aragua",
						"Barinas",
						"Bolívar",
						"Carabobo",
						"Cojedes",
						"Delta Amacuro",
						"Falcón",
						"Guarico",
						"Lara",
						"Merida",
						"Miranda",
						"Monagas",
						"Nueva Esparta",
						"Portuguesa",
						"Sucre",
						"Táchira",
						"Trujillo",
						"Vargas",
						"Yaracuy",
						"Zulia");

var s_a = new Array();
s_a[0] = "";
s_a[1] = "Libertador (Caracas)";
s_a[2] = "Alto Orinoco (La Esmeralda)|Atabapo (San Fernando de Atabapo)|Atures (Puerto Ayacucho)|Autana (Isla Ratón)|Manapiare (San Juan de Manapiare)|Maroa (Maroa)|Río Negro (San Carlos de Río Negro)";
s_a[3] = "Anaco (Anaco)|Aragua (Aragua de Barcelona)|Bolívar (Barcelona)|Bruzual (Clarines)|Cajigal (Onoto)|Carvajal (Valle de Guanape)|Diego Bautista Urbaneja (Lechería)|Freites (Cantaura)|Guanipa (El Tigrito/San José de Guanipa)|Guanta (Guanta)|Independencia (Soledad)|Libertad (San Mateo)|McGregor (El Chaparro)|Miranda (Pariaguán)|Monagas (San Diego de Cabrutica)|Peñalver (Puerto Píritu)|Píritu (Píritu)|San Juan de Capistrano (Boca de Uchire)|Santa Ana (Santa Ana)|Simón Rodriguez (El Tigre)|Sotillo (Puerto La Cruz)";
s_a[4] = "Achaguas (Achaguas)|Biruaca (Biruaca)|Muñoz (Bruzual)|Páez (Guasdualito)|Pedro Camejo (San Juan de Payara)|Rómulo Gallegos (Elorza)|San Fernando (San Fernando de Apure)";
s_a[5] = "Bolívar|Camatagua|Francisco Linares Alcántara (Santa Rita)|Girardot (Maracay)|José Ángel Lamas (Santa Cruz)|José Félix Ribas (La Victoria)|José Rafael Revenga (El Consejo)|Libertador (Palo Negro)|Mario Briceño Iragorry (El Limón)|Ocumare de la Costa de Oro (Ocumare de la Costa)|San Casimiro (San Casimiro)|San Sebastián (San Sebastián de los Reyes)|Santiago Mariño (Turmero)|Santos Michelena (Las Tejerías)|Sucre (Cagua)|Tovar (Colonia Tovar)|Urdaneta (Barbacoas)|Zamora (Villa de Cura)";
s_a[6] = "Alberto Arvelo Torrealba (Sabaneta)|Andrés Eloy Blanco (El Cantón)|Antonio José de Sucre (Socopó)|Arismendi (Arismendi)|Barinas (Barinas)|Bolívar (Barinitas)|Cruz Paredes (Barrancas)|Ezequiel Zamora (Santa Bárbara)|Obispos (Obispos)|Pedraza (Ciudad Bolivia)|Rojas (Libertad)|Sosa (Ciudad de Nutrias)";
s_a[7] = "Caroní (Ciudad Guayana)|Cedeño (Caicara del Orinoco)|El Callao (El Callao)|Gran Sabana (Santa Elena de Uairén)|Heres (Ciudad Bolívar)|Piar (Upata)|Raúl Leoni (Ciudad Piar)|Roscio (Guasipati)|Sifontes (Tumeremo)|Sucre (Maripa)|Padre Pedro Chen (El Palmar)";
s_a[8] = "Bejuma (Bejuma)|Carlos Arvelo (Güigüe)|Diego Ibarra (Mariara)|Guacara (Guacara)|Juan José Mora (Morón)|Libertador (Tocuyito)|Los Guayos (Los Guayos)|Miranda (Miranda)|Montalbán (Montalbán)|Naguanagua (Naguanagua)|Puerto Cabello (Puerto Cabello)|San Diego (San Diego)|San Joaquín (San Joaquín)|Valencia (Valencia)";
s_a[9] = "Anzoátegui (Cojedes)|Falcón (Tinaquillo)|Girardot (El Baúl)|Lima Blanco (Macapo)|Pao de San Juan Bautista (El Pao)|Ricaurte (Libertad)|Rómulo";
s_a[10] = "Antonio Díaz (Curiapo)|Casacoima (Sierra Imataca)|Pedernales (Pedernales)|Tucupita (Tucupita)";
s_a[11] = "Acosta (San Juan de los Cayos)|Bolívar (San Luis)|Buchivacoa (Capatárida)|Cacique Manaure (Yaracal)|Carirubana (Punto Fijo)|Colina (La Vela de Coro)|Dabajuro (Dabajuro)|Democracia (Pedregal)|Falcón (Pueblo Nuevo)|Federación (Churuguara)|Jacura (Jacura)|Los Taques (Santa Cruz de Los Taques)|Mauroa (Mene de Mauroa)|Miranda (Santa Ana de Coro)|Monseñor Iturriza (Chichiriviche)|Palmasola (Palmasola)|Petit (Cabure)|Píritu (Píritu)|San Francisco (Mirimire)|Silva (Tucacas)|Sucre (La Cruz de Taratara)|Tocópero (Tocópero)|Unión (Santa Cruz de Bucaral)|Urumaco (Urumaco)|Zamora (Puerto Cumarebo)";
s_a[12] = "ESTEROS DE CAMAGUAN (CAMAGUAN)|Chaguaramas(Chaguaramas)|El Socorro (El Socorro)|Francisco de Miranda (Calabozo)|José Félix Ribas (Tucupido)|José Tadeo Monagas (Altagracia de Orituco)|Juan Germán Roscio (San Juan de Los Morros)|Julián Mellado (El Sombrero)|Las Mercedes (Las Mercedes)|Leonardo Infante (Valle de La Pascua)|Pedro Zaraza (Zaraza)|Ortíz (Ortíz)|San Gerónimo de Guayabal (Guayabal)|San José de Guaribe (San José de Guaribe)|Santa María de Ipire (Santa María de Ipire)";
s_a[13] = "Adrés Eloy Blanco (Sanare)|Cespo (Duaca)|Iibarren (Barquisimeto)|Jménez (Quibor)|Mrán (El Tocuyo)|Plavecino (Cabudare)|Smón Planas (Sarare)|Trres (Carora)|Udaneta (Siquisique)";
s_a[14] = "Alberto Adriani (El Vigía)|Andrés Bello (La Azulita)|Antonio Pinto Salinas (Santa Cruz de Mora)|Aricagua (Aricagua)|Arzobispo Chacón (Canaguá)|Campo Elías (Ejido)|Caracciolo Parra Olmedo (Tucaní)|Cardenal Quintero (Santo Domingo)|Guaraque (Guaraque)|Julio César Salas (Arapuey)|Justo Briceño (Torondoy)|Libertador (Merida)|Miranda (Timotes)|Obispo Ramos de Lora (Santa Elena de Arenales)|Padre Norega (Santa María de Caparo)|Pueblo Llano (Pueblo Llano)|Rangel (Mucuchíes)|Rivas Dávila (Bailadores)|Santos Marquina (Tabay)|Sucre (Lagunillas)|Tovar (Tovar)|Tulio Febres Cordero (Nueva Bolivia)|Zea (Zea)";
s_a[15] = "Acevedo (Caucagua)|Andrés Bello (San José de Barlovento)|Baruta (Baruta)|Brión (Higuerote)|Buroz (Mamporal)|Carrizal (Carrizal)|Chacao (Chacao)|Cristóbal Rojas (Charallave)|El Hatillo (El Hatillo)|Guaicaipuro (Los Teques)|Independencia (Santa Teresa del Tuy)|Lander (Ocumare del Tuy)|Los Salias (San Antonio de los Altos)|Páez (Río Chico)|Paz Castillo (Santa Lucía)|Pedro Gual (Cúpira)|Plaza (Guarenas)|Simón Bolívar (San Francisco de Yare)|Sucre (Petare)|Urdaneta (Cúa)|Zamora (Guatire)";
s_a[16] = "Acosta (San Antonio de Capayacuar)|Aguasay (Aguasay)|Bolívar (Caripito)|Caripe (Caripe)|Cedeño (Caicara)|Ezequiel Zamora (Punta de Mata)|Libertador (Temblador)|Maturín (Maturín)|Piar (Aragua)|Punceres (Quiriquire)|Santa Bárbara (Santa Bárbara)|Sotillo (Barrancas del Orinco)|Uracoa (Uracoa)";
s_a[17] = "Antolín del Campo (La Plaza de Paraguachí)|Arismendi (La Asunción)|Díaz (San Juan Bautista)|García (El Valle del Espíritu Santo)|Gómez (Santa Ana)|Maneiro (Pampatar)|Marcano (Juan Griego)|Mariño (Porlamar)|Península de Macanao (Boca de Río)|Tubores (Punta de Piedras)|Villalba (San Pedro de Coche)";
s_a[18] = "Agua Blanca (Agua Blanca)|Araure (Araure)|Esteller (Píritu)|Guanare (Guanare)|Guanarito (Guanarito)|Monseñor José Vicenti de Unda (Chabasquén de Unda)|Ospino (Ospino)|Páez (Acarigua)|Papelón (Papelón)|San Genaro de Boconoíto (Boconoíto)|San Rafael de Onoto (San Rafael de Onoto)|Santa Rosalía (El Playón)|Sucre (Biscucuy)|Turén (Villa Bruzual)";
s_a[19] = "Andrés Eloy Blanco (Casanay)|Andrés Mata (San José de Aerocuar)|Arismendi (Río Caribe)|Benítez (El Pilar)|Bermúdez (Carúpano)|Bolívar (Marigüitar)|Cajigal (Yaguaraparo)|Cruz Salmerón Acosta (Araya)|Libertador (Tunapuy)|Mariño (Irapa)|Mejía (San Antonio del Golfo)|Montes (Cumanacoa)|Ribero (Cariaco)|Sucre (Cumaná)|Valdez (Güiria)";
s_a[20] = "Andrés Bello(Cordero)|Antonio Rómulo Costa (Las Mesas)|Ayacucho (Colón)|Bolívar (San Antonio del Táchira)|Cárdenas (Táriba)|Córdoba (Santa Ana de Táchira)|Fernández Feo (San Rafael del Piñal)|Francisco de Miranda (San José de Bolívar)|García de Hevia (La Fría)|Guásimos (Palmira)|Independencia (Capacho Nuevo)|Jáuregui (La Grita)|José María Vargas (El Cobre)|Junín (Rubio)|Libertad (Capacho Viejo)|Libertador (Abejales)|Lobatera (Lobatera)|Michelena (Michelena)|Panamericano (Coloncito)|Pedro María Ureña (Ureña)|Rafael Urdaneta (Delicias)|Samuel Darío Maldonado (La Tendida)|San Cristóbal (San Cristóbal)|Seboruco (Seboruco)|Simón Rodríguez (San Simón)|Sucre (Queniquea)|Torbes (San Josecito)|Uribante (Pregonero)|San Judas Tadeo (Umoquena)";
s_a[21] = "Andrés Bello (Santa Isabel)|Boconó (Boconó)|Bolívar (Sabana Grande)|Candelaria (Chejendé)|Carache (Carache)|Escuque (Escuque)|José Felipe Márquez Cañizalez (El Paradero)|Juan Vicente Campos Elías (Campo Elías)|La Ceiba (Santa Apolonia)|Miranda (El Dividive)|Monte Carmelo (Monte Carmelo)|Motatán (Motatán)|Pampán (Pampán)|Pampanito (Pampanito)|Rafael Rangel (Betijoque)|San Rafael de Carvajal (Carvajal)|Sucre (Sabana de Mendoza)|Trujillo (Trujillo)|Urdaneta (La Quebrada)|Valera (Valera)";
s_a[22] = "Vargas (La Guaira)";
s_a[23] = "Arístides Bastidas (San Pablo)|Bolívar (Aroa)|Bruzual (Chivacoa)|Cocorote (Cocorote)|Independencia (Independencia)|José Antonio Páez (Sabana de Parra)|La Trinidad (Boraure)|Manuel Monge (Yumare)|Nirgua (Nirgua)|Peña (Yaritagua)|San Felipe (San Felipe)|Sucre (Guama)|Urachiche (Urachiche)|Veroes (Farriar)";
s_a[24] = "Almirante Padilla (El Toro)|Baralt (San Timoteo)|Cabimas (Cabimas)|Catatumbo (Encontrados)|Colón (San Carlos del Zulia)|Francisco Javier Pulgar (Pueblo Nuevo-El Chivo)|Jesús Enrique Losada (La Concepción)|Jesús María Semprún (Casigua El Cubo)|La Cañada de Urdaneta (Concepción)|Lagunillas (Ciudat Ojeda)|Machiques de Perijá (Machiques)|Mara (San Rafael del Moján)|Maracaibo (Maracaibo)|Miranda (Los Puertos de Altagracia)|Páez (Sinamaica)|Rosario de Perijá (La Villa del Rosario)|San Francisco (San Francisco)|Santa Rita (Santa Rita)|Simón Bolívar (Tía Juana)|Sucre (Bobures)|Valmore Rodríguez (Bachaquero)";


function populateMunicipios(estadoElementId, municipioElementId, mensajePorDefecto) {

    var selectedEstadoIndex = document.getElementById(estadoElementId).selectedIndex;

    var municipioElement = document.getElementById(municipioElementId);

    municipioElement.length = 0; // Fixed by Julian Woods
    municipioElement.options[0] = new Option(mensajePorDefecto, '');
    municipioElement.selectedIndex = 0;

    var state_arr = s_a[selectedEstadoIndex].split("|");

    for (var i = 0; i < state_arr.length; i++) {
        municipioElement.options[municipioElement.length] = new Option(state_arr[i], state_arr[i]);
    }
}

function populateEstados(estadoElementId, municipioElementId, mensajePorDefecto) {
    // given the id of the <select> tag as function argument, it inserts <option> tags

    if(!mensajePorDefecto){
    	mensajePorDefecto = 'Seleccione Estado';
        mensajePorDefectoMunicipio = 'Seleccione Municipio';
    }
    else
        mensajePorDefectoMunicipio = 'Todos los Municipios';

    var estadoElement = document.getElementById(estadoElementId);
    estadoElement.length = 0;
    estadoElement.options[0] = new Option(mensajePorDefecto, '-1');
    estadoElement.selectedIndex = 0;

    for (var i = 0; i < estados.length; i++) {
        estadoElement.options[estadoElement.length] = new Option(estados[i], estados[i]);
    }

    // Assigned all countries. Now assign event listener for the states.

    if (municipioElementId) {    	
        	estadoElement.onchange = function () {
            populateMunicipios(estadoElementId, municipioElementId, mensajePorDefectoMunicipio);
        };
    }
}