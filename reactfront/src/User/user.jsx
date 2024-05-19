import React, { useState, useEffect } from 'react';
import { getUser, reset } from '../Api/api';
import './user.css';

export const User = () => {
  const [user, setUser] = useState([]);
  const [newPassword, setNewPassword] = useState('');
  const [successMessage, setSuccessMessage] = useState('');
  const [errorMessage, setErrorMessage] = useState('');

  useEffect(() => {
    const fetchUser = async () => {
      try {
        const data = await getUser();
        setUser(data);
      } catch (error) {
        console.error('Error fetching user:', error);
      }
    };

    fetchUser();
  }, []);

  const resetPassword = async () => {
    try {
      await reset(user.email, newPassword);
      setSuccessMessage('Password successfully reset.');
      setNewPassword('');
    } catch (error) {
      console.error('Error resetting password:', error);
      setErrorMessage('Failed to reset password.');
    }
  };

  return (
    <div className="container">
      <div className="user-container">
        <h1>My Profile</h1>
        <p>Username: {user.name}</p>
        <p>Email: {user.email}</p>
        <p>Number of favorites: {user.favorite}</p>
        <input
          type="text"
          placeholder="Set new password..."
          value={newPassword}
          onChange={(e) => setNewPassword(e.target.value)}
        />
        <button onClick={resetPassword}>Reset Password</button>
        {successMessage && <p className="success-message">{successMessage}</p>}
        {errorMessage && <p className="error-message">{errorMessage}</p>}
      </div>
    </div>
  );
};

export default User;
