const token = localStorage.getItem("token");

export async function login(email, password) {
    const response = await fetch(`http://localhost:8000/api/login`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
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

export async function register(name, email, password, password_confirmation) {
    const response = await fetch('http://localhost:8000/api/register', {
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
    const response = await fetch('http://localhost:8000/api/logout', {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    localStorage.removeItem("token");
    return data;
};

export async function reset(email, password_new) {
    const response = await fetch(`http://localhost:8000/api/reset`, {
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

    const response = await fetch(`http://localhost:8000/api/realestates_details?${queryParams}`, {
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
    const response = await fetch(`http://localhost:8000/api/realestates?${queryParams}`, {
        method: "GET",
        headers: {
        },
    });

    const data = await response.json();
    return data;
};

export async function showRealEstate(id) {
    const response = await fetch(`http://localhost:8000/api/realestates/${id}`, {
        method: "GET",
        headers: {
        },
    });

    const data = await response.json();
    return data;
};

export async function addRealEstate(name,price,location) {
    const response = await fetch(`http://localhost:8000/api/realestates/${name}`, {
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
    const response = await fetch(`http://localhost:8000/api/realestates/${id}`, {
        method: "DELETE",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function updateRealEstate(id,price,location) {
    const response = await fetch(`http://localhost:8000/api/realestates/${id}/${price}/${location}`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function updateApiRealEstate(id) {
    const response = await fetch(`http://localhost:8000/api/realestates/${id}/edit/updateapi`, {
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
    const response = await fetch(`http://localhost:8000/api/favorites?${queryParams}`, {
        method: "GET",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function fetchAllFavorites() {
    const response = await fetch('http://localhost:8000/api/favorites/all', {
        method: "GET",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function addFavorite(id) {
    const response = await fetch(`http://localhost:8000/api/favorites/add/${id}`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function removeFavorite(id) {
    const response = await fetch(`http://localhost:8000/api/favorites/remove/${id}`, {
        method: "DELETE",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function fetchProfiles() {
    const response = await fetch('http://localhost:8000/api/suggested-profiles', {
        method: "GET",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function showProfile(id) {
    const response = await fetch(`http://localhost:8000/api/suggested-profiles/${id}`, {
        method: "GET",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function approveProfile(id) {
    const response = await fetch(`http://localhost:8000/api/suggested-profiles/${id}/approve`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function rejectProfile(id) {
    const response = await fetch(`http://localhost:8000/api/suggested-profiles/${id}/reject`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function addProfile(username,user_id) {
    const response = await fetch(`http://localhost:8000/api/suggested-profiles/create/${username}/${user_id}`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${token}`
        },
    });

    const data = await response.json();
    return data;
};

export async function getCoordinates(city) {
    const response = await fetch(`http://api.openweathermap.org/geo/1.0/direct?q=${city}&limit=5&appid=752667ff0ad1f03d7abff59e2f700d4b`, {
        method: "GET",
    });

    const data = await response.json();
    return data;
};