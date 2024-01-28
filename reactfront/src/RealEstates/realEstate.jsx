
import React from 'react';


const RealEstate = ({ realEstate }) => {
  const {
    id,
    username,
    profile_picture_url,
    description,
    location,
    follows_count,
    followers_count,
    price,
  } = realEstate;

  return (
    <div>
      <h2>{username}'s Real Estate</h2>
      <img src={profile_picture_url} alt={`${username}'s profile`} style={{ maxWidth: '200px' }} />
      <p>Description: {description}</p>
      <p>Location: {location}</p>
      <p>Follows: {follows_count}</p>
      <p>Followers: {followers_count}</p>
      <p>Price: ${price}</p>
      <button>Show</button>
    </div>
  );
};

export default RealEstate;
