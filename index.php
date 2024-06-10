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
        .navbar, .footer {
            background-color: black !important;
        }
        .navbar-brand, .footer .text-muted {
            color: white !important;
        }
        .btn-custom {
            background-color: black;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <a class="navbar-brand" href="#">Doigravanje</a>
    </nav>

    <div class="container">
        <h1 class="mt-5">STEM games playoffs</h1>
        <form id="teamForm" method="POST">
            <input type="hidden" name="generate_bracket" value="1">
            <button type="submit" class="btn btn-custom">Generiraj polja za doigravanje</button>
        </form>
        
        <div id="bracket" class="bracket mt-5">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate_bracket'])) {
                $json = file_get_contents('popis.json');
                $teams = json_decode($json, true);
                $teams = array_slice($teams, 0, 16); // Limit to 16 teams

                $rounds = [
                    "Osmina finala" => 8,
                    "Četvrtfinale" => 4,
                    "Polufinale" => 2,
                    "Finale" => 1
                ];

                foreach ($rounds as $roundTitle => $matchups) {
                    echo "<div class='round'>";
                    echo "<div class='round-title'>{$roundTitle}</div>";

                    for ($i = 0; $i < $matchups; $i++) {
                        echo "<div class='matchup'>";
                        echo "<select class='form-control mb-2'>";
                        foreach ($teams as $team) {
                            echo "<option>{$team}</option>";
                        }
                        echo "</select>";
                        echo "<select class='form-control mb-2'>";
                        foreach ($teams as $team) {
                            echo "<option>{$team}</option>";
                        }
                        echo "</select>";
                        echo "<input type='text' class='form-control mb-2' placeholder='Rezultat'>";
                        echo "</div>";
                    }

                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>

    <footer class="footer mt-auto py-3">
        <div class="container">
            <span class="text-muted">Vik Mjeda, XML Projekt</span>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
