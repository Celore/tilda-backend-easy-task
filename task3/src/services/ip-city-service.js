export default class IpCityService {

    _apiBase = 'https://geolocation-db.com';

    getResource = async (url) => {
        const res = await fetch(`${this._apiBase}${url}`);

        if (!res.ok) {
            throw new Error(`Could not fetch ${url}` +
                `, received ${res.status}`)
        }
        return await res.json();
    };

    getIpInfo = async () => {
        return await this.getResource(`/json/`);
    };

    getPhone = async () => {
        const ipInfo = await this.getIpInfo();
        return this._findPhoneForCity(ipInfo);
    };

    _findPhoneForCity(ipInfo) {
        const city = ipInfo.city;
        const defaultPhone = "100-00-00";
        const data = {
            "Moscow": "700-06-11",
            "Minsk": "342-36-71",
            "Kiev": "134-89-45",
        }

        return data[city] ?? defaultPhone;
    }
}