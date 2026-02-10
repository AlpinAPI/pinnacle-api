// pinnacle api

<?php

    $headers = [];
    $headers[] =  "x-rapidapi-key: __YOUR_KEY__";
    $headers[] =  "x-rapidapi-host: pinbook-odds.p.rapidapi.com";

    $baseUrl = "https://pinbook-odds.p.rapidapi.com";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_ENCODING, "");

    $sinceItems = [];
    $allEvents = [];

    while (true) {
        foreach ([1] as $sportId) { // endpoint /kit/v1/sports

            // is_have_odds = 0 or 1, event_type = prematch, live
            $params = [];
            $params['sport_id'] = $sportId;
            $params['is_have_odds'] = true;
            $params['since'] = $sinceItems[$sportId] ?? null;

            $queryString = http_build_query($params);
            echo '[REQUEST] ' . $queryString . PHP_EOL;

            curl_setopt($ch, CURLOPT_URL, $baseUrl . '/kit/v1/markets?' . $queryString);

            $response = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($response, true);

            $sinceItems[$sportId] = $result['last'];

            foreach ($result['events'] as $event) {
                $allEvents[(string)$event['event_id']] = $event;

                if (isset($event['periods']['num_0']['money_line'])) {
                    echo '   ' . $event['league_name'] . ': ' . $event['home'] . ' — ' . $event['away'] . ' ' . json_encode($event['periods']['num_0']['money_line']) . PHP_EOL;
                }
            }

            echo 'Sport: ' . $result['sport_name'] . PHP_EOL;
            echo 'Number of changes: ' . count($result['events']) . PHP_EOL;
            echo ' ';

            sleep(3);
        }
    }

    curl_close($ch);
