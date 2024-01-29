import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { login } from '../Api/api.js';
import "./login.css";

function Login() {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [errorMessage, setErrorMessage] = useState('');
    const [loading, setLoading] = useState(false); 

    const handleLogin = async (e) => {
        e.preventDefault();
        setErrorMessage("");
        setLoading(true);

        login(email, password).then((data) => {
            if (data['token']) {
                window.location.reload();
                
            }
            else {
                setErrorMessage(data.message);
            }
            setLoading(false);
        });

        setEmail('');
        setPassword('');
    };

    return (
        <div className="container">
            <div className="content">
                <h2 style={{ fontSize: "35px", color: "grey" }}>LOGIN</h2>
                <form onSubmit={handleLogin}>
                    <div className="form-element">
                        <label htmlFor="email" style={{ marginRight: "10px" }}>Email:</label>
                        <input
                            style={{ height: "25px", width: "250px" }}
                            type="text"
                            id="email"
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                        />
                    </div>
                    <div className="form-element">
                        <label htmlFor="password" style={{ marginRight: "10px" }}>Password:</label>
                        <input
                            style={{ height: "25px", width: "250px", marginRight: "30px" }}
                            type="password"
                            id="password"
                            value={password}
                            onChange={(e) => setPassword(e.target.value)}
                        />
                    </div>
                    <p style={{ color: "red", justifyContent: "center", alignItems: "center" }}>{errorMessage}</p>
                    <button disabled={loading} className="submit" type="submit" style={{ backgroundColor: "green" }}>Login</button>
                    
                    
                </form>
            </div>
        </div>
    );
};

export default Login;