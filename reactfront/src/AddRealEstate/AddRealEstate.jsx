import React, { useState, useEffect } from 'react';
import { addRealEstate, fetchProfiles } from '../Api/api';
import './AddRealEstate.css';

function AddRealEstate() {
  const [username, setUsername] = useState('');
  const [location, setLocation] = useState('');
  const [price, setPrice] = useState('');
  const [approvedProfiles, setApprovedProfiles] = useState([]);

  useEffect(() => {
    async function fetchApprovedProfiles() {
      try {
        const profiles = await fetchProfiles();
        const approvedProfiles = profiles.filter(profile => profile.approval === 1);
        setApprovedProfiles(approvedProfiles);
      } catch (error) {
        console.error('Error:', error);
      }
    }

    fetchApprovedProfiles();
  }, []);

  const handleUsernameChange = (event) => {
    setUsername(event.target.value);
  };

  const handleLocationChange = (event) => {
    setLocation(event.target.value);
  };

  const handlePriceChange = (event) => {
    setPrice(event.target.value);
  };

  const handleSubmit = async (event) => {
    event.preventDefault();
    try {
      const response = await addRealEstate(username, price, location);
      setUsername('');
      setLocation('');
      setPrice('');
    } catch (error) {
      console.error('Errors:', error);
    }
  };

  return (
    <div className="add-real-estate-container">
      <div className="add-real-estate-form">
        <h2>Add Real Estate</h2>
        <form onSubmit={handleSubmit}>
          <div>
            <input type="text" placeholder="Username..." value={username} onChange={handleUsernameChange} />
          </div>
          <div>
            <input type="text" placeholder="Location..." value={location} onChange={handleLocationChange} />
          </div>
          <div>
            <input type="text" placeholder="Price..." value={price} onChange={handlePriceChange} />
          </div>
          <button type="submit">Add</button>
        </form>
      </div>

      <div className="add-real-estate-list">
        <h2>Approved Profiles</h2>
        <div className="suggest-profile-cards">
          {approvedProfiles.map(profile => (
            <div key={profile.id} className="suggest-profile-card">
              <h3 className="suggest-profile-card-username">{profile.username}</h3>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}

export default AddRealEstate;
