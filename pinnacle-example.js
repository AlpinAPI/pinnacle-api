// pinnacle api


const axios = require('axios');

const headers = {
    "x-rapidapi-key": "__YOUR_KEY__",
    "x-rapidapi-host": "pinbook-odds.p.rapidapi.com"
};

const baseUrl = "https://pinbook-odds.p.rapidapi.com";
const axiosInstance = axios.create({ headers });

let sinceItems = {};
let allEvents = {};

const fetchData = async () => {
    while (true) {
        for (const sportId of [1]) {
            const params = {
                sport_id: sportId,
                is_have_odds: true,
                since: sinceItems[sportId]
            };
            console.log('[REQUEST]', params);

            try {
                const response = await axiosInstance.get(`${baseUrl}/kit/v1/markets`, { params });
                if (response.status !== 200) {
                    throw new Error(`${response.status}: ${response.statusText}`);
                }

                const result = response.data;
                sinceItems[sportId] = result.last;

                for (const event of result.events) {
                    allEvents[String(event.event_id)] = event;

                    try {
                        console.log(event.league_name, event.home, event.away, event.periods.num_0.money_line);
                    } catch (error) {
                        // Ignore if 'money_line' does not exist
                    }
                }

                console.log('Sport:', result.sport_name);
                console.log('Number of changes:', result.events.length);
                console.log(' ');

                await new Promise(resolve => setTimeout(resolve, 3000));
            } catch (error) {
                console.error(error);
                await new Promise(resolve => setTimeout(resolve, 3000));
            }
        }
}
};

fetchData();
