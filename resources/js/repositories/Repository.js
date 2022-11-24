import axios from 'axios';

// todo: how to automate this?
const baseDomain = 'http://circadian.test';
const baseURL = `${baseDomain}/api`;

export default axios.create({
    baseURL
});
