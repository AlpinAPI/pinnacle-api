# pinnacle api

import requests
import json
import time

headers = {
    "x-rapidapi-key": "__YOUR_KEY__",
    "x-rapidapi-host": "pinbook-odds.p.rapidapi.com"
}

base_url = "https://pinbook-odds.p.rapidapi.com"
s = requests.Session()
s.headers.update(headers)

since_items = {}
all_events = {}

while True:

    for sport_id in [1]: # endpoint /kit/v1/sports

        # is_have_odds = 0 or 1, event_type = prematch, live
        params = {
            'sport_id': sport_id,
            'is_have_odds': True,
            'since': since_items.get(sport_id)
        }
        print('[REQUEST] %s' % params)

        response = s.get(base_url + '/kit/v1/markets', params=params)
        if response.status_code != 200:
            raise Exception(response.status_code, response.text)

        result = json.loads(response.text)
        since_items[sport_id] = result['last']

        for event in result['events']:
            all_events[str(event['event_id'])] = event

            try:
                print('   %s: %s — %s %s' % (event['league_name'], event['home'], event['away'], event['periods']['num_0']['money_line']))
            except KeyError:
                pass

        print('Sport: %s' % result['sport_name'])
        print('Number of changes: %s' % len(result['events']))
        print(' ')

        time.sleep(3)
