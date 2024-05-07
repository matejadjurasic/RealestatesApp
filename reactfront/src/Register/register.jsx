import React, { useState } from 'react';
import { register } from '../Api/api';
import { Link, Navigate, useNavigate } from 'react-router-dom';
import './register.css'; 

export const Register = () => {

    const [username, setUsername] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [errorMessage, setErrorMessage] = useState('');
    const [confirmPassword, setConfirmPassword] = useState('');
    const navigate = useNavigate();

    const handleRegister = async (e) => {
        e.preventDefault();
        setErrorMessage("");

        register(username, email, password,confirmPassword).then((data) => {
            if (data['token']) {
                console.log("super");
                navigate("/login");
                window.location.reload();
            }else{
                setErrorMessage("Greska pri registraciji");
            }
        });

        setUsername('');
        setEmail('');
        setPassword('');
        setConfirmPassword('');
    };


  return (
    <div className="register-container"> 
            <h2>Register</h2>
            <input
            type="text"
            placeholder="Username"
            value={username}
            onChange={(e) => setUsername(e.target.value )}
            />
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
            <input
            type="password"
            placeholder="Confirm Password"
            value={confirmPassword}
            onChange={(e) => setConfirmPassword(e.target.value )}
            />
            <button className="register-button" onClick={handleRegister}>Register</button> 
            <p className="error-message">{errorMessage}</p> 
    </div>
  )
}

export default Register;
