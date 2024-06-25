import Cookies from 'js-cookie';
import axios from 'axios';

axios.defaults.withCredentials = true;

//const token2 = localStorage.getItem("token");
const token = Cookies.get('token');


export async function login2(email, password) {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/login`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({email, password})
    });

    const data = await response.json();
    if (data['token']){

        localStorage.setItem("token", data['token']);
        localStorage.setItem("role", data['tip']);
        localStorage.setItem("user_id", data['user']['id']);
    } 
    return data;
};

export async function login(email, password) {
    try {
        const response = await axios.post(`${process.env.REACT_APP_API_URL}/login`, {
            email,
            password
        },
        {
            headers: {
                'Content-Type': 'application/json'
            }
        });

        const data = response.data;
        if (data.token) {
            //localStorage.setItem("token", data['token']);
            Cookies.set('token', data.token, { expires: 7, secure: true });
            localStorage.setItem("role", data.tip);
            localStorage.setItem("user_id", data.user.id);
        }
        return data;
    } catch (error) {
        console.error('Error logging in:', error);
        throw error;
    }
}

export async function register(name, email, password, password_confirmation) {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/register`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({name, email, password, password_confirmation})
    });

    const data = await response.json();
    return data;
};

export async function logout() {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/logout`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    localStorage.removeItem("token");
    Cookies.remove('token');
    return data;
};

export async function getUser() {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/user`, {
        method: "GET",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function reset(email, password_new) {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/reset`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({email, password_new})
    });

    const data = await response.json();
    //
    return data;
};

export async function search(username, location_name, operator, price_start, price_end,page) {
    const queryParams = new URLSearchParams({
        q: username,
        location_name,
        operator,
        price_start,
        price_end,
        page,
    });

    const response = await fetch(`${process.env.REACT_APP_API_URL}/realestates_details?${queryParams}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    });

    const data = await response.json();
    return data;
};

export async function fetchRealEstates(page) {
    const queryParams = new URLSearchParams({
        page,
    });
    const response = await fetch(`${process.env.REACT_APP_API_URL}/realestates?${queryParams}`, {
        method: "GET",
        headers: {
        },
    });

    const data = await response.json();
    return data;
};

export async function showRealEstate(id) {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/realestates/${id}`, {
        method: "GET",
        headers: {
        },
    });

    const data = await response.json();
    return data;
};

export async function addRealEstate(name,price,location) {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/realestates/${name}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${token}`
        },
        body: JSON.stringify({name,price,location})
    });

    const data = await response.json();
    return data;
};

export async function deleteRealEstate(id) {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/realestates/${id}`, {
        method: "DELETE",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function updateRealEstate(id,price,location) {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/realestates/${id}/${price}/${location}`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function updateApiRealEstate(id) {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/realestates/${id}/edit/updateapi`, {
        method: "PUT",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function fetchFavorites(page) {
    const queryParams = new URLSearchParams({
        page,
    });
    const response = await fetch(`${process.env.REACT_APP_API_URL}/favorites?${queryParams}`, {
        method: "GET",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function fetchAllFavorites() {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/favorites/all`, {
        method: "GET",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function addFavorite(id) {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/favorites/add/${id}`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function removeFavorite(id) {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/favorites/remove/${id}`, {
        method: "DELETE",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function fetchProfiles() {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/suggested-profiles`, {
        method: "GET",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function showProfile(id) {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/suggested-profiles/${id}`, {
        method: "GET",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function approveProfile(id) {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/suggested-profiles/${id}/approve`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function rejectProfile(id) {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/suggested-profiles/${id}/reject`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function addProfile(username,user_id) {
    const response = await fetch(`${process.env.REACT_APP_API_URL}/suggested-profiles/create/${username}/${user_id}`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function getCoordinates(city) {
    const response = await fetch(`http://api.openweathermap.org/geo/1.0/direct?q=${city}&limit=5&appid=${process.env.REACT_APP_WEATHER_APP_ID}`, {
        method: "GET",
    });

    const data = await response.json();
    return data;
};