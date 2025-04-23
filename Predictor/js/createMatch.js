let teams = ['Arsenal', 'Aston Villa', 'Bournemouth', 'Brighton', 'Brentford', 'Chelsea', 'Crystal Palace',
    'Everton', 'Fulham', 'Ipswich', 'Leicester City', 'Liverpool', 'Manchester City', 'Manchester United', 'Newcastle', 'Nottingham Forest',
    'Southampton', 'Tottenham', 'West Ham', 'Wolverhampton'];

const fixturesContainer = document.getElementById("fixtures-container");

let selectedTeams = new Set();
let fixtures = [];

function populateSelect(selectElement, excludeTeams = []) {
    const currentSelection = selectElement.value;
    selectElement.innerHTML = "<option value=''>Select a team</option>";

    teams.forEach(team => {
        if (!excludeTeams.includes(team) || team === currentSelection) {
            const option = document.createElement("option");
            option.value = team;
            option.textContent = team;
            if (team === currentSelection) option.selected = true;
            selectElement.appendChild(option);
        }
    });
}

function updateSelectedTeams() {
    selectedTeams.clear();
    fixtures.forEach(({ homeSelect, awaySelect }) => {
        if (homeSelect.value) selectedTeams.add(homeSelect.value);
        if (awaySelect.value) selectedTeams.add(awaySelect.value);
    });

    fixtures.forEach(({ homeSelect, awaySelect }) => {
        populateSelect(homeSelect, [...selectedTeams].filter(t => t !== homeSelect.value));
        populateSelect(awaySelect, [...selectedTeams, homeSelect.value].filter(t => t !== awaySelect.value));
    });
}

function createFixture(index) {
    const fixtureDiv = document.createElement("div");
    fixtureDiv.classList.add("fixture");

    const homeSelect = document.createElement("select");
    homeSelect.name = `home-team-${index}`;
    homeSelect.classList.add("team-select");

    const awaySelect = document.createElement("select");
    awaySelect.name = `away-team-${index}`;
    awaySelect.classList.add("team-select");

    populateSelect(homeSelect, []);
    populateSelect(awaySelect, []);

    homeSelect.addEventListener("change", updateSelectedTeams);
    awaySelect.addEventListener("change", updateSelectedTeams);

    fixtureDiv.appendChild(homeSelect);
    fixtureDiv.appendChild(document.createTextNode(" vs "));
    fixtureDiv.appendChild(awaySelect);

    fixturesContainer.appendChild(fixtureDiv);
    fixtures.push({ homeSelect, awaySelect });
}

function generateFixtures() {
    fixturesContainer.innerHTML = "";
    selectedTeams.clear();
    fixtures = [];

    for (let i = 0; i < 10; i++) {
        createFixture(i);
    }
}

generateFixtures();
