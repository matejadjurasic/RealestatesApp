import React, { useState, useEffect } from 'react';
import { addRealEstate, fetchProfiles } from '../Api/api';

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
      console.error('Erros:', error);
    }
  };

  return (
    <div>
      <h2>Add Real Estate</h2>
      <form onSubmit={handleSubmit}>
        <div>
          <label>
            Username:
            <input type="text" value={username} onChange={handleUsernameChange} />
          </label>
        </div>
        <div>
          <label>
            Location:
            <input type="text" value={location} onChange={handleLocationChange} />
          </label>
        </div>
        <div>
          <label>
            Price:
            <input type="text" value={price} onChange={handlePriceChange} />
          </label>
        </div>
        <button type="submit">Add</button>
      </form>

      <div>
        <h2>Approved Profiles</h2>
        <ul>
          {approvedProfiles.map(profile => (
            <li key={profile.id}>
              <p>Username: {profile.username}</p>
            </li>
          ))}
        </ul>
      </div>
    </div>
  );
}

export default AddRealEstate;
