<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generator doigravanja za STEM games</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 56px;
        }
        .bracket {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .round {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
        }
        .matchup {
            margin: 20px 0;
        }
        .round-title {
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
 
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#">Doigravanje</a>
    </nav>

    <div class="container">
        <h1 class="mt-5">STEM games playoffs</h1>
        <form id="teamForm" method="POST">
            <input type="hidden" name="generate_bracket" value="1">
            <button type="submit" class="btn btn-primary">Generiraj polja za doigravanje</button>
        </form>
        
        <div id="bracket" class="bracket mt-5"></div>
    </div>


    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Vik Mjeda, XML Projekt</span>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('teamForm').addEventListener('submit', function(event) {
            event.preventDefault();
            generateBracket();
        });

        function generateBracket() {
            fetch('popis.json')
                .then(response => response.json())
                .then(data => {
                    const bracketDiv = document.getElementById('bracket');
                    bracketDiv.innerHTML = '';

                    const teams = data.slice(0, 16);
                    const rounds = [
                        { title: "Osmina finala", matchups: 8 },
                        { title: "Četvrtfinale", matchups: 4 },
                        { title: "Polufinale", matchups: 2 },
                        { title: "Finale", matchups: 1 }
                    ];

                    rounds.forEach(round => {
                        const roundDiv = document.createElement('div');
                        roundDiv.classList.add('round');

                        const roundTitle = document.createElement('div');
                        roundTitle.classList.add('round-title');
                        roundTitle.innerText = round.title;
                        roundDiv.appendChild(roundTitle);

                        for (let j = 0; j < round.matchups; j++) {
                            const matchupDiv = document.createElement('div');
                            matchupDiv.classList.add('matchup');
                            matchupDiv.innerHTML = `
                                <select class="form-control mb-2">
                                    ${teams.map(team => `<option>${team}</option>`).join('')}
                                </select>
                                <select class="form-control mb-2">
                                    ${teams.map(team => `<option>${team}</option>`).join('')}
                                </select>
                                <input type="text" class="form-control mb-2" placeholder="Rezultat">
                            `;
                            roundDiv.appendChild(matchupDiv);
                        }

                        bracketDiv.appendChild(roundDiv);
                    });
                });
        }
    </script>
</body>
</html>