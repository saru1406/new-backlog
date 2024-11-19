import axios from 'axios';

export const fetchApi = async (url: string) => {
    return await axios.get(url, {
        withCredentials: true,
    });
};

export const patchApi = (url: string) => {
    return axios.patch(`${url}`, {
        withCredentials: true,
    });
};
