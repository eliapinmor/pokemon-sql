let basePokemons = [];

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".form");

    const container = document.querySelector(".container");
    container.innerHTML = "";
    showPoke();
    form.addEventListener("submit", function (event) {
        const name = document.querySelector(".name").value.trim().toLowerCase();
        const url = `https://pokeapi.co/api/v2/pokemon/${name}`;

        event.preventDefault();

        if (name.length === 0) {
            alert("No se ha introducido un nombre");
        } else {

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Pokémon no encontrado");
                    }
                    return response.json();
                })
                .then(data => {
                    let pesoKg = data.weight / 10;

                    container.innerHTML = `
                    <div style="display: flex; flex-direction: column;">
                        <div style="display: flex; flex-direction: row;">
                            <div>
                                <img src="${data.sprites.other["official-artwork"].front_default}" alt="${data.name}" style="width: 200px">
                            </div>
                            <div>
                                <p><strong>Tipo:</strong> ${data.types.map(t => t.type.name).join(", ")}</p>
                                <p><strong>Habilidades:</strong> ${data.abilities.map(h => h.ability.name).join(", ")}</p>
                                <p><strong>Peso: </strong>${pesoKg}kg</p>
                        <button id="addPoke">Añadir</button>

                            </div>
                        </div>
                    </div>
                `;
                    const newPoke = {
                        nombre: data.name,
                        tipo: data.types.map(t => t.type.name).join(", "),
                        habilidades: data.abilities.map(h => h.ability.name).join(", "),
                        imagen: data.sprites.other["official-artwork"].front_default
                    };

                    document.getElementById("addPoke").addEventListener("click", function () {
                        if (checkPokeExists(newPoke.nombre)) {
                            alert("Este Pokémon ya fue añadido.");
                        } else {
                            basePokemons.push(newPoke);
                            localStorage.setItem("pokemons", JSON.stringify(basePokemons));
                            showPoke();
                        }
                    });


                })
                .catch(error => {
                    alert("Error: " + error.message);
                });
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const datosGuardados = localStorage.getItem("pokemons");
    if (datosGuardados) {
        basePokemons = JSON.parse(datosGuardados);
        showPoke();
    }
    console.log(datosGuardados);
});

function showPoke(pokemons = basePokemons) {
    const container = document.querySelector(".showPoke");
    container.innerHTML = "";


    if (pokemons.length === 0) {
        container.style.display = "none";
    } else {

        container.style.display = "flex";
        pokemons.forEach(pokemon => {
            const pokeHTML = `
            <div class="pokemon-card">
            <div style="display: flex; justify-content: end">
                <button class="delete-button" data-nombre="${pokemon.nombre}">❌</button></div>
                <h2>${pokemon.nombre}</h2>
                <img src="${pokemon.imagen}" alt="${pokemon.nombre}" style="width: 150px;">
                <p><strong>Tipo:</strong> ${pokemon.tipo}</p>
                <p><strong>Habilidades:</strong> ${pokemon.habilidades}</p>
            </div>
        `;
            container.innerHTML += pokeHTML;
        });
        document.querySelectorAll(".delete-button").forEach(button => {
            button.addEventListener("click", function () {
                const nombre = this.getAttribute("data-nombre");
                eliminarPoke(nombre);
            });
        });
    }
}


function checkPokeExists(name) {
    return basePokemons.some(poke => poke.nombre === name);
}

function eliminarPoke(nombre) {
    basePokemons = basePokemons.filter(poke => poke.nombre !== nombre);
    localStorage.setItem("pokemons", JSON.stringify(basePokemons));
    showPoke();
}


document.getElementById("filterType").addEventListener("change", function () {
    const tipoSeleccionado = this.value;

    if (tipoSeleccionado === "todos") {
        showPoke(); // muestra todos
    } else {
        const filtrados = basePokemons.filter(poke =>
            poke.tipo.toLowerCase().includes(tipoSeleccionado)
        );
        showPoke(filtrados); // muestra filtrados
    }
});
