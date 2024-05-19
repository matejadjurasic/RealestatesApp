import React, { useState} from 'react';
import { useNavigate } from 'react-router-dom';
import { login } from '../Api/api.js';
import "./login.css";

function Login() {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [errorMessage, setErrorMessage] = useState('');
    const [user, setUser] = useState(null);
    const navigate = useNavigate();

    const handleLogin = async (e) => {
        e.preventDefault();
        setErrorMessage("");

        login(email, password).then((data) => {
            if (data['token']) {
                setUser(data['user']);
                console.log("super");
                navigate("/");
                window.location.reload();
            }
            else {
                console.log("bad");
                setErrorMessage("wrong email or password");
                window.location.reload();
            }
        });

        setEmail('');
        setPassword('');
    };

    return (
        <div className="container">
            <div className='login-container'>
                <h2>Login</h2>
                <div className='login-form'>
                <input
                type="text"
                placeholder="Email"
                value={email}
                onChange={(e) => setEmail(e.target.value )}
                />
                <input
                type="password"
                placeholder="Password"
                value={password}
                onChange={(e) => setPassword(e.target.value )}
                />
                <button onClick={handleLogin}>Login</button>
                <p>{errorMessage}</p>
                </div>
            </div>
        </div>
    );
};

export default Login;