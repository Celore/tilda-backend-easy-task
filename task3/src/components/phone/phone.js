import React, { Component } from 'react';

import IpCityService from '../../services/ip-city-service';


export default class Phone extends Component {

    ipCityService = new IpCityService();

    state = {
        phone: "DIGITS"
    };

    componentDidMount() {
        this.ipCityService
            .getPhone()
            .then(this.onIpInfoLoaded);
    }

    onIpInfoLoaded = (phone) => {
        this.setState({ phone: phone });
    };

    render() {
        const {phone} = this.state;

        return (
            <div className="info">
                8-800-{phone}
            </div>
        );
    }
}
