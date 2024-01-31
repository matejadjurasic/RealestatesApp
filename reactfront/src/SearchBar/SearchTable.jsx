import React from 'react';
import './searchtable.css';

const SearchTable = () => {
  
  const data = [
    { username: 'JohnDoe', location: 'Belgrade', price: 100000, followersCount: 500 },
    { username: 'abc', location: 'Nis', price: 100000, followersCount: 500 },
    
  ];

  return (
    <div className="container mt-4">
      <h1>Search Results</h1>
      <table className="table">
        <thead>
          <tr>
            <th>Username</th>
            <th>Location</th>
            <th>Price</th>
            <th>Followers Count</th>
          </tr>
        </thead>
        <tbody>
          {data.map((item, index) => (
            <tr key={index}>
              <td>{item.username}</td>
              <td>{item.location}</td>
              <td>${item.price}</td>
              <td>{item.followersCount}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default SearchTable;