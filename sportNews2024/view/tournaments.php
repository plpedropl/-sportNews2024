<?php
ob_start();
?>
<div style=" margin-top: 70px;">
    <h1 style="text-align: center;">Турниры</h1>
    <hr style="width: 70%; margin-left: 15%;">
    </hr>
</div>
<!-- Пример HTML-кода для списка категорий спорта и турниров -->
<div style="width: 100%; display: flex; flex-wrap: wrap; justify-content: center; text-align: center; margin: auto;">

    <div id="sport-categories">
        <!-- Картинки для выбора категории -->
        <?php
        foreach ($allcategories as $category) {
            echo  '<img src="images/' . $category['icons'] . '" alt="' . $category['title'] . '" title="' . $category['title'] . '" data-category="' . $category['title'] . '">';
        }
        ?>
        <!-- Картинки для выбора категории 
        <img src="images/football_icon.png" alt="Футбол" data-category="Футбол">
        <img src="images/tennis_icon.png" alt="Теннис" data-category="Теннис">
        <img src="images/snooker_icon.png" alt="Снукер" data-category="Снукер">
        <img src="images/basketball_icon.png" alt="Баскетбол" data-category="Баскетбол">
        <img src="images/chess_icon.png" alt="Шахматы" data-category="Шахматы">
        <img src="images/ice_hockey_icon.png" alt="Хоккей" data-category="Хоккей">-->
    </div>

    <ul style="width: 100%;" id="tournament-list"></ul>
    <div style="width: 100%;" id="tournament-details"></div>
</div>

<script>
    const tournamentsData = {
        'Футбол': [{
                name: 'Чемпионат Европы',
                details: [
                    ['22:00 14.06.2024', 'Сборная Германии', 'Сборная Шотландии', 'images/germany_flag.png', 'images/scotland_flag.png', 'Альянц Арена, Мюнхен', '2-0'],
                    ['16:00 15.06.2024', 'Сборная Испании', 'Сборная Хорватии', 'images/spain_flag.png', 'images/croatia_flag.png', 'Олимпийский, Берлин', '1-0']
                ]
            },
            {
                name: 'Лига Чемпионов',
                details: [
                    ['22:00 09.04.2024', 'Реал Мадрид', 'Манчестер Сити', 'images/real_madrid.png', 'images/manchester_city.png', 'Сантьяго Бернабеу', '2-2'],
                    ['22:00 10.04.2024', 'ПСЖ', 'Барселона', 'images/psg.png', 'images/barcelona.png', 'Парк де Пренс', '0-0']
                ]
            },
            // Add more tournaments with multiple details as needed
        ],
        'Теннис': [{
                name: 'Australian Open 2024',
                details: [
                    ['26.01.2024', 'Даниил Медведев', 'Александр Зверев', 'images/medvedev.png', 'images/zverev.png', 'Rod Laver Arena', '3-2'],
                    ['26.01.2024', 'Новак Джокович', 'Янник Синнер', 'images/djokovic.png', 'images/sinner.png', 'Rod Laver Arena', '1-3']
                ]
            },
            // Add more tournaments with multiple details as needed
        ],
        'Снукер': [{
                name: 'Players Championship 2024',
                details: [
                    ['25.02.2024', 'Марк Аллен', 'Аньда Чжан', 'images/allen.png', 'images/anda.png', 'Телфорд, Англия', '10-8'],
                    ['25.02.2024', 'Марк Аллен', 'Аньда Чжан', 'images/allen.png', 'images/anda.png', 'Телфорд, Англия', '10-8']
                ]
            },
            // Add more tournaments with multiple details as needed
        ],
        'Баскетбол': [{
                name: 'НБА',
                details: [
                    ['19.03.2024', 'Лос-Анджелес Лейкерс', 'Атланта Хокс', 'images/lakers.png', 'images/atlanta_hawks.png', 'Crypto.com Arena', '136-105'],
                    ['19.03.2024', 'Лос-Анджелес Лейкерс', 'Атланта Хокс', 'images/lakers.png', 'images/atlanta_hawks.png', 'Crypto.com Arena', '136-105']
                ]
            },
            // Add more tournaments with multiple details as needed
        ],
        'Шахматы': [{
                name: 'Матч за звание Чемпиона мира',
                details: [
                    ['2023', 'Ян Непомнящий', 'Дин Лижэнь', 'images/nepo.png', 'images/ding_liren.png', 'Астана', '8½-9½'],
                    ['2023', 'Ян Непомнящий', 'Дин Лижэнь', 'images/nepo.png', 'images/ding_liren.png', 'Астана', '8½-9½']
                ]
            },
            // Add more tournaments with multiple details as needed
        ],
        'Хоккей': [{
                name: 'НХЛ',
                details: [
                    ['19.03.2024', 'Калгари', 'Вашингтон', 'images/calgary.png', 'images/washington.png', 'Скоушабэнк-Сэдлдоум, Калгари', '2-5'],
                    ['19.03.2024', 'Калгари', 'Вашингтон', 'images/calgary.png', 'images/washington.png', 'Скоушабэнк-Сэдлдоум, Калгари', '2-5']
                ]
            },
            // Add more tournaments with multiple details as needed
        ],
        // Define details for other sports and tournaments similarly
    };

    const sportCategories = document.getElementById('sport-categories');
    const tournamentList = document.getElementById('tournament-list');
    const tournamentDetails = document.getElementById('tournament-details');

    // Variable to store the currently selected sport
    let selectedSport = null;

    // Function to populate tournament list
    function populateTournamentList(tournaments) {
        tournamentList.innerHTML = '';
        tournaments.forEach(tournament => {
            const li = document.createElement('li');
            li.textContent = tournament.name;
            tournamentList.appendChild(li);
        });
    }

    // Function to show tournament details
    function showTournamentDetails(tournament) {
        tournamentList.innerHTML = ''; // Close tournament list

        tournament.details.forEach(detail => {
            const [date, teamAName, teamBName, teamAImgPath, teamBImgPath, stadium, result] = detail;

            const container = document.createElement('div');
            container.classList.add('tournament-details-container');
            container.innerHTML = `<p>Дата: ${date}</p>
                               <p>${teamAName} <img src="${teamAImgPath}"> ${result} <img src="${teamBImgPath}"> ${teamBName}</p>
                               <p>Место проведения: ${stadium}</p>`;

            tournamentDetails.appendChild(container);
        });
    }

    // Event listener for sport category clicks
    sportCategories.addEventListener('click', event => {
        if (event.target.tagName === 'IMG') {
            // Store the selected sport
            selectedSport = event.target.getAttribute('data-category');

            // Clear tournament list and details
            tournamentList.innerHTML = '';
            tournamentDetails.innerHTML = '';

            const tournaments = tournamentsData[selectedSport];
            populateTournamentList(tournaments);
        }
    });

    // Event listener for tournament list clicks
    tournamentList.addEventListener('click', event => {
        if (event.target.tagName === 'LI') {
            const tournamentName = event.target.textContent;

            const tournaments = tournamentsData[selectedSport];
            const tournament = tournaments.find(tournament => tournament.name === tournamentName);

            if (tournament) {
                showTournamentDetails(tournament);
            }
        }
    });
</script>


<?php
$content = ob_get_clean();
include "view/templates/layout.php";
?>