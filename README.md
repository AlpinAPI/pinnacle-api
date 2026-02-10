

# Pinncale API
Real time data
PinBook Sport API is a RESTful service for getting pre-match and live odds like Pinnacle. Historical odds, score and results

⚡ [Connect API Quickstart](https://pinbook.bapi.info/quickstart)

🔗 [Pricing](https://rapidapi.com/tipsters/api/pinbook-odds/pricing)

---

### ⌚ Without delay
Odds Updates without delay, pre-match and live odds

### 🎮 Support Esports
Soccer, Tennis, Basketball, Hockey, American football, MMA, Baseball, Handball, Volleyball, Cricket and 🎮 Esports

### 📊 Historical odds
Historical odds, score and results

### ⛹️ Special Markets
Support for all Special markets, Player props, Corners



#### Before use
If you are not logged in at the pinnacle site, you will see delayed data at the pinnacle site.
This API has no data delay

---

#### Getting the odds list

##### 1. Getting the sport list

Use `@List of sports` endpoint

##### 2. Getting the list of markets

Use `@List of markets` endpoint by **sport_id**

You can pass the **event_type** and **is_have_odds** parameters

**is_have_odds** parameters: Filter the events that have periods. Markets may be absent or closed for betting. Check meta->open_



**Please note that prematch and live events are different**

**Response:**

```
{
  "sport_id": 1,		_____ Sport ID
  "sport_name": "Soccer",		_____ Sport name
  "last": 1745671020,		_____ Last modified time stamp. Use it for the next query as the “since” parameter. You will only get matches that have had changes since “since”.
  "last_call": 1745671020,		_____ Last modified time stamp.
  "events": [		_____ List of events
    {
      "event_id": 1607709101,		_____ Event ID
      "sport_id": 1,		_____ Sport ID
      "league_id": 1842,		_____ League ID
      "league_name": "Germany - Bundesliga",		_____ League Name
      "starts": "2025-04-26T13:30:00",		_____ Start Time
      "last": 1745671014,		_____ Last modified time stamp.
      "home": "Bayern Munich",		_____ Home team name
      "away": "Mainz 05",		_____ Away team name
      "event_type": "prematch",		_____ Event type, live or prematch
      "live_status_id": 2,		_____ Live status id, 0 = No live betting will be offered on this event, 1 = Live betting event, 2 = Live betting will be offered on this match, but on a different event.
      "parent_id": null,		_____ If event is linked to another event, parentId will be populated. Live event would have pre game event as parent id.
      "resulting_unit": "Regular",		_____ Specifies based on what the event will be resulted, e.g. Corners, Bookings
      "is_actual": true,		_____ The match will be in the future or has recently been finished
      "is_have_odds": true,		_____ [Alias is_have_periods] Match has periods.  Markets may be absent or closed for betting. Check [meta][open_...]
      "is_have_periods": true,		_____ Match has periods.  Markets may be absent or closed for betting. Check [meta][open_...]
      "is_have_open_markets": true,		_____ Match has one or more Open markets.
      "periods": {
        "num_0": {
          "line_id": 3080353239,		_____ Line ID
          "number": 0,		_____ Period number, endpoint @/kit/v1/meta-periods
          "description": "Match",		_____ Period name
          "cutoff": "2025-04-26T13:30:00",		_____ Period’s wagering cut-off date in UTC.
          "period_status": 1,		_____ 1 - online, period is open for betting 2 - offline, period is not open for betting
          "money_line": {		_____ Money line, 1X2
            "home": 1.228,
            "draw": 7.38,
            "away": 11.4
          },
          "spreads": {	_____ Spreads
            "-2.0": {
              "hdp": -2.0,
              "alt_line_id": null,
              "home": 1.99,
              "away": 1.917,
              "max": 10000.0
            },
            ...
          },
          "totals": {		_____ Totals
            "3.75": {
              "points": 3.75,
              "alt_line_id": null,
              "over": 1.877,
              "under": 2.02,
              "max": 5000.0
            },
			...
          },
          "team_total": {		_____ Team total
            "home": {
              "points": 2.5,
              "over": 1.636,
              "under": 2.31
            },
            "away": {
              "points": 0.5,
              "over": 1.558,
              "under": 2.49
            }
          },
          "meta": {			_____ Meta
            "number": 0,		_____ Period number, endpoint @/kit/v1/meta-periods
            "max_spread": 10000.0,		_____ Max bet Spread
            "max_money_line": 10000.0,		_____ Max bet Money_line
            "max_total": 5000.0,		_____ Max bet Total
            "max_team_total": 1500.0,		_____ Max bet Team total
            "open_money_line": true,		_____ Market Money_line open for betting
            "open_spreads": true,		_____ Market Spreads open for betting
            "open_totals": true,		_____ Market Totals open for betting
            "open_team_total": true		_____ Market Team_total open for betting
          }
        },
        "num_1": {...}
```

##### 3. Getting the list of special markets

Ex: Player Props, Futures, Both Teams To Score?

Use `@List of Special markets` endpoint by **sport_id**

**Response:**

```
{
  "sport_id": 1,		_____ Sport ID
  "sport_name": "Soccer",		_____ Sport name
  "last": 1745671020,		_____ Last modified time stamp. Use it for the next query as the “since” parameter. You will only get matches that have had changes since “since”.
  "last_call": 1745671020,		_____ Last modified time stamp.
  "specials": [		_____ List of specials lines
    {
      "special_id": 1608338379,		_____ Special ID
      "sport_id": 1,		_____ Sport ID
      "league_id": 1980,		_____ League ID
      "event_id": 1607803934,		_____ Event ID. Null - if the market is not related to the event
      "last": 1745732750,		_____ Last modified time stamp.
      "live_status": "prematch",		Live status live or prematch
      "live_status_id": 2,		_____ 0 = No live betting will be offered on this event, 1 = Live betting event, 2 = Live betting will be offered on this match, but on a different event.
      "bet_type": "MULTI_WAY_HEAD_TO_HEAD",		_____ MULTI_WAY_HEAD_TO_HEAD, SPREAD, OVER_UNDER
      "units": null,		_____ Measurment in the context of the special. This is applicable to specials bet type spead and over/under. In a hockey special this could be goals.
      "name": "3-Way Handicap Bournemouth -2",		_____ Special name
      "starts": "2025-04-27T13:00:00",		_____ Date of the special in UTC.
      "cutoff": "2025-04-27T13:00:00",		_____ Wagering cutoff date in UTC.
      "category": "Team Props",		_____ The category that the special falls under.
      "status": "O",		_____ Status of the Special. O = This is the starting status. It means that the lines are open for betting,H = This status indicates that the lines are temporarily unavailable for betting,I = This status indicates that one or more lines have a red circle (a lower maximum bet amount)
      "event": {		_____ Event data. Null - if the market is not related to the event
        "id": 1607803934,
        "period_number": 0,
        "home": "Bournemouth",
        "away": "Manchester United"
      },
      "is_actual": true,		_____ The special line will be in the future or has recently been finished
      "max_bet": 500.0,		_____ Maximum bet volume amount.
      "is_have_odds": true,		_____ [Alias is_have_lines]
      "is_have_lines": true,		_____ Specials market has lines
      "open": true,		_____ Special market is open for betting
      "lines": {
        "c_1608338380": {
          "id": 1608338380,		_____ Line ID
          "name": "Bournemouth (-2)",		_____ Line name
          "rot_num": 2824,		_____ Rotation Number
          "line_id": 4941359540,		_____ Line identifier required for placing a bet.
          "price": 5.93,		_____ Price of the line
          "handicap": null		_____ A number indicating the spread, over/under etc.
        },
        "c_1608338381": {}
        ...


```




##### 4. Event list, archive or schedule

Use `@List of archive events` endpoint by **sport_id**

##### 5. Getting a history of odds

Use `@Event details` endpoint by **event_id**

---

#### List of object statuses

**period status**
1 - online, period is open for betting 2 - offline, period is not open for betting

**period special status**
O = This is the starting status. It means that the lines are open for betting,
H = This status indicates that the lines are temporarily unavailable for betting,
I = This status indicates that one or more lines have a red circle (a lower maximum bet amount)

**period_results**
Endpoints: @kit/v1/archive and @/kit/v1/details
1 = Event period is settled, 2 = Event period is re-settled, 3 = Event period is cancelled, 4 = Event period is re-settled as cancelled, 5 = Event is deleted

---

#### How to use the since parameter?

1. Call the endpoint **@List of markets** WITHOUT the **since** parameter.
You will get a list of ALL events and odds for that sport.
Ex. `/kit/v1/markets?sport_id=1`
2. In the response you will get the **last** property - for example, (1658948800).
 The **last** property is a UTC time stamp.
3. Use the **last** value as the **since** parameter in the next call to the **@List of markets** endpoint.
Ex. `/kit/v1/markets?sport_id=1&since=1658948800`.
4. You will now get ONLY those events (full event data) which were changed after this timestamp + the NEW **last** value.
Use steps 3-4 in your cycle.
You must always use the **since** parameter, after starting your program cycle.
To not get an error. You can request without a parameter  **since** no more than 15 times in 5 minutes.



---


#### 🐍 Code Sample Python

```python


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

```

---


#### The first team is a home or away team?

*API return opposite result?*

The first team is not always the home team.
To determine this, use the endpoint @/kit/v1/leagues
Ex: "home_team_type": "Team1", or       "home_team_type": "Team2"

#### What’s num_0 and num_1?
Use endpoint @kit/v1/meta-periods
Ex:
num_0 -> Match,

num_1 -> 1st Half

num_2 -> 2nd Half
...



#### How to handle duplicated parent events?
If a parent event was created with the wrong information in the immutable properties (participant names, league , ...), a new parent event will be created with the correct information.
When the client detects a duplicate, by default can always use the event with the greater identifier value and in addition, monitor settled fixtures endpoint and discard the one that’s deleted or settled.


####  When is the market open for betting?

**First method:**

A straight market  in a period is open for betting if in Get Odds response all these is true:
1. Period status = 1
2. Market (period) has  odds.
3. Period has cutoff is in the future.

**Second method:**

```
Check the value ['periods'] -> ['num_...'] -> ['meta'] -> ['open...']
```




Ex:
```
  "events": [
    {
      "event_id": 1608004986,
         ......
            "periods": {
              ...
                 "num_0": {
                      "money_line": {},
                      "team_total": {},
                      "meta": {
                        "number": 0,
                        "max_spread": 250.0,
                        "max_total": 1000.0,
                        ...
                        "open_money_line": false,
                        "open_spreads": true,
                        "open_totals": true,
                        "open_team_total": false
              }
         }

```



#### What time zone is used for the API?
All times are **GMT (0)**.


#### How to know if an event is finished?
Please use **@/kit/v1/archive**   and **@/kit/v1/details** endpoint to find out if the event's period was settled or if the event was deleted.
Check the "cutoff" values.
