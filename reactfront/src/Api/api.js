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
    if (data['token']) localStorage.setItem("token", data['access_token']);
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